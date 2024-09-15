<?php $__env->startPush('title',$title.' List'); ?>

<?php $__env->startPush('css'); ?>
    <style type="text/css">
        .overflow-visible { 
            overflow: visible;
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
                              <li class="breadcrumb-item active" aria-current="page">Event List</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>
        
      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-12">
                    <?php echo $__env->make('backoffice._components.session_notif', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <div class="box">
                      <div class="box-body">
                          <div class="row">
                            <div class="col-md-4">
                                <form action="" method="get">
                                <input type="text" name="search" value="<?php echo e(Input::has('search')?Input::get('search'):''); ?>" class="form-control pull-right" placeholder="Search for an Event...">
                                </form>
                            </div>
                            <?php if(auth()->user()->type != 'participant'): ?>
                            <div class="col-md-4 offset-md-4">
                                <a href="<?php echo e(route('backoffice.events.create')); ?>" class="waves-effect waves-light btn btn-outline btn-primary mb-5 pull-right">Create New</a>
                            </div>
                            <?php endif; ?>
                          </div>
                          <div class="table-responsive rounded card-table overflow-visible">
                              <table class="table border-no" id="example1">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Title</th>
                                          <th>Schedule</th>
                                          <th>Status</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                      <tr class="hover-primary">
                                          <td><?php echo e($index+1); ?></td>
                                          <td><?php echo e($event->name); ?></td>
                                          <td>
                                            <strong>Start</strong> : <?php echo e($event->start?date('M d, Y @ h:i a', strtotime($event->start)):'---'); ?> <br>
                                            <strong>End</strong> : <?php echo e($event->end?date('M d, Y @ h:i a', strtotime($event->end)):'---'); ?>

                                          </td>
                                          <td><?php echo e($event->status); ?></td>
                                          <td>												
                                              <div class="btn-group pull-right">
                                                <?php if(auth()->user()->type == 'participant'): ?>
                                                <!-- <?php echo e(auth()->user()->myCertificate($event->id)); ?> -->
                                                <?php if(auth()->user()->myCertificate($event->id)): ?>
                                                <a href="<?php echo e(route('backoffice.certificates.view', auth()->user()->myCertificate($event->id)->certificate_id)); ?>" target="_blank" class="waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; View Certificate</a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('backoffice.events.view', $event->id)); ?>" class="waves-effect waves-light btn btn-primary-light"><i data-feather="message-square"></i>&nbsp; Give Feedback</a>
                                                <?php endif; ?>
                                                <?php if($event->status == 'Pending'): ?>
                                                <a href="<?php echo e(route('backoffice.events.update_status',[ $event->id, 'Happening'])); ?>" class="waves-effect waves-light btn btn-primary-light"><i data-feather="cast"></i>&nbsp; Mark as Happening</a>
                                                <?php elseif($event->status == 'Happening'): ?>
                                                <a href="<?php echo e(route('backoffice.events.update_status', [$event->id, 'Completed'])); ?>" class="waves-effect waves-light btn btn-success-light"><i data-feather="check"></i>&nbsp; Mark as Completed</a>
                                                <?php elseif($event->status == 'Completed' AND auth()->user()->type != 'participant'): ?>
                                                <a href="<?php echo e(route('backoffice.events.generate_certificate', $event->id)); ?>" target="_blank" class="waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; Generate Certificate</a>
                                                <?php endif; ?>
                                                <a class="waves-effect waves-light btn btn-light no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?php echo e(route('backoffice.events.view', $event->id)); ?>">View event</a>
                                                    <?php if(auth()->user()->type != 'participant'): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('backoffice.events.edit', $event->id)); ?>">Edit event</a>
                                                    <a class="dropdown-item" href="<?php echo e(route('backoffice.events.cancel', $event->id)); ?>">Cancel event</a>
                                                    <?php endif; ?>
                                                </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                      <tr class="hover-primary">
                                        <td colspan="7" class="text-center">No <?php echo e($title); ?> record yet...</td>
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

<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('vet-clinic/main/js/vendors.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/chat-popup.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/icons/feather-icons/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/datatable/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/template.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/events.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\markj\OneDrive\Desktop\capstone\smartserminar-suit\resources\views/backoffice/pages/events/list.blade.php ENDPATH**/ ?>