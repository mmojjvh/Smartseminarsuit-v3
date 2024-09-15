<div class="row">
    <div class="col-md-6">
        <?php echo $__env->make('backoffice._components.session_notif', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <form class="form" action="" method="POST">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Staff Information</h4>
            </div>
            <!-- /.box-header -->
            <?php echo e(csrf_field()); ?>

            <?php if($staff): ?>
            <input type="hidden" name="id" value="<?php echo e($staff->id); ?>" class="form-control">
            <input type="hidden" name="user_id" value="<?php echo e($staff->user_id); ?>" class="form-control">
            <?php endif; ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo e($errors->has('fname')?'error':null); ?>">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="fname" value="<?php echo e(old('fname',$staff?$staff->fname:'')); ?>" class="form-control" placeholder="First Name">
                            <?php if($errors->has('fname')): ?>
                            <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('fname')); ?></li></ul></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo e($errors->has('lname')?'error':null); ?>">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="lname" value="<?php echo e(old('lname',$staff?$staff->lname:'')); ?>" class="form-control" placeholder="Last Name">
                            <?php if($errors->has('lname')): ?>
                            <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('lname')); ?></li></ul></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group <?php echo e($errors->has('email')?'error':null); ?>">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" value="<?php echo e(old('email',$staff?$staff->email:'')); ?>" class="form-control" placeholder="Email">
                            <?php if($errors->has('email')): ?>
                            <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('email')); ?></li></ul></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="<?php echo e(route('backoffice.staffs.index')); ?>" class="btn waves-effect waves-light btn btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
            </form>
    </div>
    
    <?php if($staff): ?>
    <div class="col-md-6">
        <div class="box no-border no-shadow">
            <div class="box-header with-border">
                <h4 class="box-title">Types</h4>
            </div>
            <div class="box-body overflow-auto">
                <!-- the events -->
                <div id="external-events">
                    <table class="table border-no" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover-primary">
                                <td><?php echo e($index+1); ?></td>
                                <td><?php echo e($type->type); ?></td>
                                <td><?php echo e(number_format($type->price, 2)); ?></td>
                                <td><?php echo e($type->description); ?></td>
                                <td>												
                                    <div class="btn-group">
                                        <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo e(route('backoffice.services.editType', $type->id)); ?>">Edit</a>
                                            <a class="dropdown-item" href="<?php echo e(route('backoffice.services.deleteType', $type->id)); ?>">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr class="hover-primary">
                                <td colspan="5" class="text-center">No service types yet...</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="<?php echo e(route('backoffice.services.addType',$staff->id)); ?>" class="btn waves-effect waves-light btn btn-primary">
            <i class="ti-plus"></i> Add Service Type
        </a>
    </div>
    <?php endif; ?>
</div><?php /**PATH C:\Users\markj\OneDrive\Desktop\capstone\smartserminar-suit\resources\views/backoffice/pages/staffs/form.blade.php ENDPATH**/ ?>