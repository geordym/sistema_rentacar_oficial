{{ Form::model($lessor, ['route' => ['lessor.update', $lessor->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
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
            {{ Form::label('address', __('Address'), ['class' => 'form-label']) }}
            {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Enter Address'), 'required' => 'required']) }}
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

        <!-- Imagen del documento del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('document_image', __('Document Image'), ['class' => 'form-label']) }}
            {{ Form::file('document_image', ['class' => 'form-control']) }}
            @if($lessor->document_image)  <!-- Mostrar imagen actual si existe -->
                <img src="{{ asset('storage/'.$lessor->document_image) }}" alt="Document Image" width="100">
            @endif
        </div>

        <!-- Imagen de la firma del Lessor -->
        <div class="form-group col-md-6">
            {{ Form::label('signature_image', __('Signature Image'), ['class' => 'form-label']) }}
            {{ Form::file('signature_image', ['class' => 'form-control']) }}
            @if($lessor->signature_image)  <!-- Mostrar firma actual si existe -->
                <img src="{{ asset('storage/'.$lessor->signature_image) }}" alt="Signature Image" width="100">
            @endif
        </div>

        <!-- Fecha de firma del contrato -->
        <div class="form-group col-md-6">
            {{ Form::label('signature_date', __('Signature Date'), ['class' => 'form-label']) }}
            {{ Form::date('signature_date', null, ['class' => 'form-control']) }}
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
    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary ml-10']) }}
</div>
{{ Form::close() }}
