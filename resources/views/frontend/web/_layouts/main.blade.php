<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="{{asset('web/cdn-cgi/apps/head/8jwJmQl7fEk_9sdV6OByoscERU8.js')}}"></script>
    <link rel="apple-touch-icon" href="{{asset('web/pages/ico/60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('web/pages/ico/76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('web/pages/ico/120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('web/pages/ico/152.png')}}">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="description"  content=""/>
    <meta name="author"  content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auto-reply-url" content="{{ route('backoffice.auth.autoReply') }}">
    <meta name="user-id" content="{{ auth()->check()?auth()->user()->id:'0' }}">
    @include('frontend.web._includes.styles')
    @stack('css')

</head>
<body class="pace-dark">
    @include('frontend.web._components.nav',['header' => $header])
    <div class="{{$header?'p-t-60':''}}">
    @stack('content')
    </div>
    @include('frontend.web._components.footer')
    @include('frontend.web._components.search')
    @include('frontend.web._includes.scripts')
    @stack('js')
    <!-- Start of ChatBot (www.chatbot.com) code -->
    <!-- <script type="text/javascript">
        window.__be = window.__be || {};
        window.__be.id = "6511cea34b44160007c17704";
        (function() {
            var be = document.createElement('script'); be.type = 'text/javascript'; be.async = true;
            be.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.chatbot.com/widget/plugin.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(be, s);
        })();
    </script>
    <noscript>You need to <a href="https://www.chatbot.com/help/chat-widget/enable-javascript-in-your-browser/" rel="noopener nofollow">enable JavaScript</a> in order to use the AI chatbot tool powered by <a href="https://www.chatbot.com/" rel="noopener nofollow" target="_blank">ChatBot</a></noscript> -->
    <!-- <script src="https://chatrace.com/webchat/plugin.js"></script><script>ktt10.setup({"pageId":"1906593","headerTitle":"Dental Clinic","color":"#006dff"});</script> -->
    <!-- End of ChatBot code -->
</body>
</html>
