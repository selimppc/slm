
<!----- For Reference Number ----------------->
<div>
    @if(isset($ground_handling_verification))
        {{--@foreach($ground_handling_verification as $values)--}}
        <div class="col-md-6" style="padding: 0px;">
            @if(isset(Auth::user()->role_id))

                {{--@if(Auth::user()->role_id == 1 && @$values->reference_no == null)
                    <a href="{{ route('reference-ground-handling', $values->id) }}" class="btn btn-info btn-xs glyphicon glyphicon-pencil" data-placement="top" data-toggle="modal" title="Enter Reference NO." data-target="#etsbModal"></a>
                @endif--}}
                @if(Auth::user()->role_id == '1' && @$ground_handling_verification->reference_no != null && @$ground_handling_verification->sent_receive == '0')
                    <a href="{{ route('ground-sent-receive', $ground_handling_verification->id) }}" class="btn btn-info btn-xl" data-placement="top" data-toggle="modal" title="Send Received Report" data-target="#etsbModal">Send Received Report</a>
                @endif

            @endif
        </div>
        <div class="col-md-6" style="padding: 0px;">
            {!! Form::label('reference_no', 'Reference Number:', []) !!}
            @if(Auth::user()->role_id == '1' && $ground_handling_verification->reference_no == null)
                {!! Form::text('reference_no', $ground_handling_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256']) !!}
            @else
                {!! Form::text('reference_no', $ground_handling_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256','title'=>'enter reference number','readonly']) !!}
            @endif
        </div>
        {{--@endforeach--}}
    @endif
    <div class="clearfix"></div>

</div>
<!-----------------End of Reference Number ------>

<div style="background-color: yellow; height: 20px;">
    <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
</div>
@if(isset($ground_handling_verification) && $ground_handling_verification->full_name)
<div class="row">
    <div class="col-sm-4">
        {!! Form::label('full_name', 'Full Name:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('full_name', $ground_handling_verification->full_name, ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::email('email',$ground_handling_verification->email,['maxlength'=>256,'class' => 'form-control','placeholder'=>'Email Address','required','readonly']) !!}

    </div>
    <div class="col-sm-4">
        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
        {!! Form::text('telephone', $ground_handling_verification->telephone, ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}

    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('extension', 'Extension:', ['class' => 'control-label']) !!}
        {!! Form::text('extension', $ground_handling_verification->extension, ['id'=>'extension', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}

    </div>
    <div class="col-sm-4">
        {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
        {!! Form::text('fax', $ground_handling_verification->fax, ['id'=>'fax', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>

    <div class="col-sm-4">
        {!! Form::label('location_of_occurrence', 'Location of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('location_of_occurrence', $ground_handling_verification->location_of_occurrence, ['id'=>'location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    
    <div class="col-sm-4">
        {!! Form::label('ramp_condition', 'Ramp condition:', ['class' => 'control-label']) !!}
        {!! Form::text('ramp_condition', $ground_handling_verification->ramp_condition, ['id'=>'ramp_condition', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('operational_phase', 'Operational Phase:', ['class' => 'control-label']) !!}
        {!! Form::text('operational_phase', $ground_handling_verification->operational_phase, ['id'=>'operational_phase', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
        {!! Form::text('date', $ground_handling_verification->date, ['class' => 'form-control','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
        {!! Form::text('time', $ground_handling_verification->time, ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-8">
        <br>
        {!! Form::radio('utc_local', 'utc', (@$request_model == 'utc' ? 'checked': ''),array('disabled')) !!} UTC
        {!! Form::radio('utc_local', 'local', (@$request_model == 'local' ? 'checked': ''),array('disabled')) !!} Local
        <br>
        <br>
        <br>
    </div>
    <div class="col-sm-3">
        {!! Form::label('operator', 'Operator:', ['class' => 'control-label']) !!}
        {!! Form::text('operator', $ground_handling_verification->operator, ['id'=>'operator', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('flight_number', 'Flight number:', ['class' => 'control-label']) !!}
        {!! Form::text('flight_number', $ground_handling_verification->flight_number, ['id'=>'flight_number', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('aircraft_type', 'Aircraft type:', ['class' => 'control-label']) !!}
        {!! Form::text('aircraft_type', $ground_handling_verification->aircraft_type, ['id'=>'aircraft_type', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
        {!! Form::text('registration', $ground_handling_verification->registration, ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('from', 'From:', ['class' => 'control-label']) !!}
        {!! Form::text('from', $ground_handling_verification->from, ['id'=>'from', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('to', 'To:', ['class' => 'control-label']) !!}
        {!! Form::text('to', $ground_handling_verification->to, ['id'=>'to', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('delay', 'Delay (min):', ['class' => 'control-label']) !!}
        {!! Form::text('delay', $ground_handling_verification->delay, ['id'=>'delay', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('diversion', 'Diversion:', ['class' => 'control-label']) !!}
        {!! Form::text('diversion', $ground_handling_verification->diversion, ['id'=>'diversion', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-12">
        {!! Form::label('third_party_involved', 'Third party involved (Contractor):', ['class' => 'control-label']) !!}
        {!! Form::text('third_party_involved', $ground_handling_verification->third_party_involved, ['id'=>'third_party_involved', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('description_of_occurrence', 'Description of occurrence :', ['class' => 'control-label']) !!}
        {!! Form::textarea('description_of_occurrence', $ground_handling_verification->description_of_occurrence, ['id'=>'description_of_occurrence', 'class' => 'form-control','readonly']) !!}
    </div>
</div>
<div style="background-color: yellow; height: 20px;">
    <h5 class="text-center text-black"><b style="color: black">DANGEROUS GOODS</b></h5>
</div>
<div class="row">
    <div class="col-sm-6">
        {!! Form::label('origin_of_the_goods', 'Origin of the goods:', ['class' => 'control-label']) !!}
        {!! Form::text('origin_of_the_goods', $ground_handling_verification->origin_of_the_goods, ['id'=>'origin_of_the_goods', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('iata_un_or_id', 'IATA UN/ID:', ['class' => 'control-label']) !!}
        {!! Form::text('iata_un_or_id', $ground_handling_verification->iata_un_or_id, ['id'=>'iata_un_or_id', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('class_or_division', 'Class/Division:', ['class' => 'control-label']) !!}
        {!! Form::text('class_or_division', $ground_handling_verification->class_or_division, ['id'=>'class_or_division', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('subsidiary_risk', 'Subsidiary Risk:', ['class' => 'control-label']) !!}
        {!! Form::text('subsidiary_risk', $ground_handling_verification->subsidiary_risk, ['id'=>'subsidiary_risk', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('packing_group', 'Packing Group:', ['class' => 'control-label']) !!}
        {!! Form::radio('packing_group','I',(@$packing_group == 'I'),array('disabled')) !!} I
        {!! Form::radio('packing_group','II',(@$packing_group == 'II'),array('disabled')) !!} II
        {!! Form::radio('packing_group','III',(@$packing_group == 'III'),array('disabled')) !!} III
    </div>
    <div class="col-sm-6">
        {!! Form::label('class_7_category', 'Class 7 category:', ['class' => 'control-label']) !!}
        {!! Form::radio('class_7_category','I',(@$class_7_category == 'I'),array('disabled')) !!} I
        {!! Form::radio('class_7_category','II',(@$class_7_category == 'II'),array('disabled')) !!} II
        {!! Form::radio('class_7_category','III',(@$class_7_category == 'III'),array('disabled')) !!} III
    </div>
    <div class="col-sm-6">
        {!! Form::label('type_of_packing', 'Type of packing:', ['class' => 'control-label']) !!}
        {!! Form::text('type_of_packing', $ground_handling_verification->type_of_packing, ['id'=>'type_of_packing', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('packing_spec_marking', 'Packing spec. marking:', ['class' => 'control-label']) !!}
        {!! Form::text('packing_spec_marking', $ground_handling_verification->packing_spec_marking, ['id'=>'packing_spec_marking', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('number_of_packages', 'Number of packages:', ['class' => 'control-label']) !!}
        {!! Form::text('number_of_packages', $ground_handling_verification->number_of_packages, ['id'=>'number_of_packages', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('quantity_of_transport_index', 'Quantity of transport index:', ['class' => 'control-label']) !!}
        {!! Form::text('quantity_of_transport_index', $ground_handling_verification->quantity_of_transport_index, ['id'=>'quantity_of_transport_index', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('airway_bill_reference', 'Airway bill reference:', ['class' => 'control-label']) !!}
        {!! Form::text('airway_bill_reference', $ground_handling_verification->airway_bill_reference, ['id'=>'airway_bill_reference', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('courier_pouch_reference', 'Courier Pouch/Bag tag/TKT reference:', ['class' => 'control-label']) !!}
        {!! Form::text('courier_pouch_reference', $ground_handling_verification->courier_pouch_reference, ['id'=>'courier_pouch_reference', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('shipping_agent', 'Shipping agent:', ['class' => 'control-label']) !!}
        {!! Form::text('shipping_agent', $ground_handling_verification->shipping_agent, ['id'=>'shipping_agent', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('shipping_name', 'Shipping name:', ['class' => 'control-label']) !!}
        {!! Form::text('shipping_name', $ground_handling_verification->shipping_name, ['id'=>'shipping_name', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
</div>

<div style="background-color: yellow; height: 20px;">
    <h5 class="text-center text-black"><b style="color: black">VEHICLE & RAMP EQUIPMENT DAMAGE</b></h5>
</div>
<div class="row">
    <div class="col-sm-4">
        {!! Form::label('damage_to', 'Damage to:', ['class' => 'control-label']) !!}
        {!! Form::text('damage_to', $ground_handling_verification->damage_to, ['id'=>'damage_to', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('damage_by', 'Damage by:', ['class' => 'control-label']) !!}
        {!! Form::text('damage_by', $ground_handling_verification->damage_by, ['id'=>'damage_by', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('area', 'Area (stand):', ['class' => 'control-label']) !!}
        {!! Form::text('area', $ground_handling_verification->area, ['id'=>'area', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-12">
        {!! Form::label('enviromental_condition', 'Enviromental Condition (weather, surface, lighting)', ['class' => 'control-label']) !!}
        {!! Form::textarea('enviromental_condition', $ground_handling_verification->enviromental_condition, ['id'=>'enviromental_condition', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-12">
        {!! Form::label('details_of_damage', 'Details of damage', ['class' => 'control-label']) !!}
        {!! Form::textarea('details_of_damage', $ground_handling_verification->details_of_damage, ['id'=>'details_of_damage', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
</div>

@else

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('full_name', 'Full Name:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('full_name', Input::old('full_name'), ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}

    </div>
    <div class="col-sm-4">
        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::email('email',Input::old('email'),['maxlength'=>256,'class' => 'form-control','placeholder'=>'Email Address','required', 'title'=>'Enter User Email Address']) !!}

    </div>
    <div class="col-sm-4">
        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
        {!! Form::text('telephone', Input::old('telephone'), ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}

    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('extension', 'Extension:', ['class' => 'control-label']) !!}
        {!! Form::text('extension', Input::old('extension'), ['id'=>'extension', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}

    </div>
    <div class="col-sm-4">
        {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
        {!! Form::text('fax', Input::old('fax'), ['id'=>'fax', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
    </div>

    <div class="col-sm-4">
        {!! Form::label('location_of_occurrence', 'Location of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('location_of_occurrence', Input::old('location_of_occurrence'), ['id'=>'location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','title'=>'enter location of occurrence']) !!}
    </div>

    <div class="col-sm-4">
        {!! Form::label('ramp_condition', 'Ramp condition:', ['class' => 'control-label']) !!}
        {!! Form::text('ramp_condition', Input::old('ramp_condition'), ['id'=>'ramp_condition', 'class' => 'form-control','maxlength'=>'64','title'=>'enter ramp condition']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('operational_phase', 'Operational Phase:', ['class' => 'control-label']) !!}
        {!! Form::text('operational_phase', Input::old('operational_phase'), ['id'=>'operational_phase', 'class' => 'form-control','maxlength'=>'64','title'=>'enter operational phase']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
        <div class="input-group date">
            {!! Form::text('date', Input::old('date'), ['class' => 'form-control bs-datepicker-component','title'=>'select date']) !!}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="col-sm-4">
        {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
        {!! Form::text('time', Input::old('time'), ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','title'=>'enter time']) !!}
    </div>
    <div class="col-sm-8">
        <br>
        {!! Form::radio('utc_local', 'utc', (@$request_model == 'utc' ? 'checked': '')) !!} UTC
        {!! Form::radio('utc_local', 'local', (@$request_model == 'local' ? 'checked': '')) !!} Local
        <br>
        <br>
        <br>
    </div>
    <div class="col-sm-3">
        {!! Form::label('operator', 'Operator:', ['class' => 'control-label']) !!}
        {!! Form::text('operator', Input::old('operator'), ['id'=>'operator', 'class' => 'form-control','maxlength'=>'64','title'=>'enter operator']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('flight_number', 'Flight number:', ['class' => 'control-label']) !!}
        {!! Form::text('flight_number', Input::old('flight_number'), ['id'=>'flight_number', 'class' => 'form-control','maxlength'=>'64','title'=>'enter flight number']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('aircraft_type', 'Aircraft type:', ['class' => 'control-label']) !!}
        {!! Form::text('aircraft_type', Input::old('aircraft_type'), ['id'=>'aircraft_type', 'class' => 'form-control','maxlength'=>'64','title'=>'enter aircraft type']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
        {!! Form::text('registration', Input::old('registration'), ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','title'=>'enter registration']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('from', 'From:', ['class' => 'control-label']) !!}
        {!! Form::text('from', Input::old('from'), ['id'=>'from', 'class' => 'form-control','maxlength'=>'64','title'=>'enter from']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('to', 'To:', ['class' => 'control-label']) !!}
        {!! Form::text('to', Input::old('to'), ['id'=>'to', 'class' => 'form-control','maxlength'=>'64','title'=>'enter to']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('delay', 'Delay (min):', ['class' => 'control-label']) !!}
        {!! Form::text('delay', Input::old('delay'), ['id'=>'delay', 'class' => 'form-control','maxlength'=>'64','title'=>'enter delay']) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::label('diversion', 'Diversion:', ['class' => 'control-label']) !!}
        {!! Form::text('diversion', Input::old('diversion'), ['id'=>'diversion', 'class' => 'form-control','maxlength'=>'64','title'=>'enter diversion']) !!}
    </div>
    <div class="col-sm-12">
        {!! Form::label('third_party_involved', 'Third party involved (Contractor):', ['class' => 'control-label']) !!}
        {!! Form::text('third_party_involved', Input::old('third_party_involved'), ['id'=>'third_party_involved', 'class' => 'form-control','maxlength'=>'64','title'=>'enter third party involved']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('description_of_occurrence', 'Description of occurrence :', ['class' => 'control-label']) !!}
        {!! Form::textarea('description_of_occurrence', Input::old('description_of_occurrence'), ['id'=>'description_of_occurrence', 'class' => 'form-control','title'=>'Enter description of the occurrence']) !!}
    </div>
</div>
<div style="background-color: yellow; height: 20px;">
    <h5 class="text-center text-black"><b style="color: black">DANGEROUS GOODS</b></h5>
</div>
<div class="row">
    <div class="col-sm-6">
        {!! Form::label('origin_of_the_goods', 'Origin of the goods:', ['class' => 'control-label']) !!}
        {!! Form::text('origin_of_the_goods', Input::old('origin_of_the_goods'), ['id'=>'origin_of_the_goods', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter origin of the goods']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('iata_un_or_id', 'IATA UN/ID:', ['class' => 'control-label']) !!}
        {!! Form::text('iata_un_or_id', Input::old('iata_un_or_id'), ['id'=>'iata_un_or_id', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter iata un or id']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('class_or_division', 'Class/Division:', ['class' => 'control-label']) !!}
        {!! Form::text('class_or_division', Input::old('class_or_division'), ['id'=>'class_or_division', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter class/division']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('subsidiary_risk', 'Subsidiary Risk:', ['class' => 'control-label']) !!}
        {!! Form::text('subsidiary_risk', Input::old('subsidiary_risk'), ['id'=>'subsidiary_risk', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter subsidiary risk']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('packing_group', 'Packing Group:', ['class' => 'control-label']) !!}
        {!! Form::radio('packing_group','I',(@$packing_group == 'I')) !!} I
        {!! Form::radio('packing_group','II',(@$packing_group == 'II')) !!} II
        {!! Form::radio('packing_group','III',(@$packing_group == 'III')) !!} III
    </div>
    <div class="col-sm-6">
        {!! Form::label('class_7_category', 'Class 7 category:', ['class' => 'control-label']) !!}
        {!! Form::radio('class_7_category','I',(@$class_7_category == 'I')) !!} I
        {!! Form::radio('class_7_category','II',(@$class_7_category == 'II')) !!} II
        {!! Form::radio('class_7_category','III',(@$class_7_category == 'III')) !!} III
    </div>
    <div class="col-sm-6">
        {!! Form::label('type_of_packing', 'Type of packing:', ['class' => 'control-label']) !!}
        {!! Form::text('type_of_packing', Input::old('type_of_packing'), ['id'=>'type_of_packing', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter type of packing']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('packing_spec_marking', 'Packing spec. marking:', ['class' => 'control-label']) !!}
        {!! Form::text('packing_spec_marking', Input::old('packing_spec_marking'), ['id'=>'packing_spec_marking', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter packing spec. marking']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('number_of_packages', 'Number of packages:', ['class' => 'control-label']) !!}
        {!! Form::text('number_of_packages', Input::old('number_of_packages'), ['id'=>'number_of_packages', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter number of packages']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('quantity_of_transport_index', 'Quantity of transport index:', ['class' => 'control-label']) !!}
        {!! Form::text('quantity_of_transport_index', Input::old('quantity_of_transport_index'), ['id'=>'quantity_of_transport_index', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter quantity of transport index']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('airway_bill_reference', 'Airway bill reference:', ['class' => 'control-label']) !!}
        {!! Form::text('airway_bill_reference', Input::old('airway_bill_reference'), ['id'=>'airway_bill_reference', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter airway bill reference']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('courier_pouch_reference', 'Courier Pouch/Bag tag/TKT reference:', ['class' => 'control-label']) !!}
        {!! Form::text('courier_pouch_reference', Input::old('courier_pouch_reference'), ['id'=>'courier_pouch_reference', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Courier Pouch/Bag tag/TKT reference']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('shipping_agent', 'Shipping agent:', ['class' => 'control-label']) !!}
        {!! Form::text('shipping_agent', Input::old('shipping_agent'), ['id'=>'shipping_agent', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Courier shipping agent']) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::label('shipping_name', 'Shipping name:', ['class' => 'control-label']) !!}
        {!! Form::text('shipping_name', Input::old('shipping_name'), ['id'=>'shipping_name', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Courier shipping name']) !!}
    </div>
</div>

<div style="background-color: yellow; height: 20px;">
    <h5 class="text-center text-black"><b style="color: black">VEHICLE & RAMP EQUIPMENT DAMAGE</b></h5>
</div>
<div class="row">
    <div class="col-sm-4">
        {!! Form::label('damage_to', 'Damage to:', ['class' => 'control-label']) !!}
        {!! Form::text('damage_to', Input::old('damage_to'), ['id'=>'damage_to', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter damage to']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('damage_by', 'Damage by:', ['class' => 'control-label']) !!}
        {!! Form::text('damage_by', Input::old('damage_by'), ['id'=>'damage_by', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter damage by']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('area', 'Area (stand):', ['class' => 'control-label']) !!}
        {!! Form::text('area', Input::old('area'), ['id'=>'area', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter area']) !!}
    </div>
    <div class="col-sm-12">
        {!! Form::label('enviromental_condition', 'Enviromental Condition (weather, surface, lighting)', ['class' => 'control-label']) !!}
        {!! Form::textarea('enviromental_condition', Input::old('enviromental_condition'), ['id'=>'enviromental_condition', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter enviromental condition']) !!}
    </div>
    <div class="col-sm-12">
        {!! Form::label('details_of_damage', 'Details of damage', ['class' => 'control-label']) !!}
        {!! Form::textarea('details_of_damage', Input::old('details_of_damage'), ['id'=>'details_of_damage', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter details of damage']) !!}
    </div>
</div>
@endif
