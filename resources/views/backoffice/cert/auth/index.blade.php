@extends('backoffice.auth._layout.main')

@push('content')
<div class="container h-p100">
  <div class="row align-items-center justify-content-md-center h-p100">	
    
    <div class="col-12">
      <div class="row justify-content-center g-0">
        <div class="col-lg-5 col-md-5 col-12">
          <div class="bg-white rounded10 shadow-lg">
            <div class="content-top-agile p-20 pb-0">
              <h2 class="text-primary">Verified and Authentic</h2>					
            </div>
            <div class="row p-20">
            	<div class="col-lg-6">
	            	<p class="mb-0">This certificate was issued by<br> <strong>{{ config('app.name') }}</strong> 
	               </p>
	               <br>
	              <p class="mb-0">Name of recipient<br> <strong>{{ $data["certificate"]["user_name"] }}</strong> 
	               </p>
	               <br>
	               <p class="mb-0">Date Issued<br> <strong>
	               {{ $data["certificate"]["date"]?date('M d, Y', strtotime($data["certificate"]["date"])):'---'}}
	               </strong> 
	               </p>	
	               <br>
	               <p class="mb-0">Certificate ID<br> <strong>{{ $data["certificate"]["certificate_id"] }}</strong> 
	               </p>			
            	</div>
	            <div class="col-lg-6 align-items-center mt-5">
	            	<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4gKSA4wTYk8c2mE0CMgn5yvIk3dCOClZYSg&s" width="75%" height="70%" />
	            </div>
            </div>
            <br>		
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$("button").click(function () {
	  $(".check-icon").hide();
	  setTimeout(function () {
	    $(".check-icon").show();
	  }, 10);
	});
</script>

@endpush
