<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="multinav">
			<div class="multinav-scroll" style="height: 100%;">	
				<!-- sidebar menu-->
				<ul class="sidebar-menu" data-widget="tree">				
					<li>
						<a class="{{in_array(request()->route()->getName(),['backoffice.index'])?'text-primary':''}}" href="{{route('backoffice.index')}}">
							<i data-feather="monitor" class="{{in_array(request()->route()->getName(),['backoffice.index'])?'text-primary':''}}"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a class="{{in_array(request()->route()->getName(),['backoffice.appointments.index'])?'text-primary':''}}" href="{{ route('backoffice.appointments.index') }}">
							<i data-feather="calendar" class="{{in_array(request()->route()->getName(),['backoffice.appointments.index'])?'text-primary':''}}"></i>
							<span>Appointments</span>
						</a>
					</li>		
					@if( in_array(auth()->user()->type, ['super_user', 'admin']) )			
					<li class="treeview {{Request::is('backoffice/patients*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/patients*')?'text-primary':''}}">
							<i data-feather="users" class="{{Request::is('backoffice/patients*')?'text-primary':''}}"></i>
							<span>Patients</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/patients*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.patients.index'])?'text-primary':''}}" href="{{route('backoffice.patients.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.patients.create'])?'text-primary':''}}" href="{{route('backoffice.patients.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>	
					</li>	
					<!-- <li>
						<a class="{{in_array(request()->route()->getName(),['backoffice.patients.index'])?'text-primary':''}}" href="{{ route('backoffice.patients.index') }}">
							<i data-feather="users" class="{{in_array(request()->route()->getName(),['backoffice.patients.index'])?'text-primary':''}}"></i>
							<span>Patients</span>
						</a>
					</li> -->
					
					<li class="treeview {{Request::is('backoffice/services*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/services*')?'text-primary':''}}">
							<i data-feather="heart" class="{{Request::is('backoffice/services*')?'text-primary':''}}"></i>
							<span>Services</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/services*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.services.index'])?'text-primary':''}}" href="{{route('backoffice.services.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.services.create'])?'text-primary':''}}" href="{{route('backoffice.services.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>	
					</li>
					<li class="treeview {{Request::is('backoffice/faqs*')?'menu-open':''}}">
						<a href="#" class="{{Request::is('backoffice/faqs*')?'text-primary':''}}">
							<i data-feather="help-circle" class="{{Request::is('backoffice/faqs*')?'text-primary':''}}"></i>
							<span>FAQs</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu {{Request::is('backoffice/faqs*')?'display-block':''}}">	
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.faqs.index'])?'text-primary':''}}" href="{{route('backoffice.faqs.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="{{in_array(request()->route()->getName(),['backoffice.faqs.create'])?'text-primary':''}}" href="{{route('backoffice.faqs.create')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>	
					</li>
					<li>
						<a class="{{in_array(request()->route()->getName(),['backoffice.chatbot.index'])?'text-primary':''}}" href="{{ route('backoffice.chatbot.index') }}">
							<i data-feather="message-circle" class="{{in_array(request()->route()->getName(),['backoffice.chatbot.index'])?'text-primary':''}}"></i>
							<span>ChatBot</span>
						</a>
					</li>
					@else
					<li>
						@if(auth()->user()->type == 'patient')
						<a class="{{in_array(request()->route()->getName(),['backoffice.patients.view'])?'text-primary':''}}" href="{{ route('backoffice.patients.view', auth()->user()->patient->id) }}">
							<i data-feather="user" class="{{in_array(request()->route()->getName(),['backoffice.patients.view'])?'text-primary':''}}"></i>
							<span>My Info</span>
						</a>
						@endif
					</li>	
					@endif	     
				</ul>
				
				<div class="sidebar-widgets">
					<div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
						<div class="text-center">
							<img src="{{asset('images/1-remove.png')}}" class="sideimg p-5" alt="">
							<h4 class="title-bx text-primary">Request for an Appointment</h4>
							<a href="{{ route('backoffice.appointments.index') }}" class="py-10 fs-14 mb-0 text-primary">
								Best Dental Care here <i class="mdi mdi-arrow-right"></i>
							</a>
						</div>
					</div>
					<div class="copyright text-center m-25">
						<p><strong class="d-block">{{config('app.name')}}</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</aside>