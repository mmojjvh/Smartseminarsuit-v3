<header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start">	
		<!-- Logo -->
		<a href="<?php echo e(route('backoffice.index')); ?>" class="logo">
		  <!-- logo-->
		  <div class="logo-mini w-40">
			  <span class="light-logo"><img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo"></span>
			  <span class="dark-logo"><img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo"></span>
		  </div>
		  <div class="logo-lg">
			  <?php echo e(config('app.name')); ?>

		  </div>
		</a>	
	</div>  
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div class="app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
					<i data-feather="align-left"></i>
			    </a>
			</li>
			<li class="btn-group d-lg-inline-flex d-none">
				
			</li>
		</ul> 
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">		  
	      <!-- User Account-->
          <li class="dropdown user user-menu">
            <a href="#" class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent py-0 no-shadow" data-bs-toggle="dropdown" title="User">
				<div class="d-flex pt-5">
					<div class="text-end me-10">
						<p class="pt-5 fs-14 mb-0 fw-700 text-primary"><?php echo e(auth()->user()->name); ?></p>
						<small class="fs-10 mb-0 text-uppercase text-mute"><?php echo e(auth()->user()->type); ?></small>
					</div>
					<?php if(auth()->user()->getAvatar()): ?>
					<img src="<?php echo e(asset(auth()->user()->getAvatar())); ?>" class="avatar rounded-10 bg-white h-40 w-40" alt="avatar"/>
                    <?php endif; ?>
				</div>
            </a>
            <ul class="dropdown-menu animated flipInX">
              <li class="user-body">
				 
				 <a class="dropdown-item" href="<?php echo e(route('backoffice.account.index')); ?>"><i class="ti-settings text-muted me-2"></i> Settings</a>
				 <div class="dropdown-divider"></div>
				 <a class="dropdown-item" href="<?php echo e(route('backoffice.logout')); ?>"><i class="ti-lock text-muted me-2"></i> Logout</a>
              </li>
            </ul>
          </li>	
			
        </ul>
      </div>
    </nav>
  </header><?php /**PATH C:\Users\markj\OneDrive\Desktop\capstone\smartserminar-suit\resources\views/backoffice/_components/header.blade.php ENDPATH**/ ?>