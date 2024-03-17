<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;

//Request Validator
use App\Http\Requests\Backoffice\ServicesRequest;
use App\Http\Requests\Backoffice\ServiceTypesRequest;

//Global Classes
use Input;

class ServicesController extends Controller
{
    //Do some magic
    public function __construct(IServicesRepository $repo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Services';
        $this->data['service'] = null;
        $this->data['types'] = [
            'ordinary_denture' => 'Ordinary Denture',
        ];
    }

    public function index(){
        $this->data['services'] = $this->repo->fetch();
        return view('backoffice.pages.services.index',$this->data);
    }

    public function create(){
        return view('backoffice.pages.services.create',$this->data);
    }

    public function store(ServicesRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.services.edit',$crudData->id);
    }

    public function edit($id){
        $this->data['service'] = $this->repo->findOrFail($id);
        $this->data['serviceTypes'] = $this->repo->serviceTypes($id);
        if(!$this->data['service']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.services.index');
        }
        return view('backoffice.pages.services.edit', $this->data);
    }

    public function update($id, ServicesRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.services.edit',$crudData->id);
    }

    public function addType($id){
        $this->data['service'] = $this->repo->findOrFail($id);
        $this->data['serviceType'] = null;
        return view('backoffice.pages.services.type', $this->data);
    }

    public function saveType(ServiceTypesRequest $request){
        $type =  $this->repo->saveType($request);
        return redirect()->route('backoffice.services.edit', $type->service_id);
    }

    public function editType($id){
        $this->data['serviceType'] = $this->repo->findServiceType($id);
        $this->data['service'] = $this->repo->findOrFail($this->data['serviceType']->service_id);
        return view('backoffice.pages.services.type_edit', $this->data);
    }

    public function updateType(ServiceTypesRequest $request){
        $type =  $this->repo->saveType($request);
        return redirect()->route('backoffice.services.edit', $type->service_id);
    }

    public function deleteType($id){
        $this->repo->deleteType($id);
        return redirect()->back();
    }

    public function serviceTypes(){
        $data['datas'] = $this->repo->serviceTypes(Input::get('_id'));
        return response()->json($data,200); 
    }

    public function serviceTypeDetail(){
        $data['datas'] = $this->repo->findServiceType(Input::get('_id'));
        return response()->json($data,200); 
    }
}
