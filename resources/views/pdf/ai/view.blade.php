<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{URL::asset('images/favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{URL::asset('images/favicons/ms-icon-144x144.png')}}">
    <title>{{$data['title']}}</title>

    @include('commons.customfonts')
    <link rel="stylesheet" href="{{ URL::asset('custom/customfonts.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('custom/certificate.css') }}" >

</head>
<body>

  <div id="pageBody" class="certificate background" style="
    background: url({!! $data['certificate']->use_template == 1 ? URL::asset($data['certificate']->background_image) : $data['certificate']->background_image !!});
    background-size: 100% 100%;
    background-repeat: no-repeat;
    object-fit:cover;
  "> 
    <br />
    <div class="main">

      <div class="header row">
        <div class="col">
          <img src="{{ URL::asset('images/psu-logo.png') }}" style="width: 100px;height: 100px;" />
          <img class="qrcode float-right" src="{{ $data['certificate']->qrcode }}" style="width: 100px;height: 100px;" />
        </div>
      </div>

      <center class="content">
        <h2 class="head {{ $data['certificate']->heading_style }}" style="color: {{ $data['certificate']->heading_color }} ;">CERTIFICATE OF COMPLETION</h2>
        <label style="color: {{ $data['certificate']->text_color }} ;">IS PRESENTED TO:</label>

        <br />

        <h2 class="{{ $data['certificate']->title_style }}" style="color: {{ $data['certificate']->title_color }} ;">{{ $data['certificate']->user_name }}</h2>
        <hr class="large" />
        <br />

        <p class="details {{ $data['certificate']->text_style }}" style="color: {{ $data['certificate']->text_color }} ;" >For completing the event title of "<strong>{{ Str::title($data['certificate']->event_name) }}</strong>" that was held on <strong>{{$data['certificate']->date?date('M d, Y', strtotime($data['certificate']->date)):'---'}}.</strong></p>
        <br />
        <p class="quote {{ $data['certificate']->quotes_style }}" style="color: {{ $data['certificate']->quotes_color }} ;">" {!!$data['certificate']->quote!!} "</p>

      </center>

      <div>
        
        <table class="signatures-table">
          <tr>
           
            <!-- Loop through the coordinators -->
            @foreach ($data['coordinators'] as $coordinator)
              <td>
                <img class="" src="{{ $coordinator->signature }}" />
                <br>
                <span class="name" style="color: {{ $data['certificate']->text_color }} ;">{{ $coordinator->name }}</span>
                <div class="signature-line"></div>
                <br>
                <span class="role" style="color: {{ $data['certificate']->text_color }} ;">{{ $coordinator->position }}</span>                        
              </td>
            @endforeach
          </tr>
        </table>

      </div>

      <div>
        <img class="app-logo" src="{{ URL::asset('images/logo-long.png') }}" style="width: 150px;height: 35ßpx;" />
      </div>

    </div>
  
  </div>

</body>
</html>