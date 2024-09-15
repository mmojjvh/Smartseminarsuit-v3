<!DOCTYPE html>
<html>
<body>
	<h3>Hi <?php echo e($data->name); ?></h3>
	<p>Welcome to <?php echo e(config('app.name')); ?>!</br></br> Below are your credentials, please login  here <a href="<?php echo e(route('backoffice.auth.login')); ?>" target="_blank"><?php echo e(route('backoffice.auth.login')); ?></a> and update your password.</p>
	<p>Username: <strong><?php echo e($data->username); ?></strong> </br>
	   Password: <strong><?php echo e($data->password); ?></strong>
	</p>
	<p>
		Thanks,</br>
		<?php echo e(config('app.name')); ?>

	</p>
</body>
</html><?php /**PATH C:\Users\markj\OneDrive\Desktop\capstone\smartserminar-suit\resources\views/emails/staff_creation.blade.php ENDPATH**/ ?>