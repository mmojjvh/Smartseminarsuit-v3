<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;

use App\Domain\Interfaces\Repositories\Backoffice\IFAQsRepository;

//Repositories

class PageController extends Controller
{
    public function __construct(IFAQsRepository $repo){
        $this->data = [];
        $this->repo = $repo;
    }

    public function index(){
        $this->data['faqs'] = $this->repo->fetch();
        return view('frontend.web.index',$this->data);
    }
}
