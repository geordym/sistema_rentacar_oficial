{{Form::open(array('url'=>'vehicle','method'=>'post', 'enctype' => "multipart/form-data"))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('name',__('Vehicle Name'),array('class'=>'form-label')) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter vehicle name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('type', __('Type'),['class'=>'form-label']) }}
            {!! Form::select('type', $types,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('model',__('Model'),array('class'=>'form-label')) }}
            {{Form::text('model',null,array('class'=>'form-control','placeholder'=>__('Enter model'),'required'=>'required'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('mark',__('Mark'),array('class'=>'form-label')) }}
            {{Form::text('mark',null,array('class'=>'form-control','placeholder'=>__('Enter mark'),'required'=>'required'))}}
        </div>

        
        <div class="form-group col-md-6">
            {{Form::label('color',__('Color'),array('class'=>'form-label')) }}
            {{Form::text('color',null,array('class'=>'form-control','placeholder'=>__('Enter color'),'required'=>'required'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('number_doors',__('number_doors'),array('class'=>'form-label')) }}
            {{Form::text('number_doors',null,array('class'=>'form-control','placeholder'=>__('Enter the number of doors'),'required'=>'required'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('state',__('state'),array('class'=>'form-label')) }}
            {{Form::text('state',null,array('class'=>'form-control','placeholder'=>__('Enter the state'),'required'=>'required'))}}
        </div>




        <div class="form-group col-md-6">
            {{Form::label('engine_type',__('Engine Type'),array('class'=>'form-label')) }}
            {{Form::text('engine_type',null,array('class'=>'form-control','placeholder'=>__('Enter engine type'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('engine_no',__('Engine Number'),array('class'=>'form-label')) }}
            {{Form::text('engine_no',null,array('class'=>'form-control','placeholder'=>__('Enter engine number')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('license_plate',__('License Plate'),array('class'=>'form-label')) }}
            {{Form::text('license_plate',null,array('class'=>'form-control','placeholder'=>__('Enter license plate'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('registration_expiry_date',__('Registration Expiry Date'),array('class'=>'form-label')) }}
            {{Form::date('registration_expiry_date',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('daily_rate',__('Daily Rate'),array('class'=>'form-label')) }}
            {{Form::number('daily_rate',null,array('class'=>'form-control','placeholder'=>__('Enter daily rate'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('year_of_ﬁrst_immatriculation',__('Year of First Immatriculation'),array('class'=>'form-label')) }}
            {{Form::number('year_of_ﬁrst_immatriculation',null,array('class'=>'form-control','placeholder'=>__('Enter Year of First Immatriculation')))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('gearbox', __('Gearbox'),['class'=>'form-label']) }}
            <select name="gearbox" class="form-control hidesearch " id="gearbox" required>
                @foreach($gearbox as $k=>$val)
                    <option value="{{$k}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('fuel_type', __('Fuel Type'),['class'=>'form-label']) }}
            <select name="fuel_type" class="form-control hidesearch " id="fuel_type" required>
                @foreach($fuelType as $k=>$val)
                    <option value="{{$k}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('number_of_seats',__('Number of Seats'),array('class'=>'form-label','required'=>'required')) }}
            {{Form::number('number_of_seats',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('kilometers',__('Kilometer'),array('class'=>'form-label','required'=>'required')) }}
            {{Form::number('kilometers',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('option', __('Options'),['class'=>'form-label']) }}
            {!! Form::select('option[]', $option,null,array('class' => 'form-control hidesearch ','multiple')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('document',__('Document'),array('class'=>'form-label')) }}
            {{Form::file('document',array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
            {{Form::textarea('notes',null,array('class'=>'form-control','placeholder'=>__('Enter notes'),'rows'=>1))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}

