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

        @media print {
            /* Hide non-essential elements */
            body * {
                visibility: hidden;
            }
            .printable-area, .printable-area * {
                visibility: visible;
            }
            .printable-area {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

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
            background-blend-mode: darken;
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
            background-blend-mode: darken;
        }
        .content{
            padding: 0cm;
            background-color: floralwhite;
            background-blend-mode: revert-layer;
        }
        .inner-container{
            /*position: absolute;
            align-content: center;
            align-items: center;
            text-align: center;
            margin-left: calc(100vw / 3.2);*/
            display: flex; flex-direction: row; align-items: center; justify-content: center;
            margin-top: -30px;
        }
        .cert-title{
            font-size: 45pt;
            margin-top: 40pt;
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
        }
        .underline{
            margin-top: -50px;
        }
        table{
            width: 100%;
            /* border: 1px solid red; */
            padding-top: 75px;
        }
        .pt{
            margin-top: 100px;
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
/*  display: none;*/
}

.qrcode-container {
  display: flex; flex-direction: row; align-items: flex-end; justify-content: flex-end;
  margin-top: 5pt;
  align-content: flex-end;
  align-self: flex-end;
  text-align: right;
}

.qrcode-container img {
  width: 100px;
  height: 100px;
}

.spacer {
    color: transparent;
    width: 150px;
}

    </style>
</head>
<body>

<!-- <div id="loaderContainer" class="loader-container text-center">
  <div class="loader"></div>
  <br>
  <label class="text-center loader-text text-gray ps-10">Generating Certificates</label>
</div> -->

<div id="pageBody" class="page-body">

@foreach($data['certificates'] as $index => $certificate)
<div class="content overlay {{ $loop->last?'':'page-break' }}" 
    style="background-image: url(
    <?php 
        if($data["background_image"] != ''){
            echo $data["background_image"];
        }else{
            echo $certificate->background_image;
        }
     ?>
    );background-color: lightgray;">

    <div class="qrcode-container" data-cert="{{ $certificate }}">
      <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"> -->
      <img src="{{ $certificate->qrcode }}">
    </div>

    <div class="inner-container">
        <div class="text-center">
        <h1 class="cert-title">CERTIFICATE</h1>
        <h2 class="certificate-content">OF COMPLETION</h2>
        <p>IS PRESENTED TO:</p>
        <h1 class="participant-name">{{ $certificate->user_name }}</h1>
        <p class="underline">___________________________________________________________</p>
        <p>For completing the <strong>{{ $certificate->category }}</strong> with the event <br>
        title of "<strong>{{ Str::title($certificate->event_name) }}</strong>" that was held on <strong>{{$certificate->date?date('M d, Y', strtotime($certificate->date)):'---'}}.</strong></p>
        <br>
        <p>" {!!$certificate->quote!!} "</p>
        <table>
            <tr class="">
                <td class="text-center "></td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <td class="text-center spacer">&nbsp;</td>
                <!-- <td class="text-center "><strong>{{$certificate->date?date('m-d-Y', strtotime($certificate->date)):'---'}}</strong></td> -->
                <td class="text-center spacer">
                  <!-- <img id="signature" src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="Signature" style="width: 220px; height: 70px;z-index: 1;margin-top: 15px;"> -->
                  <img id="signature" src="{{ $certificate->user_signature }}" alt="Signature" style="width: 220px; height: 70px;z-index: 1;margin-top: 15px;">
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
@endforeach
</div>

  <!-- <canvas id="certificateCanvas" width="1024" height="1024"></canvas> -->

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

    <script>
        
      // Set up your OpenAI API key
// const openaiApiKey = 'sk-proj-1R615hAmPdPe1f3L0pzzT3BlbkFJkMhIgu2vWB6qBxHfx8Kb';

// Define your prompt for DALL-E 2

//FOR CRAPPY GENERATION
// const prompt = `A high-quality background image for an event certificate with a blue border and a small gold seal, add a heading on top 'CERTIFICATE' and 'OF COMPLETION' under, do not use light colors`;

const prompt = `A high-quality background image for an event certificate with a blue border and a small gold seal, use light colors and gradients`;

async function generateCertificateBackground() {
  try {

    const corsBypasser = 'https://cors-anywhere.herokuapp.com/';
    const response = await fetch('https://api.openai.com/v1/images/generations', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${openaiApiKey}`,
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          prompt: prompt,
          n: 1,
          quality: 'hd',
          style: 'natural',
          size: "1024x1024"
        })
      });

        const data = await response.json();
        // const imageUrl = corsBypasser + data.data[0]?.url || '';
        const imageUrl = data.data[0]?.url || '';
        return imageUrl;

    } catch (error) {
        console.error('Error generating certificate background:', error);
    }
}

async function generateCertificatex() {
    const name = document.getElementById('name').value;
    const date = document.getElementById('date').value;

    if (!name || !date) {
        alert('Please enter both name and date.');
        return;
    }

    const backgroundUrl = await generateCertificateBackground();
    const signatureImage = document.getElementById('signature');

    const canvas = document.getElementById('certificateCanvas');
    const ctx = canvas.getContext('2d');

    const background = new Image();
    background.crossOrigin = "Anonymous";  // To avoid CORS issues
    background.onload = () => {
        ctx.drawImage(background, 0, 0, canvas.width, canvas.height);

        // Customize font and positions for name and date
        ctx.font = '40px Arial';
        ctx.fillStyle = 'black';

        const nameX = 400;  // X position for name
        const nameY = 600;  // Y position for name
        ctx.fillText(name, nameX, nameY);

        const dateX = 400;  // X position for date
        const dateY = 700;  // Y position for date
        ctx.fillText(date, dateX, dateY);

        // Add the e-signature
        const signatureWidth = 200;  // Adjust the width as needed
        const signatureHeight = 100;  // Adjust the height as needed
        const signatureX = 400;  // X position of the signature
        const signatureY = 750;  // Y position of the signature
        ctx.drawImage(signatureImage, signatureX, signatureY, signatureWidth, signatureHeight);
    };

    background.src = backgroundUrl;
}


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
    setTimeout(() => {
        document.getElementById("loaderContainer").style.display = 'none';
        document.getElementById("pageBody").style.display = 'block';
        window.print();
    }, 300)
  }

  // onload();

    </script>
</body>
</html>