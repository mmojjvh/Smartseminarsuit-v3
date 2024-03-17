@extends('backoffice._layout.main')

@push('title',$title)

@push('css')
<style>
	.m-0{
		margin: 0px!important;
	}
	.chat-item{
		cursor: pointer;
	}
	.float-start{
		border-radius: 20px;
		border-top-left-radius: 5px;
	}
	.float-end{
		border-radius: 20px;
		border-bottom-right-radius: 5px;
	}
	.box-footer{
		display: none;
	}
	.slimScrollDiv{
		height: 350px;
	}
	.chat-box-list{
		background: #ffffff;
		padding: 20px;
		border-radius: 10px;
		margin-bottom: 20px;
		position: relative;
		overflow-x: hidden;
		overflow-y: scroll;
		height: 350px;
	}
	.chat-header{
		height: 45px;
		font-size: 20px;
		font-weight: 300;
	}
	.chat-title{
		height: 45px;
		font-size: 20px;
		font-weight: 300;
	}
	.book-form{
		display: none;
	}
	::-webkit-scrollbar {
		width: 5px;
	}
</style>
@endpush

@push('content')
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-3 col-12">
					<div class="chat-box-list">
						<div class="chat-header">Guest Chat Box</div>
						<div class="chat-list media-list media-list-hover">
						</div>
					</div>
					<div class="chat-box-list">
						<div class="chat-header">Pending Appointment Request</div>
						<div class="book-list media-list media-list-hover">
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-12">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="box">
							  <div class="box-header">
								<div class="media align-items-top p-0">
									<div class="d-lg-flex d-block justify-content-between align-items-center w-p100 m-0">
										<div class="media-body m-0">
											<p class="fs-16">
											  <strong class="chat-title">Select a Chat Box or Appointment Request</strong>
											</p>
										</div>
									</div>				  
								</div>             
							  </div>
							  <div class="box-body">
									<div class="chat-box-one2">
									</div>
									<div class="book-form">
										<form action="" method="POST" id="bookForm">
										{{csrf_field()}}
										<div class="book-details">
											<p><strong>Name :</strong> <span id="book-name">Joshua Arosco</span></p>
											<p><strong>Email :</strong> <span id="book-email">aroscojoshua@gmail.com</span></p>
											<p><strong>Contact #:</strong> <span id="book-contact">09957807232</span></p>
											<p><strong>Date :</strong> <span id="book-date">2023-01-01</span></p>
											<p><strong>Details :</strong> <span id="book-details">Tooth Extraction</span></p>
										</div>
										<input type="hidden" name="name" id="input-name">
										<input type="hidden" name="email" id="input-email">
										<input type="hidden" name="contact" id="input-contact">
										<input type="hidden" name="details" id="input-details">
										<div class="row mt-3">
											<div class="col-md-12">
												<div class="form-group {{$errors->has('service_id')?'error':null}}">
													<label class="form-label">Service <span class="text-danger">*</span></label>
													<select name="service_id" class="form-control bg-white" required>
														<option value="">---</option>
														@foreach($services as $index => $service)
														@if($appointment AND $appointment->service_id == $index OR old('service_id') == $index)
														<option value="{{ $index }}" selected>{{ $service }}</option>
														@else
														<option value="{{ $index }}">{{ $service }}</option>
														@endif
														@endforeach
													</select>
													@if($errors->has('service_id'))
													<div class="help-block"><ul role="alert"><li>{{$errors->first('service_id')}}</li></ul></div>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group {{$errors->has('status')?'error':null}}">
													<label class="form-label">Status <span class="text-danger">*</span></label>
													<select name="status" class="form-control bg-white input-pet" id="input-status" required>
														<option value="">---</option>
														@foreach($statuses as $index => $status)
														@if($appointment AND $appointment->status == $status OR old('status') == $index)
														<option value="{{ $status }}" selected>{{ $status }}</option>
														@else
														<option value="{{ $status }}">{{ $status }}</option>
														@endif
														@endforeach
													</select>
													@if($errors->has('status'))
													<div class="help-block"><ul role="alert"><li>{{$errors->first('status')}}</li></ul></div>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group {{$errors->has('start')?'error':null}}">
													<label class="form-label">Start Time & Date <span class="text-danger">*</span></label>
													<input type="datetime-local" name="start" value="{{old('start',$appointment?$appointment->start:'')}}" class="form-control" placeholder="Start Time & Date" required>
													@if($errors->has('start'))
													<div class="help-block"><ul role="alert"><li>{{$errors->first('start')}}</li></ul></div>
													@endif
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group {{$errors->has('end')?'error':null}}">
													<label class="form-label">End Time & Date <span class="text-danger">*</span></label>
													<input type="datetime-local" name="end" value="{{old('end',$appointment?$appointment->end:'')}}" class="form-control" placeholder="End Time & Date" required>
													@if($errors->has('end'))
													<div class="help-block"><ul role="alert"><li>{{$errors->first('end')}}</li></ul></div>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<button class="btn btn-primary btn-md" id="book-btn" type="submit">Mark the Date</button>
											</div>
										</div>
										</form>
									</div>
							  </div>
							  <div class="box-footer no-border">
								 <div class="d-md-flex d-block justify-content-between align-items-center bg-white p-5 rounded10 b-1 overflow-hidden">
										<input type="hidden" id="message-id">
										<input type="hidden" id="book-id">
										<input class="form-control b-0 py-10" type="text" id="input-message" placeholder="Say something...">
										<div class="d-flex justify-content-between align-items-center mt-md-0 mt-30">
											<button type="button" class="waves-effect waves-circle btn btn-circle btn-primary" id="btn-send">
												<i class="mdi mdi-send"></i>
											</button>
										</div>
									</div>
							  </div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="box">
								<div class="box-body px-0 pt-0">
									<div id="calendar" class="dask min-h-400"></div>
								</div>
								<div class="box-body p-0">
								</div>
							</div>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default">Feed more data to your AI</button>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('backoffice.chatbot.train') }}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="modal-header">
				<h4 class="modal-title">Train your AI</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label for="formFile" class="form-label">Upload .CSV file containing Question and Answer to train your AI</label>
				<input class="form-control" type="file" name="file" id="formFile" required>
			</div>
			<div class="modal-footer" style="display: flex;">
				<button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Upload</button>
			</div>
			</form>
		</div>
	</div>
</div>
@endpush

@push('js')
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<!-- <script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script> -->
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>

<script src="{{asset('vet-clinic/assets/vendor_components/moment/min/moment.min.js')}}"></script>
<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>

<script src="{{asset('vet-clinic/main/js/fullcalendar.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'Asia/Singapore',
            themeSystem: 'bootstrap5',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            dayMaxEvents: true, // allow "more" link when too many events
            events: {!! $events !!}
        });
        
        calendar.render();
    });
    
</script>

<script type="module">
	import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js";
	import { getCountFromServer, getFirestore, setDoc, addDoc, doc, collection, updateDoc, deleteDoc, onSnapshot, query, getDocs, or, where, getDoc, limit, and, serverTimestamp } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-firestore.js";

	const firebaseConfig = {
        apiKey: "AIzaSyB6AwYq5DNv8fqWTMxCqyU_sAp--id9aMM",
        authDomain: "dental-clinic-3ccac.firebaseapp.com",
        projectId: "dental-clinic-3ccac",
        storageBucket: "dental-clinic-3ccac.appspot.com",
        messagingSenderId: "563628572047",
        appId: "1:563628572047:web:ce6dbc3fa7b5baa337dffa",
        measurementId: "G-HEX3P0G7S7"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);

	const messagesRef = collection(db, "messages");
    const q = query(messagesRef);

    let counter = 0;

    const unsubscribe = onSnapshot(q, (querySnapshot) => {
		
		$(".chat-list").empty();
        querySnapshot.forEach((doc) => {
            counter +=1;

			let data = doc.data();
			let index = data.thread.length;
			var str = data.visitor_id;
			let latest = data.thread[index-1].message;

			if(latest.length > 30) latest = latest.substring(0,30);
			if(str.length > 20) str = str.substring(0,20);

			$(".chat-list").append(`
				<div class="media p-0 mb-3 chat-item-${data.id}" data-messageId="${data.id}">
					<div class="media-body m-0">
					<p>
						<a class="hover-primary" href="#"><strong>${str}...</strong></a>
					</p>
					<p>${latest}...</p>
					</div>
				</div>
			`);
			$(".chat-item-"+data.id).on("click", function(){
				
				$('.slimScrollDiv').css("display", "block");
				$('.book-form').css("display", "none");
				
				var id = data.id;
				getMessageThread(id);
				
				let title = document.querySelector(".chat-title");
				title.innerHTML = str+"...";
				
				$("#message-id").val(id);
				$(".box-footer").css("display", "block");
			});
        });
    });
	let thread = [];

	function getMessageThread(messageId){
		console.log("MESSAGE ID: "+messageId);
        const messageRef = collection(db, "messages");
        const q = query(messageRef, 
            where("id", "==", messageId),
            limit(1)
        );
		
        const senderId = 'admin'; 
        const unsubscribe = onSnapshot(q, (querySnapshot) => {

            querySnapshot.forEach((doc) => {
                thread = doc.data().thread;
            });

            if(thread){
                $('.chat-box-one2').empty();
                thread.forEach(function(item) {
                    let d = item.sent_at;
                    var time = moment(d).format('hh:mm a - L');

                    let position = '';

                    if(item.sender_id == senderId){
                        $('.chat-box-one2').append(`
							<div class="card d-inline-block mb-3 float-end me-2 bg-primary max-w-p80">
								<div class="card-body">
									<div class="chat-text-start">
										<p class="mb-0 text-semi-muted">${item.message}</p><br>
										<small>${time}</small>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
						`);
                    }else{
                        $('.chat-box-one2').append(`
							<div class="card d-inline-block mb-3 float-start me-2 no-shadow bg-lighter max-w-p80">
								<div class="card-body">
									<div class="chat-text-start">
										<p class="mb-0 text-semi-muted">${item.message}</p><br>
										<small>${time}</small>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
                        `);
                    }
                });
                
                var body = document.querySelector('.chat-box-one2');
                let height = 0;
                if(body.scrollHeight == 0){
                    height = 500;
                }else{
                    height = body.scrollHeight;
                }
                console.log(height);
                body.scrollTop = height;
            }
            
        });
    }

	$("#btn-send").on("click", function(){
		var messageId = $("#message-id").val();
		sendMessage(messageId)
	});

	function sendMessage(messageId){

		const messageRef = collection(db, "messages");
		const q = query(messageRef, 
			where("id", "==", messageId),
			limit(1)
		);

		const unsubscribe = onSnapshot(q, (querySnapshot, thread) => {
			querySnapshot.forEach((doc) => {
				thread = doc.data().thread;
			});
		});

		let inputMessage = document.getElementById("input-message").value;
		if(!thread){
			thread = []
		}
		if(inputMessage!=''){
			let senderId = 'admin';
			const newThreadMessage = [
				{sent_at: Date.now(), sender_id: senderId, message: inputMessage }
			];

			const allMessage = [...thread, ...newThreadMessage];

			updateDoc(doc(db, "messages", messageId), {
				thread: allMessage
			});

			document.getElementById("input-message").value = '';
		}
	}

	const appointmentRef = collection(db, "appointments");
    const qu = query(appointmentRef, where("status", "==", 'pending'));

	const unsub = onSnapshot(qu, (querySnapshot) => {
		
		$(".book-list").empty();
        querySnapshot.forEach((doc) => {
            counter +=1;

			let data = doc.data();
			var str = data.name;
			let latest = data.details;

			if(latest.length > 30) latest = latest.substring(0,30);

			$(".book-list").append(`
				<div class="media p-0 mb-3 book-item-${data.id}">
					<div class="media-body m-0">
					<p>
						<a class="hover-primary" href="#"><strong>${str}</strong></a>
					</p>
					<p>${latest}...</p>
					</div>
				</div>
			`);
			
			$(".book-item-"+data.id).on("click", function(){
				var id = data.id;
				getAppointmentDetail(id);
				
				let title = document.querySelector(".chat-title");
				title.innerHTML = str;
				
				$("#book-id").val(id);
				$(".box-footer").css("display", "none");
			});
        });
    });

	function getAppointmentDetail(bookId){
        const bookRef = collection(db, "appointments");
        const q = query(bookRef, 
            where("id", "==", bookId),
            limit(1)
        );
		
        const unsubscribe = onSnapshot(q, (querySnapshot) => {

            querySnapshot.forEach((doc) => {
                let data = doc.data();

				var date = moment(data.date).format('MMMM D, Y');

				$('.chat-box-one2').empty();
				$('.book-form').css("display", "block");
				$('.slimScrollDiv').css("display", "none");
				
				document.querySelector('#book-name').innerHTML = data.name;
				document.querySelector('#book-email').innerHTML = data.email;
				document.querySelector('#book-contact').innerHTML = data.contact;
				document.querySelector('#book-date').innerHTML = date;
				document.querySelector('#book-details').innerHTML = data.details;

				$('#input-name').val(data.name);
				$('#input-email').val(data.email);
				$('#input-contact').val(data.contact);
				$('#input-details').val(data.details);
            });
            
        });
	}

	let bookForm = document.getElementById("bookForm");
	bookForm.addEventListener("submit", (e) => {
		e.preventDefault();
		let bookId = $("#book-id").val();
		let status = $("#input-status").val();

		updateDoc(doc(db, "appointments", bookId), {
			status: status
		});

		bookForm.submit();
	});
</script>
@endpush