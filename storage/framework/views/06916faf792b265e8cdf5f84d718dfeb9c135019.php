

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
                              <li class="breadcrumb-item active" aria-current="page">Event Attendance List</li>
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
                          </div>
                          <div class="table-responsive rounded card-table overflow-visible">
                              <table class="table border-no" id="example1">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Event</th>
                                          <th>Schedule</th>
                                          <th>No. of Participants Attended</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                      <tr class="hover-primary">
                                          <td><?php echo e($index+1); ?></td>
                                          <td><strong><a href="<?php echo e(route('backoffice.events.view', $event->id)); ?>"><?php echo e($event->name); ?></a></strong></td>
                                          <td>
                                                <strong>Start</strong> : <?php echo e($event->start?date('M d, Y @ h:i a', strtotime($event->start)):'---'); ?> <br>
                                                <strong>End</strong> : <?php echo e($event->end?date('M d, Y @ h:i a', strtotime($event->end)):'---'); ?>

                                          </td>
                                          <td><?php echo e($event->attendance->count()); ?></td>
                                          <td>
                                            <a href="<?php echo e(route('backoffice.attendance.participants', $event->id)); ?>" class="waves-effect waves-light btn btn-primary-light pull-right">
                                                <i data-feather="book-open"></i> &nbsp; Attendance
                                            </a>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\markj\OneDrive\Desktop\Capstone 2\smartserminar-suit 1.0 (1)\smartserminar-suit\resources\views/backoffice/pages/attendance/index.blade.php ENDPATH**/ ?>