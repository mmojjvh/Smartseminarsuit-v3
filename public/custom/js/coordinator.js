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
      var email = $("#coordemail").val()
      // sigText.innerHTML = dataUrl;
  
      // convert to Blob (async)
      canvas.toBlob( (blob) => {
        const file = new File( [ blob ], "signature.png" );
        const dT = new DataTransfer();
        dT.items.add( file );
        // document.getElementById("signatureInput").files = dT.files;
        renderCoordinator(name, position, email, dataUrl, dT.files);
        // document.querySelector( "input" ).files = dT.files;
      } );
      
      clearCanvas();
      // sigImage.setAttribute("src", dataUrl);
    }, false);	
  
    function renderCoordinator(name, position, email, img, file) {
  
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
      $("#co-email-inputs").append(`<input id="coordRow${total + 1}coemailinput" type="email" name="coordinateemails[]" value="${email}" multiple="multiple" style="visibility:hidden;" />`);
  
      document.getElementById(`coordRow${total + 1}cosiginput`).files = file
  
      $(".coord-row-btn").on("click", (e) => {
        let id = $(e.target).attr("id")
        $(`#${id}Main`).remove()
        $(`#${id}cosiginput`).remove()
        $(`#${id}conameinput`).remove()
        $(`#${id}coemailinput`).remove()
      });
      
    }
  
  })();