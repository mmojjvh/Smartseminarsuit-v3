<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title><?php echo e(config('app.name')); ?></title>
	
	<?php echo $__env->make('backoffice.auth._includes.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url(<?php echo e(asset('vet-clinic/images/auth-bg/bg-1.jpg')); ?>)">
	
	<?php echo $__env->yieldPushContent('content'); ?>

	<!-- Vendor JS -->
	<?php echo $__env->make('backoffice.auth._includes.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH C:\Users\markj\OneDrive\Desktop\Capstone 2\smartserminar-suit 1.0 (1)\smartserminar-suit\resources\views/backoffice/auth/_layout/main.blade.php ENDPATH**/ ?>