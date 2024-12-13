<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Domain\Interfaces\Repositories\Backoffice\IEventsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\ICertificatesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IParticipantsRepository;

use App\Models\Backoffice\Coordinator;

use App\Logic\DalleAIGenerator;
use App\Logic\EmailSender;
use App\Logic\QRCode\QRCodeMaker;

use Input, App, PDF;

class CertificateController extends Controller
{
    public function __construct(IEventsRepository $eventRepo, ICertificatesRepository $certRepo, IParticipantsRepository $userRepo){
        $this->data = [];
        $this->certRepo = $certRepo;
        $this->eventRepo = $eventRepo;
        $this->userRepo = $userRepo;
    }

    public function index(){
        $this->data['certificates'] =  $this->certRepo->fetch();
        return view('backoffice.pages.certificates.index',$this->data);
    }

    public function getPayload($payload){
        $result = [];
        $result["prompt"] = isset($payload["prompt"]) ? $payload["prompt"] : "";
        $result["cfheading"] = isset($payload["cfheading"]) ? $payload["cfheading"] : "";
        $result["cftitle"] = isset($payload["cftitle"]) ? $payload["cftitle"] : "";
        $result["cftext"] = isset($payload["cftext"]) ? $payload["cftext"] : "";
        $result["cfquotes"] = isset($payload["cfquotes"]) ? $payload["cfquotes"] : "";
        $result["cfheadingcolor"] = isset($payload["cfheadingcolor"]) ? $payload["cfheadingcolor"] : "";
        $result["cftitlecolor"] = isset($payload["cftitlecolor"]) ? $payload["cftitlecolor"] : "";
        $result["cftextcolor"] = isset($payload["cftextcolor"]) ? $payload["cftextcolor"] : "";
        $result["cfquotescolor"] = isset($payload["cfquotescolor"]) ? $payload["cfquotescolor"] : "";
        return $result;
    }
    
    public function genCert($id, Request $request){

        $baseUrl = $request->root();
        $payload = $request->session()->get('data');

        $payload2 = $this->getPayload($payload);

        //custom styles
        $customStyles = [];
        $customStyles["heading"] = $payload2["cfheading"];
        $customStyles["title"] = $payload2["cftitle"];
        $customStyles["text"] = $payload2["cftext"];
        $customStyles["quotes"] = $payload2["cfquotes"];
        $customStyles["heading_color"] = $payload2["cfheadingcolor"];
        $customStyles["title_color"] = $payload2["cftitlecolor"];
        $customStyles["text_color"] = $payload2["cftextcolor"];
        $customStyles["quotes_color"] = $payload2["cfquotescolor"];

        // $ai_bg = $this->generateCertificateBackground($prompt);
        // $base64_background = "data:image/png;base64,".$ai_bg;
        $ai_background = $payload["backgroundimage"];
        
        $useTemplate = 0;
        if(isset($payload["use_template"]) && $payload["use_template"] == "true"){
            $useTemplate = 1;
        }

        $event = $this->eventRepo->findOrFail($id);
        $title = $payload["cert_title"];
        $description = $payload["cert_desc"];
        $data['title'] = 'Certificate of Completion for '.$event->name.' Participants ';
        // $data['certCat'] = $event->certCat;
        $key = array_rand(__('quotes'));
        $data['quote'] = __('quotes')[$key];
        $data['background_image'] = $ai_background;
        $data['certificates'] = [];
        $check = $this->certRepo->fetch($id);

        if($check->count() == 0){            
            $data['certificates'] = $this->certRepo->generateCertificate($event, $data['quote'], $ai_background, $customStyles, $useTemplate, $title, $description);
        }else{

            //update background to new generated
            $data['certificates'] = $this->certRepo->updateAndFetch($id, $ai_background, $customStyles, $useTemplate, $title, $description);
            // $data['certificates'] = $this->certRepo->fetch($id);
        }

        $qrCodes = [];
        foreach ($data['certificates'] as $certificate) {
            $qrData = $baseUrl.'/backoffice/cert/auth/' . $certificate->certificate_id;
            $qrCodeData = QRCodeMaker::qrcode($qrData);
            $qrCodes[$certificate->id] = $qrCodeData;
        }

        foreach ($data['certificates'] as $certificate) {
            $certificate->qrcode = $qrCodes[$certificate->id];
        }

        // Event Coordinators
        $coordinators = $this->certRepo->getCoordinators($id);
        $data['coordinators'] = $coordinators;

        // $pdf = PDF::loadView('pdf.ai.all', compact('data'))->setPaper('A4', 'landscape')->stream();
        
        return view('pdf.ai.all', compact('data'));
        // return $pdf;
    }

    public function view($id, Request $request){

        $baseUrl = $request->root();
        $certificate = $this->certRepo->getCertificate($id);
        if(!$certificate){
            return abort(404);
        }
        $data['title'] = 'Certificate of Completion for '.$certificate->event_name.' Participants ';

        $qrData = $baseUrl .'/backoffice/cert/auth/' . $certificate->certificate_id;
        $certificate['qrcode'] = QRCodeMaker::qrcode($qrData);

        // Event Coordinators
        $coordinators = $this->certRepo->getCoordinators($certificate->event_id);
        $data['coordinators'] = $coordinators;

        $data['certificate'] = $certificate;

        // $pdf = PDF::loadView('pdf.ai.view', compact('data'))->setPaper('A4', 'landscape')->stream();

        return view('pdf.ai.view', compact('data'));
        // return $pdf;
    }

    public function verifyCertificate($id){
        $certificate = $this->certRepo->getCertificate($id);
        if(!$certificate){
            return abort(404);
        }
        $data['title'] = 'Certificate of Completion for '.$certificate->event_name.' Participants ';
        $data['certificate'] = $certificate;
        return view('backoffice.cert.auth.index', compact('data'));
    }


    // Used when submitting the AI prompt form
    public function getCertificatePrompt(Request $request){
        $data = $request->all();
        return redirect()->route('backoffice.events.generate_certificate', $data["id"])->with('data', $data);
    }

    public function distributeCertificate(Request $request){

        $data = $request->all();

        if(isset($data["fileDataURI"]) && isset($data["emails"])){
            
            $emails = $data["emails"];
            $pdfdoc = $data['fileDataURI'];
            $b64file = trim( str_replace('data:application/pdf;filename=generated.pdf;base64,', '',$pdfdoc));
            $b64file = str_replace(' ', '+',$b64file);
            $decoded_pdf = base64_decode($b64file);

            $status = EmailSender::send($emails, $decoded_pdf);
            
            if($status){
                return "Email Sent!";
            }else{
                return "Unable to send email. Try again later";
            }
        }else{
            echo json_encode($data);
        }

    }

    public function generateCertificate(Request $request){
        $data = $request->all();
        $result = "";
        if(isset($data["prompt"])){
            $prompt = $data["prompt"];
            $result = DalleAIGenerator::generate($prompt);
        }
        return $result;
    }

}
