<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('images/favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('images/favicons/ms-icon-144x144.png')}}">
    <title>{{$data['title']}}</title>
    <style>
        .page-break {
  page-break-after: always;
}

@page {
  margin-top:0;
  margin-bottom:0;
  margin-left:0;
  margin-right:0;
  padding: 0;
}

body {
  font-family: helvetica !important;
  font-size: 10pt;
  position: relative;
}

.overlay {
  top: 0;
  left: 0;
  height: 780px;
  width: 100%;
  background-position: center top;
  background-repeat: repeat;
  background-size: cover;
  z-index: -1;
}

.content{
  padding: 0cm;
  background-color: rgba(0, 0, 0, 1);
  background-blend-mode: color;
  mix-blend-mode: difference;

}

.inner-container{
  display: flex; flex-direction: row; align-items: center; justify-content: center;
  margin-top: -77.5px;
  margin-left: 2.5%;
  width: 90%;
  padding: 30px;
  border-radius: 30px;
  background-color: rgba(255, 255, 255, 0.97);
  background-blend-mode: color;
  border: 2px solid green;
}

.cert-title{
  font-size: 60pt;
  margin-top: 0pt;
  color: #25b09b;
}

.text-center{
  text-align: center;
}

.certificate-content{
  line-height: 10px; 
  margin-top: -30px;

}
.participant-name{
  font-size: 35pt;
  font-style: italic; 
  font-family: cursive;
  color: #25b09b;
}

.underline{
  margin-top: -40px;
}

table{
  width: 100%;
  /* border: 1px solid red; */
  padding-top: 20px;
}

.pt{
  margin-top: 90px;
  height: 50px;
}

/* HTML: <div class="loader"></div> */
.loader {
  width: 60px;
  aspect-ratio: 1;
  display: grid;
  margin-left: 47.5%;
}

.loader::before,
.loader::after {    
  content:"";
  grid-area: 1/1;
  --c:no-repeat radial-gradient(farthest-side,#25b09b 92%,#0000);
  background: 
  var(--c) 50%  0, 
  var(--c) 50%  100%, 
  var(--c) 100% 50%, 
  var(--c) 0    50%;
  background-size: 12px 12px;
  animation: l12 1s infinite;
}

.loader::before {
  margin: 4px;
  filter: hue-rotate(45deg);
  background-size: 8px 8px;
  animation-timing-function: linear
}

@keyframes l12 { 
  100%{transform: rotate(.5turn)}
}

.loader-container {
  margin-top: 25%;
  display: none;
}

.qrcode-container {
  display: flex; flex-direction: row; align-items: flex-end; justify-content: flex-end;
  margin-top: 0pt;
  align-content: flex-end;
  align-self: flex-end;
  text-align: right;
  z-index: 2;
}

.qrcode-container img {
  width: 90px;
  height: 90px;
  background-color:#fff;
  margin-right:20px;
  margin-top:22px;
}

.spacer {
  color: transparent;
  width: 150px;
}
    </style>
</head>
<body>

<div id="pageBody" class="page-body">

<div class="content overlay" 
    style="background-image: url({!! $data['certificate']->background_image !!})">

    <div class="qrcode-container" data-cert="{{ $data['certificate'] }}"> 
      <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"> -->
      <img src="{{ $data['certificate']->qrcode }}">
    </div>

    <div class="inner-container">
        <div class="text-center">
        <h1 class="cert-title">CERTIFICATE</h1>
        <h2 class="certificate-content" style="font-size: 18pt;">OF COMPLETION</h2>
        <p style="font-size: 14pt;">IS PRESENTED TO:</p>
        <br /><br />
        <h1 class="participant-name">{{ $data['certificate']->user_name }}</h1>
        <p class="underline">___________________________________________________________</p>
        <p style="font-size: 13pt;text-align: center;">For completing the <strong>{{ $data['certificate']->category }}</strong> with the event <br>
        title of "<strong>{{ Str::title($data['certificate']->event_name) }}</strong>" that was held on <strong>{{$data['certificate']->date?date('M d, Y', strtotime($data['certificate']->date)):'---'}}.</strong></p>
        <p style="font-size: 12pt;">" {!!$data['certificate']->quote!!} "</p>
        <table>
            <tr class="">
                <td class="text-center "></td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">
                <img id="signature" src="{{ $data['certificate']->user_signature }}" alt="Signature" style="width: 250px; height: 90px;z-index: 1;margin-top: 20px;">
                </td>
                <td class="text-center spacer">&nbsp;</td>
            </tr>
            <tr class="">
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center ">______________________________</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center ">______________________________</td>
                <td class="text-center spacer">&nbsp;</td>
            </tr>
            <tr class="">
                <td class="text-center "></td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center "></td>
            </tr>
            <tr class="">
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center ">Coordinator</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center ">Signature</td>
                <td class="text-center spacer">&nbsp;</td>
            </tr>
        </table>
    </div>
    </div>
    <br><br><br>
</div>

</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">
    
    async function generateQRCode() {
        await $(".qrcode-container").map((i, item) => {
            let data = $(item).data("cert");
            console.log(data);

            var qr = qrcode(0, 'H');
            qr.addData(`${window.location.origin}/backoffice/cert/auth/${data.certificate_id}`);
            qr.make();
            $(item).html(qr.createImgTag());
        });
    }

    const onload = async function() {

        const getQRCode = await generateQRCode();

        Promise.all([getQRCode]).then((values) => {
          document.getElementById("loaderContainer").style.display = 'none';
          document.getElementById("pageBody").style.display = 'block';
          window.print();
        }); 
    }
    // onload();

</script>
</body>
</html>