<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inspection')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('inspection.index')); ?>">
                <?php echo e(__('Inspection')); ?>

            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Details')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <a class="btn btn-secondary print" href="javascript:void(0);"><i class="fa fa-print"></i> <?php echo e(__('Print')); ?></a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="invoice-print">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo e(__('Inspection Details')); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="detail-group">
                                    <h6><?php echo e(__('Vehicle')); ?></h6>
                                    <p class="mb-20"><?php echo e(!empty($inspection->vehicles)?$inspection->vehicles->name:'-'); ?> </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-group">
                                    <h6><?php echo e(__('Inspection By')); ?></h6>
                                    <p class="mb-20"><?php echo e($inspection->inspector); ?> </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-group">
                                    <h6><?php echo e(__('Inspection Date')); ?></h6>
                                    <p class="mb-20"><?php echo e(dateFormat($inspection->inspection_date)); ?>  </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-group">
                                    <h6><?php echo e(__('Inspection Status')); ?></h6>
                                    <p class="mb-20">

                                        <?php if($inspection->status=='pending' || $inspection->status=='on_hold'): ?>
                                            <span
                                                class="badge badge-warning"><?php echo e(\App\Models\Inspection::$status[$inspection->status]); ?></span>
                                        <?php elseif($inspection->status=='completed' || $inspection->status=='conditional_pass'): ?>
                                            <span
                                                class="badge badge-success"><?php echo e(\App\Models\Inspection::$status[$inspection->status]); ?></span>
                                        <?php elseif($inspection->status=='in_progress'): ?>
                                            <span
                                                class="badge badge-primary"><?php echo e(\App\Models\Inspection::$status[$inspection->status]); ?></span>
                                        <?php elseif($inspection->status=='reject'): ?>
                                            <span
                                                class="badge badge-danger"><?php echo e(\App\Models\Inspection::$status[$inspection->status]); ?></span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-group">
                                    <h6><?php echo e(__('Repair Status')); ?></h6>
                                    <p class="mb-20">
                                        <?php if($inspection->repair_status=='pending' || $inspection->repair_status=='on_hold'): ?>
                                            <span
                                                class="badge badge-warning"><?php echo e(\App\Models\Inspection::$repairStatus[$inspection->repair_status]); ?></span>
                                        <?php elseif($inspection->repair_status=='completed'): ?>
                                            <span
                                                class="badge badge-success"><?php echo e(\App\Models\Inspection::$repairStatus[$inspection->repair_status]); ?></span>
                                        <?php elseif($inspection->repair_status=='in_progress'): ?>
                                            <span
                                                class="badge badge-primary"><?php echo e(\App\Models\Inspection::$repairStatus[$inspection->repair_status]); ?></span>
                                        <?php elseif($inspection->repair_status=='needs_repair'): ?>
                                            <span
                                                class="badge badge-danger"><?php echo e(\App\Models\Inspection::$repairStatus[$inspection->repair_status]); ?></span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-group">
                                    <h6><?php echo e(__('Amount')); ?></h6>
                                    <p class="mb-20"><?php echo e(priceFormat($inspection->amount)); ?>  </p>
                                </div>
                            </div>
                            <?php if(!empty($inspection->receipt)): ?>
                                <div class="col-6">
                                    <div class="detail-group">
                                        <h6><?php echo e(__('Receipt')); ?></h6>
                                        <p class="mb-20">
                                            <a class="text-primary"
                                               href="<?php echo e(asset('/storage/upload/expense/'.$inspection->receipt)); ?> "
                                               target="_blank" data-bs-toggle="tooltip"
                                               data-bs-original-title="<?php echo e(__('Receipt')); ?>"> <i data-feather="file"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo e(__('Incoming Details')); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="detail-group">
                                            <h6><?php echo e(__('Date')); ?></h6>
                                            <p class="mb-20"><?php echo e(!empty($inspection->incoming_date)? dateFormat($inspection->incoming_date):'-'); ?> </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="detail-group">
                                            <h6><?php echo e(__('Meter Reading (Km)')); ?></h6>
                                            <p class="mb-20"><?php echo e(!empty($inspection->meter_reading_incoming)?$inspection->meter_reading_incoming:'-'); ?> </p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($inspection->notes)): ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="detail-group">
                                        <h6><?php echo e(__('Notes')); ?></h6>
                                        <p class="mb-20"><?php echo e($inspection->notes); ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo e(__('Inspections Checklist')); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-6">
                                    <div class="detail-group">
                                        <h6>
                                            <?php if(isset($type['status']) && $type['status']=='on'): ?>
                                                <i data-feather="check" class="text-success"></i>
                                            <?php else: ?>
                                                <i data-feather="x" class="text-danger"></i>
                                            <?php endif; ?>
                                            <?php echo e($type['type']); ?> </h6>
                                        <p class="mb-20"><?php echo e($type['note']); ?> </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '.print', function () {
            var printContents = document.getElementById('invoice-print').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u604031758/domains/rentacarvidal.com/public_html/resources/views/inspection/show.blade.php ENDPATH**/ ?>