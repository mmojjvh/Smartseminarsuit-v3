

<?php $__env->startPush('title',$title.' List'); ?>

<?php echo $__env->make('commons.customfonts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('custom/customfonts.css')); ?>">

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
                                                
                                                <!-- <a id="generateCertificateBtn_<?php echo e($event->id); ?>" style="display: none;" href="<?php echo e(route('backoffice.events.generate_certificate', [$event->id, ''])); ?>" target="_blank" class=" waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; Generate Certificate</a> -->

                                                <!-- <a id="generateCertificateBtn_<?php echo e($event->id); ?>" style="display: none;" href="<?php echo e(route('backoffice.events.certificate-prompt', [$event->id, ''])); ?>" target="_blank" class=" waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; Generate Certificate</a> -->

                                                <a id="" data-toggle="modal" data-target="#exampleModal2" href="#" class="promptToggleBtn waves-effect waves-light btn btn-warning-light" data-event="<?php echo e($event); ?>"><i data-feather="award"></i>&nbsp; Generate Certificate</a>
                                                
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


<div class="modal fade" id="exampleModal2" tabindex="-9" role="dialog" aria-labelledby="exampleModalLabel">
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
              <p>Select the template for the event's certificate</p>
                <div class="col-lg-12" id="templates-container" style="height:500px;overflow-y:scroll;">
                  <div class="row" >

                    <?php 

                      $templates = [
                        "images/certificates/templates/template1.png",
                        "images/certificates/templates/template2.png",
                        "images/certificates/templates/template3.png",
                        "images/certificates/templates/template4.png",
                        "images/certificates/templates/template5.png",
                        "images/certificates/templates/template6.png",
                        "images/certificates/templates/template7.png",
                        "images/certificates/templates/template8.png",
                        "images/certificates/templates/template9.png",
                        "images/certificates/templates/template10.png",
                        "images/certificates/templates/template11.png",
                        "images/certificates/templates/template12.png",
                        "images/certificates/templates/template13.png",
                        "images/certificates/templates/template14.png",
                      ];
                    
                    ?>

                    <?php if(isset($templates)): ?>
                      <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4">
                          <div class="card active" style="padding:0;">
                            <div class="card-body">
                              <img src="<?php echo e(asset($template)); ?>" style="width:300px;height:130px;" />
                            </div>
                            <div class="card-footer align-items-center text-center">
                              <a type="button" class="btn btn-secondary selectTemplateBtn" data-url=" <?php echo e($template); ?> ">Select Template</a>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    

                    <!-- <div class="col-lg-4">
                      <div class="card" style="padding:0;">
                        <div class="card-body">
                          <img src="<?php echo e(asset('images\certificates\business-orientation-seminar-and-training-program.jpg')); ?>" style="width:250px;height:180px;" />
                        </div>
                        <div class="card-footer align-items-center text-center">
                          <a type="button" class="btn btn-primary">Select Template</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="card" style="padding:0;">
                        <div class="card-body">
                          <img src="<?php echo e(asset('images\certificates\capability-building-seminar-empowering-youth-leadership.jpg')); ?>" style="width:250px;height:180px;" />
                        </div>
                        <div class="card-footer align-items-center text-center">
                          <a type="button" class="btn btn-primary">Select Template</a>
                        </div>
                      </div>
                    </div> -->

                  </div>
                </div>
            </div>
          <br/>
        </div>
      </div>
      <br><br>
      <input required readonly type="text" name="id" id="promptEventId" style="display:none;">
      <input required readonly type="text" name="prompt" id="" style="display:none;">
      <input required readonly type="text" name="template" value="true" style="display:none;">
      <input required readonly type="text" name="backgroundimage" id="templateImageUrl" style="display:none;">
      
      <input required readonly type="text" name="cfheading" value="" style="display:none;">
      <input required readonly type="text" name="cftitle" value="" style="display:none;">
      <input required readonly type="text" name="cftext" value="" style="display:none;">
      <input required readonly type="text" name="cfquotes" value="" style="display:none;">
      <input required readonly type="text" name="cfheadingcolor" value="" style="display:none;">
      <input required readonly type="text" name="cftitlecolor" value="" style="display:none;">
      <input required readonly type="text" name="cftextcolor" value="" style="display:none;">
      <input required readonly type="text" name="cfquotescolor" value="" style="display:none;">

      <div class="modal-footer float-right">
        <button id="useCustomBtn" type="button" data-dismiss="modal" data-target="exampleModal" class="btn btn-secondary">Use Custom Design</button>
        <button id="proceedBtn" type="submit" class="btn btn-primary">Proceed</button>
      </div>
    </form>
  </div>
    
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                  <p>Enter the prompt that the AI will use to generate the certificate background.</p>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input style="color:black;visibility:hidden;" required type="text" name="id" id="promptEventId2" value="<?php echo e(isset($_GET['id']) ? $_GET['id'] : 'hehe'); ?> " />
              <textarea required name="prompt" id="promptInput" style="width: 100%;" rows="5"></textarea>
            </div>
          </div>
          <br/>
          
          <div class="row">
            <div class="col-md-12">
              <label>Fonts Customization:</label>
              <br>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Heading</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-heading" name="cfheading">
                          <option disabled>Select Font</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-heading-color" name="cfheadingcolor" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Title</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-title" name="cftitle">
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-title-color" name="cftitlecolor" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Text</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-text" name="cftext">
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-text-color" name="cftextcolor" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Quotes</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-quotes" name="cfquotes">
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-quotes-color" name="cfquotescolor" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-5">
            <div class="col-md-12">
              <label>Preview:</label>
              <br>
              <div class="row">

                <center>

                  <h1 id="preview-heading">CERTIFICATE OF COMPLETION</h1>
                  <label>IS PRESENTED TO:</label>
                  <br />
                  <h2 id="preview-title">Juan Dela Cruz</h2>
                  <br />

                  <div class="text-center" style="text-align:center;">
                    <label id="preview-text" >This is the texts section this is the texts section</label>
                    <br />
                    <label id="preview-quotes" style="font-style:italic;">" This is a sample quotation section "</label>
                  </div>

                </center>

              </div>
            </div>
          </div>

        </div>
      </div>
      <br><br>
      <div class="modal-footer float-right">
        <button id="useDefaultBtn" data-dismiss="modal" data-target="exampleModal2" type="button" class="btn btn-secondary">Use Default Template</button>
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

<script src="<?php echo e(URL::asset('custom/js/customfonts.js')); ?>"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>


<script type="text/javascript">

  let currentEvent = {id: null, name: ''};

  const defaultPrompt = '<?php echo e(env('DEFAULT_PROMPT')); ?>';

  function setPromptInputValue () {
    $("#promptInput").val(defaultPrompt.replace("%event_name%", currentEvent.name));
    $("#promptEventId").attr("value", currentEvent.id);
    $("#promptEventId2").attr("value", currentEvent.id);
  }

  $(".promptToggleBtn").on("click", (e) => {
    let data = $(e.currentTarget).data("event");
    currentEvent = data;
    setPromptInputValue();
  });

  $(document).ready(function() {
    $("#useDefaultBtn").on("click", () => {
      setPromptInputValue();
      $("#exampleModal").modal("hide");
      $("#exampleModal2").modal("show");
    });

    $("#useCustomBtn").on("click", () => {
      setPromptInputValue();
      $("#exampleModal2").modal("hide");
      $("#exampleModal").modal("show");
    });
  })

  


  // font customizations
  loadCustomFonts("cf-heading", "preview-heading")
  loadCustomFonts("cf-title", "preview-title")
  loadCustomFonts("cf-text", "preview-text")
  loadCustomFonts("cf-quotes", "preview-quotes")

  $("#cf-heading-color").on("change", (e) => {
    $("#preview-heading").css("color", e.currentTarget.value)
  })

  $("#cf-title-color").on("change", (e) => {
    $("#preview-title").css("color", e.currentTarget.value)
  })

  $("#cf-text-color").on("change", (e) => {
    $("#preview-text").css("color", e.currentTarget.value)
  })

  $("#cf-quotes-color").on("change", (e) => {
    $("#preview-quotes").css("color", e.currentTarget.value)
  })

  $(".selectTemplateBtn").on("click", (e) => {

    let url = $(e.target).data("url")
    $("#templateImageUrl").val(url)

    $(".selectTemplateBtn").each((index) => {

      let btn = $(".selectTemplateBtn")[index]
      let _url = $(btn).data("url")

      if(_url == url){
        $(btn).attr("class", "btn btn-primary selectTemplateBtn")
        $(btn).html("Selected")
      }else{
        $(btn).attr("class", "btn btn-secondary selectTemplateBtn")
        $(btn).html("Select Template")
      }
    
    })

  })

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Smartseminarsuit-v3\resources\views/backoffice/pages/events/list.blade.php ENDPATH**/ ?>