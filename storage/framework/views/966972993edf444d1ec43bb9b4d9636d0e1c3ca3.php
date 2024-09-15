<?php $__env->startPush('content'); ?>
<div class="container h-p100">
  <div class="row align-items-center justify-content-md-center h-p100">	
    
    <div class="col-12">
      <div class="row justify-content-center g-0">
        <div class="col-lg-5 col-md-5 col-12">
          <div class="bg-white rounded10 shadow-lg">
            <div class="content-top-agile p-20 pb-0">
              <h2 class="text-primary">Let's Get Started</h2>
              <p class="mb-0">Sign in to continue to <?php echo e(config('app.name')); ?>.</p>							
            </div>
            <div class="p-40">
              <?php if(session()->has('notification-status')): ?>
              <div class="mb-20">
                <span class="badge badge-lg badge-<?php echo e(session()->get('notification-status') == 'warning'? 'danger': 'success'); ?> text-wrap text-start w-p100">
                  <strong><?php echo e(Str::title(session()->get('notification-status'))); ?>: </strong> <?php echo e(session()->get('notification-msg')); ?>

                </span>
              </div>
              <?php endif; ?>
              <form action="" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                    <input type="text" name="username" class="form-control ps-15 bg-transparent" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group mb-3">
                    <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                    <input type="password" name="password" class="form-control ps-15 bg-transparent" placeholder="Password">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="checkbox">
                    <input type="checkbox" name="remember_me" id="basic_checkbox_1" >
                    <label for="basic_checkbox_1">Remember Me</label>
                    </div>
                  </div>
                  <div class="col-6">
                   <div class="fog-pwd text-end">
                    <a href="<?php echo e(route('backoffice.auth.forgotPass')); ?>" class="hover-warning">Forgot password?</a><br>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
                  </div>
                  <!-- /.col -->
                  </div>
              </form>	
              <div class="text-center">
                <p class="mt-15 mb-0">Don't have an account? <a href="<?php echo e(route('backoffice.auth.register')); ?>" class="text-warning ms-5">Sign Up</a></p>
              </div>	
            </div>						
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice.auth._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\smartserminar-suit\resources\views/backoffice/auth/login.blade.php ENDPATH**/ ?>