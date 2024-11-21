<form class="form " action="" method="POST" enctype="multipart/form-data" id="eventForm">
    <?php echo e(csrf_field()); ?>

    <?php if($event): ?>
    <input type="hidden" name="id" value="<?php echo e($event->id); ?>" class="form-control">
    <input type="hidden" name="details" value="<?php echo e($event->details); ?>" class="form-control">
    <?php endif; ?>
    <div class="row box-body">
        <div class="box-body col-md-6">
            <div class="row">
                <div class="form-group <?php echo e($errors->has('name')?'error':null); ?>">
                    <label class="form-label">Event Title <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="<?php echo e(old('name',$event?$event->name:'')); ?>" class="form-control" placeholder="Event Title">
                    <?php if($errors->has('name')): ?>
                    <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('name')); ?></li></ul></div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- <div class="row">
                <div class="form-group <?php echo e($errors->has('category_id')?'error':null); ?>">
                    <label class="form-label">Event Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control">
                        <option value="">--Choose A Category--</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category == old('category_id') OR ($event?$event->category_id:'')): ?>
                        <option value="<?php echo e($index); ?>" selected><?php echo e($category); ?></option>
                        <?php else: ?>
                        <option value="<?php echo e($index); ?>"><?php echo e($category); ?></option>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('category_id')): ?>
                    <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('category_id')); ?></li></ul></div>
                    <?php endif; ?>
                </div>
            </div> -->
            <div class="row">
                <div class="form-group <?php echo e($errors->has('details')?'error':null); ?>">
                    <label class="form-label">Details <span class="text-danger">*</span></label>
                    <textarea rows="3" name="details" id="editor1" class="textarea" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Event Details"><?php echo e(old('details',$event?$event->details:'')); ?></textarea>
                    <?php if($errors->has('details')): ?>
                    <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('details')); ?></li></ul></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo e($errors->has('start')?'error':null); ?> start-date">
                        <label class="form-label">Start <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="start" min="<?php echo e(date('Y-m-d')); ?>" id="start" value="<?php echo e(old('start',$event?date('Y-m-d\TH:i', strtotime($event->start)):'')); ?>" class="form-control" placeholder="Date">
                        <?php if($errors->has('start')): ?>
                        <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('start')); ?></li></ul></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo e($errors->has('end')?'error':null); ?> end-date">
                        <label class="form-label">End <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="end" min="<?php echo e(date('Y-m-d')); ?>" id="end" value="<?php echo e(old('end',$event?date('Y-m-d\TH:i',strtotime($event->end)):'')); ?>" class="form-control" placeholder="End Date">
                        <?php if($errors->has('end')): ?>
                        <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('end')); ?></li></ul></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if(auth()->user()->type != 'patient'): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group <?php echo e($errors->has('status')?'error':null); ?>">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control bg-white input-pet">
                            <option value="">---</option>
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($event AND $event->status == $status OR old('status') == $index): ?>
                            <option value="<?php echo e($status); ?>" selected><?php echo e($status); ?></option>
                            <?php else: ?>
                            <option value="<?php echo e($status); ?>"><?php echo e($status); ?></option>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('status')): ?>
                        <div class="help-block"><ul role="alert"><li><?php echo e($errors->first('status')); ?></li></ul></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="box-footer text-end">
                <a href="<?php echo e(route('backoffice.events.index')); ?>" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
                    <i class="fa fa-sign-out" style="font-size:24px"></i> Exit
                </a>
                <button type="button" class="btn waves-effect waves-light btn btn-outline btn-primary " id="formSubmitBtn">
                    <i class="ti-save-alt"></i> Save
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label class="form-label">Signatories <span class="text-danger"></span></label><br>
                    <label class="text-danger" id="coordformerror"></label><br>
                    <div class="form-controlx">
                        <button type="button" data-toggle="modal" id="addCoordBtn" data-target="#exampleModal" class="btn waves-effect waves-light btn btn-outlined btn-primary ">
                            <i class="ti-plus"></i> Add Signatory
                        </button>

                        <div class="row mt-5 p-5" id="co-container"></div>
                        <div id="co-name-inputs"></div>
                        <div id="co-pos-inputs"></div>
                        <div id="co-sig-inputs"></div>
                        <div id="co-email-inputs"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
      
</form>

<div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
      <div class="modal-content">
        <form action="<?php echo e(route('backoffice.events.certificate-prompt')); ?>" method="POST" target="_blank">
        <?php echo csrf_field(); ?>  <!-- This token is necessary for security reasons -->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i data-feather="users"></i>  &nbsp;Add Signatory</h5>
            <button type="button" class="btn btn-sm btn-outlined" data-dismiss="modal" aria-label="Close" style="border:none;">
              <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="form-group <?php echo e($errors->has('name')?'error':null); ?> end-date">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="coordname" id="coordname" class="form-control" placeholder="">  
                    </div>
                    <div class="form-group <?php echo e($errors->has('position')?'error':null); ?> end-date">
                        <label class="form-label">Position <span class="text-danger">*</span></label>
                        <input type="text" name="coordpos" id="coordpos" class="form-control" placeholder="">  
                    </div>
                    <div class="form-group <?php echo e($errors->has('email')?'error':null); ?> end-date">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="coordemail" id="coordemail" class="form-control" placeholder="">  
                        <p class="text-secondary m-2"><i data-feather="info"></i> The certificate will be sent to this email</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">E-Sginature <span class="text-danger">*</span></label>
                        <canvas id="sig-canvas" width="740" height="220">
                            Get a better browser, bro.
                        </canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Sign in the canvas above for the e-signature</p>
                    </div>
                </div>

                <br/>
            </div>
        </div>
        <div class="modal-footer">
            <button id="sig-submitBtn" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
            <button id="sig-clearBtn" type="button" class="btn btn-secondary">Reset</button>
        </div>

        </form>
      </div>
    
  </div>
</div><?php /**PATH C:\wamp64\www\Smartseminarsuit-v3\resources\views/backoffice/pages/events/form.blade.php ENDPATH**/ ?>