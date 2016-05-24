

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('full_name', 'Full Name:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('full_name', Input::old('full_name'), ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::email('email',Input::old('email'),['class' => 'form-control','placeholder'=>'Email Address','required', 'title'=>'Enter User Email Address']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
        {!! Form::text('telephone', Input::old('telephone'), ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
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
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('captain', 'Captain:', ['class' => 'control-label']) !!}
        {!! Form::text('captain', Input::old('captain'), ['id'=>'captain', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-2">
        <br>
        {!! Form::radio('pf_pnf', 'pf', false) !!} PF
        {!! Form::radio('pf_pnf', 'pnf', true) !!} PNF


    </div>
    <div class="col-sm-4">
        {!! Form::label('co_pilot', 'Co Pilot:', ['class' => 'control-label']) !!}
        {!! Form::text('co_pilot', Input::old('co_pilot'), ['id'=>'co_pilot', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-2">
        <br>
        {!! Form::radio('pf_pnf2', 'pf', false) !!} PF
        {!! Form::radio('pf_pnf2', 'pnf', true) !!} PNF
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('others', 'Others:', ['class' => 'control-label']) !!}
        {!! Form::text('others', Input::old('others'), ['id'=>'others', 'class' => 'form-control','maxlength'=>'64','title'=>'enter other']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('purser', 'Purser:', ['class' => 'control-label']) !!}
        {!! Form::text('purser', Input::old('purser'), ['id'=>'purser', 'class' => 'form-control','maxlength'=>'64','title'=>'enter purser']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
        <div class="input-group date">
            {!! Form::text('date', Input::old('date'), ['class' => 'form-control bs-datepicker-component','title'=>'select date','required']) !!}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="col-sm-4">
        {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
        {!! Form::text('time', Input::old('time'), ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
    </div>

    <div class="col-sm-4">
        <br>
        {!! Form::radio('utc_local', 'utc', (@$request_model == 'utc' ? 'checked': '')) !!} UTC
        {!! Form::radio('utc_local', 'local', (@$request_model == 'local' ? 'checked': '')) !!} Local
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('air_craft_type', 'Air Craft Type:', ['class' => 'control-label']) !!}
        {!! Form::text('air_craft_type', Input::old('air_craft_type'), ['id'=>'air_craft_type', 'class' => 'form-control','maxlength'=>'64','title'=>'enter air craft type']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
        {!! Form::text('registration', Input::old('registration'), ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('flight_no', 'Flight No:', ['class' => 'control-label']) !!}
        {!! Form::text('flight_no', Input::old('flight_no'), ['id'=>'flight_no', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Flight No']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('from', 'From:', ['class' => 'control-label']) !!}
        {!! Form::text('from', Input::old('from'), ['id'=>'from', 'class' => 'form-control','maxlength'=>'64','title'=>'enter From Flight','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('to', 'To:', ['class' => 'control-label']) !!}
        {!! Form::text('to', Input::old('to'), ['id'=>'to', 'class' => 'form-control','maxlength'=>'64','title'=>'enter To Flight','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('flt_diverted_to', 'FLT Diverted To:', ['class' => 'control-label']) !!}
        {!! Form::text('flt_diverted_to', Input::old('flt_diverted_to'), ['id'=>'flt_diverted_to', 'class' => 'form-control','maxlength'=>'64','title'=>'enter FLT diverted to']) !!}
    </div>
</div>



<div class="row">
    <div class="col-sm-4">
        {!! Form::label('assigned_door', 'Assigned Door:', ['class' => 'control-label']) !!}
        {!! Form::text('assigned_door', Input::old('assigned_door'), ['id'=>'assigned_door', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter assigned door']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('position_during_event', 'Position During Event:', ['class' => 'control-label']) !!}
        {!! Form::text('position_during_event', Input::old('position_during_event'), ['id'=>'position_during_event', 'class' => 'form-control','maxlength'=>'64','title'=>'enter position during event']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('nr_of_pax', 'NR of Pax:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_pax', Input::old('nr_of_pax'), ['id'=>'nr_of_pax', 'class' => 'form-control','maxlength'=>'64','title'=>'enter NR of pax']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('nr_of_crew', 'NR of Crew:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_crew', Input::old('nr_of_crew'), ['id'=>'nr_of_crew', 'class' => 'form-control','maxlength'=>'64','title'=>'enter NR of crew']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('previous_flights', 'Previous Flights', ['class' => 'control-label']) !!}
        {!! Form::text('previous_flights', Input::old('previous_flights'), ['id'=>'previous_flights', 'class' => 'form-control','maxlength'=>'200','title'=>'enter previous flights']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('nr_of_landings_of_the_day', 'NR of Landings of the Day:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_landings_of_the_day', Input::old('nr_of_landings_of_the_day'), ['id'=>'nr_of_landings_of_the_day', 'class' => 'form-control','maxlength'=>'200','title'=>'enter NR of landings of the day']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        {!! Form::label('flight_phase', 'Flight Phase:', ['class' => 'control-label']) !!}
        <br>
        {!! Form::radio('flight_phase', 'parked', true) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'push_back', false) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'taxi_out', false) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'take_off', false) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'initial_climb', false) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'climb', false) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;

        {!! Form::radio('flight_phase', 'cruise', false) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'holding', false) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'descent', false) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'approach', false) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'landing', false) !!} LANDING&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'taxi_in', false) !!} TAXI IN
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        {!! Form::label('description_of_occurrence', 'Description Of Occurrence:', ['class' => 'control-label']) !!}
        {!! Form::textarea('description_of_occurrence', @$data[0]['description_of_occurrence'], ['size' => '6x5', 'class' => 'form-control','title'=>'enter description of occurrence','required']) !!}
    </div>
</div>