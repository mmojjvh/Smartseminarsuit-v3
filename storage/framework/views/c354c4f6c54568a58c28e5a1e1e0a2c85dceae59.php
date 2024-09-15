<?php $__env->startPush('title','Create New '.$title); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('content'); ?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->	  
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><?php echo e($title); ?></h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('backoffice.index')); ?>"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create New Staff</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
        <?php echo $__env->make('backoffice.pages.staffs.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </section>
    </div>
</div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('vet-clinic/main/js/vendors.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/chat-popup.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/icons/feather-icons/feather.min.js')); ?>"></script>	
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/select2/dist/js/select2.full.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_plugins/iCheck/icheck.min.js')); ?>"></script>

<!-- Rhythm Admin App -->
<script src="<?php echo e(asset('vet-clinic/main/js/template.js')); ?>"></script>

<script src="<?php echo e(asset('vet-clinic/main/js/pages/advanced-form-element.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\smartserminar-suit\resources\views/backoffice/pages/staffs/create.blade.php ENDPATH**/ ?>