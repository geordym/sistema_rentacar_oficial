<?php echo e(Form::open(array('url' => 'subscriptions'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('title',__('Title'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter subscription title'),'required'=>'required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('interval', __('Interval'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('interval', $intervals, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('package_amount',__('Package Amount'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('package_amount',null,array('class'=>'form-control','placeholder'=>__('Enter package amount'),'step'=>'0.01'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('user_limit',__('User Limit'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('user_limit',null,array('class'=>'form-control','placeholder'=>__('Enter user limit'),'required'=>'required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('driver_limit',__('Driver Limit'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('driver_limit',null,array('class'=>'form-control','placeholder'=>__('Enter driver limit'),'required'=>'required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('enabled_logged_history',__('Show User Logged History'),array('class'=>'form-label'))); ?>

            <div>
                <label class="switch with-icon switch-primary">
                    <input type="checkbox" name="enabled_logged_history" id="enabled_logged_history"><span class="switch-btn"></span>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary btn-rounded'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home/u604031758/domains/peachpuff-wolf-941356.hostingersite.com/public_html/resources/views/subscription/create.blade.php ENDPATH**/ ?>