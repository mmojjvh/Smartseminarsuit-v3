<?php $__env->startPush('content'); ?>
<?php echo $__env->make('frontend.web._sections.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- <?php echo $__env->make('frontend.web._sections.intro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>
<link class="main-stylesheet" href="<?php echo e(asset('pages/css/chat.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.web._layouts.main',['header' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bpaltezo/Desktop/Smartseminarsuit-v3/resources/views/frontend/web/index.blade.php ENDPATH**/ ?>