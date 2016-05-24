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
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Edit Air Safety report</b></h4>
        </div>

        {{--{!! Form::open(['route' => 'store-safety','class' => 'form-horizontal','id' => 'form_2']) !!}--}}
        {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-safety', $data->id],'id' => 'jq-validation-form']) !!}

        <div class="panel-body">

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div style="background-color: yellow; height: 25px;">
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
                    <div class="col-sm-4">
                        {!! Form::label('others', 'Others:', ['class' => 'control-label']) !!}
                        {!! Form::text('others', Input::old('others'), ['id'=>'others', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('captain', 'Captain:', ['class' => 'control-label']) !!}
                        {!! Form::text('captain', Input::old('captain'), ['id'=>'captain', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        {!! Form::radio('pf_pnf', 'pf', (@$data['pf_pnf'] == 'pf' ? 'checked': '')) !!} PF
                        {!! Form::radio('pf_pnf', 'pnf', (@$data['pf_pnf'] == 'pnf' ? 'checked': '')) !!} PNF
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('co_pilot', 'Co Pilot:', ['class' => 'control-label']) !!}
                        {!! Form::text('co_pilot', Input::old('co_pilot'), ['id'=>'co_pilot', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        {!! Form::radio('pf_pnf2', 'pf', (@$data['pf_pnf2'] == 'pf' ? 'checked': '')) !!} PF
                        {!! Form::radio('pf_pnf2', 'pnf', (@$data['pf_pnf2'] == 'pnf' ? 'checked': '')) !!} PNF
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
                        {!! Form::text('time', Input::old('time'), ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
                    </div>

                    <div class="col-sm-4">
                        <br>
                        {!! Form::radio('utc_local', 'utc', (@$data['utc_local'] == 'utc' ? 'checked': '')) !!} UTC
                        {!! Form::radio('utc_local', 'local', (@$data['utc_local'] == 'local' ? 'checked': '')) !!} Local
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('air_craft_time', 'Air Craft Time:', ['class' => 'control-label']) !!}
                        {!! Form::text('air_craft_time', Input::old('air_craft_time'), ['id'=>'air_craft_time', 'class' => 'form-control','maxlength'=>'64','title'=>'enter air craft time']) !!}
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
                        {!! Form::radio('flight_phase', 'parked', (@$data['flight_phase'] == 'parked' ? 'checked': '')) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'push_back', (@$data['flight_phase'] == 'push_back' ? 'checked': '')) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'taxi_out', (@$data['flight_phase'] == 'taxi_out' ? 'checked': '')) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'take_off', (@$data['flight_phase'] == 'take_off' ? 'checked': '')) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'initial_climb', (@$data['flight_phase'] == 'initial_climb' ? 'checked': '')) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'climb', (@$data['flight_phase'] == 'climb' ? 'checked': '')) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;

                        {!! Form::radio('flight_phase', 'cruise', (@$data['flight_phase'] == 'cruise' ? 'checked': '')) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'holding', (@$data['flight_phase'] == 'holding' ? 'checked': '')) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'descent', (@$data['flight_phase'] == 'descent' ? 'checked': '')) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'approach', (@$data['flight_phase'] == 'approach' ? 'checked': '')) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'landing', (@$data['flight_phase'] == 'landing' ? 'checked': '')) !!} LANDING&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'taxi_in', (@$data['flight_phase'] == 'taxi_in' ? 'checked': '')) !!} TAXI IN
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('description_of_occurence', 'Description Of Occurence:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description_of_occurence', @$data[0]['description_of_occurence'], ['size' => '6x2', 'class' => 'form-control','title'=>'enter description of occurence','required']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">METEOROLOGICAL INFORMATION</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('imc_vmc', 'IMC/VMC:', ['class' => 'control-label']) !!}
                        {!! Form::text('imc_vmc', Input::old('imc_vmc'), ['id'=>'imc_vmc', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('vmc_km', 'VMC (km):', ['class' => 'control-label']) !!}
                        {!! Form::text('vmc_km', Input::old('vmc_km'), ['id'=>'vmc_km', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('wind_direction', 'Wind Direction (deg):', ['class' => 'control-label']) !!}
                        {!! Form::text('wind_direction', Input::old('wind_direction'), ['id'=>'wind_direction', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('wind_speed', 'Wind Speed:', ['class' => 'control-label']) !!}
                        {!! Form::text('wind_speed', Input::old('wind_speed'), ['id'=>'wind_speed', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('visibility', 'Visibility:', ['class' => 'control-label']) !!}
                        {!! Form::text('visibility', Input::old('visibility'), ['id'=>'visibility', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('ceiling', 'Ceiling:', ['class' => 'control-label']) !!}
                        {!! Form::text('ceiling', Input::old('ceiling'), ['id'=>'ceiling', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('clouds', 'Clouds:', ['class' => 'control-label']) !!}
                        {!! Form::text('clouds', Input::old('clouds'), ['id'=>'clouds', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('temperature', 'Temperature:', ['class' => 'control-label']) !!}
                        {!! Form::text('temperature', Input::old('temperature'), ['id'=>'temperature', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('qnh', 'Qnh:', ['class' => 'control-label']) !!}
                        {!! Form::text('qnh', Input::old('qnh'), ['id'=>'qnh', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('weather_condition', 'Weather Condition:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('weather_condition', 'soft', (@@$data['weather_condition'] == 'soft' ? 'checked': '')) !!} SOFT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'moderate', (@@$data['weather_condition'] == 'moderate' ? 'checked': '')) !!} MODERATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'severe', (@@$data['weather_condition'] == 'severe' ? 'checked': '')) !!} SEVERE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'turbulence', (@@$data['weather_condition'] == 'turbulence' ? 'checked': '')) !!} TURBULENCE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'wind_shear', (@@$data['weather_condition'] == 'wind_shear' ? 'checked': '')) !!} WIND-SHEAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'rain', (@@$data['weather_condition'] == 'rain' ? 'checked': '')) !!} RAIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        {!! Form::radio('weather_condition', 'hail', (@@$data['weather_condition'] == 'hail' ? 'checked': '')) !!} HAIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'mist', (@@$data['weather_condition'] == 'mist' ? 'checked': '')) !!} MIST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'fog', (@@$data['weather_condition'] == 'fog' ? 'checked': '')) !!} FOG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'snow', (@@$data['weather_condition'] == 'snow' ? 'checked': '')) !!} SNOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('runway', 'Run Way:', ['class' => 'control-label']) !!}
                        {!! Form::text('runway', Input::old('runway'), ['id'=>'runway', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('runway_condition', 'Runway Condition:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('runway_condition', 'dry', (@@$data['runway_condition'] == 'dry' ? 'checked': '')) !!} DRY
                        {!! Form::radio('runway_condition', 'wet', (@@$data['runway_condition'] == 'wet' ? 'checked': '')) !!} WET
                        {!! Form::radio('runway_condition', 'mist', (@@$data['runway_condition'] == 'mist' ? 'checked': '')) !!} MIST
                        {!! Form::radio('runway_condition', 'snow', (@@$data['runway_condition'] == 'snow' ? 'checked': '')) !!} SNOW
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('rvr', 'RVR (M):', ['class' => 'control-label']) !!}
                        {!! Form::text('rvr', Input::old('rvr'), ['id'=>'rvr', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('auto_pilot', 'Auto Pilot:', ['class' => 'control-label']) !!}
                        {!! Form::text('auto_pilot', Input::old('auto_pilot'), ['id'=>'auto_pilot', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('auto_thrust', 'Auto Thrust:', ['class' => 'control-label']) !!}
                        {!! Form::text('auto_thrust', Input::old('auto_thrust'), ['id'=>'auto_thrust', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('gear', 'Gear:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('gear', 'up', (@@$data['pf_pnf2'] == 'up' ? 'checked': '')) !!} UP
                        {!! Form::radio('gear', 'down', (@@$data['pf_pnf2'] == 'down' ? 'checked': '')) !!} DOWN
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('flap', 'Flap:', ['class' => 'control-label']) !!}
                        {!! Form::text('flap', Input::old('flap'), ['id'=>'flap', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('slat', 'Slat:', ['class' => 'control-label']) !!}
                        {!! Form::text('slat', Input::old('slat'), ['id'=>'slat', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('spoilers', 'Spoilers:', ['class' => 'control-label']) !!}
                        {!! Form::text('spoilers', Input::old('spoilers'), ['id'=>'spoilers', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">TCAS INFORMATION (traffic)</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('type_of_alert', 'Type OF Alert:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('type_of_alert', 'none', (@@$data['type_of_alert'] == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('type_of_alert', 'ra', (@@$data['type_of_alert'] == 'ra' ? 'checked': '')) !!} RA
                        {!! Form::radio('type_of_alert', 'ta', (@@$data['type_of_alert'] == 'ta' ? 'checked': '')) !!} TA
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('type_of_ra', 'Type OF RA:', ['class' => 'control-label']) !!}
                        {!! Form::text('type_of_ra', Input::old('type_of_ra'), ['id'=>'type_of_ra', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('ra_followed', 'RA Followed?:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('ra_followed', 'yes', (@@$data['ra_followed'] == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('ra_followed', 'no', (@@$data['ra_followed'] == 'no' ? 'checked': '')) !!} NO
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">ATC PROCEDURES</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('level_of_risk', 'Level OF Risk:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('level_of_risk', 'none', (@@$data['level_of_risk'] == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('level_of_risk', 'low', (@@$data['level_of_risk'] == 'low' ? 'checked': '')) !!} LOW
                        {!! Form::radio('level_of_risk', 'medium', (@@$data['level_of_risk'] == 'medium' ? 'checked': '')) !!} MEDIUM
                        {!! Form::radio('level_of_risk', 'high', (@@$data['level_of_risk'] == 'high' ? 'checked': '')) !!} HIGH
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('evasive_actions', 'Evasive Actions:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('evasive_actions', 'yes', (@@$data['evasive_actions'] == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('evasive_actions', 'no', (@@$data['evasive_actions'] == 'no' ? 'checked': '')) !!} NO
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('reported_to_atc', 'Reported TO ATC?:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('reported_to_atc', 'yes', (@@$data['reported_to_atc'] == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('reported_to_atc', 'no', (@@$data['reported_to_atc'] == 'no' ? 'checked': '')) !!} NO
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('atc_instruction', 'ATC Instructions:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('atc_instruction', 'none', (@@$data['atc_instruction'] == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('atc_instruction', 'climb', (@@$data['atc_instruction'] == 'climb' ? 'checked': '')) !!} CLIMB
                        {!! Form::radio('atc_instruction', 'descent', (@@$data['atc_instruction'] == 'descent' ? 'checked': '')) !!} DESCENT
                        {!! Form::radio('atc_instruction', 'turn_left', (@@$data['atc_instruction'] == 'turn_left' ? 'checked': '')) !!} TURN LEFT
                        {!! Form::radio('atc_instruction', 'turn_right', (@@$data['atc_instruction'] == 'turn_right' ? 'checked': '')) !!} TURN RIGHT
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('used_frequency', 'USED Frequency:', ['class' => 'control-label']) !!}
                        {!! Form::text('used_frequency', Input::old('used_frequency'), ['id'=>'used_frequency', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('heading', 'Heading:', ['class' => 'control-label']) !!}
                        {!! Form::text('heading', Input::old('heading'), ['id'=>'heading', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('heading_other_ac', 'Heading Of The Other AC:', ['class' => 'control-label']) !!}
                        {!! Form::text('heading_other_ac', Input::old('heading_other_ac'), ['id'=>'heading_other_ac', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">AIRPROX</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('ver_seperation', 'VER Separation:', ['class' => 'control-label']) !!}
                        {!! Form::text('ver_seperation', Input::old('ver_seperation'), ['id'=>'ver_seperation', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('hor_seperation', 'HOR Separation:', ['class' => 'control-label']) !!}
                        {!! Form::text('hor_seperation', Input::old('hor_seperation'), ['id'=>'hor_seperation', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">BIRD STRIKE</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('type_of_bird', 'Type Of Bird:', ['class' => 'control-label']) !!}
                        {!! Form::text('type_of_bird', Input::old('type_of_bird'), ['id'=>'type_of_bird', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('nr_of_birds', 'NR OF Birds:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('nr_of_birds', 'seen', (@@$data['nr_of_birds'] == 'seen' ? 'checked': '')) !!} SEEN
                        {!! Form::radio('nr_of_birds', 'impact', (@@$data['nr_of_birds'] == 'impact' ? 'checked': '')) !!} IMPACT
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('size', 'Size:', ['class' => 'control-label']) !!}
                        {!! Form::text('size', Input::old('size'), ['id'=>'size', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('areas_affected', 'Areas Affected:', ['class' => 'control-label']) !!}
                        {!! Form::text('areas_affected', Input::old('areas_affected'), ['id'=>'areas_affected', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('advice_earlier', 'Advised Earlier:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('advice_earlier', 'yes', (@@$data['advice_earlier'] == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('advice_earlier', 'no', (@@$data['advice_earlier'] == 'no' ? 'checked': '')) !!} NO
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('lighting_conditions', 'Lighting Conditions:', ['class' => 'control-label']) !!}
                        {!! Form::text('lighting_conditions', Input::old('lighting_conditions'), ['id'=>'lighting_conditions', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('conditions_of_the_sky', 'Condition Of The Sky:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('conditions_of_the_sky', 'clear', (@@$data['conditions_of_the_sky'] == 'clear' ? 'checked': '')) !!} CLEAR
                        {!! Form::radio('conditions_of_the_sky', 'clouded', (@@$data['conditions_of_the_sky'] == 'clouded' ? 'checked': '')) !!} CLOUDED
                        {!! Form::radio('conditions_of_the_sky', 'dark', (@@$data['conditions_of_the_sky'] == 'dark' ? 'checked': '')) !!} DARK
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">TURBULANCE</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('course_ac', 'Course of the AC:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('course_ac', 'none', (@@$data['course_ac'] == 'none' ? 'checked': '')) !!} NONE
                        {!! Form::radio('course_ac', 'right', (@@$data['course_ac'] == 'right' ? 'checked': '')) !!} RIGHT
                        {!! Form::radio('course_ac', 'left', (@@$data['course_ac'] == 'left' ? 'checked': '')) !!} LEFT
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('glidslope_position', 'GLIDSLOPE POSITION:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('glidslope_position', 'hi', (@@$data['glidslope_position'] == 'hi' ? 'checked': '')) !!} HI
                        {!! Form::radio('glidslope_position', 'low', (@@$data['glidslope_position'] == 'low' ? 'checked': '')) !!} LOW
                        {!! Form::radio('glidslope_position', 'on', (@@$data['glidslope_position'] == 'on' ? 'checked': '')) !!} ON
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('pos_extended_center', 'POS. ON EXTENDED CENTR.LINE:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('pos_extended_center', 'left', (@@$data['pos_extended_center'] == 'left' ? 'checked': '')) !!} LEFT
                        {!! Form::radio('pos_extended_center', 'right', (@@$data['pos_extended_center'] == 'right' ? 'checked': '')) !!} RIGHT
                        {!! Form::radio('pos_extended_center', 'on', (@@$data['pos_extended_center'] == 'on' ? 'checked': '')) !!} ON
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('change_in_pitch', 'CHANGE IN PITCH (deg):', ['class' => 'control-label']) !!}
                        {!! Form::text('change_in_pitch', Input::old('change_in_pitch'), ['id'=>'change_in_pitch', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('speed_buffet', 'SPEED BUFFET?:', ['class' => 'control-label']) !!}
                        {!! Form::text('speed_buffet', Input::old('speed_buffet'), ['id'=>'speed_buffet', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('stickshaker', 'STICKSHAKER?:', ['class' => 'control-label']) !!}
                        {!! Form::text('stickshaker', Input::old('stickshaker'), ['id'=>'stickshaker', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Actual Weight']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('suspected_wake_turbulance', 'SUSPECTED WAKE TURBULANCE:', ['class' => 'control-label']) !!}
                        {!! Form::text('suspected_wake_turbulance', Input::old('suspected_wake_turbulance'), ['id'=>'suspected_wake_turbulance', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('sign_verticle_accelaration', 'SIGN. VERTICAL ACCELARATION:', ['class' => 'control-label']) !!}
                        {!! Form::text('sign_verticle_accelaration', Input::old('sign_verticle_accelaration'), ['id'=>'sign_verticle_accelaration', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('details_ac_wake_turbulance', 'DETAILS OF AC WAKE TURBULANCE??:', ['class' => 'control-label']) !!}
                        {!! Form::text('details_ac_wake_turbulance', Input::old('details_ac_wake_turbulance'), ['id'=>'details_ac_wake_turbulance', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Altitude']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('advice_other_aircraft', 'ADVISE TO OTHER AIRCRAFT:', ['class' => 'control-label']) !!}
                        {!! Form::text('advice_other_aircraft', Input::old('advice_other_aircraft'), ['id'=>'advice_other_aircraft', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">HUMAN FACTORS</b></h5>
                </div>


                <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('persion_involved', 'Person Involved:', ['class' => 'control-label']) !!}
                        {!! Form::text('persion_involved', Input::old('persion_involved'), ['id'=>'persion_involved', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Speed']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('function_position', 'Function/Position:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('function_position', 'crew', (@@$data['function_position'] == 'crew' ? 'checked': '')) !!} CREW
                        {!! Form::radio('function_position', 'ground', (@@$data['function_position'] == 'ground' ? 'checked': '')) !!} GROUND
                        {!! Form::radio('function_position', 'other', (@@$data['function_position'] == 'other' ? 'checked': '')) !!} OTHER
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('type_of_influence', 'TYPE OF INFLUENCE:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('type_of_influence', 'crew_actions', (@@$data['type_of_influence'] == 'crew_actions' ? 'checked': '')) !!} CREW ACTIONS
                        {!! Form::radio('type_of_influence', 'external', (@@$data['type_of_influence'] == 'external' ? 'checked': '')) !!} EXTERNAL
                        {!! Form::radio('type_of_influence', 'organizations', (@@$data['type_of_influence'] == 'organizations' ? 'checked': '')) !!} ORGANIZATIONA
                        {!! Form::radio('type_of_influence', 'personal', (@@$data['type_of_influence'] == 'personal' ? 'checked': '')) !!} PERSONAL
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('comments', 'COMMENTS:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('comments', @$data[0]['comments'], ['size' => '6x2', 'class' => 'form-control','title'=>'enter description of occurence']) !!}
                    </div>
                    {{--<div class="col-sm-4">
                        {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
                        <small class="narration">(Active status Selected)</small>
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['class'=>'form-control ','required']) !!}
                    </div>--}}
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