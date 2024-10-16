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

  <div id="pageBody" class="certificate background" style="background: url({!! $data['certificate']->background_image !!});"> 
    <br /><br />
    <div class="main">

      <div class="header row">
        <div class="col">
          <img src="{{ public_path('images/psu-logo.png') }}" style="width: 55px;height: 55px;" />
          <img src="{{ public_path('images/logo-long.png') }}" style="width: 150px;height: 35ßpx;margin-bottom:10px;" />
          <img class="qrcode float-right" src="{{ $data['certificate']->qrcode }}" style="width: 100px;height: 100px;" />
        </div>
      </div>

      <center class="content">
        <h1>CERTIFICATE OF COMPLETION</h1>
        <label>IS PRESENTED TO:</label>

        <br /><br />

        <h2>{{ $data['certificate']->user_name }}</h2>
        <hr class="large" />
        <br />

        <p class="details">For completing the <strong>{{ $data['certificate']->category }}</strong> with the event
        title of "<strong>{{ Str::title($data['certificate']->event_name) }}</strong>" that was held on <strong>{{$data['certificate']->date?date('M d, Y', strtotime($data['certificate']->date)):'---'}}.</strong></p>
        <br />
        <p class="quote">" {!!$data['certificate']->quote!!} "</p>

      </center>

      <div>
        
        <table class="signatures-table">
          <tr>
            <td>
              <!-- <img class="" src="{{ $data['certificate']->user_signature }}" /> -->
              <br>
              <span class="name">John Dela Cruz</span>
              <div class="signature-line"></div>
              <br>     
              <span class="role">Recipient</span>                                 
            </td>

            <!-- Loop through the coordinators -->
            @foreach ($data['coordinators'] as $coordinator)
              <td>
                <img class="" src="{{ $coordinator->signature }}" />
                <br>
                <span class="name">{{ $coordinator->name }}</span>
                <div class="signature-line"></div>
                <br>
                <span class="role">Coordinator</span>                        
              </td>
            @endforeach
          </tr>
        </table>

      </div>

    </div>
  
  </div>

</body>
</html>