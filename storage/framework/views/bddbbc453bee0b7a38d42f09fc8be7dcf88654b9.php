<?php echo e(Form::open(array('url'=>'rental-agreement','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('driver', __('Driver'),['class'=>'form-label'])); ?>

            <?php echo Form::select('driver', $drivers,null,array('class' => 'form-control hidesearch ','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('vehicle', __('Vehicle'),['class'=>'form-label'])); ?>

            <select name="vehicle" id="vehicle" class="form-control basic-select" required>
                <option value=""><?php echo e(__('Select Vehicle')); ?></option>
                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                        value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->name.' - '.$vehicle->license_plate); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('rental_start_date',__('Rental Start Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('rental_start_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('rental_end_date',__('Rental End Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('rental_end_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('rental_duration',__('Rental Duration (Days)'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('rental_duration',null,array('class'=>'form-control','placeholder'=>__('Enter rental duration'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

            <?php echo Form::select('status', $status,null,array('class' => 'form-control hidesearch ','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('terms_condition',__('Terms & Condition'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('terms_condition',null,array('class'=>'form-control','placeholder'=>__('Enter terms & condition'),'rows'=>5))); ?>

        </div>
        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('description',__('Description'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter description'),'rows'=>5))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\laragon\www\sistema_rentacar_oficial\resources\views/rental_agreement/create.blade.php ENDPATH**/ ?>