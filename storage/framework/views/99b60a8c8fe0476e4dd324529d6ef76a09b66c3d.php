

<?php $__env->startPush('title','Appointment Request'); ?>

<?php $__env->startPush('css'); ?>
<style>
    .start-date-error{
        display: none;
    }
    .end-date-error{
        display: none;
    }
    .input-select{
        background-color: white!important;
    }
</style>
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
                                <li class="breadcrumb-item active" aria-current="page">Event Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-5">
                    <?php echo $__env->make('backoffice._components.session_notif', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <strong class=""><?php echo e($event->status); ?></strong><br>
                            <h1 class="box-title text-primary"><?php echo e($event->name); ?></h1><br>
                            <span><i class="mdi mdi-calendar-clock"></i> <?php echo e($event->start?date('M d, Y @ h:i a', strtotime($event->start)):'---'); ?></span> - 
                            <span><?php echo e($event->end?date('M d, Y @ h:i a', strtotime($event->end)):'---'); ?></span>
                        </div>
                        <div class="box-body">
                            <?php echo $event->details; ?>

                        </div>
                    </div>
                    <?php if(auth()->check() AND auth()->user()->type == 'participant' AND $event->status == 'Happening' AND !$attendance): ?>
                    <a href="<?php echo e(route('backoffice.events.index')); ?>" class="btn waves-effect waves-light btn btn-warning me-1">
                        Cancel
                    </a>
                    <a href="<?php echo e(route('backoffice.events.attend', $event->id)); ?>" class="btn waves-effect waves-light btn btn-primary ">
                        Attend
                    </a>
                    <?php endif; ?>
                </div>
                <div class="col-md-7">
                    
					<!-- <div class="box">
						<div class="box-header with-border">
							<h4 class="box-title"><i data-feather="message-square"></i> Feedbacks</h4>
						</div>
						<div class="box-body p-0">
							<div class="inner-user-div">
                                <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="media-list bb-1 bb-dashed border-light">
                                    <div class="media align-items-center">
                                        <a class="avatar avatar-lg status-success" href="#">
                                            <img src="<?php echo e(asset($feedback->user->getAvatar())); ?>" class="bg-success-light" alt="...">
                                        </a>
                                        <div class="media-body">
                                            <p class="fs-16">
                                                <a class="hover-primary" href="<?php echo e(route('backoffice.participants.view', $feedback->user->participant->id)); ?>"><?php echo e($feedback->user->name); ?></a>
                                            </p>
                                            <span class="text-muted"><?php echo e($feedback->created_at->diffForHumans()); ?></span>
                                        </div>
                                        <div class="media-right">
                                        </div>
                                    </div>					
                                    <div class="media pt-0">
                                        <p class="text-fade"><?php echo e($feedback->comment); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="media-list bb-1 bb-dashed border-light">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <h4 class="text-center">No feedbacks yet...</h4>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
							</div>
						</div>

                       

						<div class="box-footer">
                            <?php if(auth()->user()->type != 'participant'): ?>
							<a href="<?php echo e(route('backoffice.feedbacks.index', ['event_id' => $event->id])); ?>" class="d-block w-p100 waves-effect waves-light btn btn-primary-light">See More Feedbacks</a>
                            <?php else: ?>
                            <?php if($attendance): ?>
                            <form action="<?php echo e(route('backoffice.feedbacks.add')); ?>" method="POST">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="event_id" value="<?php echo e($event->id); ?>">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group <?php echo e($errors->has('comment')?'error':null); ?>">
                                            <div class="input-group">
                                                <input type="text" name="comment" class="form-control ps-15 bg-transparent form-control-md" placeholder="Add a comment..." required>
                                            </div>
                                            <?php if($errors->has('comment')): ?>
                                            <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('comment')); ?></li></ul></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" class="waves-effect waves-light btn btn-primary-light btn-circle btn-sm"><i data-feather="send"></i></button>
                                    </div>
                                </div>
                            </form>
                            <?php endif; ?>
                            <?php endif; ?>
						</div>
					</div> -->

                    <?php if($event->status == 'Completed'): ?>

                    <div class="box">
						<div class="box-header with-border">
							<h4 class="box-title"><i data-feather="message-square"></i> Feedbacks</h4>
						</div>
						<div class="box-body p-0">
							<div class="inner-user-div">
                                <form action="<?php echo e(route('backoffice.feedbacks.add')); ?>" method="POST">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="event_id" value="<?php echo e($event->id); ?>">
                                <?php $__currentLoopData = $feedback_questions_with_answer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="media-list bb-1 bb-dashed border-light">
                                        <div class="media pt-2">
                                            <p class="text-"><?php echo str_replace("QUE", "?", $feedback->question); ?></p>
                                        </div>
                                        <?php if(isset($feedback->user_answer) && $feedback->user_answer != ''): ?>
                                            <div class="media align-items-center">                                        
                                                <div class="media-body">
                                                    <p class="text-primary"><?php echo e($feedback->user_answer); ?></p>
                                                </div>
                                                <div class="media-rightx">                                            
                                                    <span class="text-muted"><?php echo e($feedback->user_answer_date != '' ? $feedback->user_answer_date->diffForHumans() : ''); ?></span>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <?php if(auth()->user()->type != 'participant'): ?>
							                    <a href="<?php echo e(route('backoffice.feedbacks.index', ['event_id' => $event->id])); ?>" class="d-block w-p100 waves-effect waves-light btn btn-primary-light">See More Feedbacks</a>
                                            <?php else: ?>
                                            <?php if($attendance): ?>
                                                
                                                    
                                                    <input type="hidden" name="feedback_question_id[]" value="<?php echo e($feedback->id); ?>">
                                                    <input type="hidden" name="feedback_question[]" value="<?php echo e($feedback->question); ?>">

                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="form-group <?php echo e($errors->has('comment')?'error':null); ?>">
                                                                <div class="input-group">
                                                                    <?php if($feedback->type == 'fill'): ?>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comment[]" class="form-control ps-15 bg-transparent form-control-md" placeholder="Your answer..." required>
                                                                    <?php elseif($feedback->type == 'rating'): ?>
                                                                    <div>                                                                        
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="comment[]" type="radio" id="ratingradio1id<?php echo e($feedback->id); ?>" value="1" required>
                                                                            <label class="form-check-label" for="ratingradio1id<?php echo e($feedback->id); ?>">1</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="comment[]" type="radio" id="ratingradio2id<?php echo e($feedback->id); ?>" value="2" required>
                                                                            <label class="form-check-label" for="ratingradio2id<?php echo e($feedback->id); ?>">2</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="comment[]" type="radio" id="ratingradio3id<?php echo e($feedback->id); ?>" value="3" required>
                                                                            <label class="form-check-label" for="ratingradio3id<?php echo e($feedback->id); ?>">3</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="comment[]" type="radio" id="ratingradio4id<?php echo e($feedback->id); ?>" value="4" required>
                                                                            <label class="form-check-label" for="ratingradio4id<?php echo e($feedback->id); ?>">4</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="comment[]" type="radio" id="ratingradio5id<?php echo e($feedback->id); ?>" value="5" required>
                                                                            <label class="form-check-label" for="ratingradio5id<?php echo e($feedback->id); ?>">5</label>
                                                                        </div>
                                                                        <p class="text-light"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Strongly Disagree <span style="float:right;">Strongly Agree</span></p>
                                                                    </div>
                                                                    <?php elseif($feedback->type == 'select'): ?>
                                                                    <div>
                                                                        <?php 
                                                                            $choices = explode('andseparator', $feedback->choices);
                                                                            foreach ($choices as $key => $choice) {
                                                                                echo '<div class="form-check">
                                                                                    <input class="form-check-input" name="comment[]" type="radio" id="selectradio'.$key.'id'.$feedback->id.'" value="'.$choice.'" required>
                                                                                    <label class="form-check-label" for="selectradio'.$key.'id'.$feedback->id.'">'.$choice.'</label>
                                                                                </div>';
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if($errors->has('comment')): ?>
                                                                <span class="help-block"><ul role="alert"><li><?php echo e($errors->first('comment')); ?></li></ul></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="row col-md-12 m-5 p-5 d-flex">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-3 btn btn-info float-right">
                                        <span>Submit</span> <button type="submit" class="waves-effect waves-light btn btn-primary-light btn-circle btn-sm"><i data-feather="send"></i></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>


                </div>
            </div>
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
<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Smartseminarsuit-v3\resources\views/backoffice/pages/events/view.blade.php ENDPATH**/ ?>