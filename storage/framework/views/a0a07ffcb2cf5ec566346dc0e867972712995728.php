

<?php $__env->startPush('title',$title.' List'); ?>

<?php $__env->startPush('css'); ?>
<style type="text/css">
    .overflow-visible { 
        overflow: visible;
    }
</style>
<link class="main-stylesheet" href="<?php echo e(asset('pages/css/chat.css')); ?>" rel="stylesheet" type="text/css" />
<style>
    .col-xs-2 {
        width: 16.66666667%;
    }
    .col-xs-6 {
        width: 50%;
    }
    .col-xs-10 {
        width: 83.33333333%;
    }
    /* #1dbfc1 */
    .fc-event-past{
        background: #608ad2!important;
    }
    .box-past{
        background: #608ad2;
        height : 15px;
        width : 15px;
        float: left;
        margin-right: 5px;
    }
    .box-future{
        background: #1dbfc1;
        height : 15px;
        width : 15px;
        float: left;
        margin-right: 5px;
    }
    .fc-day-past {
        background-color: #c5c5c5;
    }
    .box-current-date{
        background: #fffadf;
        height : 15px;
        width : 15px;
        float: left;
        margin-right: 5px;
    }
    .box-past-date{
        background: #c5c5c5;
        height : 15px;
        width : 15px;
        float: left;
        margin-right: 5px;
    }
    .event-date{
        padding: 5px;
        border: 2px solid;
        line-height: 20px;
        border-radius: 5px;
        width: 60px;
    }
    .event-day{
        font-size: 30px;
        font-weight: 500;
    }
    .event-month{
        font-size: 15px;
        font-weight: 300;
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
                    <h4 class="page-title">Events</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('backoffice.index')); ?>"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e(config('app.name')); ?> Calendar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">	
                <div class="col-xl-5 col-lg-5 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="calendar"></div>
                            <!-- <div class="row mt-10">
                                <div class="col-md-12">LEGENDS:</div>
                                <div class="col-md-6">
                                    <div class="box-past-date"></div> Past Date
                                </div>
                                <div class="col-md-6">
                                    <div class="box-current-date"></div> Current Date
                                </div>
                                <div class="col-md-6">
                                    <div class="box-past"></div> Past Events
                                </div>
                                <div class="col-md-6">
                                    <div class="box-future"></div> Future Events
                                </div>
                            </div> -->
                        </div>
                    </div> 
                </div>
                <div class="col-xl-7 col-lg-7 col-12"> 
                    <?php echo $__env->make('backoffice._components.session_notif', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box no-border no-shadow">
                        <div class="box-body overflow-auto">
                            <!-- the events -->
                            <div id="external-events">
                                <h3 class="fw-300">Events & Seminars</h3>
                                <hr>
                                <table class="table border-no" id="example1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="width: 45%">Information</th>
                                            <th style="width: 40%">Schedule</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover-primary">
                                            <td>
                                                <div class="border-primary event-date bg-temple-dark text-center">
                                                    <span class="event-month"><?php echo e($event->start?date('M', strtotime($event->start)):'---'); ?></span><br>
                                                    <span class="event-day"><?php echo e($event->start?date('j', strtotime($event->start)):'---'); ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                Event : <strong><?php echo e($event->name); ?></strong><br>
                                                Status:
                                                <?php if($event->status != 'Happening'): ?>
                                                <strong><?php echo e($event->status); ?></strong>
                                                <?php else: ?>
                                                <strong class="text-primary"><?php echo e($event->status); ?> Now</strong>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong>Start</strong> : <?php echo e($event->start?date('M d, Y @ h:i a', strtotime($event->start)):'---'); ?> <br>
                                                <strong>End</strong> : <?php echo e($event->end?date('M d, Y @ h:i a', strtotime($event->end)):'---'); ?>

                                            </td>
                                            <td>				
                                                <?php if(auth()->user()->type != 'participant'): ?>								
                                                <div class="btn-group">
                                                    <?php if($event->status == 'Pending'): ?>
                                                    <a href="<?php echo e(route('backoffice.events.update_status',[ $event->id, 'Happening'])); ?>" class="waves-effect waves-light btn btn-primary-light">Mark as Happening</a>
                                                    <?php elseif($event->status == 'Happening'): ?>
                                                    <a href="<?php echo e(route('backoffice.events.update_status', [$event->id, 'Completed'])); ?>" class="waves-effect waves-light btn btn-success-light">Mark as Completed</a>
                                                    <?php endif; ?>
                                                    <button class="waves-effect waves-light btn btn-light no-caret" data-bs-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?php echo e(route('backoffice.events.view', $event->id)); ?>">View event</a>
                                                        <a class="dropdown-item" href="<?php echo e(route('backoffice.events.edit', $event->id)); ?>">Edit event</a>
                                                        <a class="dropdown-item" href="<?php echo e(route('backoffice.events.cancel', $event->id)); ?>">Cancel event</a>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <?php if($event->status == 'Happening'): ?>
                                                <a href="<?php echo e(route('backoffice.events.view', $event->id)); ?>" class="waves-effect waves-light btn btn-success-light">
                                                    Join
                                                </a>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr class="hover-primary">
                                            <td colspan="4" class="text-center">No Events yet...</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if(auth()->check() AND !in_array(auth()->user()->type, ['participant'])): ?>
                    <a href="<?php echo e(route('backoffice.events.create')); ?>" class="btn btn-primary">
                        <i class="ti-calendar"></i> Create Event
                    </a>
                    <?php endif; ?>
                </div> 
            </div>
        </section>
        <!-- /.content -->
    </div>	  
    
</div>

<?php if(auth()->user()->type == 'patient'): ?>
<?php echo $__env->make('commons.chatbot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('vet-clinic/main/js/vendors.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/pages/chat-popup.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/icons/feather-icons/feather.min.js')); ?>"></script>	
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/assets/vendor_components/fullcalendar/lib/moment.min.js')); ?>"></script>

<!-- Rhythm Admin App -->
<script src="<?php echo e(asset('vet-clinic/main/js/template.js')); ?>"></script>
<script src="<?php echo e(asset('vet-clinic/main/js/fullcalendar.min.js')); ?>"></script>
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
            events: <?php echo $calendar; ?>

        });
        
        calendar.render();
    });
    
</script>

<script src="<?php echo e(asset('pages/js/moment.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backoffice._layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\smartserminar-suit\resources\views/backoffice/pages/events/index.blade.php ENDPATH**/ ?>