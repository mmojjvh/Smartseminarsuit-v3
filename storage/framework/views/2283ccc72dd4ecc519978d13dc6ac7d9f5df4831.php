

<?php $__env->startPush('title',$title.' List'); ?>

<?php echo $__env->make('commons.customfonts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo e(URL::asset('custom/customfonts.css')); ?>">

<?php $__env->startPush('css'); ?>
  <style type="text/css">
    .overflow-visible { 
      overflow: visible;
    }
    .editable {
      cursor:hand;
    }
  </style>
<?php $__env->stopPush(); ?>

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

  $commands = [
    "Blue border and a small gold seal, use light colors and gradients. Do not use dark colors.",
    "Test",

  ]
                      
?>

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
                                                <?php if(auth()->user()->myCertificate($event->id) && auth()->user()->myFeedback($event->id)): ?>
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

                                                <a id="" data-toggle="modal" data-target="#exampleModal" href="#" class="promptToggleBtn waves-effect waves-light btn btn-warning-light" data-event="<?php echo e($event); ?>"><i data-feather="award"></i>&nbsp; Generate Certificate</a>
                                                
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

<div class="modal fade" id="templateModal" tabindex="-5" role="dialog" aria-labelledby="templateModalLabel">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="templateModalLabel"><i data-feather="award"></i> Generate Certificate</h5>
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

                </div>
              </div>
            </div>
          </div>
        </div>
        <br><br>
        <div class="modal-footer float-right">
          <button id="cancelSelectTemplateBtn" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
          <button id="doneSelectTemplateBtn" data-dismiss="modal" class="btn btn-primary">Done</button>
        </div>
      </div>
    
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    
    <div class="modal-content" style="overflow:auto;overflow-y:scroll;height: 630px;">
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

                <input type="text" class="form-control" placeholder="Enter certificate title" name="cert_title" required id="certTitleInput" />

                <input style="color:black;visibility:hidden;" required type="text" name="id" id="promptEventId" />
                <input required readonly type="text" name="backgroundimage" id="backgroundImageInput" style="display:none;">
                <input required readonly type="text" name="use_template" id="useTemplateInput" style="display:none;">
                                  
                <p>Enter the prompt that the AI will use to generate the certificate background.</p>

                <div class="row">
                  <div class="col-lg-12">
                    <select class="form-control" id="commandsSelect">
                      <option selected disabled>* Select pre-defined template commands</option>
                      <?php $__currentLoopData = $commands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($command); ?>"><?php echo e($command); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>                  
                </div>
                <div class="row col-lg-12 m-1 mt-2">
                  <textarea class="form-control" name="prompt" id="promptInput" style="width: 100%;" rows="5"></textarea>
                  <div class="col-sm-6 mt-2">
                    <button type="button" id="generateBtn" class="btn btn-secondary">Generate Image</button>
                    <button type="button" data-dismiss="modal" id="selectTemplateBtn" class="btn btn-secondary">Select Template</button>
                  </div>
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-md-12 mt-2">
                        <label>Fonts Customization:</label>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-lg-10">
                                  <select class="form-control" id="fontSelect">
                                    <option selected disabled>Select Font</option>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <input type="color" class="form-control btn-sm" style="width:50px;height:30px;" id="colorSelect" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input readonly type="text" name="cfheading" id="cfheading" style="display:none;">
                      <input readonly type="text" name="cftitle" id="cftitle" style="display:none;">
                      <input readonly type="text" name="cftext" id="cftext" style="display:none;">
                      <input readonly type="text" name="cfquotes" id="cfquotes" style="display:none;">

                      <input readonly type="text" name="cfheadingcolor" id="cfheadingcolor" style="display:none;">
                      <input readonly type="text" name="cftitlecolor" id="cftitlecolor" style="display:none;">
                      <input readonly type="text" name="cftextcolor" id="cftextcolor" style="display:none;">
                      <input readonly type="text" name="cfquotescolor" id="cfquotescolor" style="display:none;">

                    </div>
                  </div>
                </div>
              </div>
            </div>   

            <div class="mt-5">
              <div class="col-md-12">
                <label>Preview:</label>
                <br>
                <div class="row m-3 p-2">
                  <div class="preview-body">
                    <center>
                      <br><br>
                      <h1 class="editable" id="preview-heading" style="text-transform:uppercase;">CERTIFICATE OF COMPLETION</h1>
                      <label>IS PRESENTED TO:</label>
                      <br />
                      <h2 class="editable" id="preview-title">Juan Dela Cruz</h2>
                      <br />

                      <div class="text-center" style="text-align:center;">
                        <label class="editable" id="preview-text" >This is the texts section this is the texts section</label>
                        <br />
                        <label class="editable" id="preview-quotes" style="font-style:italic;">" This is a sample quotation section "</label>
                      </div>
                      <br>
                      <br><br>
                    </center>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer float-right">
          <button data-dismiss="modal" type="button" class="btn btn-secondary">Cancel</button>
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

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script>
    // "global" vars, built using blade
    var templatesUrl = '<?php echo e(URL::asset('images/certificates/templates/')); ?>';

    $(function () {
      $('[data-toggle="popover"]').popover()
    })
</script>
<script type="text/javascript">

  let currentEvent = {id: null, name: ''};
  let selectedItemToEdit = null;  

  const defaultPrompt = '<?php echo e(env('DEFAULT_PROMPT')); ?>';

  function setPromptInputValue () {
    $("#promptInput").val(defaultPrompt.replace("%event_name%", currentEvent.name));
    $("#promptEventId").attr("value", currentEvent.id);
    $("#promptEventId2").attr("value", currentEvent.id);
  }

  $(".promptToggleBtn").on("click", (e) => {
    let data = $(e.currentTarget).data("event");
    currentEvent = data;
    $("#promptEventId").attr("value", currentEvent.id);
  });

  $("#commandsSelect").on("change", (e) => {
    $("#promptInput").val(e.target.value);
  });

  $("#selectTemplateBtn").on("click", (e) => {
    $("#templateModal").modal("show");
  });

  $("#doneSelectTemplateBtn").on("click", (e) => {
    let urlvalue = $("#backgroundImageInput").val()
    let url = urlvalue.split("/")[3]
    console.log(url)
    $("#useTemplateInput").val("true")
    $(".preview-body").attr("style", `
      background: url(${templatesUrl}/${url});
      background-size: 100% 100%;
      background-repeat: no-repeat;
      object-fit:cover;`);
      $("#templateModal").modal("hide");
    $("#exampleModal").modal("show");
  });

  $("#cancelSelectTemplateBtn").on("click", (e) => {
    $("#backgroundImageInput").val("")
  })

  $(".editable").on("click", (e) => {
    let id = $(e.currentTarget).attr("id")
    loadCustomFonts("fontSelect", id, (val) => {
      $(`#cf${id.replace("preview-", "")}`).val(val)
    })
    $("#colorSelect").attr("data-target", id)
    selectedItemToEdit = id
  })

  $("#colorSelect").on("change", (e) => {
    $(`#${selectedItemToEdit}`).css("color", e.currentTarget.value)
    $(`#cf${selectedItemToEdit.replace("preview-", "")}color`).val(e.currentTarget.value)
  })

  $("#generateBtn").on("click", (e) => {
    $("#generateBtn").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Generating</span>')
    let prompt = $("#promptInput").val()
    let url = window.location.origin + '/api/certificate/generate?prompt='+prompt
    $.get(url).then((res) => {
      console.log(res)
      $("#generateBtn").html("Generate Image")

      if(res){
        $(".preview-body").attr("style", `
          background: url(${res});
          background-size: 100% 100%;
          background-repeat: no-repeat;
          object-fit:cover;`);
        $("#backgroundImageInput").val(res)
        $("#useTemplateInput").val("")
      }

    }).catch((error) => {
      console.log(error)
      $("#generateBtn").html("Generate Image")
    })
    
  })

  $(".selectTemplateBtn").on("click", (e) => {

    let url = $(e.target).data("url")
    $("#backgroundImageInput").val(url)
    $("#promptInput").val("")
    
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

  $("#certTitleInput").on("input", (e) => {
    $("#preview-heading").html(e.currentTarget.value)
  })

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Smartseminarsuit-v3\resources\views/backoffice/pages/events/list.blade.php ENDPATH**/ ?>