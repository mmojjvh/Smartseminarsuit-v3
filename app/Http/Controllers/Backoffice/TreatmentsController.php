<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\ITreatmentsRepository;

//Request Validator
use App\Http\Requests\Backoffice\AppointmentRequest;

//Global Classes
use Input, DB;

class TreatmentsController extends Controller
{
    //Do some magic
    public function __construct(ITreatmentsRepository $repo, ICRUDService $CRUDservice, IServicesRepository $serviceRepo){
        $this->data = [];
        $this->repo = $repo;
        $this->serviceRepo = $serviceRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Treatments';
    }

    public function create($id){
        $crudData = $this->repo->saveData($id);
        if(!$crudData){
            return redirect()->back();
        }
        return redirect()->route('backoffice.patients.view_treatment', $crudData->id);
    }

    public function view($id){
        $this->data['services'] = $this->serviceRepo->fetch();
        $this->data['treatment'] = $this->repo->findOrFail($id);
        $this->data['treatments'] = $this->repo->fetchTreatments($id);
        return view('backoffice.pages.patients.treatments', $this->data);
    }

    public function save(Request $request, $id){
        $crudData = $this->repo->saveTreatment($request, $id);
        return redirect()->back();
    }
}
