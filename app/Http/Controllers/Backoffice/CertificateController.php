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
    
    public function genCert($id, Request $request){

        $baseUrl = $request->root();
        $payload = $request->session()->get('data');
        $prompt = $payload["prompt"];

        //custom styles
        $customStyles = [];
        $customStyles["heading"] = $payload["cfheading"];
        $customStyles["title"] = $payload["cftitle"];
        $customStyles["text"] = $payload["cftext"];
        $customStyles["quotes"] = $payload["cfquotes"];
        $customStyles["heading_color"] = $payload["cfheadingcolor"];
        $customStyles["title_color"] = $payload["cftitlecolor"];
        $customStyles["text_color"] = $payload["cftextcolor"];
        $customStyles["quotes_color"] = $payload["cfquotescolor"];

        // $ai_bg = $this->generateCertificateBackground($prompt);
        // $base64_background = "data:image/png;base64,".$ai_bg;

        $ai_background = DalleAIGenerator::generate($prompt);

        $event = $this->eventRepo->findOrFail($id);
        $data['title'] = 'Certificate of Completion for '.$event->name.' Participants ';
        // $data['certCat'] = $event->certCat;
        $key = array_rand(__('quotes'));
        $data['quote'] = __('quotes')[$key];
        $data['background_image'] = $ai_background;
        $data['certificates'] = [];
        $check = $this->certRepo->fetch($id);

        if($check->count() == 0){
            $data['certificates'] = $this->certRepo->generateCertificate($event, $data['quote'], $ai_background, $customStyles);
        }else{

            //update background to new generated
            $data['certificates'] = $this->certRepo->updateAndFetch($id, $ai_background, $customStyles);
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

}
