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

    <?php echo $__env->make('commons.customfonts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('custom/customfonts.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('custom/certificate.css')); ?>" >
</head>
<body>

<div id="pageBody" class="page-body">

<?php $__currentLoopData = $data['certificates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

 <div id="pageBody" class="certificate background <?php echo e($loop->last?'':'page-break'); ?>" style="
    background: url(
    <?php 
        if($data["background_image"] != ''){
            echo $data["background_image"];
        }else{
            echo $certificate->background_image;
        }
     ?>
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
      <h2 class="head <?php echo e($certificate->heading_style); ?>" style="color: <?php echo e($certificate->heading_color); ?> ;">CERTIFICATE OF COMPLETION</h2>
      <label style="color: <?php echo e($certificate->text_color); ?> ;">IS PRESENTED TO:</label>

      <br />

      <h2 class="<?php echo e($certificate->title_style); ?>" style="color: <?php echo e($certificate->title_color); ?> ;"><?php echo e($certificate->user_name); ?></h2>
      <hr class="large" />
      <br />

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
      <img src="<?php echo e(URL::asset('images/logo-long.png')); ?>" style="width: 150px;height: 35ßpx;" />
    </div>
  </div>


</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</body>
</html><?php /**PATH /Users/bpaltezo/Desktop/Smartseminarsuit-v3/resources/views/pdf/ai/all.blade.php ENDPATH**/ ?>