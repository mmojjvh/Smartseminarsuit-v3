

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
                              <li class="breadcrumb-item active" aria-current="page">Staff List</li>
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
                      <div class="box-body overflow-auto">
                          <div class="row">
                            <div class="col-md-4">
                                <form action="" method="get">
                                <input type="text" name="search" value="<?php echo e(Input::has('search')?Input::get('search'):''); ?>" class="form-control pull-right" placeholder="Search for a Staff...">
                                </form>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <a href="<?php echo e(route('backoffice.staffs.create')); ?>" class="waves-effect waves-light btn btn-outline btn-primary mb-5 pull-right">Create New</a>
                            </div>
                          </div>
                          <div class="table-responsive rounded card-table overflow-visible">
                              <table class="table border-no" id="example1">
                                  <thead>
                                      <tr>
                                          <th style="width: 5%;">#</th>
                                          <th style="width: 40%;">Name</th>
                                          <th style="width: 55%;">Email</th>
                                          <!-- <th style="width: 5%;"></th> -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                      <tr class="hover-primary">
                                          <td><?php echo e($index+1); ?></td>
                                          <td><?php echo e($staff->fname); ?> <?php echo e($staff->lname); ?></td>
                                          <td><?php echo e($staff->user->email); ?></td>
                                          
                                      </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                      <tr class="hover-primary">
                                        <td colspan="6" class="text-center">No <?php echo e($title); ?> record yet...</td>
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
<script src="<?php echo e(asset('vet-clinic/main/js/pages/patients.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\smartserminar-suit\resources\views/backoffice/pages/staffs/index.blade.php ENDPATH**/ ?>