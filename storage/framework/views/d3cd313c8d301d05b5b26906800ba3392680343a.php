<nav class="header <?php echo e($header?'minimized dark':'transparent-light'); ?> bg-header" data-pages="header" <?php echo $header?:'data-pages-header="autoresize" data-pages-resize-class="dark"'; ?>>
    <div class="container relative">

        <div class="pull-left">

            <div class="header-inner">
                <span class="alt text-white"><?php echo e(Str::upper(env('APP_NAME'))); ?></span>
                <span class="logo text-white" class="active"><?php echo e(Str::upper(env('APP_NAME'))); ?></span>
            </div>
            <!-- <img src="<?php echo e(asset('images/finallogo.png')); ?>" class="dental-logo" alt="logo"> -->
        </div>
        <div class="pull-right">
            <div class="header-inner">
                <a href="#" data-toggle="search" class="search-toggle visible-sm-inline visible-xs-inline p-r-10"><i class="fs-14 pg-search"></i></a>
                <div class="visible-sm-inline visible-xs-inline menu-toggler pull-right p-l-10" data-pages="header-toggle" data-pages-element="#header">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
            </div>
        </div>

        <div class="menu-content mobile-dark pull-right clearfix" data-pages-direction="slideRight" id="header">

            <div class="pull-right">
                <a href="#" class="padding-10 visible-xs-inline visible-sm-inline pull-right m-t-10 m-b-10 m-r-10" data-pages="header-toggle" data-pages-element="#header">
                    <i class=" pg-close_line"></i>
                </a>
            </div>


            <div class="header-inner">
                <ul class="menu">
                    <?php if(auth()->check()): ?>
                    <li>
                        <a data-text="Dashboard" class="link" href="<?php echo e(route('backoffice.auth.login')); ?>">Dashboard </a>
                    </li>
                    <?php else: ?>
                    <li>
                        <a data-text="Sign In" class="link" href="<?php echo e(route('backoffice.auth.login')); ?>">Sign In </a>
                    </li>
                    <li>
                        <a data-text="Sign Up" class="link" href="<?php echo e(route('backoffice.auth.register')); ?>">Sign Up </a>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="font-arial m-l-35 m-r-35 m-b-20  visible-sm visible-xs m-t-30">
                    <p class="fs-11 small-text muted">Copyright &copy; <?php echo e(date('Y')); ?> <?php echo e(env('APP_NAME')); ?></p>
                </div>

            </div>

        </div>
    </div>
</nav>
<?php /**PATH /Users/bpaltezo/Desktop/Smartseminarsuit-v3/resources/views/frontend/web/_components/nav.blade.php ENDPATH**/ ?>