<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IFAQsRepository;

//Request Validator
use App\Http\Requests\Backoffice\FAQsRequest;

//Global Classes
use Input;

class FAQsController extends Controller
{
    //Do some magic
    public function __construct(IFAQsRepository $repo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'FAQs';
        $this->data['faq'] = null;
    }

    public function index(){
        $this->data['faqs'] = $this->repo->fetch();
        return view('backoffice.pages.faqs.index',$this->data);
    }

    public function create(){
        return view('backoffice.pages.faqs.create',$this->data);
    }

    public function store(FAQsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.faqs.index',$this->data);
    }

    public function edit($id){
        $this->data['faq'] = $this->repo->findOrFail($id);
        if(!$this->data['faq']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.faqs.index');
        }
        return view('backoffice.pages.faqs.edit', $this->data);
    }

    public function update($id, FAQsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.faqs.index');
    }
}
