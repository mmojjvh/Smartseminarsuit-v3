@extends('frontend.web._layouts.main',['header' => false])

@push('content')
@include('frontend.web._sections.banner')
@include('commons.chatbot')
@endpush
@push('js')
    <script src="{{asset('pages/js/moment.js')}}"></script>
    <script src="{{asset('pages/js/chat.js')}}"></script>
    <script type="module" src="{{asset('pages/js/firebase-chat.js')}}"></script>
@endpush

@push('css')
<link class="main-stylesheet" href="{{asset('pages/css/chat.css')}}" rel="stylesheet" type="text/css" />
@endpush
