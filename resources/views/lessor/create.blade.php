{{ Form::open(['url' => 'lessor', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <!-- Nombre del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
        </div>

        <!-- Nacionalidad del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('nationality', __('Nationality'), ['class' => 'form-label']) }}
            {{ Form::text('nationality', null, ['class' => 'form-control', 'placeholder' => __('Enter Nationality')]) }}
        </div>

        <!-- Tipo de documento del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('document_type', __('Document Type'), ['class' => 'form-label']) }}
            {{ Form::text('document_type', null, ['class' => 'form-control', 'placeholder' => __('Enter Document Type'), 'required' => 'required']) }}
        </div>

        <!-- Número de documento del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('document_number', __('Document Number'), ['class' => 'form-label']) }}
            {{ Form::text('document_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Document Number'), 'required' => 'required']) }}
        </div>

        <!-- Dirección del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('fiscal_address', __('Fiscal Address'), ['class' => 'form-label']) }}
            {{ Form::textarea('fiscal_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Fiscal Address'), 'required' => 'required', 'rows' => 1]) }}
        </div>


        <div class="form-group col-md-6">
            {{ Form::label('residence_address', __('Residence Address'), ['class' => 'form-label']) }}
            {{ Form::textarea('residence_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Residence Address'), 'required' => 'required', 'rows' => 1]) }}
        </div>
        
       
        

        <!-- Ciudad del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('city', __('City'), ['class' => 'form-label']) }}
            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('Enter City')]) }}
        </div>

        <!-- Municipio del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('municipality', __('Municipality'), ['class' => 'form-label']) }}
            {{ Form::text('municipality', null, ['class' => 'form-control', 'placeholder' => __('Enter Municipality')]) }}
        </div>

        <!-- Número de licencia del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('license_number', __('License Number'), ['class' => 'form-label']) }}
            {{ Form::text('license_number', null, ['class' => 'form-control', 'placeholder' => __('Enter License Number')]) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('license_issued_state', __('License Issued State'), ['class' => 'form-label']) }}
            {{ Form::text('license_issued_state', null, ['class' => 'form-control', 'placeholder' => __('Enter License Issued State')]) }}
        </div>

     


        <!-- Imagen del documento del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('document_image', __('Document Image'), ['class' => 'form-label']) }}
            {{ Form::file('document_image', ['class' => 'form-control']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('drive_license_image', __('Drive License Image'), ['class' => 'form-label']) }}
            {{ Form::file('drive_license_image', ['class' => 'form-control']) }}
        </div>



        <!-- Notas adicionales -->
        <div class="form-group col-md-12">
            {{ Form::label('notes', __('Notes'), ['class' => 'form-label']) }}
            {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => __('Enter Notes'), 'rows' => 3]) }}
        </div>

    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{ __('Close') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn btn-primary ml-10']) }}
</div>
{{ Form::close() }}
