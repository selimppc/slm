@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')

    {{--<script src="assets/bitd/js/jquery.min.js"></script>--}}

    <style>
        #panel_padding {
            padding: 20px;
        }
    </style>

    <div class="panel" id="panel_padding">
        <div style="background-color: #0490a6; height: 25px;">
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Add new Air Safety report</b></h4>
        </div>

        {!! Form::open(['route' => 'store-safety','class' => 'form-horizontal','id' => 'form_2']) !!}

        <div class="panel-body">

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div style="background-color: yellow; height: 20px;">
                    <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
                </div>

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
                        {!! Form::text('telephone', Input::old('telephone'), ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','title'=>'enter telephone no','required']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('extension', 'Extension:', ['class' => 'control-label']) !!}
                        {!! Form::text('extension', Input::old('extension'), ['id'=>'extension', 'class' => 'form-control','maxlength'=>'64','title'=>'enter extension']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
                        {!! Form::text('fax', Input::old('fax'), ['id'=>'fax', 'class' => 'form-control','maxlength'=>'64','title'=>'enter fax']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('others', 'Others:', ['class' => 'control-label']) !!}
                        {!! Form::text('others', Input::old('others'), ['id'=>'others', 'class' => 'form-control','maxlength'=>'64','title'=>'enter others']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('captain', 'Captain:', ['class' => 'control-label']) !!}
                        {!! Form::text('captain', Input::old('captain'), ['id'=>'captain', 'class' => 'form-control','maxlength'=>'64','title'=>'enter captain','required']) !!}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        {!! Form::radio('pf_pnf', 'pf', true) !!} PF
                        {!! Form::radio('pf_pnf', 'pnf', false) !!} PNF
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('co_pilot', 'Co Pilot:', ['class' => 'control-label']) !!}
                        {!! Form::text('co_pilot', Input::old('co_pilot'), ['id'=>'co_pilot', 'class' => 'form-control','maxlength'=>'64','title'=>'enter co_pilot','required']) !!}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        {!! Form::radio('pf_pnf2', 'pf', true) !!} PF
                        {!! Form::radio('pf_pnf2', 'pnf', false) !!} PNF
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
                        <div class="input-group date">
                            {!! Form::text('date', Input::old('date'), ['class' => 'form-control bs-datepicker-component','title'=>'select date','required']) !!}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
                        {!! Form::text('time', Input::old('time'), ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','title'=>'enter time']) !!}
                    </div>

                    <div class="col-sm-4">
                        <br>
                        {!! Form::radio('utc_local', 'utc', (@$request_model == 'utc' ? 'checked': '')) !!} UTC
                        {!! Form::radio('utc_local', 'local', (@$request_model == 'local' ? 'checked': '')) !!} Local
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('air_craft_time', 'Air Craft Time:', ['class' => 'control-label']) !!}
                        {!! Form::text('air_craft_time', Input::old('air_craft_time'), ['id'=>'air_craft_time', 'class' => 'form-control','maxlength'=>'64','title'=>'enter air craft time']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
                        {!! Form::text('registration', Input::old('registration'), ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','title'=>'enter registration','required']) !!}
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
                        {!! Form::label('position', 'Position (geogr.co-ord):', ['class' => 'control-label']) !!}
                        {!! Form::text('position', Input::old('position'), ['id'=>'position', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Position']) !!}
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('altitude', 'Altitude:', ['class' => 'control-label']) !!}
                        {!! Form::text('altitude', Input::old('altitude'), ['id'=>'altitude', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('speed', 'Speed/Mach:', ['class' => 'control-label']) !!}
                        {!! Form::text('speed', Input::old('speed'), ['id'=>'speed', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('actual_weight', 'actual_weight:', ['class' => 'control-label']) !!}
                        {!! Form::text('actual_weight', Input::old('actual_weight'), ['id'=>'actual_weight', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('remaining_fuel', 'Remaining Fuel:', ['class' => 'control-label']) !!}
                        {!! Form::text('remaining_fuel', Input::old('remaining_fuel'), ['id'=>'remaining_fuel', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Remaining Fuel']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('atl_ref', 'Atl Ref:', ['class' => 'control-label']) !!}
                        {!! Form::text('atl_ref', Input::old('atl_ref'), ['id'=>'atl_ref', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Atl Ref']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('delay', 'Delay (min):', ['class' => 'control-label']) !!}
                        {!! Form::text('delay', Input::old('delay'), ['id'=>'delay', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Delay']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('diversion', 'Diversion:', ['class' => 'control-label']) !!}
                        {!! Form::text('diversion', Input::old('diversion'), ['id'=>'diversion', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('nr_crew', 'NR Crew:', ['class' => 'control-label']) !!}
                        {!! Form::text('nr_crew', Input::old('nr_crew'), ['id'=>'nr_crew', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('nr_pax', 'NR Pax:', ['class' => 'control-label']) !!}
                        {!! Form::text('nr_pax', Input::old('nr_pax'), ['id'=>'nr_pax', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
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
                        {!! Form::label('description_of_occurence', 'Description Of Occurrence:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description_of_occurence', @$data[0]['description_of_occurence'], ['size' => '6x2', 'class' => 'form-control','title'=>'enter description of occurrence','required']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">METEOROLOGICAL INFORMATION</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('imc_vmc', 'IMC/VMC:', ['class' => 'control-label']) !!}
                        {!! Form::text('imc_vmc', Input::old('imc_vmc'), ['id'=>'imc_vmc', 'class' => 'form-control','maxlength'=>'64','title'=>'enter imc_vmc']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('vmc_km', 'VMC (km):', ['class' => 'control-label']) !!}
                        {!! Form::text('vmc_km', Input::old('vmc_km'), ['id'=>'vmc_km', 'class' => 'form-control','maxlength'=>'64','title'=>'enter vmc_km']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('wind_direction', 'Wind Direction (deg):', ['class' => 'control-label']) !!}
                        {!! Form::text('wind_direction', Input::old('wind_direction'), ['id'=>'wind_direction', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual wind_direction']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('wind_speed', 'Wind Speed:', ['class' => 'control-label']) !!}
                        {!! Form::text('wind_speed', Input::old('wind_speed'), ['id'=>'wind_speed', 'class' => 'form-control','maxlength'=>'64','title'=>'enter wind_speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('visibility', 'Visibility:', ['class' => 'control-label']) !!}
                        {!! Form::text('visibility', Input::old('visibility'), ['id'=>'visibility', 'class' => 'form-control','maxlength'=>'64','title'=>'enter visibility']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('ceiling', 'Ceiling:', ['class' => 'control-label']) !!}
                        {!! Form::text('ceiling', Input::old('ceiling'), ['id'=>'ceiling', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual ceiling']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('clouds', 'Clouds:', ['class' => 'control-label']) !!}
                        {!! Form::text('clouds', Input::old('clouds'), ['id'=>'clouds', 'class' => 'form-control','maxlength'=>'64','title'=>'enter clouds']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('temperature', 'Temperature:', ['class' => 'control-label']) !!}
                        {!! Form::text('temperature', Input::old('temperature'), ['id'=>'temperature', 'class' => 'form-control','maxlength'=>'64','title'=>'enter temperature']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('qnh', 'Qnh:', ['class' => 'control-label']) !!}
                        {!! Form::text('qnh', Input::old('qnh'), ['id'=>'qnh', 'class' => 'form-control','maxlength'=>'64','title'=>'enter qnh']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('weather_condition', 'Weather Condition:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('weather_condition', 'soft', (@$request_model == 'soft' ? 'checked': '')) !!} SOFT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'moderate', (@$request_model == 'moderate' ? 'checked': '')) !!} MODERATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'severe', (@$request_model == 'severe' ? 'checked': '')) !!} SEVERE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'turbulence', (@$request_model == 'turbulence' ? 'checked': '')) !!} TURBULENCE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'wind_shear', (@$request_model == 'wind_shear' ? 'checked': '')) !!} WIND-SHEAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'rain', (@$request_model == 'rain' ? 'checked': '')) !!} RAIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        {!! Form::radio('weather_condition', 'hail', (@$request_model == 'hail' ? 'checked': '')) !!} HAIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'mist', (@$request_model == 'mist' ? 'checked': '')) !!} MIST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'fog', (@$request_model == 'fog' ? 'checked': '')) !!} FOG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'snow', (@$request_model == 'snow' ? 'checked': '')) !!} SNOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('runway', 'Run Way:', ['class' => 'control-label']) !!}
                        {!! Form::text('runway', Input::old('runway'), ['id'=>'runway', 'class' => 'form-control','maxlength'=>'64','title'=>'enter runway']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('runway_condition', 'Runway Condition:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('runway_condition', 'dry', (@$request_model == 'dry' ? 'checked': '')) !!} DRY
                        {!! Form::radio('runway_condition', 'wet', (@$request_model == 'wet' ? 'checked': '')) !!} WET
                        {!! Form::radio('runway_condition', 'mist', (@$request_model == 'mist' ? 'checked': '')) !!} MIST
                        {!! Form::radio('runway_condition', 'snow', (@$request_model == 'snow' ? 'checked': '')) !!} SNOW
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('rvr', 'RVR (M):', ['class' => 'control-label']) !!}
                        {!! Form::text('rvr', Input::old('rvr'), ['id'=>'rvr', 'class' => 'form-control','maxlength'=>'64','title'=>'enter rvr']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('auto_pilot', 'Auto Pilot:', ['class' => 'control-label']) !!}
                        {!! Form::text('auto_pilot', Input::old('auto_pilot'), ['id'=>'auto_pilot', 'class' => 'form-control','maxlength'=>'64','title'=>'enter auto_pilot']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('auto_thrust', 'Auto Thrust:', ['class' => 'control-label']) !!}
                        {!! Form::text('auto_thrust', Input::old('auto_thrust'), ['id'=>'auto_thrust', 'class' => 'form-control','maxlength'=>'64','title'=>'enter auto_thrust']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('gear', 'Gear:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('gear', 'up', (@$request_model == 'up' ? 'checked': '')) !!} UP
                        {!! Form::radio('gear', 'down', (@$request_model == 'down' ? 'checked': '')) !!} DOWN
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('flap', 'Flap:', ['class' => 'control-label']) !!}
                        {!! Form::text('flap', Input::old('flap'), ['id'=>'flap', 'class' => 'form-control','maxlength'=>'64','title'=>'enter flap']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('slat', 'Slat:', ['class' => 'control-label']) !!}
                        {!! Form::text('slat', Input::old('slat'), ['id'=>'slat', 'class' => 'form-control','maxlength'=>'64','title'=>'enter slat']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('spoilers', 'Spoilers:', ['class' => 'control-label']) !!}
                        {!! Form::text('spoilers', Input::old('spoilers'), ['id'=>'spoilers', 'class' => 'form-control','maxlength'=>'64','title'=>'enter spoilers']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">TCAS INFORMATION (traffic)</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('type_of_alert', 'Type OF Alert:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('type_of_alert', 'none', (@$request_model == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('type_of_alert', 'ra', (@$request_model == 'ra' ? 'checked': '')) !!} RA
                        {!! Form::radio('type_of_alert', 'ta', (@$request_model == 'ta' ? 'checked': '')) !!} TA
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('type_of_ra', 'Type OF RA:', ['class' => 'control-label']) !!}
                        {!! Form::text('type_of_ra', Input::old('type_of_ra'), ['id'=>'type_of_ra', 'class' => 'form-control','maxlength'=>'64','title'=>'enter type_of_ra']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('ra_followed', 'RA Followed?:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('ra_followed', 'yes', (@$request_model == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('ra_followed', 'no', (@$request_model == 'no' ? 'checked': '')) !!} NO
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">ATC PROCEDURES</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('level_of_risk', 'Level OF Risk:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('level_of_risk', 'none', (@$request_model == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('level_of_risk', 'low', (@$request_model == 'low' ? 'checked': '')) !!} LOW
                        {!! Form::radio('level_of_risk', 'medium', (@$request_model == 'medium' ? 'checked': '')) !!} MEDIUM
                        {!! Form::radio('level_of_risk', 'high', (@$request_model == 'high' ? 'checked': '')) !!} HIGH
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('evasive_actions', 'Evasive Actions:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('evasive_actions', 'yes', (@$request_model == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('evasive_actions', 'no', (@$request_model == 'no' ? 'checked': '')) !!} NO
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('reported_to_atc', 'Reported TO ATC?:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('reported_to_atc', 'yes', (@$request_model == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('reported_to_atc', 'no', (@$request_model == 'no' ? 'checked': '')) !!} NO
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('atc_instruction', 'ATC Instructions:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('atc_instruction', 'none', (@$request_model == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('atc_instruction', 'climb', (@$request_model == 'climb' ? 'checked': '')) !!} CLIMB
                        {!! Form::radio('atc_instruction', 'descent', (@$request_model == 'descent' ? 'checked': '')) !!} DESCENT
                        {!! Form::radio('atc_instruction', 'turn_left', (@$request_model == 'turn_left' ? 'checked': '')) !!} TURN LEFT
                        {!! Form::radio('atc_instruction', 'turn_right', (@$request_model == 'turn_right' ? 'checked': '')) !!} TURN RIGHT
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('used_frequency', 'USED Frequency:', ['class' => 'control-label']) !!}
                        {!! Form::text('used_frequency', Input::old('used_frequency'), ['id'=>'used_frequency', 'class' => 'form-control','maxlength'=>'64','title'=>'enter used_frequency']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('heading', 'Heading:', ['class' => 'control-label']) !!}
                        {!! Form::text('heading', Input::old('heading'), ['id'=>'heading', 'class' => 'form-control','maxlength'=>'64','title'=>'enter heading']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('heading_other_ac', 'Heading Of The Other AC:', ['class' => 'control-label']) !!}
                        {!! Form::text('heading_other_ac', Input::old('heading_other_ac'), ['id'=>'heading_other_ac', 'class' => 'form-control','maxlength'=>'64','title'=>'enter heading_other_ac']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">AIRPROX</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('ver_seperation', 'VER Separation:', ['class' => 'control-label']) !!}
                        {!! Form::text('ver_seperation', Input::old('ver_seperation'), ['id'=>'ver_seperation', 'class' => 'form-control','maxlength'=>'64','title'=>'enter ver_seperation']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('hor_seperation', 'HOR Separation:', ['class' => 'control-label']) !!}
                        {!! Form::text('hor_seperation', Input::old('hor_seperation'), ['id'=>'hor_seperation', 'class' => 'form-control','maxlength'=>'64','title'=>'enter hor_seperation']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">BIRD STRIKE</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('type_of_bird', 'Type Of Bird:', ['class' => 'control-label']) !!}
                        {!! Form::text('type_of_bird', Input::old('type_of_bird'), ['id'=>'type_of_bird', 'class' => 'form-control','maxlength'=>'64','title'=>'enter type_of_bird']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('nr_of_birds', 'NR OF Birds:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('nr_of_birds', 'seen', (@$request_model == 'seen' ? 'checked': '')) !!} SEEN
                        {!! Form::radio('nr_of_birds', 'impact', (@$request_model == 'impact' ? 'checked': '')) !!} IMPACT
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('size', 'Size:', ['class' => 'control-label']) !!}
                        {!! Form::text('size', Input::old('size'), ['id'=>'size', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('areas_affected', 'Areas Affected:', ['class' => 'control-label']) !!}
                        {!! Form::text('areas_affected', Input::old('areas_affected'), ['id'=>'areas_affected', 'class' => 'form-control','maxlength'=>'64','title'=>'enter size']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('advice_earlier', 'Advised Earlier:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('advice_earlier', 'yes', (@$request_model == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('advice_earlier', 'no', (@$request_model == 'no' ? 'checked': '')) !!} NO
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('lighting_conditions', 'Lighting Conditions:', ['class' => 'control-label']) !!}
                        {!! Form::text('lighting_conditions', Input::old('lighting_conditions'), ['id'=>'lighting_conditions', 'class' => 'form-control','maxlength'=>'64','title'=>'enter lighting_conditions']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('conditions_of_the_sky', 'Condition Of The Sky:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('conditions_of_the_sky', 'clear', (@$request_model == 'clear' ? 'checked': '')) !!} CLEAR
                        {!! Form::radio('conditions_of_the_sky', 'clouded', (@$request_model == 'clouded' ? 'checked': '')) !!} CLOUDED
                        {!! Form::radio('conditions_of_the_sky', 'dark', (@$request_model == 'dark' ? 'checked': '')) !!} DARK
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">TURBULANCE</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('course_ac', 'Course of the AC:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('course_ac', 'none', (@$request_model == 'none' ? 'checked': '')) !!} NONE
                        {!! Form::radio('course_ac', 'right', (@$request_model == 'right' ? 'checked': '')) !!} RIGHT
                        {!! Form::radio('course_ac', 'left', (@$request_model == 'left' ? 'checked': '')) !!} LEFT
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('glidslope_position', 'GLIDSLOPE POSITION:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('glidslope_position', 'hi', (@$request_model == 'hi' ? 'checked': '')) !!} HI
                        {!! Form::radio('glidslope_position', 'low', (@$request_model == 'low' ? 'checked': '')) !!} LOW
                        {!! Form::radio('glidslope_position', 'on', (@$request_model == 'on' ? 'checked': '')) !!} ON
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('pos_extended_center', 'POS. ON EXTENDED CENTR.LINE:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('pos_extended_center', 'left', (@$request_model == 'left' ? 'checked': '')) !!} LEFT
                        {!! Form::radio('pos_extended_center', 'right', (@$request_model == 'right' ? 'checked': '')) !!} RIGHT
                        {!! Form::radio('pos_extended_center', 'on', (@$request_model == 'on' ? 'checked': '')) !!} ON
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('change_in_pitch', 'CHANGE IN PITCH (deg):', ['class' => 'control-label']) !!}
                        {!! Form::text('change_in_pitch', Input::old('change_in_pitch'), ['id'=>'change_in_pitch', 'class' => 'form-control','maxlength'=>'64','title'=>'enter change_in_pitch']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('speed_buffet', 'SPEED BUFFET?:', ['class' => 'control-label']) !!}
                        {!! Form::text('speed_buffet', Input::old('speed_buffet'), ['id'=>'speed_buffet', 'class' => 'form-control','maxlength'=>'64','title'=>'enter speed_buffet']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('stickshaker', 'STICKSHAKER?:', ['class' => 'control-label']) !!}
                        {!! Form::text('stickshaker', Input::old('stickshaker'), ['id'=>'stickshaker', 'class' => 'form-control','maxlength'=>'64','title'=>'enter stickshaker']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('suspected_wake_turbulance', 'SUSPECTED WAKE TURBULANCE:', ['class' => 'control-label']) !!}
                        {!! Form::text('suspected_wake_turbulance', Input::old('suspected_wake_turbulance'), ['id'=>'suspected_wake_turbulance', 'class' => 'form-control','maxlength'=>'64','title'=>'enter suspected_wake_turbulance']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('sign_verticle_accelaration', 'SIGN. VERTICAL ACCELARATION:', ['class' => 'control-label']) !!}
                        {!! Form::text('sign_verticle_accelaration', Input::old('sign_verticle_accelaration'), ['id'=>'sign_verticle_accelaration', 'class' => 'form-control','maxlength'=>'64','title'=>'enter sign_verticle_accelaration']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('details_ac_wake_turbulance', 'DETAILS OF AC WAKE TURBULANCE?:', ['class' => 'control-label']) !!}
                        {!! Form::text('details_ac_wake_turbulance', Input::old('details_ac_wake_turbulance'), ['id'=>'details_ac_wake_turbulance', 'class' => 'form-control','maxlength'=>'64','title'=>'enter details_ac_wake_turbulance']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('advice_other_aircraft', 'ADVISE TO OTHER AIRCRAFT:', ['class' => 'control-label']) !!}
                        {!! Form::text('advice_other_aircraft', Input::old('advice_other_aircraft'), ['id'=>'advice_other_aircraft', 'class' => 'form-control','maxlength'=>'64','title'=>'enter advice_other_aircraft']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">HUMAN FACTORS</b></h5>
                </div>


                <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('persion_involved', 'Person Involved:', ['class' => 'control-label']) !!}
                        {!! Form::text('persion_involved', Input::old('persion_involved'), ['id'=>'persion_involved', 'class' => 'form-control','maxlength'=>'64','title'=>'enter persion_involved']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('function_position', 'Function/Position:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('function_position', 'crew', (@$request_model == 'crew' ? 'checked': '')) !!} CREW
                        {!! Form::radio('function_position', 'ground', (@$request_model == 'ground' ? 'checked': '')) !!} GROUND
                        {!! Form::radio('function_position', 'other', (@$request_model == 'other' ? 'checked': '')) !!} OTHER
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('type_of_influence', 'TYPE OF INFLUENCE:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('type_of_influence', 'crew_actions', (@$request_model == 'crew_actions' ? 'checked': '')) !!} CREW ACTIONS
                        {!! Form::radio('type_of_influence', 'external', (@$request_model == 'external' ? 'checked': '')) !!} EXTERNAL
                        {!! Form::radio('type_of_influence', 'organizations', (@$request_model == 'organizations' ? 'checked': '')) !!} ORGANIZATIONA
                        {!! Form::radio('type_of_influence', 'personal', (@$request_model == 'personal' ? 'checked': '')) !!} PERSONAL
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('comments', 'COMMENTS:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('comments', @$data[0]['comments'], ['size' => '6x2', 'class' => 'form-control','title'=>'enter comments']) !!}
                    </div>

                    {{--<div class="col-sm-4">
                        {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
                        <small class="narration">(Active status Selected)</small>
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['class'=>'form-control ','required']) !!}
                    </div>--}}

                </div>

                <div class="form-group">
                    {!! Form::hidden('status','active' ) !!}
                </div>


                <div class="footer-form-margin-btn">
                    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                    <a href="{{route('air-safety')}}" class=" btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
                </div>


            </div>
        </div>


        {!! Form::close() !!}

    </div>




    <script>

        //document.onload = function() {
        $(function () {
            $("#form_2").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    max: {
                        required: true,
                        maxlength: 4
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $("#form_2").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    last_name: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    number: {
                        required: "(Please enter your phone number)",
                        number: "(Please enter valid phone number)"
                    },
                    last_name: {
                        required: "This is custom message for required",
                        minlength: "This is custom message for min length"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                },
                errorPlacement: function (error, element) {
                    $(element)
                            .closest("form")
                            .find("label[for='" + element.attr("id") + "']")
                            .append(error);
                },
                errorElement: "span",
            });
        });
        //}
    </script>



@stop