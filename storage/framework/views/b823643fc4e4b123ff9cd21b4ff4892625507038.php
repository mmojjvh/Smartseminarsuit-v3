

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
    .form-control:disabled, .form-control:read-only {
        background-color: #ffffff;
        opacity: 1;
    }
    #sig-canvas {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
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
                                <li class="breadcrumb-item active" aria-current="page">Create Event</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $__env->make('backoffice._components.session_notif', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Create Event</h4>
                        </div>
                        <!-- /.box-header -->
                        <?php echo $__env->make('backoffice.pages.events.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
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
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/template.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/editor.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/advanced-form-element.js')); ?>"></script>

<script>

function checkTimeRange(input, className) {
    console.log(input);
    // Get the selected date and time from the input
    const selectedDateTime = new Date(input.value);
    
    // Define the start and end times (in this case, 8am and 5pm)
    const startTime = new Date(selectedDateTime);
    startTime.setHours(8, 0, 0, 0); // 8am

    const endTime = new Date(selectedDateTime);
    endTime.setHours(17, 0, 0, 0); // 5pm

    // Check if the selected time is within the allowed range
    if (selectedDateTime < startTime || selectedDateTime > endTime) {
        $("."+className).addClass('error');
        alert('Please select a time between 8am and 5pm.');
        input.value = ''; // Reset the input value
        $('.'+className+"-error").css('display', 'block');
    }else{
        $('.'+className+"-error").css('display', 'none');
    }
}

$(function() {
    // $(".input-service-type").prop("disabled", true);
    // var today = new Date().toISOString().slice(0, 16);

    const currentDate = new Date();

    var year = currentDate.getFullYear();
    var month = currentDate.getMonth()+1;
    var dt = currentDate.getDate();

    if (dt < 10) {
        dt = '0' + dt;
    }
    if (month < 10) {
        month = '0' + month;
    }

    var today = year+'-' + month + '-'+dt;

    // document.getElementsById("start")[0].min = today;
    // document.getElementsById("end")[0].min = today;

    $("#start").on("change", function(){
        var val = $(this).val();

        var input = document.getElementById("end");
        input.setAttribute("min", val);

        var start_time = document.getElementById('start-time'), time, i;
        if(val == "<?php echo date('Y-m-d'); ?>"){
            for(i = 0; i < start_time.length; i++) {
                time = start_time[i];
                if(time.value < <?php echo date('H'); ?>){
                    time.disabled = true;
                }
            }
        }else{
            for(i = 0; i < start_time.length; i++) {
                time = start_time[i];
                time.disabled = false;
            }
        }
    });
    
    $("#end").on("change", function(){
        var val = $(this).val();
        var end_time = document.getElementById('end-time'), time, i;
        if(val == "<?php echo date('Y-m-d'); ?>"){
            for(i = 0; i < end_time.length; i++) {
                time = end_time[i];
                if(time.value < <?php echo date('H'); ?>){
                    time.disabled = true;
                }
            }
        }else{
            for(i = 0; i < end_time.length; i++) {
                time = end_time[i];
                time.disabled = false;
            }
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">
	(function() {
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
  })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
    $("#coordname").val("")
  }

  // Set up the UI
  // var sigText = document.getElementById("sig-dataUrl");
  var sigInput = document.getElementById("sig-Input");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");

  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    // sigText.innerHTML = "Data URL for your signature will go here!";
    sigInput.value = null;
    sigImage.setAttribute("src", "");
  }, false);

  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    var name = $("#coordname").val()
    var position = $("#coordpos").val()
    // sigText.innerHTML = dataUrl;

    // convert to Blob (async)
    canvas.toBlob( (blob) => {
      const file = new File( [ blob ], "signature.png" );
      const dT = new DataTransfer();
      dT.items.add( file );
      // document.getElementById("signatureInput").files = dT.files;
      renderCoordinator(name, position, dataUrl, dT.files);
      // document.querySelector( "input" ).files = dT.files;
    } );
    
    clearCanvas();
    // sigImage.setAttribute("src", dataUrl);
  }, false);	

  function renderCoordinator(name, position, img, file) {

    
    const total = $("#co-container .coord-row").length    

    $("#co-container").append(`<div class="col-md-12 p-2 coord-row row" id="coordRow${total + 1}Main" style="border-bottom:1px solid gray;justify-content:center;align-items:center;">
                                <div class="col-md-9 p-5" >
                                    <button type="button" id="coordRow${total + 1}" class="btn waves-effect waves-light btn btn-sm btn-outlined btn-danger coord-row-btn">
                                      <i class="ti-trash" style="pointer-events:none;"></i>
                                    </button>
                                    <label>&nbsp; ${name}</label>
                                </div>
                                <div class="col-md-3">
                                    <img src="${img}" width="100%" height="65" alt="" />
                                </div>
                            </div>`);

    $("#co-sig-inputs").append(`<input id="coordRow${total + 1}cosiginput" type="file" accept="image/*" name="coordinatesigs[]" multiple="multiple" style="visibility:hidden;" />`);
    $("#co-name-inputs").append(`<input id="coordRow${total + 1}conameinput" type="text" name="coordinatenames[]" value="${name}" multiple="multiple" style="visibility:hidden;" />`);
    $("#co-pos-inputs").append(`<input id="coordRow${total + 1}coposinput" type="text" name="coordinatepositions[]" value="${position}" multiple="multiple" style="visibility:hidden;" />`);
    
    document.getElementById(`coordRow${total + 1}cosiginput`).files = file

    $(".coord-row-btn").on("click", (e) => {
      let id = $(e.target).attr("id")
      $(`#${id}Main`).remove()
      $(`#${id}cosiginput`).remove()
      $(`#${id}conameinput`).remove()
    });
    
  }

})();

  $("#formSubmitBtn").on("click", () => {
    const totalCoordinates = $("#co-container .coord-row").length
    if(totalCoordinates > 5 || totalCoordinates < 2){
      $("#coordformerror").html("Coordinators must be more than 2 and less than 5")
      window.scrollTo(0, 0)
    }else{
      $("#eventForm").submit()
    }
  });

  $("#addCoordBtn").on("click", function() {
    $("#coordformerror").html("")
  })

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\markj\OneDrive\Desktop\Capstone 2\smartserminar-suit 1.0 (1)\smartserminar-suit\resources\views/backoffice/pages/events/create.blade.php ENDPATH**/ ?>