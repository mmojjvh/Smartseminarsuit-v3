<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(public_path('images/favicons/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(public_path('images/favicons/manifest.json')); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e(public_path('images/favicons/ms-icon-144x144.png')); ?>">
    <title><?php echo e($data['title']); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(public_path('custom/certificate.css')); ?>" >
</head>
<body>

  <div id="pageBody" class="certificate background" style="background: url(<?php echo $data['certificate']->background_image; ?>);"> 
    <br /><br />
    <div class="main">

      <div class="header row">
        <div class="col">
          <img src="<?php echo e(public_path('images/psu-logo.png')); ?>" style="width: 55px;height: 55px;" />
          <img src="<?php echo e(public_path('images/logo-long.png')); ?>" style="width: 150px;height: 35ßpx;margin-bottom:10px;" />
          <img class="qrcode float-right" src="<?php echo e($data['certificate']->qrcode); ?>" style="width: 100px;height: 100px;" />
        </div>
      </div>

      <center class="content">
        <h1>CERTIFICATE OF COMPLETION</h1>
        <label>IS PRESENTED TO:</label>

        <br /><br />

        <h2><?php echo e($data['certificate']->user_name); ?></h2>
        <hr class="large" />
        <br />

        <p class="details">For completing the <strong><?php echo e($data['certificate']->category); ?></strong> with the event
        title of "<strong><?php echo e(Str::title($data['certificate']->event_name)); ?></strong>" that was held on <strong><?php echo e($data['certificate']->date?date('M d, Y', strtotime($data['certificate']->date)):'---'); ?>.</strong></p>
        <br />
        <p class="quote">" <?php echo $data['certificate']->quote; ?> "</p>

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
                <img class="" src="<?php echo e($data['certificate']->user_signature); ?>" />
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

</body>
</html><?php /**PATH /Users/bpaltezo/Desktop/Smartseminarsuit-v3/resources/views/pdf/ai/view.blade.php ENDPATH**/ ?>