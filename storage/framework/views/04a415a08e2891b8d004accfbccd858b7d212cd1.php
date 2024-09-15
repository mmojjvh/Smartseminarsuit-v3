<?php if( session()->has('notification-status') ): ?>
<div class="row alert-div">
    <div class="col-md-12">
        <div class="b-1 border-<?php echo e(session()->get('notification-status')); ?> bg-<?php echo e(session()->get('notification-status')); ?>-light rounded p-10 mb-15"><?php echo e(session()->get('notification-msg')); ?> <i class="ti-close pull-right mt-1 alert-close"></i></div>
    </div>
</div>
<?php endif; ?><?php /**PATH C:\Users\markj\OneDrive\Desktop\capstone\smartserminar-suit\resources\views/backoffice/_components/session_notif.blade.php ENDPATH**/ ?>