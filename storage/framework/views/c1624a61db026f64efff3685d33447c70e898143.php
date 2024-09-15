<?php $__env->startPush('title',$title.' Details'); ?>

<?php $__env->startPush('css'); ?>
<style>
    .event-date{
        padding: 5px;
        border: 2px solid;
        line-height: 20px;
        border-radius: 5px;
        width: 60px;
    }
    .event-day{
        font-size: 30px;
        font-weight: 500;
    }
    .event-month{
        font-size: 15px;
        font-weight: 300;
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
                  <h4 class="page-title">Participant</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('backoffice.index')); ?>"><i class="mdi mdi-home-outline"></i></a></li>
                            <?php if(in_array(auth()->user()->type,['super_user','admin'])): ?>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('backoffice.participants.index')); ?>"><i class="mdi mdi-account-outline"></i></a></li>
                            <?php endif; ?>
                            <li class="breadcrumb-item active" aria-current="page">Participant Details</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>  

      <!-- Main content -->
      <section class="content">

          <div class="row">
              <div class="col-xl-6 col-12">
                  <div class="box">
                      <div class="box-body text-end min-h-150" style="background-image:url(<?php echo e(asset('images/bg-hero.jpg')); ?>); background-repeat: no-repeat; background-position: center;background-size: cover;">	
                      </div>						
                      <div class="box-body wed-up position-relative">
                          <div class="d-md-flex align-items-center">
                              <div class=" me-20 text-center text-md-start">
                                  <?php if($participant->getAvatar()): ?>
                                  <img src="<?php echo e(asset($participant->getAvatar())); ?>" class="bg-lightest border-light rounded10 patient-avatar" alt="avatar" />	
                                  <?php endif; ?>
                              </div>
                              <div class="mt-40">
                                  <h4 class="fw-600 mb-5">&nbsp;</h4>
                                  <h2 class="fw-300 mb-5 mt-10"><?php echo e($participant->fname); ?> <?php echo e($participant->mname); ?> <?php echo e($participant->lname); ?></h2>
                              </div>
                          </div>
                      </div>				
                  </div>
                  <div class="row">
                      <div class="col-xl-12 col-12">
                          <div class="box">
                              <div class="box-body box-profile">            
                                <div class="row">
                                  <div class="col-12">
                                      <div>
                                          <p><strong>Age</strong> :<span class="text-gray ps-10"><?php echo e($participant->age); ?></span></p>
                                          <p><strong>Gender</strong> :<span class="text-gray ps-10"><?php echo e(ucfirst($participant->gender)); ?></span></p>
                                          <p><strong>Email</strong> :<span class="text-gray ps-10"><?php echo e($participant->user->email); ?></span> </p>
                                          <p><strong>Phone</strong> :<span class="text-gray ps-10"><?php echo e($participant->user->contact_number); ?></span></p>
                                          <p><strong>Address</strong> :<span class="text-gray ps-10"><?php echo e($participant->address); ?></span></p>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <!-- /.box-body -->
                            </div>
                      </div>
                  </div>					
              </div>
              
              <div class="col-xl-6 col-lg-6 col-12"> 
                    <?php echo $__env->make('backoffice._components.session_notif', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box no-border no-shadow">
                        <div class="box-body overflow-auto">
                            <!-- the events -->
                            <div id="external-events">
                                <h3 class="fw-300">Events & Seminars Attended</h3>
                                <hr>
                                
                                <table class="table border-no" id="example1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="width: 45%">Information</th>
                                            <th style="width: 40%">Schedule</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover-primary">
                                            <td>
                                                <div class="border-primary event-date bg-temple-dark text-center">
                                                    <span class="event-month"><?php echo e($event->start?date('M', strtotime($event->start)):'---'); ?></span><br>
                                                    <span class="event-day"><?php echo e($event->start?date('j', strtotime($event->start)):'---'); ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                Event : <strong><?php echo e($event->name); ?></strong><br>
                                                Status:
                                                <?php if($event->status != 'Happening'): ?>
                                                <strong><?php echo e($event->status); ?></strong>
                                                <?php else: ?>
                                                <strong class="text-primary"><?php echo e($event->status); ?> Now</strong>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong>Start</strong> : <?php echo e($event->start?date('M d, Y @ h:i a', strtotime($event->start)):'---'); ?> <br>
                                                <strong>End</strong> : <?php echo e($event->end?date('M d, Y @ h:i a', strtotime($event->end)):'---'); ?>

                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('backoffice.events.view', $event->id)); ?>" class="waves-effect waves-light btn btn-primary-light">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr class="hover-primary">
                                            <td colspan="4" class="text-center">No Events yet...</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
          </div>

      </section>
      <!-- /.content -->
    </div>
</div>

<?php if(auth()->user()->type == 'participant'): ?>
<?php echo $__env->make('commons.chatbot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('vet-clinic/main/js/vendors.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/chat-popup.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/icons/feather-icons/feather.min.js')); ?>"></script>	

<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')); ?>"></script>	

<!-- Rhythm Admin App -->
<script src="<?php echo e(asset('vet-clinic/main/js/template.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/participant-details.js')); ?>"></script>

<script src="<?php echo e(asset('pages/js/moment.js')); ?>"></script>
<script src="<?php echo e(asset('pages/js/chat.js')); ?>"></script>
<script type="module" src="<?php echo e(asset('pages/js/firebase-chat.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\markj\OneDrive\Desktop\capstone\smartserminar-suit\resources\views/backoffice/pages/participants/view.blade.php ENDPATH**/ ?>