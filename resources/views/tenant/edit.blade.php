{{ Form::model($tenant, ['route' => ['tenant.update', $tenant->id], 'enctype' => 'multipart/form-data', 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('nationality', __('Nationality'), ['class' => 'form-label']) }}
            {{ Form::text('nationality', null, ['class' => 'form-control', 'placeholder' => __('Enter Nationality')]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('document_type', __('Document Type'), ['class' => 'form-label']) }}
            {{ Form::text('document_type', null, ['class' => 'form-control', 'placeholder' => __('Enter Document Type'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('document_number', __('Document Number'), ['class' => 'form-label']) }}
            {{ Form::text('document_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Document Number'), 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('address', __('Address'), ['class' => 'form-label']) }}
            {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => __('Enter Address'), 'required' => 'required', 'rows' => 1]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('city', __('City'), ['class' => 'form-label']) }}
            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('Enter City')]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('municipality', __('Municipality'), ['class' => 'form-label']) }}
            {{ Form::text('municipality', null, ['class' => 'form-control', 'placeholder' => __('Enter Municipality')]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('license_number', __('License Number'), ['class' => 'form-label']) }}
            {{ Form::text('license_number', null, ['class' => 'form-control', 'placeholder' => __('Enter License Number')]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('issue_date', __('Issue Date'), ['class' => 'form-label']) }}
            {{ Form::date('issue_date', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>


        <div class="form-group col-md-6">
            {{ Form::label('document', __('Document'), ['class' => 'form-label']) }}

            @if($tenant->document_image)
            <!-- Mostrar la imagen almacenada en base64 -->
            <div class="image-preview">
                <img src="data:image/jpeg;base64,{{ $tenant->document_image }}" alt="Document Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;" />
            </div>
            @else
            <!-- Si no hay imagen, mostrar un mensaje o una imagen predeterminada -->
            <p>No document uploaded</p>
            @endif

            <!-- Campo para subir el archivo -->
            {{ Form::file('document', ['class' => 'form-control']) }}
        </div>


        <div class="form-group col-md-6">
            {{ Form::label('license', __('License'), ['class' => 'form-label']) }}
            {{ Form::file('license', ['class' => 'form-control']) }}
        </div>
     
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{ __('Close') }}</button>
    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary ml-10']) }}
</div>
{{ Form::close() }}