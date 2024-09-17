<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{public_path('images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{public_path('images/favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{public_path('images/favicons/ms-icon-144x144.png')}}">
    <title>{{$data['title']}}</title>

    <link rel="stylesheet" type="text/css" href="{{ public_path('custom/certificate.css') }}" >
</head>
<body>

<div id="pageBody" class="page-body">

@foreach($data['certificates'] as $index => $certificate)

<div id="pageBody" class="certificate background {{ $loop->last?'':'page-break' }}" 
  style="background-image: url(
    <?php 
        if($data["background_image"] != ''){
            echo $data["background_image"];
        }else{
            echo $certificate->background_image;
        }
     ?>
    );background-color: lightgray;">

  <br /><br />
  <div class="main">

    <div class="header row">
      <div class="col">
        <img src="{{ public_path('images/psu-logo.png') }}" style="width: 55px;height: 55px;" />
        <img src="{{ public_path('images/logo-long.png') }}" style="width: 150px;height: 35ßpx;margin-bottom:10px;" />
        <img class="qrcode float-right" src="{{ $certificate->qrcode }}" style="width: 100px;height: 100px;" />
      </div>
    </div>

    <center class="content">
      <h1>CERTIFICATE OF COMPLETION</h1>
      <label>IS PRESENTED TO:</label>

      <br /><br />

      <h2>{{ $certificate->user_name }}</h2>
      <hr class="large" />
      <br />

      <p class="details">For completing the <strong>{{ $certificate->category }}</strong> with the event <br>
      title of "<strong>{{ Str::title($certificate->event_name) }}</strong>" that was held on <strong>{{$certificate->date?date('M d, Y', strtotime($certificate->date)):'---'}}.</strong></p>
      <br />
      <p class="quote">" {!!$certificate->quote!!} "</p>

    </center>

    <br /><br />
    <div>
      <table>
        <tbody>
          <tr>
            <td></td>
            <td class="col-200"></td>
            <td></td>
            <td class="col-200">
              <img class="" src="{{ $certificate->user_signature }}" />
            </td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td class="underline-top">Coordinator</td>
            <td></td>
            <td class="underline-top">Signature</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>


</div>
@endforeach
</div>
</body>
</html>