<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="multinav">
			<div class="multinav-scroll" style="height: 100%;">	
				<!-- sidebar menu-->
				<ul class="sidebar-menu" data-widget="tree">				
					<li>
						<a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.index'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.index')); ?>">
							<i data-feather="monitor" class="<?php echo e(in_array(request()->route()->getName(),['backoffice.index'])?'text-primary':''); ?>"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li class="treeview <?php echo e(Request::is('backoffice/events*')?'menu-open':''); ?>">
						<a href="#" class="<?php echo e(Request::is('backoffice/events*')?'text-primary':''); ?>">
							<i data-feather="calendar" class="<?php echo e(Request::is('backoffice/events*')?'text-primary':''); ?>"></i>
							<span>Events</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu <?php echo e(Request::is('backoffice/events*')?'display-block':''); ?>">	
							<li><a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.events.index'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.events.index')); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Calendar</a></li>
							<?php if( in_array(auth()->user()->type, ['participant']) ): ?>	
							<li><a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.events.completed'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.events.completed')); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Completed</a></li>
							<?php endif; ?>
							<?php if( in_array(auth()->user()->type, ['super_user', 'admin', 'staff']) ): ?>	
							<li><a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.events.list'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.events.list')); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<?php endif; ?>
						</ul>	
					</li>
					<?php if( in_array(auth()->user()->type, ['super_user', 'admin', 'staff']) ): ?>	
					<?php if( in_array(auth()->user()->type, ['super_user', 'admin'])): ?>
					<li class="treeview <?php echo e(Request::is('backoffice/staffs*')?'menu-open':''); ?>">
						<a href="#" class="<?php echo e(Request::is('backoffice/staffs*')?'text-primary':''); ?>">
							<i data-feather="user-check" class="<?php echo e(Request::is('backoffice/staffs*')?'text-primary':''); ?>"></i>
							<span>Staffs</span>
							<span class="pull-right-container">
								<i class="ti-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu <?php echo e(Request::is('backoffice/staffs*')?'display-block':''); ?>">	
							<li><a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.staffs.index'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.staffs.index')); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
							<li><a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.staffs.create'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.staffs.create')); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create</a></li>
						</ul>	
					</li>
					<?php endif; ?>
					<li>
						<a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.participants.index'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.participants.index')); ?>">
							<i data-feather="users" class="<?php echo e(in_array(request()->route()->getName(),['backoffice.participants.index'])?'text-primary':''); ?>"></i>
							<span>Participants</span>
						</a>
					</li>		
					<li>
						<a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.attendance.index'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.attendance.index')); ?>">
							<i data-feather="book" class="<?php echo e(in_array(request()->route()->getName(),['backoffice.attendance.index'])?'text-primary':''); ?>"></i>
							<span>Attendance</span>
						</a>
					</li>
								
					<li>
						<a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.feedbacks.index'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.feedbacks.index')); ?>">
							<i data-feather="message-square" class="<?php echo e(in_array(request()->route()->getName(),['backoffice.feedbacks.index'])?'text-primary':''); ?>"></i>
							<span>Feedbacks</span>
						</a>
					</li>		
					<?php else: ?>
					<li>
						<?php if(auth()->user()->type == 'participant'): ?>
						<a class="<?php echo e(in_array(request()->route()->getName(),['backoffice.participants.view'])?'text-primary':''); ?>" href="<?php echo e(route('backoffice.participants.view', auth()->user()->participant->id)); ?>">
							<i data-feather="user" class="<?php echo e(in_array(request()->route()->getName(),['backoffice.participants.view'])?'text-primary':''); ?>"></i>
							<span>My Info</span>
						</a>
						<?php endif; ?>
					</li>	
					<?php endif; ?>	     
				</ul>
				
				<div class="sidebar-widgets">
					<div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
						<div class="text-center">
							<img src="<?php echo e(asset('images/side-image.png')); ?>" class="sideimg p-5" alt="">
							<h4 class="title-bx text-primary">Look for Seminar</h4>
							<a href="<?php echo e(route('backoffice.events.index')); ?>" class="py-10 fs-14 mb-0 text-primary">
								Best Seminars here <i class="mdi mdi-arrow-right"></i>
							</a>
						</div>
					</div>
					<div class="copyright text-center m-25">
						<p><strong class="d-block"><?php echo e(config('app.name')); ?></strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</aside><?php /**PATH C:\wamp64\www\smartserminar-suit\resources\views/backoffice/_components/sidebar.blade.php ENDPATH**/ ?>