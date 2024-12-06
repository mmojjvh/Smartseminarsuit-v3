<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(URL::asset('images/favicons/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(URL::asset('images/favicons/manifest.json')); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e(URL::asset('images/favicons/ms-icon-144x144.png')); ?>">
    <title><?php echo e($data['title']); ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <?php echo $__env->make('commons.customfonts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('custom/customfonts.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('custom/certificate.css')); ?>" >
</head>
<body id="body">

<div id="printable">

<div id="pageBody-main" class="page-body">

<?php $__currentLoopData = $data['certificates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

 <div id="pageBody" class="certificate background <?php echo e($loop->last?'':'page-break'); ?>" style="
    background: url(
    
     <?php echo e($certificate->use_template == 1 ? URL::asset($certificate->background_image) : $certificate->background_image); ?>

    );
    background-size: 100% 100%;
    background-repeat: no-repeat;
    object-fit:cover;
  "> 

  <br /><br />
  <div class="main">

    <div class="header row">
      <div class="col">
        <img src="<?php echo e(URL::asset('images/psu-logo.png')); ?>" style="width: 100px;height: 100px;" />
        <img class="qrcode float-right" src="<?php echo e($certificate->qrcode); ?>" style="width: 100px;height: 100px;" />
      </div>
    </div>

    <center class="content">
      <h2 class="head <?php echo e($certificate->heading_style); ?>" style="color: <?php echo e($certificate->heading_color); ?> ;"><?php echo e($certificate->title); ?></h2>
      <label style="color: <?php echo e($certificate->text_color); ?> ;">IS PRESENTED TO:</label>

      <br />

      <h2 class="<?php echo e($certificate->title_style); ?>" style="color: <?php echo e($certificate->title_color); ?> ;"><?php echo e($certificate->user_name); ?></h2>
      <br />
      <hr class="large" />
      

      <!-- <p class="details">For completing the <strong><?php echo e($certificate->category); ?></strong> with the event <br> -->
      <p class="details <?php echo e($certificate->text_style); ?>" style="color: <?php echo e($certificate->text_color); ?> ;">For completing the event title of "<strong><?php echo e(Str::title($certificate->event_name)); ?></strong>" that was held on <strong><?php echo e($certificate->date?date('M d, Y', strtotime($certificate->date)):'---'); ?>.</strong></p>
      <br />
      <p class="quote <?php echo e($certificate->quotes_style); ?>" style="color: <?php echo e($certificate->quotes_color); ?> ;">" <?php echo $certificate->quote; ?> "</p>

    </center>

    <div>
      <table class="signatures-table">
        <tr>
          <!-- Loop through the coordinators -->
          <?php $__currentLoopData = $data['coordinators']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coordinator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td>
              <img class="" src="<?php echo e($coordinator->signature); ?>" />
              <br>
              <span class="name" style="color: <?php echo e($certificate->text_color); ?> ;"><?php echo e($coordinator->name); ?></span>
              <div class="signature-line"></div>
              <br>
              <span class="role" style="color: <?php echo e($certificate->text_color); ?> ;"> <?php echo e($coordinator->position); ?> </span>                        
            </td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
      </table>
    </div>
    <div>
      <img class="app-logo" src="<?php echo e(URL::asset('images/logo-long.png')); ?>" style="width: 150px;height: 35px;" />
    </div>
  </div>


</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- PRINTABLE END -->
</div>

<div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
      <div class="modal-content">
        <form action="<?php echo e(route('backoffice.events.certificate-prompt')); ?>" method="POST" target="_blank">
        <?php echo csrf_field(); ?>  <!-- This token is necessary for security reasons -->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i data-feather="users"></i>  &nbsp;Distribute Certificate</h5>
            <button type="button" class="btn btn-sm btn-outlined" data-dismiss="modal" aria-label="Close" style="border:none;">
              <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">                    
                <div class="row">
                    <div class="col-md-12">
                        <p>Do you want to distribute and send this certificate to the signatories?</p>
                    </div>
                </div>
                <br/>
            </div>
        </div>
        <div class="modal-footer">
            <button id="sendBtn" type="button" class="btn btn-primary" data-dismiss="modal" >Send</button>
            <button type="button" class="btn btn-secondary">Cancel</button>
        </div>

        </form>
      </div>
    
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('assets/plugins/jquery/jquery-1.11.1.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

  let emails = ''

  window.onload = () => {

      try {
        let raw = '<?php echo e(json_encode($data["coordinators"])); ?>'
        let data = JSON.parse(raw.replace(/(&quot\;)/g,"\""))
        // let data = JSON.parse(raw)
        console.log(data)
        if(data && data.length > 0){

          emails = data?.map((coordinator) => coordinator?.email || '')?.join(",")

          $("#exampleModal").modal("show")
          $("#sendBtn").on("click", function() {

            $("#sendBtn").html("Sending")
            $(".certificate").addClass("pdf-height")
            
            let opt = {
              margin: 0,
              filename: 'certificate.pdf',
              image: { type: 'jpeg', quality: 0.95 },
              html2canvas: { scrollX: 0, scrollY: 0 },
              jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape', floatPrecision: 6 },
              // pagebreak: { mode: 'avoid-all', after: '.page-break' }
            }

            html2pdf()
            .set(opt)
            .from(document.getElementById("pageBody-main"))
            .toPdf()
            .output('datauristring')
            .then(function( pdfAsString ) {
              console.log(pdfAsString)
              let data = {
                'fileDataURI': pdfAsString,
                'emails': emails
              }
              send(data)
            });

          })
        }
      } catch (error) {
        console.log(error)
      }
  }

  function send(data) {
    $.post(`${window.location.origin}/api/certificate/distribute`, data).then((raw) => {
      try {
        // let data = JSON.parse(raw)
        console.log("Raw value:", raw)
        $(".certificate").removeClass("pdf-height")
        $("#sendBtn").html("Sent")
        $("#exampleModal").modal("hide")
      } catch (error) {
        console.log(error)
        $(".certificate").removeClass("pdf-height")
      }
    }).catch((error) => {
      console.log(error)
      $(".certificate").removeClass("pdf-height")
    })
  }

  
</script>

</body>
</html><?php /**PATH C:\wamp64\www\Smartseminarsuit-v3\resources\views/pdf/ai/all.blade.php ENDPATH**/ ?>