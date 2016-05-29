<!----- For Reference Number ----------------->
<div>
    @if(isset($operational_safety_verification))
        {{--@foreach($ground_handling_verification as $values)--}}
        <div class="col-md-6" style="padding: 0px;">
            @if(isset(Auth::user()->role_id))

                @if(Auth::user()->role_id == 1 && @$operational_safety_verification->reference_no != null && @$operational_safety_verification->sent_receive == 0)
                    <a href="{{ route('operational-sent-receive', $operational_safety_verification->id) }}" class="btn btn-info btn-xl" data-placement="top" data-toggle="modal" title="Send Email" data-target="#etsbModal">Send Received Report</a>
                @endif

            @endif
        </div>
        <div class="col-md-6" style="padding: 0px;">
            {!! Form::label('reference_no', 'Reference Number:', []) !!}
            @if(Auth::user()->role_id = 1 && $operational_safety_verification->reference_no == null)
                {!! Form::text('reference_no', $operational_safety_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256']) !!}
            @else
                {!! Form::text('reference_no', $operational_safety_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256','title'=>'enter reference number','readonly']) !!}
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

@if(isset($operational_safety_verification) && $operational_safety_verification->operator)
<div style="margin: 10px 0px;">
    <div class="row">
        <div class="col-md-12">
            {!! Form::label('type_of_occurrence','Mark type of Occurrence : ') !!}
            {!! Form::radio('type_of_occurrence','accident',(@$type_of_occurrence == 'accident'),array('disabled')) !!} Accident
            {!! Form::radio('type_of_occurrence','incident',(@$type_of_occurrence == 'incident'),array('disabled')) !!} Incident
            {!! Form::radio('type_of_occurrence','other_occurrence',(@$type_of_occurrence == 'other_occurrence'),array('disabled')) !!} Other Occurrence

            {{--{!! Form::radio('pf_pnf', 'pnf', (@$pf_pnf == 'pnf' ? 'checked': '')) !!} PNF--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {!! Form::label('operator', 'Operator:', ['class' => 'control-label']) !!}
            <small class="required">(Required)</small>
            {!! Form::text('operator', $operational_safety_verification->operator, ['id'=>'operator', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>

        <div class="col-sm-4">
            {!! Form::label('date_of_occurrence', 'Date of occurrence:', ['class' => 'control-label']) !!}
            {!! Form::text('date_of_occurrence', $operational_safety_verification->date_of_occurrence, ['id'=>'date_id','class' => ' form-control','readonly']) !!}
        </div>

        <div class="col-md-4">
            {!! Form::label('local_time_of_occurrence', 'Local time of Occurrence:', ['class' => 'control-label']) !!}
            {!! Form::text('local_time_of_occurrence', $operational_safety_verification->local_time_of_occurrence, ['id'=>'local_time_of_occurrence', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-sm-4">
            {!! Form::label('flight_date', 'Flight Date:', ['class' => 'control-label']) !!}
            {!! Form::text('flight_date', $operational_safety_verification->flight_date, ['id'=>'date_id','class' => 'form-control','readonly']) !!}

        </div>
        <div class="col-md-8">
            {!! Form::label('flight_no', 'Flight no:', ['class' => 'control-label']) !!}
            {!! Form::text('flight_no', $operational_safety_verification->flight_no, ['id'=>'flight_no', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('departure_airport', 'Departure airport:', ['class' => 'control-label']) !!}
            {!! Form::text('departure_airport', $operational_safety_verification->departure_airport, ['id'=>'departure_airport', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('destination_airport', 'Destination airport:', ['class' => 'control-label']) !!}
            {!! Form::text('destination_airport', $operational_safety_verification->destination_airport, ['id'=>'destination_airport', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('aircraft_type', 'Aircraft type:', ['class' => 'control-label']) !!}
            {!! Form::text('aircraft_type', $operational_safety_verification->aircraft_type, ['id'=>'aircraft_type', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div><div class="col-md-6">
            {!! Form::label('aircraft_registration', 'Aircraft registration:', ['class' => 'control-label']) !!}
            {!! Form::text('aircraft_registration', $operational_safety_verification->aircraft_registration, ['id'=>'aircraft_registration', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div><div class="col-md-6">
            {!! Form::label('location_of_occurrence', 'Location of occurrence:', ['class' => 'control-label']) !!}
            {!! Form::text('location_of_occurrence', $operational_safety_verification->location_of_occurrence, ['id'=>'location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('origin_of_the_goods', 'Origin of the goods:', ['class' => 'control-label']) !!}
            {!! Form::text('origin_of_the_goods', $operational_safety_verification->origin_of_the_goods, ['id'=>'origin_of_the_goods', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('description_of_the_occurrence', 'Description of the occurrence including details of injury, damage, etc :', ['class' => 'control-label']) !!}
            {!! Form::textarea('description_of_the_occurrence', $operational_safety_verification->description_of_the_occurrence, ['id'=>'description_of_the_occurrence', 'class' => 'form-control','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('proper_shipping_name', 'Proper shipping name (including the technical name):', ['class' => 'control-label']) !!}
            {!! Form::text('proper_shipping_name', $operational_safety_verification->proper_shipping_name, ['id'=>'proper_shipping_name', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('un_or_id_no', 'UN/ID no (when known) (including the technical name):', ['class' => 'control-label']) !!}
            {!! Form::text('un_or_id_no', $operational_safety_verification->un_or_id_no, ['id'=>'un_or_id_no', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('class_or_division', 'Class/division (when known):', ['class' => 'control-label']) !!}
            {!! Form::text('class_or_division', $operational_safety_verification->class_or_division, ['id'=>'class_or_division', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('subsidiary_risks', 'Subsidiary risk(s):', ['class' => 'control-label']) !!}
            {!! Form::text('subsidiary_risks', $operational_safety_verification->subsidiary_risks, ['id'=>'subsidiary_risks', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('packing_group', 'Packing group:', ['class' => 'control-label']) !!}
            {!! Form::text('packing_group', $operational_safety_verification->packing_group, ['id'=>'packing_group', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('category', 'Category (class 7 only):', ['class' => 'control-label']) !!}
            {!! Form::text('category', $operational_safety_verification->category, ['id'=>'category', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('type_of_packaging', 'Type of packaging:', ['class' => 'control-label']) !!}
            {!! Form::text('type_of_packaging', $operational_safety_verification->type_of_packaging, ['id'=>'type_of_packaging', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('packaging_specification_marking', 'Packaging specification marking:', ['class' => 'control-label']) !!}
            {!! Form::text('packaging_specification_marking', $operational_safety_verification->packaging_specification_marking, ['id'=>'packaging_specification_marking', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('no_of_packages', 'No of packages:', ['class' => 'control-label']) !!}
            {!! Form::text('no_of_packages', $operational_safety_verification->no_of_packages, ['id'=>'no_of_packages', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('quantity', 'Quantity (or transport
index. If applicable):', ['class' => 'control-label']) !!}
            {!! Form::text('quantity', $operational_safety_verification->quantity, ['id'=>'quantity', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('reference_no_of_airway_bill', 'Reference no. of Airway bill:', ['class' => 'control-label']) !!}
            {!! Form::text('reference_no_of_airway_bill', $operational_safety_verification->reference_no_of_airway_bill, ['id'=>'reference_no_of_airway_bill', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('reference_no_of_courier', 'Reference no. of courier pouch, baggage tag, or passenger ticket:', ['class' => 'control-label']) !!}
            {!! Form::text('reference_no_of_courier', $operational_safety_verification->reference_no_of_courier, ['id'=>'reference_no_of_courier', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('name_and_address_of_shipper_agent_passenger', 'Name and address of shipper, agent, passenger, etc.:', ['class' => 'control-label']) !!}
            {!! Form::textarea('name_and_address_of_shipper_agent_passenger', $operational_safety_verification->name_and_address_of_shipper_agent_passenger, ['id'=>'name_and_address_of_shipper_agent_passenger', 'class' => 'form-control','readonly']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('other_relevant_information', 'Other relevant information (including suspected cause, any action taken):', ['class' => 'control-label']) !!}
            {!! Form::textarea('other_relevant_information', $operational_safety_verification->other_relevant_information, ['id'=>'other_relevant_information', 'class' => 'form-control','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('name_and_title_of_person_making_report', 'Name and title of person making report:', ['class' => 'control-label']) !!}
            {!! Form::text('name_and_title_of_person_making_report', $operational_safety_verification->name_and_title_of_person_making_report, ['id'=>'name_and_title_of_person_making_report', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('telephone_no', 'Telephone no:', ['class' => 'control-label']) !!}
            {!! Form::text('telephone_no', $operational_safety_verification->telephone_no, ['id'=>'telephone_no', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('company_contact', 'Company dept. code, E-mail or Info Mail code:', ['class' => 'control-label']) !!}
            {!! Form::text('company_contact', $operational_safety_verification->company_contact, ['id'=>'company_contact', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('reporter_ref', 'Reporter ref.:', ['class' => 'control-label']) !!}
            {!! Form::text('reporter_ref', $operational_safety_verification->reporter_ref, ['id'=>'reporter_ref', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
            {!! Form::text('address', $operational_safety_verification->address, ['id'=>'address', 'class' => 'form-control','maxlength'=>'200','readonly']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Form::label('signature', 'Signature:', ['class' => 'control-label']) !!}
            <small class="required">(max size 100kb)</small>
            {!! Form::file('signature',  ['id'=>'signature', 'class' => 'form-control','disabled']) !!}

        </div>
        <div class="col-sm-6">
            {!! Form::label('date_of_signature', 'Date of Signature:', ['class' => 'control-label']) !!}
            {!! Form::text('date_of_signature', $operational_safety_verification->date_of_signature, ['id'=>'date_id','class' => 'form-control','readonly']) !!}

        </div>

    </div>
</div>


@else


<div style="margin: 10px 0px;">
    <div class="row">
        <div class="col-md-12">
            {!! Form::label('type_of_occurrence','Mark type of Occurrence : ') !!}
            {!! Form::radio('type_of_occurrence','accident',(@$type_of_occurrence == 'accident')) !!} Accident
            {!! Form::radio('type_of_occurrence','incident',(@$type_of_occurrence == 'incident')) !!} Incident
            {!! Form::radio('type_of_occurrence','other_occurrence',(@$type_of_occurrence == 'other_occurrence')) !!} Other Occurrence

            {{--{!! Form::radio('pf_pnf', 'pnf', (@$pf_pnf == 'pnf' ? 'checked': '')) !!} PNF--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {!! Form::label('operator', 'Operator:', ['class' => 'control-label']) !!}
            <small class="required">(Required)</small>
            {!! Form::text('operator', Input::old('operator'), ['id'=>'operator', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter operator','required'=>'required']) !!}
        </div>

        <div class="col-sm-4">
            {!! Form::label('date_of_occurrence', 'Date of occurrence:', ['class' => 'control-label']) !!}
            <div class="input-group date">
                {!! Form::text('date_of_occurrence', Input::old('date_of_occurrence'), ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date of occurrence']) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>

        <div class="col-md-4">
            {!! Form::label('local_time_of_occurrence', 'Local time of Occurrence:', ['class' => 'control-label']) !!}
            {!! Form::text('local_time_of_occurrence', Input::old('local_time_of_occurrence'), ['id'=>'local_time_of_occurrence', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter local time of occurrence']) !!}
        </div>
        <div class="col-sm-4">
            {!! Form::label('flight_date', 'Flight Date:', ['class' => 'control-label']) !!}
            <div class="input-group date">
                {!! Form::text('flight_date', Input::old('flight_date'), ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select flight_date']) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="col-md-8">
            {!! Form::label('flight_no', 'Flight no:', ['class' => 'control-label']) !!}
            {!! Form::text('flight_no', Input::old('flight_no'), ['id'=>'flight_no', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter flight no']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('departure_airport', 'Departure airport:', ['class' => 'control-label']) !!}
            {!! Form::text('departure_airport', Input::old('departure_airport'), ['id'=>'departure_airport', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter departure airport']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('destination_airport', 'Destination airport:', ['class' => 'control-label']) !!}
            {!! Form::text('destination_airport', Input::old('destination_airport'), ['id'=>'destination_airport', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Destination airport']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('aircraft_type', 'Aircraft type:', ['class' => 'control-label']) !!}
            {!! Form::text('aircraft_type', Input::old('aircraft_type'), ['id'=>'aircraft_type', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Aircraft type']) !!}
        </div><div class="col-md-6">
            {!! Form::label('aircraft_registration', 'Aircraft registration:', ['class' => 'control-label']) !!}
            {!! Form::text('aircraft_registration', Input::old('aircraft_registration'), ['id'=>'aircraft_registration', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Aircraft registration']) !!}
        </div><div class="col-md-6">
            {!! Form::label('location_of_occurrence', 'Location of occurrence:', ['class' => 'control-label']) !!}
            {!! Form::text('location_of_occurrence', Input::old('location_of_occurrence'), ['id'=>'location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Location of occurrence']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('origin_of_the_goods', 'Origin of the goods:', ['class' => 'control-label']) !!}
            {!! Form::text('origin_of_the_goods', Input::old('origin_of_the_goods'), ['id'=>'origin_of_the_goods', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Origin of the goods']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('description_of_the_occurrence', 'Description of the occurrence including details of injury, damage, etc :', ['class' => 'control-label']) !!}
            {!! Form::textarea('description_of_the_occurrence', Input::old('description_of_the_occurrence'), ['id'=>'description_of_the_occurrence', 'class' => 'form-control','title'=>'Enter description of the occurrence']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('proper_shipping_name', 'Proper shipping name (including the technical name):', ['class' => 'control-label']) !!}
            {!! Form::text('proper_shipping_name', Input::old('proper_shipping_name'), ['id'=>'proper_shipping_name', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Proper shipping name']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('un_or_id_no', 'UN/ID no (when known) (including the technical name):', ['class' => 'control-label']) !!}
            {!! Form::text('un_or_id_no', Input::old('un_or_id_no'), ['id'=>'un_or_id_no', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter UN/ID no']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('class_or_division', 'Class/division (when known):', ['class' => 'control-label']) !!}
            {!! Form::text('class_or_division', Input::old('class_or_division'), ['id'=>'class_or_division', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Class/division']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('subsidiary_risks', 'Subsidiary risk(s):', ['class' => 'control-label']) !!}
            {!! Form::text('subsidiary_risks', Input::old('subsidiary_risks'), ['id'=>'subsidiary_risks', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Subsidiary risk(s)']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('packing_group', 'Packing group:', ['class' => 'control-label']) !!}
            {!! Form::text('packing_group', Input::old('packing_group'), ['id'=>'packing_group', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Packing group']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('category', 'Category (class 7 only):', ['class' => 'control-label']) !!}
            {!! Form::text('category', Input::old('category'), ['id'=>'category', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Category']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('type_of_packaging', 'Type of packaging:', ['class' => 'control-label']) !!}
            {!! Form::text('type_of_packaging', Input::old('type_of_packaging'), ['id'=>'type_of_packaging', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Type of packaging']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('packaging_specification_marking', 'Packaging specification marking:', ['class' => 'control-label']) !!}
            {!! Form::text('packaging_specification_marking', Input::old('packaging_specification_marking'), ['id'=>'packaging_specification_marking', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Packaging specification marking']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('no_of_packages', 'No of packages:', ['class' => 'control-label']) !!}
            {!! Form::text('no_of_packages', Input::old('no_of_packages'), ['id'=>'no_of_packages', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter No of packages']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::label('quantity', 'Quantity (or transport
index. If applicable):', ['class' => 'control-label']) !!}
            {!! Form::text('quantity', Input::old('quantity'), ['id'=>'quantity', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Quantity']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('reference_no_of_airway_bill', 'Reference no. of Airway bill:', ['class' => 'control-label']) !!}
            {!! Form::text('reference_no_of_airway_bill', Input::old('reference_no_of_airway_bill'), ['id'=>'reference_no_of_airway_bill', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Reference no.']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('reference_no_of_courier', 'Reference no. of courier pouch, baggage tag, or passenger ticket:', ['class' => 'control-label']) !!}
            {!! Form::text('reference_no_of_courier', Input::old('reference_no_of_courier'), ['id'=>'reference_no_of_courier', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Reference no.']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('name_and_address_of_shipper_agent_passenger', 'Name and address of shipper, agent, passenger, etc.:', ['class' => 'control-label']) !!}
            {!! Form::textarea('name_and_address_of_shipper_agent_passenger', Input::old('name_and_address_of_shipper_agent_passenger'), ['id'=>'name_and_address_of_shipper_agent_passenger', 'class' => 'form-control','title'=>'Enter Name and address']) !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('other_relevant_information', 'Other relevant information (including suspected cause, any action taken):', ['class' => 'control-label']) !!}
            {!! Form::textarea('other_relevant_information', Input::old('other_relevant_information'), ['id'=>'other_relevant_information', 'class' => 'form-control','title'=>'Enter Other relevant information']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('name_and_title_of_person_making_report', 'Name and title of person making report:', ['class' => 'control-label']) !!}
            {!! Form::text('name_and_title_of_person_making_report', Input::old('name_and_title_of_person_making_report'), ['id'=>'name_and_title_of_person_making_report', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Quantity']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('telephone_no', 'Telephone no:', ['class' => 'control-label']) !!}
            {!! Form::text('telephone_no', Input::old('telephone_no'), ['id'=>'telephone_no', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter telephone no']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('company_contact', 'Company dept. code, E-mail or Info Mail code:', ['class' => 'control-label']) !!}
            {!! Form::text('company_contact', Input::old('company_contact'), ['id'=>'company_contact', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter company contact']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('reporter_ref', 'Reporter ref.:', ['class' => 'control-label']) !!}
            {!! Form::text('reporter_ref', Input::old('reporter_ref'), ['id'=>'reporter_ref', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter Reporter ref']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
            {!! Form::text('address', Input::old('address'), ['id'=>'address', 'class' => 'form-control','maxlength'=>'200','title'=>'Enter address']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Form::label('signature', 'Signature:', ['class' => 'control-label']) !!}
            <small class="required">(max size 100kb)</small>
            {!! Form::file('signature',  ['id'=>'signature', 'class' => 'form-control','title'=>'Upload your signature']) !!}

        </div>
        <div class="col-sm-6">
            {!! Form::label('date_of_signature', 'Date of Signature:', ['class' => 'control-label']) !!}
            <div class="input-group date">
                {!! Form::text('date_of_signature', Input::old('date_of_signature'), ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date of Signature']) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>

    </div>
</div>

@endif