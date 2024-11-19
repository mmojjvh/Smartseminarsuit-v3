

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
                              <li class="breadcrumb-item active" aria-current="page">Participant List</li>
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
                                <input type="text" name="search" value="<?php echo e(Input::has('search')?Input::get('search'):''); ?>" class="form-control pull-right" placeholder="Search for a Participant...">
                                </form>
                            </div>
                            <!-- <div class="col-md-4 offset-md-4">
                                <a href="<?php echo e(route('backoffice.participants.create')); ?>" class="waves-effect waves-light btn btn-outline btn-primary mb-5 pull-right">Create New</a>
                            </div> -->
                          </div>
                          <div class="table-responsive rounded card-table overflow-visible">
                              <table class="table border-no" id="example1">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Gender</th>
                                          <th>Age</th>
                                          <th>Email</th>
                                          <th>Contact Number</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                      <tr class="hover-primary">
                                          <td><?php echo e($index+1); ?></td>
                                          <td><a href="<?php echo e(route('backoffice.participants.view', $participant->id)); ?>"><?php echo e($participant->user->name); ?></a></td>
                                          <td><?php echo e($participant->gender); ?></td>
                                          <td><?php echo e($participant->age); ?></td>
                                          <td><?php echo e($participant->user->email); ?></td>
                                          <td><?php echo e($participant->user->contact_number); ?></td>
                                          <td>												
                                              <div class="btn-group">
                                                <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="<?php echo e(route('backoffice.participants.view', $participant->id)); ?>">View Details</a>
                                                  <!-- <a class="dropdown-item" href="<?php echo e(route('backoffice.participants.edit', $participant->id)); ?>">Edit</a> -->
                                                  
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
<script src="<?php echo e(asset('vet-clinic/main/js/pages/participants.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Smartseminarsuit-v3\resources\views/backoffice/pages/participants/index.blade.php ENDPATH**/ ?>