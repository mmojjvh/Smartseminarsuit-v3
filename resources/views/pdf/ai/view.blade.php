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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Acme&family=Almendra:ital,wght@0,400;0,700;1,400;1,700&family=Amatic+SC:wght@400;700&family=Andika:ital,wght@0,400;0,700;1,400;1,700&family=Anton&family=Archivo+Black&family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Asap:ital,wght@0,100..900;1,100..900&family=Averia+Sans+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Bangers&family=Bebas+Neue&family=Belgrano&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Caveat:wght@400..700&family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Dancing+Script:wght@400..700&family=DynaPuff:wght@400..700&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lilita+One&family=Lobster&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Oxanium:wght@200..800&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Quicksand:wght@300..700&family=Rajdhani:wght@300;400;500;600;700&family=Space+Grotesk:wght@300..700&family=Updock&display=swap" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100..900;1,100..900&family=Black+Han+Sans&family=Bree+Serif&family=Bungee&family=Cabin+Sketch:wght@400;700&family=Cabin:ital,wght@0,400..700;1,400..700&family=Cardo:ital,wght@0,400;0,700;1,400&family=Coda:wght@400;800&family=Cutive+Mono&family=Delius+Swash+Caps&family=Didact+Gothic&family=Domine:wght@400..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Eczar:wght@400..800&family=Enriqueta:wght@400;500;600;700&family=Exo:ital,wght@0,100..900;1,100..900&family=Expletus+Sans:ital,wght@0,400..700;1,400..700&family=Fanwood+Text:ital@0;1&family=Fira+Mono:wght@400;500;700&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Gidugu&family=Glegoo:wght@400;700&family=Hammersmith+One&family=Inconsolata:wght@200..900&family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Josefin+Slab:ital,wght@0,100..700;1,100..700&family=Kameron:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Knewave&family=Lora:ital,wght@0,400..700;1,400..700&family=Lusitana:wght@400;700&family=Macondo&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Metamorphous&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Overpass:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Sevillana&family=Share+Tech+Mono&family=Signika:wght@300..700&family=Skranji:wght@400;700&family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Tangerine:wght@400;700&family=Taviraj:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Vollkorn:ital,wght@0,400..900;1,400..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&family=Yanone+Kaffeesatz:wght@200..700&family=Zilla+Slab+Highlight:wght@400;700&family=Zilla+Slab:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"> -->

    
    <link rel="stylesheet" type="text/css" href="{{ asset('custom/certificate.css') }}" >
</head>
<body>

  <div id="pageBody" class="certificate background" style="background: url({!! $data['certificate']->background_image !!});"> 
    <br /><br />
    <div class="main">

      <div class="header row">
        <div class="col">
          <img src="{{ public_path('images/psu-logo.png') }}" style="width: 100px;height: 100px;" />
          <img class="qrcode float-right" src="{{ $data['certificate']->qrcode }}" style="width: 100px;height: 100px;" />
        </div>
      </div>

      <center class="content">
        <h1>CERTIFICATE OF COMPLETION</h1>
        <label>IS PRESENTED TO:</label>

        <br />

        <h2>{{ $data['certificate']->user_name }}</h2>
        <hr class="large" />
        <br />

        <p class="details">For completing the event title of "<strong>{{ Str::title($data['certificate']->event_name) }}</strong>" that was held on <strong>{{$data['certificate']->date?date('M d, Y', strtotime($data['certificate']->date)):'---'}}.</strong></p>
        <br />
        <p class="quote">" {!!$data['certificate']->quote!!} "</p>

      </center>

      <div>
        
        <table class="signatures-table">
          <tr>
            <!-- <td>
              <img class="" src="{{ $data['certificate']->user_signature }}" />
              <br>
              <span class="name">{{ $data['certificate']->user_name }}</span>
              <div class="signature-line"></div>
              <br>     
              <span class="role">Recipient</span>                                 
            </td> -->

            <!-- Loop through the coordinators -->
            @foreach ($data['coordinators'] as $coordinator)
              <td>
                <img class="" src="{{ $coordinator->signature }}" />
                <br>
                <span class="name">{{ $coordinator->name }}</span>
                <div class="signature-line"></div>
                <br>
                <span class="role">{{ $coordinator->position }}</span>                        
              </td>
            @endforeach
          </tr>
        </table>

      </div>

      <div>
        <img src="{{ public_path('images/logo-long.png') }}" style="width: 150px;height: 35ßpx;" />
      </div>

    </div>
  
  </div>

</body>
</html>