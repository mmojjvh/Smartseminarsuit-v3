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
                                          <?php if(!$event->timeout): ?>
                                          <td><?php echo e($event->status); ?></td>
                                          <?php else: ?>
                                          <td>
                                            <strong>Signed Out</strong> : <?php echo e($event->timeout?date('M d, Y @ h:i a', strtotime($event->timeout)):'---'); ?>

                                          </td>
                                          <?php endif; ?>
                                          <td>												
                                              <div class="btn-group pull-right">
                                                <?php if(auth()->user()->type == 'participant'): ?>
                                                <!-- <?php echo e(auth()->user()->myCertificate($event->id)); ?> -->
                                                <?php if(auth()->user()->myCertificate($event->id)): ?>
                                                <a href="<?php echo e(route('backoffice.certificates.view', auth()->user()->myCertificate($event->id)->certificate_id)); ?>" target="_blank" class="waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; View Certificate</a>
                                                <?php endif; ?>
                                                <!-- <a href="<?php echo e(route('backoffice.events.view', $event->id)); ?>" class="waves-effect waves-light btn btn-primary-light"><i data-feather="message-square"></i>&nbsp; Give Feedback</a> -->
                                                <?php endif; ?>
                                                <?php if($event->status == 'Pending'): ?>
                                                <a href="<?php echo e(route('backoffice.events.update_status',[ $event->id, 'Happening'])); ?>" class="waves-effect waves-light btn btn-primary-light"><i data-feather="cast"></i>&nbsp; Mark as Happening</a>
                                                <?php elseif($event->status == 'Happening'): ?>
                                                  <?php if(!$event->timeout): ?>
                                                    <a href="<?php echo e(route('backoffice.events.quit_event', [$event->attendance_id])); ?>" class="waves-effect waves-light btn btn-danger-light"><i data-feather="log-out"></i>&nbsp; Quit Event</a>
                                                  <?php endif; ?>
                                                <?php elseif($event->status == 'Completed' AND auth()->user()->type != 'participant'): ?>
                                                
                                                <!-- <a id="generateCertificateBtn_<?php echo e($event->id); ?>" style="display: none;" href="<?php echo e(route('backoffice.events.generate_certificate', [$event->id, ''])); ?>" target="_blank" class=" waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; Generate Certificate</a> -->
        
                                                <!-- <a id="generateCertificateBtn_<?php echo e($event->id); ?>" style="display: none;" href="<?php echo e(route('backoffice.events.certificate-prompt', [$event->id, ''])); ?>" target="_blank" class=" waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; Generate Certificate</a> -->

                                                <a id="" data-toggle="modal" data-target="#exampleModal" href="#" class="promptToggleBtn waves-effect waves-light btn btn-warning-light" data-event="<?php echo e($event); ?>"><i data-feather="award"></i>&nbsp; Generate Certificate</a>
                                                
                                                <?php endif; ?>
                                                <a class="waves-effect waves-light btn btn-light no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu">
                                                   <?php if(!$event->timeout): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('backoffice.events.view', $event->id)); ?>">View event</a>
                                                    <?php endif; ?>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
      <div class="modal-content">
        <form action="<?php echo e(route('backoffice.events.certificate-prompt')); ?>" method="POST" target="_blank">
        <?php echo csrf_field(); ?>  <!-- This token is necessary for security reasons -->

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i data-feather="award"></i> Generate Certificate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <p>Enter the prompt that the AI will use to generate the certificate.</p>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <input required readonly type="text" name="id" id="promptEventId" style="display:none;">
                  <textarea required name="prompt" id="promptInput" style="width: 100%;" rows="10"></textarea>
              </div>
          </div>
          <br/>
      </div>
        </div>
        <div class="modal-footer">
          <button id="useDefaultBtn" type="button" class="btn btn-secondary">Use Default</button>
          <button id="proceedBtn" type="submit" class="btn btn-primary">Proceed</button>
        </div>

        </form>
      </div>
    
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>


<script type="text/javascript">

  let currentEvent = {id: null, name: ''};

  const defaultPrompt = '<?php echo e(env('DEFAULT_PROMPT')); ?>';

  function setPromptInputValue () {
    $("#promptInput").val(defaultPrompt.replace("%event_name%", currentEvent.name));
    $("#promptEventId").val(currentEvent.id);
  }

  $(".promptToggleBtn").on("click", (e) => {
    let data = $(e.currentTarget).data("event");
    currentEvent = data;
    setPromptInputValue();
  });

  $("#useDefaultBtn").on("click", () => {
    setPromptInputValue();
  });

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bpaltezo/Desktop/Smartseminarsuit-v3/resources/views/backoffice/pages/events/attendance.blade.php ENDPATH**/ ?>