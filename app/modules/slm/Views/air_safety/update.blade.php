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

                <!----- For Reference Number ----------------->
                <div>
                    @if(isset($data))
                        <div class="col-md-6" style="padding: 0px;">
                            @if(isset(Auth::user()->role_id))

                                @if(Auth::user()->role_id == '1' && @$data->reference_no != null && @$data->sent_receive == '0')
                                    <a href="{{ route('safety-sent-receive', $data->id) }}" class="btn btn-info btn-xl" data-placement="top" data-toggle="modal" title="Send Received Report" data-target="#etsbModal">Send Received Report</a>
                                @endif

                            @endif
                        </div>
                        <div class="col-md-6" style="padding: 0px;">
                            {!! Form::label('reference_no', 'Reference Number:', []) !!}
                            @if(Auth::user()->role_id == '1' && $data->reference_no == null)
                                {!! Form::text('reference_no', $data->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256']) !!}
                            @else
                                {!! Form::text('reference_no', $data->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256','title'=>'enter reference number','readonly']) !!}
                            @endif
                        </div>

                    @endif
                    <div class="clearfix"></div>

                </div>
                <!-----------------End of Reference Number ------>

                <div style="background-color: yellow; height: 25px;">
                    <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('full_name', 'Full Name:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::text('full_name', $data->full_name, ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::email('email',$data->email,['class' => 'form-control','placeholder'=>'Email Address','required','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
                        {!! Form::text('telephone', $data->telephone, ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('extension', 'Extension:', ['class' => 'control-label']) !!}
                        {!! Form::text('extension', $data->extension, ['id'=>'extension', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
                        {!! Form::text('fax', $data->fax, ['id'=>'fax', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('others', 'Others:', ['class' => 'control-label']) !!}
                        {!! Form::text('others', $data->others, ['id'=>'others', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('captain', 'Captain:', ['class' => 'control-label']) !!}
                        {!! Form::text('captain', $data->captain, ['id'=>'captain', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        {!! Form::radio('pf_pnf', 'pf', (@$data['pf_pnf'] == 'pf' ? 'checked': ''),array('disabled')) !!} PF
                        {!! Form::radio('pf_pnf', 'pnf', (@$data['pf_pnf'] == 'pnf' ? 'checked': ''),array('disabled')) !!} PNF
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('co_pilot', 'Co Pilot:', ['class' => 'control-label']) !!}
                        {!! Form::text('co_pilot', $data->co_pilot, ['id'=>'co_pilot', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-2">
                        <br>
                        {!! Form::radio('pf_pnf2', 'pf', (@$data['pf_pnf2'] == 'pf' ? 'checked': ''),array('disabled')) !!} PF
                        {!! Form::radio('pf_pnf2', 'pnf', (@$data['pf_pnf2'] == 'pnf' ? 'checked': ''),array('disabled')) !!} PNF
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
                        {{--<div class="input-group date">--}}
                            {!! Form::text('date', $data->date, ['class' => 'form-control','readonly']) !!}
                            {{--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
                        {!! Form::text('time', $data->time, ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>

                    <div class="col-sm-4">
                        <br>
                        {!! Form::radio('utc_local', 'utc', (@$data['utc_local'] == 'utc' ? 'checked': ''),array('disabled')) !!} UTC
                        {!! Form::radio('utc_local', 'local', (@$data['utc_local'] == 'local' ? 'checked': ''),array('disabled')) !!} Local
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('air_craft_time', 'Air Craft Time:', ['class' => 'control-label']) !!}
                        {!! Form::text('air_craft_time', $data->air_craft_time, ['id'=>'air_craft_time', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
                        {!! Form::text('registration', $data->registration, ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('flight_no', 'Flight No:', ['class' => 'control-label']) !!}
                        {!! Form::text('flight_no', $data->flight_no, ['id'=>'flight_no', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('from', 'From:', ['class' => 'control-label']) !!}
                        {!! Form::text('from', $data->from, ['id'=>'from', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('to', 'To:', ['class' => 'control-label']) !!}
                        {!! Form::text('to', $data->to, ['id'=>'to', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('position', 'Position (geogr.co-ord):', ['class' => 'control-label']) !!}
                        {!! Form::text('position', $data->position, ['id'=>'position', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('altitude', 'Altitude:', ['class' => 'control-label']) !!}
                        {!! Form::text('altitude', $data->altitude, ['id'=>'altitude', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('speed', 'Speed/Mach:', ['class' => 'control-label']) !!}
                        {!! Form::text('speed', $data->speed, ['id'=>'speed', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('actual_weight', 'actual_weight:', ['class' => 'control-label']) !!}
                        {!! Form::text('actual_weight', $data->actual_weight, ['id'=>'actual_weight', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('remaining_fuel', 'Remaining Fuel:', ['class' => 'control-label']) !!}
                        {!! Form::text('remaining_fuel', $data->remaining_fuel, ['id'=>'remaining_fuel', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('atl_ref', 'Atl Ref:', ['class' => 'control-label']) !!}
                        {!! Form::text('atl_ref', $data->atl_ref, ['id'=>'atl_ref', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('delay', 'Delay (min):', ['class' => 'control-label']) !!}
                        {!! Form::text('delay', $data->delay, ['id'=>'delay', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('diversion', 'Diversion:', ['class' => 'control-label']) !!}
                        {!! Form::text('diversion', $data->diversion, ['id'=>'diversion', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('nr_crew', 'NR Crew:', ['class' => 'control-label']) !!}
                        {!! Form::text('nr_crew', $data->nr_crew, ['id'=>'nr_crew', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('nr_pax', 'NR Pax:', ['class' => 'control-label']) !!}
                        {!! Form::text('nr_pax', $data->nr_pax, ['id'=>'nr_pax', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('flight_phase', 'Flight Phase:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('flight_phase', 'parked', (@$data['flight_phase'] == 'parked' ? 'checked': ''),array('disabled')) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'push_back', (@$data['flight_phase'] == 'push_back' ? 'checked': ''),array('disabled')) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'taxi_out', (@$data['flight_phase'] == 'taxi_out' ? 'checked': ''),array('disabled')) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'take_off', (@$data['flight_phase'] == 'take_off' ? 'checked': ''),array('disabled')) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'initial_climb', (@$data['flight_phase'] == 'initial_climb' ? 'checked': ''),array('disabled')) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'climb', (@$data['flight_phase'] == 'climb' ? 'checked': ''),array('disabled')) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;

                        {!! Form::radio('flight_phase', 'cruise', (@$data['flight_phase'] == 'cruise' ? 'checked': ''),array('disabled')) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'holding', (@$data['flight_phase'] == 'holding' ? 'checked': ''),array('disabled')) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'descent', (@$data['flight_phase'] == 'descent' ? 'checked': ''),array('disabled')) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'approach', (@$data['flight_phase'] == 'approach' ? 'checked': ''),array('disabled')) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'landing', (@$data['flight_phase'] == 'landing' ? 'checked': ''),array('disabled')) !!} LANDING&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'taxi_in', (@$data['flight_phase'] == 'taxi_in' ? 'checked': ''),array('disabled')) !!} TAXI IN
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('description_of_occurence', 'Description Of Occurence:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description_of_occurence', @$data[0]['description_of_occurence'], ['size' => '6x2', 'class' => 'form-control','readonly']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">METEOROLOGICAL INFORMATION</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('imc_vmc', 'IMC/VMC:', ['class' => 'control-label']) !!}
                        {!! Form::text('imc_vmc', $data->imc_vmc, ['id'=>'imc_vmc', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('vmc_km', 'VMC (km):', ['class' => 'control-label']) !!}
                        {!! Form::text('vmc_km', $data->vmc_km, ['id'=>'vmc_km', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('wind_direction', 'Wind Direction (deg):', ['class' => 'control-label']) !!}
                        {!! Form::text('wind_direction', $data->wind_direction, ['id'=>'wind_direction', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('wind_speed', 'Wind Speed:', ['class' => 'control-label']) !!}
                        {!! Form::text('wind_speed', $data->wind_speed, ['id'=>'wind_speed', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('visibility', 'Visibility:', ['class' => 'control-label']) !!}
                        {!! Form::text('visibility', $data->visibility, ['id'=>'visibility', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('ceiling', 'Ceiling:', ['class' => 'control-label']) !!}
                        {!! Form::text('ceiling', $data->ceiling, ['id'=>'ceiling', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('clouds', 'Clouds:', ['class' => 'control-label']) !!}
                        {!! Form::text('clouds', $data->clouds, ['id'=>'clouds', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('temperature', 'Temperature:', ['class' => 'control-label']) !!}
                        {!! Form::text('temperature', $data->temperature, ['id'=>'temperature', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('qnh', 'Qnh:', ['class' => 'control-label']) !!}
                        {!! Form::text('qnh', $data->qnh, ['id'=>'qnh', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('weather_condition', 'Weather Condition:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('weather_condition', 'soft', (@@$data['weather_condition'] == 'soft' ? 'checked': ''),array('disabled')) !!} SOFT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'moderate', (@@$data['weather_condition'] == 'moderate' ? 'checked': ''),array('disabled')) !!} MODERATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'severe', (@@$data['weather_condition'] == 'severe' ? 'checked': ''),array('disabled')) !!} SEVERE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'turbulence', (@@$data['weather_condition'] == 'turbulence' ? 'checked': ''),array('disabled')) !!} TURBULENCE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'wind_shear', (@@$data['weather_condition'] == 'wind_shear' ? 'checked': ''),array('disabled')) !!} WIND-SHEAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'rain', (@@$data['weather_condition'] == 'rain' ? 'checked': ''),array('disabled')) !!} RAIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        {!! Form::radio('weather_condition', 'hail', (@@$data['weather_condition'] == 'hail' ? 'checked': ''),array('disabled')) !!} HAIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'mist', (@@$data['weather_condition'] == 'mist' ? 'checked': ''),array('disabled')) !!} MIST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'fog', (@@$data['weather_condition'] == 'fog' ? 'checked': ''),array('disabled')) !!} FOG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'snow', (@@$data['weather_condition'] == 'snow' ? 'checked': ''),array('disabled')) !!} SNOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('runway', 'Run Way:', ['class' => 'control-label']) !!}
                        {!! Form::text('runway', $data->runway, ['id'=>'runway', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('runway_condition', 'Runway Condition:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('runway_condition', 'dry', (@@$data['runway_condition'] == 'dry' ? 'checked': ''),array('disabled')) !!} DRY
                        {!! Form::radio('runway_condition', 'wet', (@@$data['runway_condition'] == 'wet' ? 'checked': ''),array('disabled')) !!} WET
                        {!! Form::radio('runway_condition', 'mist', (@@$data['runway_condition'] == 'mist' ? 'checked': ''),array('disabled')) !!} MIST
                        {!! Form::radio('runway_condition', 'snow', (@@$data['runway_condition'] == 'snow' ? 'checked': ''),array('disabled')) !!} SNOW
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('rvr', 'RVR (M):', ['class' => 'control-label']) !!}
                        {!! Form::text('rvr', $data->rvr, ['id'=>'rvr', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('auto_pilot', 'Auto Pilot:', ['class' => 'control-label']) !!}
                        {!! Form::text('auto_pilot', $data->auto_pilot, ['id'=>'auto_pilot', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('auto_thrust', 'Auto Thrust:', ['class' => 'control-label']) !!}
                        {!! Form::text('auto_thrust', $data->auto_thrust, ['id'=>'auto_thrust', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('gear', 'Gear:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('gear', 'up', (@@$data['pf_pnf2'] == 'up' ? 'checked': ''),array('disabled')) !!} UP
                        {!! Form::radio('gear', 'down', (@@$data['pf_pnf2'] == 'down' ? 'checked': ''),array('disabled')) !!} DOWN
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('flap', 'Flap:', ['class' => 'control-label']) !!}
                        {!! Form::text('flap', $data->flap, ['id'=>'flap', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('slat', 'Slat:', ['class' => 'control-label']) !!}
                        {!! Form::text('slat', $data->slat, ['id'=>'slat', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('spoilers', 'Spoilers:', ['class' => 'control-label']) !!}
                        {!! Form::text('spoilers', $data->spoilers, ['id'=>'spoilers', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">TCAS INFORMATION (traffic)</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('type_of_alert', 'Type OF Alert:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('type_of_alert', 'none', (@@$data['type_of_alert'] == 'none' ? 'checked': ''),array('disabled')) !!} None
                        {!! Form::radio('type_of_alert', 'ra', (@@$data['type_of_alert'] == 'ra' ? 'checked': ''),array('disabled')) !!} RA
                        {!! Form::radio('type_of_alert', 'ta', (@@$data['type_of_alert'] == 'ta' ? 'checked': ''),array('disabled')) !!} TA
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('type_of_ra', 'Type OF RA:', ['class' => 'control-label']) !!}
                        {!! Form::text('type_of_ra', $data->type_of_ra, ['id'=>'type_of_ra', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('ra_followed', 'RA Followed?:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('ra_followed', 'yes', (@@$data['ra_followed'] == 'yes' ? 'checked': ''),array('disabled')) !!} YES
                        {!! Form::radio('ra_followed', 'no', (@@$data['ra_followed'] == 'no' ? 'checked': ''),array('disabled')) !!} NO
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">ATC PROCEDURES</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('level_of_risk', 'Level OF Risk:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('level_of_risk', 'none', (@@$data['level_of_risk'] == 'none' ? 'checked': ''),array('disabled')) !!} None
                        {!! Form::radio('level_of_risk', 'low', (@@$data['level_of_risk'] == 'low' ? 'checked': ''),array('disabled')) !!} LOW
                        {!! Form::radio('level_of_risk', 'medium', (@@$data['level_of_risk'] == 'medium' ? 'checked': ''),array('disabled')) !!} MEDIUM
                        {!! Form::radio('level_of_risk', 'high', (@@$data['level_of_risk'] == 'high' ? 'checked': ''),array('disabled')) !!} HIGH
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('evasive_actions', 'Evasive Actions:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('evasive_actions', 'yes', (@@$data['evasive_actions'] == 'yes' ? 'checked': ''),array('disabled')) !!} YES
                        {!! Form::radio('evasive_actions', 'no', (@@$data['evasive_actions'] == 'no' ? 'checked': ''),array('disabled')) !!} NO
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('reported_to_atc', 'Reported TO ATC?:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('reported_to_atc', 'yes', (@@$data['reported_to_atc'] == 'yes' ? 'checked': ''),array('disabled')) !!} YES
                        {!! Form::radio('reported_to_atc', 'no', (@@$data['reported_to_atc'] == 'no' ? 'checked': ''),array('disabled')) !!} NO
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('atc_instruction', 'ATC Instructions:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('atc_instruction', 'none', (@@$data['atc_instruction'] == 'none' ? 'checked': ''),array('disabled')) !!} None
                        {!! Form::radio('atc_instruction', 'climb', (@@$data['atc_instruction'] == 'climb' ? 'checked': ''),array('disabled')) !!} CLIMB
                        {!! Form::radio('atc_instruction', 'descent', (@@$data['atc_instruction'] == 'descent' ? 'checked': ''),array('disabled')) !!} DESCENT
                        {!! Form::radio('atc_instruction', 'turn_left', (@@$data['atc_instruction'] == 'turn_left' ? 'checked': ''),array('disabled')) !!} TURN LEFT
                        {!! Form::radio('atc_instruction', 'turn_right', (@@$data['atc_instruction'] == 'turn_right' ? 'checked': ''),array('disabled')) !!} TURN RIGHT
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('used_frequency', 'USED Frequency:', ['class' => 'control-label']) !!}
                        {!! Form::text('used_frequency', $data->used_frequency, ['id'=>'used_frequency', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('heading', 'Heading:', ['class' => 'control-label']) !!}
                        {!! Form::text('heading', $data->heading, ['id'=>'heading', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('heading_other_ac', 'Heading Of The Other AC:', ['class' => 'control-label']) !!}
                        {!! Form::text('heading_other_ac', $data->heading_other_ac, ['id'=>'heading_other_ac', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">AIRPROX</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('ver_seperation', 'VER Separation:', ['class' => 'control-label']) !!}
                        {!! Form::text('ver_seperation', $data->ver_seperation, ['id'=>'ver_seperation', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('hor_seperation', 'HOR Separation:', ['class' => 'control-label']) !!}
                        {!! Form::text('hor_seperation', $data->hor_seperation, ['id'=>'hor_seperation', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">BIRD STRIKE</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('type_of_bird', 'Type Of Bird:', ['class' => 'control-label']) !!}
                        {!! Form::text('type_of_bird', $data->type_of_bird, ['id'=>'type_of_bird', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('nr_of_birds', 'NR OF Birds:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('nr_of_birds', 'seen', (@@$data['nr_of_birds'] == 'seen' ? 'checked': ''),array('disabled')) !!} SEEN
                        {!! Form::radio('nr_of_birds', 'impact', (@@$data['nr_of_birds'] == 'impact' ? 'checked': ''),array('disabled')) !!} IMPACT
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('size', 'Size:', ['class' => 'control-label']) !!}
                        {!! Form::text('size', $data->size, ['id'=>'size', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('areas_affected', 'Areas Affected:', ['class' => 'control-label']) !!}
                        {!! Form::text('areas_affected', $data->areas_affected, ['id'=>'areas_affected', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('advice_earlier', 'Advised Earlier:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('advice_earlier', 'yes', (@@$data['advice_earlier'] == 'yes' ? 'checked': ''),array('disabled')) !!} YES
                        {!! Form::radio('advice_earlier', 'no', (@@$data['advice_earlier'] == 'no' ? 'checked': ''),array('disabled')) !!} NO
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('lighting_conditions', 'Lighting Conditions:', ['class' => 'control-label']) !!}
                        {!! Form::text('lighting_conditions', $data->lighting_conditions, ['id'=>'lighting_conditions', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('conditions_of_the_sky', 'Condition Of The Sky:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('conditions_of_the_sky', 'clear', (@@$data['conditions_of_the_sky'] == 'clear' ? 'checked': ''),array('disabled')) !!} CLEAR
                        {!! Form::radio('conditions_of_the_sky', 'clouded', (@@$data['conditions_of_the_sky'] == 'clouded' ? 'checked': ''),array('disabled')) !!} CLOUDED
                        {!! Form::radio('conditions_of_the_sky', 'dark', (@@$data['conditions_of_the_sky'] == 'dark' ? 'checked': ''),array('disabled')) !!} DARK
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">TURBULANCE</b></h5>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('course_ac', 'Course of the AC:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('course_ac', 'none', (@@$data['course_ac'] == 'none' ? 'checked': ''),array('disabled')) !!} NONE
                        {!! Form::radio('course_ac', 'right', (@@$data['course_ac'] == 'right' ? 'checked': ''),array('disabled')) !!} RIGHT
                        {!! Form::radio('course_ac', 'left', (@@$data['course_ac'] == 'left' ? 'checked': ''),array('disabled')) !!} LEFT
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('glidslope_position', 'GLIDSLOPE POSITION:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('glidslope_position', 'hi', (@@$data['glidslope_position'] == 'hi' ? 'checked': ''),array('disabled')) !!} HI
                        {!! Form::radio('glidslope_position', 'low', (@@$data['glidslope_position'] == 'low' ? 'checked': ''),array('disabled')) !!} LOW
                        {!! Form::radio('glidslope_position', 'on', (@@$data['glidslope_position'] == 'on' ? 'checked': ''),array('disabled')) !!} ON
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('pos_extended_center', 'POS. ON EXTENDED CENTR.LINE:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('pos_extended_center', 'left', (@@$data['pos_extended_center'] == 'left' ? 'checked': ''),array('disabled')) !!} LEFT
                        {!! Form::radio('pos_extended_center', 'right', (@@$data['pos_extended_center'] == 'right' ? 'checked': ''),array('disabled')) !!} RIGHT
                        {!! Form::radio('pos_extended_center', 'on', (@@$data['pos_extended_center'] == 'on' ? 'checked': ''),array('disabled')) !!} ON
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('change_in_pitch', 'CHANGE IN PITCH (deg):', ['class' => 'control-label']) !!}
                        {!! Form::text('change_in_pitch', $data->change_in_pitch, ['id'=>'change_in_pitch', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('speed_buffet', 'SPEED BUFFET?:', ['class' => 'control-label']) !!}
                        {!! Form::text('speed_buffet', $data->speed_buffet, ['id'=>'speed_buffet', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('stickshaker', 'STICKSHAKER?:', ['class' => 'control-label']) !!}
                        {!! Form::text('stickshaker', $data->stickshaker, ['id'=>'stickshaker', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('suspected_wake_turbulance', 'SUSPECTED WAKE TURBULANCE:', ['class' => 'control-label']) !!}
                        {!! Form::text('suspected_wake_turbulance', $data->suspected_wake_turbulance, ['id'=>'suspected_wake_turbulance', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('sign_verticle_accelaration', 'SIGN. VERTICAL ACCELARATION:', ['class' => 'control-label']) !!}
                        {!! Form::text('sign_verticle_accelaration', $data->sign_verticle_accelaration, ['id'=>'sign_verticle_accelaration', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('details_ac_wake_turbulance', 'DETAILS OF AC WAKE TURBULANCE??:', ['class' => 'control-label']) !!}
                        {!! Form::text('details_ac_wake_turbulance', $data->details_ac_wake_turbulance, ['id'=>'details_ac_wake_turbulance', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('advice_other_aircraft', 'ADVISE TO OTHER AIRCRAFT:', ['class' => 'control-label']) !!}
                        {!! Form::text('advice_other_aircraft', $data->advice_other_aircraft, ['id'=>'advice_other_aircraft', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                </div>

                <div style="background-color: yellow">
                    <h5 class="text-center text-black"><b style="color: black">HUMAN FACTORS</b></h5>
                </div>


                <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('persion_involved', 'Person Involved:', ['class' => 'control-label']) !!}
                        {!! Form::text('persion_involved', $data->persion_involved, ['id'=>'persion_involved', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('function_position', 'Function/Position:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('function_position', 'crew', (@@$data['function_position'] == 'crew' ? 'checked': ''),array('disabled')) !!} CREW
                        {!! Form::radio('function_position', 'ground', (@@$data['function_position'] == 'ground' ? 'checked': ''),array('disabled')) !!} GROUND
                        {!! Form::radio('function_position', 'other', (@@$data['function_position'] == 'other' ? 'checked': ''),array('disabled')) !!} OTHER
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('type_of_influence', 'TYPE OF INFLUENCE:', ['class' => 'control-label']) !!}
                        <br>
                        {!! Form::radio('type_of_influence', 'crew_actions', (@@$data['type_of_influence'] == 'crew_actions' ? 'checked': ''),array('disabled')) !!} CREW ACTIONS
                        {!! Form::radio('type_of_influence', 'external', (@@$data['type_of_influence'] == 'external' ? 'checked': ''),array('disabled')) !!} EXTERNAL
                        {!! Form::radio('type_of_influence', 'organizations', (@@$data['type_of_influence'] == 'organizations' ? 'checked': ''),array('disabled')) !!} ORGANIZATIONA
                        {!! Form::radio('type_of_influence', 'personal', (@@$data['type_of_influence'] == 'personal' ? 'checked': ''),array('disabled')) !!} PERSONAL
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('comments', 'COMMENTS:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('comments', @$data[0]['comments'], ['size' => '6x2', 'class' => 'form-control','readonly']) !!}
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

    <div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">


            </div>
        </div>
    </div>
    <!-- modal -->



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