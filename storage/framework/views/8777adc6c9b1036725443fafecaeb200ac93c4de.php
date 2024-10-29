<form class="form" action="<?php echo e(route('backoffice.account.update_password')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <div class="box-body">
        <h4 class="box-title text-dark mb-0"><i class="ti-lock me-15"></i> Password Settings</h4>
        <hr class="my-15">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('old_password')?'error':null); ?>">
                    <label class="form-label">Old Password <span class="text-danger">*</span></label>
                    <input type="password" name="old_password" value="" class="form-control" placeholder="Old Password">
                    <?php if($errors->has('old_password')): ?>
                    <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('old_password')); ?></li></ul></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('new_password_confirmation')?'error':null); ?>">
                    <label class="form-label">New Password <span class="text-danger">*</span></label>
                    <input type="password" name="new_password_confirmation" value="" class="form-control" placeholder="New Password">
                    <?php if($errors->has('new_password_confirmation')): ?>
                    <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('new_password_confirmation')); ?></li></ul></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('new_password')?'error':null); ?>">
                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="new_password" value="" class="form-control" placeholder="Confirm Password">
                    <?php if($errors->has('new_password')): ?>
                    <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('new_password')); ?></li></ul></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn waves-effect waves-light btn btn-primary ">
                    <i class="ti-save-alt"></i> Save
                </button>
            </div>
        </div>
    </div>
</form><?php /**PATH C:\Users\markj\OneDrive\Desktop\Capstone 2\smartserminar-suit 1.0 (1)\smartserminar-suit\resources\views/backoffice/pages/account/password_settings.blade.php ENDPATH**/ ?>