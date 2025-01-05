<?php echo e(Form::open(array('url'=>'rental-agreement','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('lessor', __('Lessor'),['class'=>'form-label'])); ?>

            <?php echo Form::select('lessor', $lessors,null,array('class' => 'form-control hidesearch ','required'=>'required')); ?>

        </div>

        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('tenant', __('Tenant'),['class'=>'form-label'])); ?>

            <?php echo Form::select('tenant', $tenants,null,array('class' => 'form-control hidesearch ','required'=>'required')); ?>

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
            <?php echo e(Form::label('rental_start_date', __('Rental Start Date'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::datetimeLocal('rental_start_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('rental_end_date', __('Rental End Date'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::datetimeLocal('rental_end_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

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
            <?php echo e(Form::label('rental_agreement_duration_days', __('ARRENDAMIENTO_CLAUSULA_SEGUNDA_CONTRATO_VIGENCIA_DIAS'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('rental_agreement_duration_days', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('tenant_payment_concept', __('ARRENDAMIENTO_CLAUSULA_TERCERA_ARRENDATARIO_PAGO_CONCEPTO'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('tenant_payment_concept', null, ['class' => 'form-control', 'placeholder' => __('Enter tenant payment concept'), 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('tenant_payment_amount', __('ARRENDAMIENTO_CLAUSULA_TERCERA_ARRENDATARIO_PAGO_CANTIDAD'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('tenant_payment_amount', null, ['class' => 'form-control', 'placeholder' => __('Enter tenant payment amount'), 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('transport_concept', __('ARRENDAMIENTO_CLAUSULA_QUINTA_TRANSPORTE_CONCEPTO'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('transport_concept', null, ['class' => 'form-control', 'placeholder' => __('Enter transport concept'), 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('transport_destination', __('ARRENDAMIENTO_CLAUSULA_QUINTA_TRANSPORTE_DESTINO'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('transport_destination', null, ['class' => 'form-control', 'placeholder' => __('Enter transport destination'), 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('signature_city', __('ARRENDAMIENTO_FIRMA_CIUDAD'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('signature_city', null, ['class' => 'form-control', 'placeholder' => __('Enter city of signature'), 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('signature_date', __('ARRENDAMIENTO_FIRMA_FECHA'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('signature_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>




        <div class="form-group col-md-12 col-lg-12">
            <?php echo e(Form::label('contract_number', __('CONTRATO_NUMERO'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('contract_number', null, ['class' => 'form-control', 'placeholder' => __('Enter contract number'), 'required' => 'required'])); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\laragon\www\sistema_rentacar_oficial\resources\views/rental_agreement/create.blade.php ENDPATH**/ ?>