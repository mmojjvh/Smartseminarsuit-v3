<style>
    #sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
</style>
<?php $__env->startPush('content'); ?>
<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">
        
        <div class="col-12">
            <div class="row justify-content-center g-0">
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="bg-white rounded10 shadow-lg">
                        <div class="content-top-agile p-20 pb-0">
                            <h2 class="text-primary"> Participants Registration </h2>
                            <p class="mb-0">Fill out the form carefully for registration</p>							
                        </div>
                        <div class="p-40">
                            <form action="" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?php echo e($errors->has('fname')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="fname" value="<?php echo e(old('fname')); ?>" class="form-control ps-15 bg-transparent" placeholder="First Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?php echo e($errors->has('lname')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="lname" value="<?php echo e(old('lname')); ?>" class="form-control ps-15 bg-transparent" data-toggle="tooltip" title="Last Name" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 <?php echo e($errors->has('email')?'error':null); ?>">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control ps-15 bg-transparent" placeholder="Email" required>
                                            </div>
                                            <?php if($errors->has('email')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('email')); ?></li></ul></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?php echo e($errors->has('contact_number')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="contact_number" value="<?php echo e(old('contact_number')); ?>" class="form-control ps-15 bg-transparent" placeholder="Contact Number" required data-inputmask="'mask':[ '(9999)999-9999']" data-mask>
                                            </div>
                                        </div>
                                        <?php if($errors->has('contact_number')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('contact_number')); ?></li></ul></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?php echo e($errors->has('age')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="number" min="1" name="age" value="<?php echo e(old('age')); ?>" class="form-control ps-15 bg-transparent" placeholder="Age" required>
                                            </div>
                                        </div>
                                        <?php if($errors->has('age')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('age')); ?></li></ul></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?php echo e($errors->has('gender')?'error':null); ?>">
                                            <select name="gender" class="form-control ps-15 bg-transparent" id="" required>
                                                <option value="">-- Gender ---</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <?php if($errors->has('gender')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('gender')); ?></li></ul></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?php echo e($errors->has('province')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="province" value="<?php echo e(old('province')); ?>" class="form-control ps-15 bg-transparent" placeholder="Province" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group <?php echo e($errors->has('city')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="city" value="<?php echo e(old('city')); ?>" class="form-control ps-15 bg-transparent" placeholder="City" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group <?php echo e($errors->has('barangay')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="barangay" value="<?php echo e(old('barangay')); ?>" class="form-control ps-15 bg-transparent" placeholder="Barangay" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group <?php echo e($errors->has('street')?'error':null); ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="street" value="<?php echo e(old('street')); ?>" class="form-control ps-15 bg-transparent" placeholder="Street & House No." required>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group <?php echo e($errors->has('address')?'error':null); ?>">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent"><i class="ti-location-pin"></i></span>
                                        <textarea type="text" name="address" class="form-control ps-15 bg-transparent" placeholder="Address" required><?php echo e(old('address')); ?></textarea>
                                    </div>
                                    <?php if($errors->has('address')): ?>
                                        <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('address')); ?></li></ul></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group <?php echo e($errors->has('signature')?'error':null); ?>">
                                    <div class="input-group mb-3">
                                        <!-- <span class="input-group-text bg-transparent"><i class="ti-marker-alt"></i></span> -->

                                        <!-- <div data-toggle="modal" data-target="#exampleModal" class="sig-container form-control" style="cursor: pointer;">     
                                            <p class="text-gray text-default" style="color:#343a40;font-size: 1rem;">E-Signature</p>                                      
                                            <img id="sig-image" width="100%" height="60" style="border: 0;display: block;" />   
                                            <input type="file" accept="image/*" name="signature" id="signatureInput" value="<?php echo e(old('signature')); ?>" class="" placeholder="Signature" style="display: block;width: 0px;height: 0px;"> 
                                            
                                        </div> -->
                                                                                
                                        <!-- <button type="button" class="form-control" data-toggle="modal" data-target="#exampleModal">
  Signature
</button> -->

                                        <!-- <input type="file" name="signature" id="signature" value="<?php echo e(old('signature')); ?>" class="form-control ps-15 bg-transparent" placeholder="Signature" style="display: none;">
                                        <label for="signature" class="form-control ps-15  bg-transparent" style="color: #212529;padding-top: 15;">Signature</label> -->

                                    </div>
                                    <?php if($errors->has('signature')): ?>
                                        <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('signature')); ?></li></ul></span>
                                    <?php endif; ?>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3 <?php echo e($errors->has('username')?'error':null); ?>">
                                            <div class="input-group">
                                                <input type="text" name="username" value="<?php echo e(old('username')); ?>" class="form-control ps-15 bg-transparent" placeholder="Username" required>
                                            </div>
                                            <?php if($errors->has('username')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('username')); ?></li></ul></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 <?php echo e($errors->has('password')?'error':null); ?>">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                                <input type="password" name="password" class="form-control ps-15 bg-transparent" placeholder="Password" required>
                                            </div>
                                            <?php if($errors->has('password')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('password')); ?></li></ul></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 <?php echo e($errors->has('password_confirmation')?'error':null); ?>">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                                <input type="password" name="password_confirmation" class="form-control ps-15 bg-transparent" placeholder="Confirm Password" required>
                                            </div>
                                            <?php if($errors->has('password_confirmation')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('password_confirmation')); ?></li></ul></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_1" required>
                                            <label for="basic_checkbox_1">I agree to the <a href="#" class="text-warning"><b>Terms</b></a></label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info margin-top-10">SIGN UP</button>
                                    </div>
                                </div>
                            </form>				
                            <div class="text-center">
                                <p class="mt-15 mb-0">Already have an account?<a href="<?php echo e(route('backoffice.auth.login')); ?>" class="text-danger ms-5"> Sign In</a></p>
                            </div>
                        </div>
                    </div>								
                </div>
            </div>
        </div>			
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">E-Signature</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Sign in the canvas below and save your signature as an image!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <canvas id="sig-canvas" width="740" height="220">
                    Get a better browser, bro.
                </canvas>
            </div>
        </div>
        <br/>
    </div>
      </div>
      <div class="modal-footer">
        <button id="sig-clearBtn" type="button" class="btn btn-secondary">Reset</button>
        <button id="sig-submitBtn" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backoffice.auth._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bpaltezo/Desktop/Smartseminarsuit-v3/resources/views/backoffice/auth/register.blade.php ENDPATH**/ ?>