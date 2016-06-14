@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')

    <script src="assets/bitd/js/jquery.min.js"></script>

    <div class="panel">
        <div style="background-color: #0490a6" class="title-div">
            <h3 class="text-center text-green"><b style="color: #f5f5f5">Air Safety report</b></h3>
        </div>

        <div style="padding-right: 15px" class="buttons-div">
            <a href="{{ route('airsafety-pdf', $data->id) }}" class="btn btn-primary margin-bot-5"><strong>Export PDF</strong></a>
        </div>

        <div style="height: 25px"></div>

        <div class="panel-body">
            <table class="table table-bordered table-responsive report" width="100%">
                <tr>
                    <th width="100%" colspan="2" rowspan="2" style="border: 2px solid; text-align:center;"><img src="{{ URL::to('/') }}/assets/img/logo.png" alt="slm logo" style="width: 50%; padding-top: 30px;"></th>
                    <th width="100%" colspan="2" rowspan="2" style="border: 2px solid; text-align:right;">
                        <p style="font-weight: bolder; font-size:40px;" align="center">(OSR)</p>
                        <p style="font-weight: bolder; font-size:20px;" align="center">Operational Safety Report</p>
                    </th>
                    <th width="100%" colspan="2" style="border: 2px solid; text-align:right;"> Safety Department ref. nr : {{ $data->reference_no }}</th>
                </tr>
                <tr>
                    <th width="100%" colspan="2" style="border: 2px solid #6a6c6f; text-align: center; color:red; font-size: 35px; font-weight: bold">AIR SAFETY <br> REPORT</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">GENERAL INFORMATION</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : {{ isset($data->full_name)?ucfirst($data->full_name):''}},{{ isset($data->email)?ucfirst($data->email):''}},{{ isset($data->telephone)?ucfirst($data->telephone):''}},{{ isset($data->extension)?ucfirst($data->extension):''}},{{ isset($data->fax)?ucfirst($data->fax):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="32%" style="border: 2px solid" colspan="2">
                        2. CAPTAIN : {{ isset($data->captain)?ucfirst($data->captain):''}}&nbsp;&nbsp;
                        {!! Form::radio('pf_pnf', 'pf', (@$data->pf_pnf == 'pf' ? 'checked': '')) !!} PF
                        {!! Form::radio('pf_pnf', 'pnf', (@$data->pf_pnf == 'pnf' ? 'checked': '')) !!} PNF
                    </th>
                    <th width="32%" style="border: 2px solid" colspan="2">
                        3. CO-PILOT : {{ isset($data->co_pilot)?ucfirst($data->co_pilot):'' }}
                        {!! Form::radio('pf_pnf2', 'pf', (@$data->pf_pnf2 == 'pf' ? 'checked': '')) !!} PF
                        {!! Form::radio('pf_pnf2', 'pnf', (@$data->pf_pnf2 == 'pnf' ? 'checked': '')) !!} PNF
                    </th>
                    <th width="36%" style="border: 2px solid" colspan="2">4. OTHER : {{ isset($data->others)?ucfirst($data->others):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">5. DATE : {{ isset($data->date)?ucfirst($data->date):''}}</th>
                    <th width="32%" style="border: 2px solid" colspan="2">
                        6. TIME : {{ isset($data->time)?ucfirst($data->time):''}}&nbsp;&nbsp;
                        {!! Form::radio('utc_local', 'utc', (@$data->utc_local == 'utc' ? 'checked': '')) !!} UTC
                        {!! Form::radio('utc_local', 'local', (@$data->utc_local == 'local' ? 'checked': '')) !!} Local
                    </th>
                    <th width="16%" style="border: 2px solid">7. AIRCRAFT TYPE : {{ isset($data->air_craft_time)?ucfirst($data->air_craft_time):'' }}</th>
                    <th width="36%" style="border: 2px solid" colspan="2">8. REGISTRATION : {{ isset($data->registration)?ucfirst($data->registration):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">9. FLIGHT NUMBER : {{ isset($data->flight_no)?ucfirst($data->flight_no):''}}</th>
                    <th width="32%" style="border: 2px solid" colspan="2">10. FROM : {{ isset($data->from)?ucfirst($data->from):'' }}</th>
                    <th width="16%" style="border: 2px solid">11. TO : {{ isset($data->to)?ucfirst($data->to):''}}</th>
                    <th width="36%" style="border: 2px solid" colspan="2">12. POSITION (geogr. Co-ord) : {{ isset($data->position)?ucfirst($data->position):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">13. ALTITUDE : {{ isset($data->altitude)?ucfirst($data->altitude):'' }}</th>
                    <th width="32%" style="border: 2px solid" colspan="2">14. SPEED/MACH : {{ isset($data->speed)?ucfirst($data->speed):''}}</th>
                    <th width="16%" style="border: 2px solid">15. ACTUAL WEIGHT : {{ isset($data->actual_weight)?ucfirst($data->actual_weight):''}}</th>
                    <th width="36%" style="border: 2px solid" colspan="2">16. REMAINING FUEL : {{ isset($data->remaining_fuel)?ucfirst($data->remaining_fuel):'' }}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">17. ATL REF. : {{ isset($data->atl_ref)?ucfirst($data->atl_ref):''}}</th>
                    <th width="32%" style="border: 2px solid">18. DELAY (min) : {{ isset($data->delay)?ucfirst($data->delay):''}}</th>
                    <th width="16%" style="border: 2px solid">19. DIVERSION : {{ isset($data->diversion)?ucfirst($data->diversion):'' }}</th>
                    <th width="16%" style="border: 2px solid">20. NR CREW : {{ isset($data->nr_crew)?ucfirst($data->nr_crew):''}}</th>
                    <th width="36%" style="border: 2px solid" colspan="2">21. NR. PAX : {{ isset($data->nr_pax)?ucfirst($data->nr_pax):''}}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        22. FLIGHT PHASE :
                        <br>
                        {!! Form::radio('flight_phase', 'parked', (@$data->flight_phase == 'parked' ? 'checked': '')) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'push_back', (@$data->flight_phase == 'push_back' ? 'checked': '')) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'taxi_out', (@$data->flight_phase == 'taxi_out' ? 'checked': '')) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'take_off', (@$data->flight_phase == 'take_off' ? 'checked': '')) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'initial_climb', (@$data->flight_phase == 'initial_climb' ? 'checked': '')) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'climb', (@$data->flight_phase == 'climb' ? 'checked': '')) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                        {!! Form::radio('flight_phase', 'cruise', (@$data->flight_phase == 'cruise' ? 'checked': '')) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'holding', (@$data->flight_phase == 'holding' ? 'checked': '')) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'descent', (@$data->flight_phase == 'descent' ? 'checked': '')) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'approach', (@$data->flight_phase == 'approach' ? 'checked': '')) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'landing', (@$data->flight_phase == 'landing' ? 'checked': '')) !!} LANDING&nbsp;&nbsp;
                        {!! Form::radio('flight_phase', 'taxi_in', (@$data->flight_phase == 'taxi_in' ? 'checked': '')) !!} TAXI IN
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        23. DESCRIPTION OF OCCURRENCE ( add forms if necessary) :
                        <p>{{ isset($data->description_of_occurence)?ucfirst($data->description_of_occurence):''}}</p>
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">METEOROLOGICAL INFORMATION</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">24. IMC/VMC : {{ isset($data->imc_vmc)?ucfirst($data->imc_vmc):''}}</th>
                    <th width="32%" style="border: 2px solid" colspan="2">25. VCM (km) : {{ isset($data->vmc_km)?ucfirst($data->vmc_km):'' }}</th>
                    <th width="16%" style="border: 2px solid">26. WIND DIRECTION (deg) : {{ isset($data->wind_direction)?ucfirst($data->wind_direction):''}}</th>
                    <th width="36%" style="border: 2px solid" colspan="2">
                        27. WIND SPEED : {{ isset($data->wind_speed)?ucfirst($data->wind_speed):''}}
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">28. VISIBILITY : {{ isset($data->visibility)?ucfirst($data->visibility):'' }}</th>
                    <th width="32%" style="border: 2px solid">29. CEILING : {{ isset($data->ceiling)?ucfirst($data->ceiling):''}}</th>
                    <th width="16%" style="border: 2px solid">30. CLOUDS : {{ isset($data->clouds)?ucfirst($data->clouds):''}}</th>
                    <th width="16%" style="border: 2px solid">31. TEMPERATURE : {{ isset($data->temperature)?ucfirst($data->temperature):'' }}</th>
                    <th width="36%" style="border: 2px solid" colspan="2">32. QNH : {{ isset($data->qnh)?ucfirst($data->qnh):''}}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        33. WEATHER CONDITION :
                        <br>
                        {!! Form::radio('weather_condition', 'soft', (@$data->weather_condition == 'soft' ? 'checked': '')) !!} SOFT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'moderate', (@$data->weather_condition == 'moderate' ? 'checked': '')) !!} MODERATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'severe', (@$data->weather_condition == 'severe' ? 'checked': '')) !!} SEVERE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'turbulence', (@$data->weather_condition == 'turbulence' ? 'checked': '')) !!} TURBULENCE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'wind_shear', (@$data->weather_condition == 'wind_shear' ? 'checked': '')) !!} WIND-SHEAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'rain', (@$data->weather_condition == 'rain' ? 'checked': '')) !!} RAIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                        {!! Form::radio('weather_condition', 'hail', (@$data->weather_condition == 'hail' ? 'checked': '')) !!} HAIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'mist', (@$data->weather_condition == 'mist' ? 'checked': '')) !!} MIST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'fog', (@$data->weather_condition == 'fog' ? 'checked': '')) !!} FOG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('weather_condition', 'snow', (@$data->weather_condition == 'snow' ? 'checked': '')) !!} SNOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">34. RUNWAY : {{ isset($data->runway)?ucfirst($data->runway):'' }}</th>
                    <th width="48%" style="border: 2px solid" colspan="4">35. RUNWAY CONDITION : {{ isset($data->runway_condition)?ucfirst($data->runway_condition):''}}</th>
                    <th width="20%" style="border: 2px solid">36. RVR (M) : {{ isset($data->rvr)?ucfirst($data->rvr):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">37. AUTO PILOT : {{ isset($data->auto_pilot)?ucfirst($data->auto_pilot):''}}</th>
                    <th width="32%" style="border: 2px solid">38. AUTO THRUST : {{ isset($data->auto_thrust)?ucfirst($data->auto_thrust):'' }}</th>
                    <th width="16%" style="border: 2px solid">
                        39. GEAR :
                        {!! Form::radio('gear', 'up', (@$data->gear == 'up' ? 'checked': '')) !!} UP
                        {!! Form::radio('gear', 'down', (@$data->gear == 'down' ? 'checked': '')) !!} DOWN
                    </th>
                    <th width="16%" style="border: 2px solid">40. FLAP : {{ isset($data->flap)?ucfirst($data->flap):''}}</th>
                    <th width="36%" style="border: 2px solid">41. SLAT : {{ isset($data->slat)?ucfirst($data->slat):'' }}</th>
                    <th width="36%" style="border: 2px solid">42. SPOILERS : {{ isset($data->spoilers)?ucfirst($data->spoilers):''}}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">TCAS INFORMATION (traffic)</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        43. TYPE OF ALERT :
                        {!! Form::radio('type_of_alert', 'none', (@$data->type_of_alert == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('type_of_alert', 'ra', (@$data->type_of_alert == 'ra' ? 'checked': '')) !!} RA
                        {!! Form::radio('type_of_alert', 'ta', (@$data->type_of_alert == 'ta' ? 'checked': '')) !!} TA
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">44. TYPE OF RA : {{ isset($data->type_of_ra)?ucfirst($data->type_of_ra):''}}</th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        45. RA FOLLOWED? :
                        {!! Form::radio('ra_followed', 'yes', (@$data->ra_followed == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('ra_followed', 'no', (@$data->ra_followed == 'no' ? 'checked': '')) !!} NO
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">ATC PROCEDURES</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        46. LEVEL OF RISK :
                        {!! Form::radio('level_of_risk', 'none', (@$data->level_of_risk == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('level_of_risk', 'low', (@$data->level_of_risk == 'low' ? 'checked': '')) !!} LOW
                        {!! Form::radio('level_of_risk', 'medium', (@$data->level_of_risk == 'medium' ? 'checked': '')) !!} MEDIUM
                        {!! Form::radio('level_of_risk', 'high', (@$data->level_of_risk == 'high' ? 'checked': '')) !!} HIGH
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">
                        47. EVASIVE ACTIONS :
                        {!! Form::radio('evasive_actions', 'yes', (@$data->evasive_actions == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('evasive_actions', 'no', (@$data->evasive_actions == 'no' ? 'checked': '')) !!} NO
                    </th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        48. REPORTED TO ATC? :
                        {!! Form::radio('reported_to_atc', 'yes', (@$data->reported_to_atc == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('reported_to_atc', 'no', (@$data->reported_to_atc == 'no' ? 'checked': '')) !!} NO
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        49. ATC INSTUCTIONS :
                        {!! Form::radio('atc_instruction', 'none', (@$data->atc_instruction == 'none' ? 'checked': '')) !!} None
                        {!! Form::radio('atc_instruction', 'climb', (@$data->atc_instruction == 'climb' ? 'checked': '')) !!} CLIMB
                        {!! Form::radio('atc_instruction', 'descent', (@$data->atc_instruction == 'descent' ? 'checked': '')) !!} DESCENT
                        {!! Form::radio('atc_instruction', 'turn_left', (@$data->atc_instruction == 'turn_left' ? 'checked': '')) !!} TURN LEFT
                        {!! Form::radio('atc_instruction', 'turn_right', (@$data->atc_instruction == 'turn_right' ? 'checked': '')) !!} TURN RIGHT
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">
                        50. USED FREQUENCY :
                        {{ isset($data->used_frequency)?ucfirst($data->used_frequency):''}}
                    </th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        51. HEADING :
                        {{ isset($data->heading)?ucfirst($data->heading):''}}
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        52. HEADING OF THE OTHER AC :
                        {{ isset($data->heading_other_ac)?ucfirst($data->heading_other_ac):'' }}
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">AIRPROX</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="3">
                        53. VER. SEPARATION :
                        {{ isset($data->ver_seperation)?ucfirst($data->ver_seperation):''}}
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="3">
                        54. HOR. SEPARATION :
                        {{ isset($data->hor_seperation)?ucfirst($data->hor_seperation):'' }}
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">BIRD STRIKE</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        55. TYPE OF BIRD :
                        {{ isset($data->type_of_bird)?ucfirst($data->type_of_bird):''}}
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        56. nr of BIRDS :
                        {!! Form::radio('nr_of_birds', 'seen', (@$data->nr_of_birds == 'seen' ? 'checked': '')) !!} SEEN
                        {!! Form::radio('nr_of_birds', 'impact', (@$data->nr_of_birds == 'impact' ? 'checked': '')) !!} IMPACT
                    </th>
                    <th width="52%" style="border: 2px solid">
                        57. SIZE :
                        {{ isset($data->size)?ucfirst($data->size):''}}
                    </th>
                    <th width="52%" style="border: 2px solid">
                        58. AREAS AFFECTED :
                        {{ isset($data->areas_affected)?ucfirst($data->areas_affected):''}}
                    </th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        59. ADVISED EARLIER? :
                        {!! Form::radio('advice_earlier', 'yes', (@$data->advice_earlier == 'yes' ? 'checked': '')) !!} YES
                        {!! Form::radio('advice_earlier', 'no', (@$data->advice_earlier == 'no' ? 'checked': '')) !!} NO
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        60. LIGHTING CONDITIONS :
                        {{ isset($data->lighting_conditions)?ucfirst($data->lighting_conditions):''}}
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        61. CODITION OF THE SKY :
                        {!! Form::radio('conditions_of_the_sky', 'clear', (@$data->conditions_of_the_sky == 'clear' ? 'checked': '')) !!} CLEAR
                        {!! Form::radio('conditions_of_the_sky', 'clouded', (@$data->conditions_of_the_sky == 'clouded' ? 'checked': '')) !!} CLOUDED
                        {!! Form::radio('conditions_of_the_sky', 'dark', (@$data->conditions_of_the_sky == 'dark' ? 'checked': '')) !!} DARK
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">BIRD STRIKE</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        62. Course of the AC :
                        {!! Form::radio('course_ac', 'none', (@$data->course_ac == 'none' ? 'checked': '')) !!} NONE
                        {!! Form::radio('course_ac', 'right', (@$data->course_ac == 'right' ? 'checked': '')) !!} RIGHT
                        {!! Form::radio('course_ac', 'left', (@$data->course_ac == 'left' ? 'checked': '')) !!} LEFT
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        63. GLIDSLOPE POSITION :
                        {!! Form::radio('glidslope_position', 'hi', (@$data->glidslope_position == 'hi' ? 'checked': '')) !!} HI
                        {!! Form::radio('glidslope_position', 'low', (@$data->glidslope_position == 'low' ? 'checked': '')) !!} LOW
                        {!! Form::radio('glidslope_position', 'on', (@$data->glidslope_position == 'on' ? 'checked': '')) !!} ON
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        64. POS. ON EXTENDED CENTR. LINE. :
                        {!! Form::radio('pos_extended_center', 'left', (@$data->pos_extended_center == 'left' ? 'checked': '')) !!} LEFT
                        {!! Form::radio('pos_extended_center', 'right', (@$data->pos_extended_center == 'right' ? 'checked': '')) !!} RIGHT
                        {!! Form::radio('pos_extended_center', 'on', (@$data->pos_extended_center == 'on' ? 'checked': '')) !!} ON
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        65. CHANGE IN PITCH (deg) :{{ isset($data->change_in_pitch)?ucfirst($data->change_in_pitch):'' }}</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        66. CHANGE IN ROLL (deg) :{{ isset($data->change_in_roll)?ucfirst($data->change_in_roll):'' }}</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        67. CHANGE IN YAW (deg) :{{ isset($data->change_in_yaw)?ucfirst($data->change_in_yaw):'' }}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        68. CHANGE IN ALT. :{{ isset($data->change_in_alt)?ucfirst($data->change_in_alt):'' }}</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        69. SPEED BUFFET? :{{ isset($data->speed_buffet)?ucfirst($data->speed_buffet):''}}</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        70. STICKSHAKER? :{{ isset($data->stickshaker)?ucfirst($data->stickshaker):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="3">
                        71. SUSPECTED WAKE TURBULANCE :{{ isset($data->suspected_wake_turbulance)?ucfirst($data->suspected_wake_turbulance):'' }}</th>
                    <th width="52%" style="border: 2px solid" colspan="3">
                        72. SIGN. VERTICAL ACCELARATION :{{ isset($data->sign_verticle_accelaration)?ucfirst($data->sign_verticle_accelaration):''}}</th>

                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        73. DETAILS OF AC WAKE TURBULANCE? :{{ isset($data->details_ac_wake_turbulance)?ucfirst($data->details_ac_wake_turbulance):''}}</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        74. ADVISE TO OTHER AIRCRAFT :{{ isset($data->advice_other_aircraft)?ucfirst($data->advice_other_aircraft):'' }}</th>

                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">HUMAN FACTORS</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        75. PERSON INVOLVED (name) [ optional field] :{{ isset($data->persion_involved)?ucfirst($data->persion_involved):''}}</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        76. FUNCTION/POSITION :{{ isset($data->function_position)?ucfirst($data->function_position):''}}</th>

                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="6">
                        77. TYPE OF INFLUENCE :{{ isset($data->type_of_influence)?ucfirst($data->type_of_influence):'' }}</th>

                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="6">
                        78. COMMENTS :{{ isset($data->comments)?ucfirst($data->comments):''}}</th>

                </tr>

            </table>




            <div class="col-sm-12 text-center">
                <a href="{{route('air-safety')}}" class="btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
            </div>

        </div>

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