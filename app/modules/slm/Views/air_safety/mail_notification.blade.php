<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
        }

        table, tr, th {
            text-align: left;
        }
        
    </style>
</head>
<body>

<div style="background-color: #0490a6">
    <h4><b style="color: #f5f5f5">Safety Information</b></h4>
</div>

<table width="100%">
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">GENERAL INFORMATION</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="6">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : {{ isset($model->full_name)?ucfirst($model->full_name):''}},{{ isset($model->email)?ucfirst($model->email):''}},{{ isset($model->telephone)?ucfirst($model->telephone):''}},{{ isset($model->extension)?ucfirst($model->extension):''}},{{ isset($model->fax)?ucfirst($model->fax):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="32%" style="border: 2px solid" colspan="2">
            2. CAPTAIN : {{ isset($model->captain)?ucfirst($model->captain):''}}&nbsp;&nbsp;
            {!! Form::radio('pf_pnf', 'pf', (@$model->pf_pnf == 'pf' ? 'checked': '')) !!} PF
            {!! Form::radio('pf_pnf', 'pnf', (@$model->pf_pnf == 'pnf' ? 'checked': '')) !!} PNF
        </th>
        <th width="32%" style="border: 2px solid" colspan="2">
            3. CO-PILOT : {{ isset($model->co_pilot)?ucfirst($model->co_pilot):'' }}
            {!! Form::radio('pf_pnf2', 'pf', (@$model->pf_pnf2 == 'pf' ? 'checked': '')) !!} PF
            {!! Form::radio('pf_pnf2', 'pnf', (@$model->pf_pnf2 == 'pnf' ? 'checked': '')) !!} PNF
        </th>
        <th width="36%" style="border: 2px solid" colspan="2">4. OTHER : {{ isset($model->others)?ucfirst($model->others):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">5. DATE : {{ isset($model->date)?ucfirst($model->date):''}}</th>
        <th width="32%" style="border: 2px solid" colspan="2">
            6. TIME : {{ isset($model->time)?ucfirst($model->time):''}}&nbsp;&nbsp;
            {!! Form::radio('utc_local', 'utc', (@$model->utc_local == 'utc' ? 'checked': '')) !!} UTC
            {!! Form::radio('utc_local', 'local', (@$model->utc_local == 'local' ? 'checked': '')) !!} Local
        </th>
        <th width="16%" style="border: 2px solid">7. AIRCRAFT TYPE : {{ isset($model->air_craft_time)?ucfirst($model->air_craft_time):'' }}</th>
        <th width="36%" style="border: 2px solid" colspan="2">8. REGISTRATION : {{ isset($model->registration)?ucfirst($model->registration):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">9. FLIGHT NUMBER : {{ isset($model->flight_no)?ucfirst($model->flight_no):''}}</th>
        <th width="32%" style="border: 2px solid" colspan="2">10. FROM : {{ isset($model->from)?ucfirst($model->from):'' }}</th>
        <th width="16%" style="border: 2px solid">11. TO : {{ isset($model->to)?ucfirst($model->to):''}}</th>
        <th width="36%" style="border: 2px solid" colspan="2">12. POSITION (geogr. Co-ord) : {{ isset($model->position)?ucfirst($model->position):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">13. ALTITUDE : {{ isset($model->altitude)?ucfirst($model->altitude):'' }}</th>
        <th width="32%" style="border: 2px solid" colspan="2">14. SPEED/MACH : {{ isset($model->speed)?ucfirst($model->speed):''}}</th>
        <th width="16%" style="border: 2px solid">15. ACTUAL WEIGHT : {{ isset($model->actual_weight)?ucfirst($model->actual_weight):''}}</th>
        <th width="36%" style="border: 2px solid" colspan="2">16. REMAINING FUEL : {{ isset($model->remaining_fuel)?ucfirst($model->remaining_fuel):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">17. ATL REF. : {{ isset($model->atl_ref)?ucfirst($model->atl_ref):''}}</th>
        <th width="32%" style="border: 2px solid">18. DELAY (min) : {{ isset($model->delay)?ucfirst($model->delay):''}}</th>
        <th width="16%" style="border: 2px solid">19. DIVERSION : {{ isset($model->diversion)?ucfirst($model->diversion):'' }}</th>
        <th width="16%" style="border: 2px solid">20. NR CREW : {{ isset($model->nr_crew)?ucfirst($model->nr_crew):''}}</th>
        <th width="36%" style="border: 2px solid" colspan="2">21. NR. PAX : {{ isset($model->nr_pax)?ucfirst($model->nr_pax):''}}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="6">
            22. FLIGHT PHASE :
            <br>
            {!! Form::radio('flight_phase', 'parked', (@$model->flight_phase == 'parked' ? 'checked': '')) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'push_back', (@$model->flight_phase == 'push_back' ? 'checked': '')) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'taxi_out', (@$model->flight_phase == 'taxi_out' ? 'checked': '')) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'take_off', (@$model->flight_phase == 'take_off' ? 'checked': '')) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'initial_climb', (@$model->flight_phase == 'initial_climb' ? 'checked': '')) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'climb', (@$model->flight_phase == 'climb' ? 'checked': '')) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
            <br>
            {!! Form::radio('flight_phase', 'cruise', (@$model->flight_phase == 'cruise' ? 'checked': '')) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'holding', (@$model->flight_phase == 'holding' ? 'checked': '')) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'descent', (@$model->flight_phase == 'descent' ? 'checked': '')) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'approach', (@$model->flight_phase == 'approach' ? 'checked': '')) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'landing', (@$model->flight_phase == 'landing' ? 'checked': '')) !!} LANDING&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'taxi_in', (@$model->flight_phase == 'taxi_in' ? 'checked': '')) !!} TAXI IN
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="6">
            23. DESCRIPTION OF OCCURRENCE ( add forms if necessary) :
            <p>{{ isset($model->description_of_occurence)?ucfirst($model->description_of_occurence):''}}</p>
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">METEOROLOGICAL INFORMATION</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">24. IMC/VMC : {{ isset($model->imc_vmc)?ucfirst($model->imc_vmc):''}}</th>
        <th width="32%" style="border: 2px solid" colspan="2">25. VCM (km) : {{ isset($model->vmc_km)?ucfirst($model->vmc_km):'' }}</th>
        <th width="16%" style="border: 2px solid">26. WIND DIRECTION (deg) : {{ isset($model->wind_direction)?ucfirst($model->wind_direction):''}}</th>
        <th width="36%" style="border: 2px solid" colspan="2">
            27. WIND SPEED : {{ isset($model->wind_speed)?ucfirst($model->wind_speed):''}}
        </th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">28. VISIBILITY : {{ isset($model->visibility)?ucfirst($model->visibility):'' }}</th>
        <th width="32%" style="border: 2px solid">29. CEILING : {{ isset($model->ceiling)?ucfirst($model->ceiling):''}}</th>
        <th width="16%" style="border: 2px solid">30. CLOUDS : {{ isset($model->clouds)?ucfirst($model->clouds):''}}</th>
        <th width="16%" style="border: 2px solid">31. TEMPERATURE : {{ isset($model->temperature)?ucfirst($model->temperature):'' }}</th>
        <th width="36%" style="border: 2px solid" colspan="2">32. QNH : {{ isset($model->qnh)?ucfirst($model->qnh):''}}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="6">
            33. WEATHER CONDITION :
            <br>
            {!! Form::radio('weather_condition', 'soft', (@$model->weather_condition == 'soft' ? 'checked': '')) !!} SOFT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'moderate', (@$model->weather_condition == 'moderate' ? 'checked': '')) !!} MODERATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'severe', (@$model->weather_condition == 'severe' ? 'checked': '')) !!} SEVERE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'turbulence', (@$model->weather_condition == 'turbulence' ? 'checked': '')) !!} TURBULENCE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'wind_shear', (@$model->weather_condition == 'wind_shear' ? 'checked': '')) !!} WIND-SHEAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'rain', (@$model->weather_condition == 'rain' ? 'checked': '')) !!} RAIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <br>
            {!! Form::radio('weather_condition', 'hail', (@$model->weather_condition == 'hail' ? 'checked': '')) !!} HAIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'mist', (@$model->weather_condition == 'mist' ? 'checked': '')) !!} MIST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'fog', (@$model->weather_condition == 'fog' ? 'checked': '')) !!} FOG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('weather_condition', 'snow', (@$model->weather_condition == 'snow' ? 'checked': '')) !!} SNOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        </th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">34. RUNWAY : {{ isset($model->runway)?ucfirst($model->runway):'' }}</th>
        <th width="48%" style="border: 2px solid" colspan="4">35. RUNWAY CONDITION : {{ isset($model->ceiling)?ucfirst($model->ceiling):''}}</th>
        <th width="20%" style="border: 2px solid">36. RVR (M) : {{ isset($model->rvr)?ucfirst($model->rvr):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid">37. AUTO PILOT : {{ isset($model->auto_pilot)?ucfirst($model->auto_pilot):''}}</th>
        <th width="32%" style="border: 2px solid">38. AUTO THRUST : {{ isset($model->auto_thrust)?ucfirst($model->auto_thrust):'' }}</th>
        <th width="16%" style="border: 2px solid">
            39. GEAR :
            {!! Form::radio('gear', 'up', (@$model->gear == 'up' ? 'checked': '')) !!} UP
            {!! Form::radio('gear', 'down', (@$model->gear == 'down' ? 'checked': '')) !!} DOWN
        </th>
        <th width="16%" style="border: 2px solid">40. FLAP : {{ isset($model->flap)?ucfirst($model->flap):''}}</th>
        <th width="36%" style="border: 2px solid">41. SLAT : {{ isset($model->slat)?ucfirst($model->slat):'' }}</th>
        <th width="36%" style="border: 2px solid">42. SPOILERS : {{ isset($model->spoilers)?ucfirst($model->spoilers):''}}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">TCAS INFORMATION (traffic)</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid" colspan="2">
            43. TYPE OF ALERT :
            {!! Form::radio('type_of_alert', 'none', (@$model->type_of_alert == 'none' ? 'checked': '')) !!} None
            {!! Form::radio('type_of_alert', 'ra', (@$model->type_of_alert == 'ra' ? 'checked': '')) !!} RA
            {!! Form::radio('type_of_alert', 'ta', (@$model->type_of_alert == 'ta' ? 'checked': '')) !!} TA
        </th>
        <th width="48%" style="border: 2px solid" colspan="2">44. TYPE OF RA : {{ isset($model->type_of_ra)?ucfirst($model->type_of_ra):''}}</th>
        <th width="20%" style="border: 2px solid" colspan="2">
            45. RA FOLLOWED? :
            {!! Form::radio('ra_followed', 'yes', (@$model->ra_followed == 'yes' ? 'checked': '')) !!} YES
            {!! Form::radio('ra_followed', 'no', (@$model->ra_followed == 'no' ? 'checked': '')) !!} NO
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">ATC PROCEDURES</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid" colspan="2">
            46. LEVEL OF RISK :
            {!! Form::radio('level_of_risk', 'none', (@$model->level_of_risk == 'none' ? 'checked': '')) !!} None
            {!! Form::radio('level_of_risk', 'low', (@$model->level_of_risk == 'low' ? 'checked': '')) !!} LOW
            {!! Form::radio('level_of_risk', 'medium', (@$model->level_of_risk == 'medium' ? 'checked': '')) !!} MEDIUM
            {!! Form::radio('level_of_risk', 'high', (@$model->level_of_risk == 'high' ? 'checked': '')) !!} HIGH
        </th>
        <th width="48%" style="border: 2px solid" colspan="2">
            47. EVASIVE ACTIONS :
            {!! Form::radio('evasive_actions', 'yes', (@$model->evasive_actions == 'yes' ? 'checked': '')) !!} YES
            {!! Form::radio('evasive_actions', 'no', (@$model->evasive_actions == 'no' ? 'checked': '')) !!} NO
        </th>
        <th width="20%" style="border: 2px solid" colspan="2">
            48. REPORTED TO ATC? :
            {!! Form::radio('reported_to_atc', 'yes', (@$model->reported_to_atc == 'yes' ? 'checked': '')) !!} YES
            {!! Form::radio('reported_to_atc', 'no', (@$model->reported_to_atc == 'no' ? 'checked': '')) !!} NO
        </th>
    </tr>
    <tr style="border: 2px solid">
        <th width="16%" style="border: 2px solid" colspan="2">
            49. ATC INSTUCTIONS :
            {!! Form::radio('atc_instruction', 'none', (@$model->atc_instruction == 'none' ? 'checked': '')) !!} None
            {!! Form::radio('atc_instruction', 'climb', (@$model->atc_instruction == 'climb' ? 'checked': '')) !!} CLIMB
            {!! Form::radio('atc_instruction', 'descent', (@$model->atc_instruction == 'descent' ? 'checked': '')) !!} DESCENT
            {!! Form::radio('atc_instruction', 'turn_left', (@$model->atc_instruction == 'turn_left' ? 'checked': '')) !!} TURN LEFT
            {!! Form::radio('atc_instruction', 'turn_right', (@$model->atc_instruction == 'turn_right' ? 'checked': '')) !!} TURN RIGHT
        </th>
        <th width="48%" style="border: 2px solid" colspan="2">
            50. USED FREQUENCY :
            {{ isset($model->used_frequency)?ucfirst($model->used_frequency):''}}
        </th>
        <th width="20%" style="border: 2px solid" colspan="2">
            51. HEADING :
            {{ isset($model->heading)?ucfirst($model->heading):''}}
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="6">
            52. HEADING OF THE OTHER AC :
            {{ isset($model->heading_other_ac)?ucfirst($model->heading_other_ac):'' }}
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">AIRPROX</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="3">
            53. VER. SEPARATION :
            {{ isset($model->ver_seperation)?ucfirst($model->ver_seperation):''}}
        </th>
        <th width="52%" style="border: 2px solid" colspan="3">
            54. HOR. SEPARATION :
            {{ isset($model->hor_seperation)?ucfirst($model->hor_seperation):'' }}
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">BIRD STRIKE</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="2">
            55. TYPE OF BIRD :
            {{ isset($model->type_of_bird)?ucfirst($model->type_of_bird):''}}
        </th>
        <th width="52%" style="border: 2px solid" colspan="2">
            56. nr of BIRDS :
            {!! Form::radio('nr_of_birds', 'seen', (@$model->nr_of_birds == 'seen' ? 'checked': '')) !!} SEEN
            {!! Form::radio('nr_of_birds', 'impact', (@$model->nr_of_birds == 'impact' ? 'checked': '')) !!} IMPACT
        </th>
        <th width="52%" style="border: 2px solid">
            57. SIZE :
            {{ isset($model->size)?ucfirst($model->size):''}}
        </th>
        <th width="52%" style="border: 2px solid">
            58. AREAS AFFECTED :
            {{ isset($model->areas_affected)?ucfirst($model->areas_affected):''}}
        </th>
    </tr>

    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="2">
            59. ADVISED EARLIER? :
            {!! Form::radio('advice_earlier', 'yes', (@$model->advice_earlier == 'yes' ? 'checked': '')) !!} YES
            {!! Form::radio('advice_earlier', 'no', (@$model->advice_earlier == 'no' ? 'checked': '')) !!} NO
        </th>
        <th width="52%" style="border: 2px solid" colspan="2">
            60. LIGHTING CONDITIONS :
            {{ isset($model->lighting_conditions)?ucfirst($model->lighting_conditions):''}}
        </th>
        <th width="52%" style="border: 2px solid" colspan="2">
            61. CODITION OF THE SKY :
            {!! Form::radio('conditions_of_the_sky', 'clear', (@$model->conditions_of_the_sky == 'clear' ? 'checked': '')) !!} CLEAR
            {!! Form::radio('conditions_of_the_sky', 'clouded', (@$model->conditions_of_the_sky == 'clouded' ? 'checked': '')) !!} CLOUDED
            {!! Form::radio('conditions_of_the_sky', 'dark', (@$model->conditions_of_the_sky == 'dark' ? 'checked': '')) !!} DARK
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">BIRD STRIKE</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="2">
            62. Course of the AC :
            {!! Form::radio('course_ac', 'none', (@$model->course_ac == 'none' ? 'checked': '')) !!} NONE
            {!! Form::radio('course_ac', 'right', (@$model->course_ac == 'right' ? 'checked': '')) !!} RIGHT
            {!! Form::radio('course_ac', 'left', (@$model->course_ac == 'left' ? 'checked': '')) !!} LEFT
        </th>
        <th width="52%" style="border: 2px solid" colspan="2">
            63. GLIDSLOPE POSITION :
            {!! Form::radio('glidslope_position', 'hi', (@$model->glidslope_position == 'hi' ? 'checked': '')) !!} HI
            {!! Form::radio('glidslope_position', 'low', (@$model->glidslope_position == 'low' ? 'checked': '')) !!} LOW
            {!! Form::radio('glidslope_position', 'on', (@$model->glidslope_position == 'on' ? 'checked': '')) !!} ON
        </th>
        <th width="52%" style="border: 2px solid" colspan="2">
            64. POS. ON EXTENDED CENTR. LINE. :
            {!! Form::radio('pos_extended_center', 'left', (@$model->pos_extended_center == 'left' ? 'checked': '')) !!} LEFT
            {!! Form::radio('pos_extended_center', 'right', (@$model->pos_extended_center == 'right' ? 'checked': '')) !!} RIGHT
            {!! Form::radio('pos_extended_center', 'on', (@$model->pos_extended_center == 'on' ? 'checked': '')) !!} ON
        </th>
    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="2">
            65. CHANGE IN PITCH (deg) :{{ isset($model->change_in_pitch)?ucfirst($model->change_in_pitch):'' }}</th>
        <th width="52%" style="border: 2px solid" colspan="2">
            66. CHANGE IN ROLL (deg) :{{ isset($model->change_in_roll)?ucfirst($model->change_in_roll):'' }}</th>
        <th width="52%" style="border: 2px solid" colspan="2">
            67. CHANGE IN YAW (deg) :{{ isset($model->change_in_yaw)?ucfirst($model->change_in_yaw):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="2">
            68. CHANGE IN ALT. :{{ isset($model->change_in_alt)?ucfirst($model->change_in_alt):'' }}</th>
        <th width="52%" style="border: 2px solid" colspan="2">
            69. SPEED BUFFET? :{{ isset($model->speed_buffet)?ucfirst($model->speed_buffet):''}}</th>
        <th width="52%" style="border: 2px solid" colspan="2">
            70. STICKSHAKER? :{{ isset($model->stickshaker)?ucfirst($model->stickshaker):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="3">
            71. SUSPECTED WAKE TURBULANCE :{{ isset($model->suspected_wake_turbulance)?ucfirst($model->suspected_wake_turbulance):'' }}</th>
        <th width="52%" style="border: 2px solid" colspan="3">
            72. SIGN. VERTICAL ACCELARATION :{{ isset($model->sign_verticle_accelaration)?ucfirst($model->sign_verticle_accelaration):''}}</th>

    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="2">
            73. DETAILS OF AC WAKE TURBULANCE? :{{ isset($model->details_ac_wake_turbulance)?ucfirst($model->details_ac_wake_turbulance):''}}</th>
        <th width="52%" style="border: 2px solid" colspan="2">
            74. ADVISE TO OTHER AIRCRAFT :{{ isset($model->advice_other_aircraft)?ucfirst($model->advice_other_aircraft):'' }}</th>

    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">HUMAN FACTORS</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="2">
            75. PERSON INVOLVED (name) [ optional field] :{{ isset($model->persion_involved)?ucfirst($model->persion_involved):''}}</th>
        <th width="52%" style="border: 2px solid" colspan="2">
            76. FUNCTION/POSITION :{{ isset($model->function_position)?ucfirst($model->function_position):''}}</th>

    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="6">
            77. TYPE OF INFLUENCE :{{ isset($model->type_of_influence)?ucfirst($model->type_of_influence):'' }}</th>

    </tr>
    <tr style="border: 2px solid">
        <th width="48%" style="border: 2px solid" colspan="6">
            78. COMMENTS :{{ isset($model->comments)?ucfirst($model->comments):''}}</th>

    </tr>

</table>


{{--<table border="0">
    <tr>
        <th>Full Name</th>
        <td>{{ isset($model->full_name)?ucfirst($model->full_name):''}}</td>
        <th>Email Address</th>
        <td>{{ isset($model->email)?ucfirst($model->email):'' }}</td>
        <th>Telephone No</th>
        <td>{{ isset($model->telephone)?ucfirst($model->telephone):'' }}</td>
    </tr>

    <tr>
        <th>Extension</th>
        <td>{{ isset($model->extension)?ucfirst($model->extension):''}}</td>
        <th>Fax</th>
        <td>{{ isset($model->fax)?ucfirst($model->fax):'' }}</td>
        <th>Others</th>
        <td>{{ isset($model->others)?ucfirst($model->others):'' }}</td>
    </tr>

    <tr>
        <th>Captain</th>
        <td>
            {{ isset($model->captain)?ucfirst($model->captain):''}}
            ({{ isset($model->pf_pnf)?ucfirst($model->pf_pnf):'' }})
        </td>
        <th>Co Pilot</th>
        <td>
            {{ isset($model->co_pilot)?ucfirst($model->co_pilot):'' }}
            ({{ isset($model->pf_pnf2)?ucfirst($model->pf_pnf2):'' }})
        </td>
        <th>Date</th>
        <td>{{ isset($model->date)?ucfirst($model->date):''}}</td>
    </tr>

    <tr>
        <th>Time</th>
        <td>
            {{ isset($model->time)?ucfirst($model->time):''}}
            ({{ isset($model->utc_local)?ucfirst($model->utc_local):'' }})
        </td>
        <th>Air Craft Time</th>
        <td>{{ isset($model->air_craft_time)?ucfirst($model->air_craft_time):'' }}</td>
        <th>Registration</th>
        <td>{{ isset($model->registration)?ucfirst($model->registration):''}}</td>
    </tr>

    <tr>
        <th>Flight No</th>
        <td>{{ isset($model->flight_no)?ucfirst($model->flight_no):''}}</td>
        <th>From</th>
        <td>{{ isset($model->from)?ucfirst($model->from):'' }}</td>
        <th>To</th>
        <td>{{ isset($model->to)?ucfirst($model->to):''}}</td>
    </tr>

    <tr>
        <th>Position (geogr.co-ord)</th>
        <td>{{ isset($model->position)?ucfirst($model->position):''}}</td>
        <th>Altitude</th>
        <td>{{ isset($model->altitude)?ucfirst($model->altitude):'' }}</td>
        <th>Speed/Mach</th>
        <td>{{ isset($model->speed)?ucfirst($model->speed):''}}</td>
    </tr>

    <tr>
        <th>actual_weight</th>
        <td>{{ isset($model->actual_weight)?ucfirst($model->actual_weight):''}}</td>
        <th>Remaining Fuel</th>
        <td>{{ isset($model->remaining_fuel)?ucfirst($model->remaining_fuel):'' }}</td>
        <th>Atl Ref</th>
        <td>{{ isset($model->atl_ref)?ucfirst($model->atl_ref):''}}</td>
    </tr>

    <tr>
        <th>Delay (min)</th>
        <td>{{ isset($model->delay)?ucfirst($model->delay):''}}</td>
        <th>Diversion</th>
        <td>{{ isset($model->diversion)?ucfirst($model->diversion):'' }}</td>
        <th>NR Crew</th>
        <td>{{ isset($model->nr_crew)?ucfirst($model->nr_crew):''}}</td>
    </tr>

    <tr>
        <th>NR Pax</th>
        <td>{{ isset($model->nr_pax)?ucfirst($model->nr_pax):''}}</td>
        <th>Flight Phase</th>
        <td>{{ isset($model->flight_phase)?ucfirst($model->flight_phase):'' }}</td>
        <th>Description Of Occurence</th>
        <td>{{ isset($model->description_of_occurence)?ucfirst($model->description_of_occurence):''}}</td>
    </tr>


    <tr>
        <th>IMC/VMC</th>
        <td>{{ isset($model->imc_vmc)?ucfirst($model->imc_vmc):''}}</td>
        <th>VMC (km)</th>
        <td>{{ isset($model->vmc_km)?ucfirst($model->vmc_km):'' }}</td>
        <th>Wind Direction (deg)</th>
        <td>{{ isset($model->wind_direction)?ucfirst($model->wind_direction):''}}</td>
    </tr>

    <tr>
        <th>Wind Speed</th>
        <td>{{ isset($model->wind_speed)?ucfirst($model->wind_speed):''}}</td>
        <th>Visibility</th>
        <td>{{ isset($model->visibility)?ucfirst($model->visibility):'' }}</td>
        <th>Ceiling</th>
        <td>{{ isset($model->ceiling)?ucfirst($model->ceiling):''}}</td>
    </tr>

    <tr>
        <th>Clouds</th>
        <td>{{ isset($model->clouds)?ucfirst($model->clouds):''}}</td>
        <th>Temperature</th>
        <td>{{ isset($model->temperature)?ucfirst($model->temperature):'' }}</td>
        <th>Qnh</th>
        <td>{{ isset($model->qnh)?ucfirst($model->qnh):''}}</td>
    </tr>

    <tr>
        <th>Weather Condition</th>
        <td>{{ isset($model->weather_condition)?ucfirst($model->weather_condition):''}}</td>
        <th>Run Way</th>
        <td>{{ isset($model->runway)?ucfirst($model->runway):'' }}</td>
        <th>Runway Condition</th>
        <td>{{ isset($model->runway_condition)?ucfirst($model->runway_condition):''}}</td>
    </tr>

    <tr>
        <th>Auto Pilot</th>
        <td>{{ isset($model->auto_pilot)?ucfirst($model->auto_pilot):''}}</td>
        <th>Auto Thrust</th>
        <td>{{ isset($model->auto_thrust)?ucfirst($model->auto_thrust):'' }}</td>
        <th>Gear</th>
        <td>{{ isset($model->gear)?ucfirst($model->gear):''}}</td>
    </tr>

    <tr>
        <th>Flap</th>
        <td>{{ isset($model->flap)?ucfirst($model->flap):''}}</td>
        <th>Slat</th>
        <td>{{ isset($model->slat)?ucfirst($model->slat):'' }}</td>
        <th>Spoilers</th>
        <td>{{ isset($model->spoilers)?ucfirst($model->spoilers):''}}</td>
    </tr>

    <tr>
        <th>TCAS INFORMATION (traffic)</th>
        <td>{{ isset($model->type_of_alert)?ucfirst($model->type_of_alert):''}}</td>
        <th>Type OF Alert</th>
        <td>{{ isset($model->type_of_ra)?ucfirst($model->type_of_ra):'' }}</td>
        <th>RA Followed?</th>
        <td>{{ isset($model->ra_followed)?ucfirst($model->ra_followed):''}}</td>
    </tr>

    <tr>
        <th>RVR (M):</th>
        <td>{{ isset($model->rvr)?ucfirst($model->rvr):''}}</td>
        <th>Level OF Risk</th>
        <td>{{ isset($model->level_of_risk)?ucfirst($model->level_of_risk):'' }}</td>
        <th>ATC Instructions</th>
        <td>{{ isset($model->atc_instruction)?ucfirst($model->atc_instruction):''}}</td>
    </tr>

    <tr>
        <th>Heading</th>
        <td>{{ isset($model->heading)?ucfirst($model->heading):''}}</td>
        <th>Heading Of The Other AC</th>
        <td>{{ isset($model->heading_other_ac)?ucfirst($model->heading_other_ac):'' }}</td>
        <th>USED Frequency</th>
        <td>{{ isset($model->used_frequency)?ucfirst($model->used_frequency):''}}</td>
    </tr>

    <tr>
        <th>VER Separation</th>
        <td>{{ isset($model->ver_seperation)?ucfirst($model->ver_seperation):''}}</td>
        <th>HOR Separation</th>
        <td>{{ isset($model->hor_seperation)?ucfirst($model->hor_seperation):'' }}</td>
        <th>Reported TO ATC</th>
        <td>{{ isset($model->reported_to_atc)?ucfirst($model->reported_to_atc):''}}</td>
    </tr>

    <tr>
        <th>Type Of Bird</th>
        <td>{{ isset($model->type_of_bird)?ucfirst($model->type_of_bird):''}}</td>
        <th>NR OF Birds</th>
        <td>{{ isset($model->nr_of_birds)?ucfirst($model->nr_of_birds):'' }}</td>
        <th>Size</th>
        <td>{{ isset($model->size)?ucfirst($model->size):''}}</td>
    </tr>

    <tr>
        <th>Areas Affected</th>
        <td>{{ isset($model->areas_affected)?ucfirst($model->areas_affected):''}}</td>
        <th>Advised Earlier</th>
        <td>{{ isset($model->advice_earlier)?ucfirst($model->advice_earlier):'' }}</td>
        <th>Lighting Conditions</th>
        <td>{{ isset($model->lighting_conditions)?ucfirst($model->lighting_conditions):''}}</td>
    </tr>

    <tr>
        <th>Condition Of The Sky</th>
        <td>{{ isset($model->conditions_of_the_sky)?ucfirst($model->conditions_of_the_sky):''}}</td>

        <th>Course of the AC</th>
        <td>{{ isset($model->course_ac)?ucfirst($model->course_ac):'' }}</td>
        <th>GLIDSLOPE POSITION</th>
        <td>{{ isset($model->glidslope_position)?ucfirst($model->glidslope_position):''}}</td>
    </tr>

    <tr>
        <th>POS. ON EXTENDED CENTR.LINE</th>
        <td>{{ isset($model->pos_extended_center)?ucfirst($model->pos_extended_center):''}}</td>

        <th>CHANGE IN PITCH (deg)</th>
        <td>{{ isset($model->change_in_pitch)?ucfirst($model->change_in_pitch):'' }}</td>
        <th>SPEED BUFFET?</th>
        <td>{{ isset($model->speed_buffet)?ucfirst($model->speed_buffet):''}}</td>
    </tr>

    <tr>
        <th>STICKSHAKER?</th>
        <td>{{ isset($model->stickshaker)?ucfirst($model->stickshaker):''}}</td>

        <th>SUSPECTED WAKE TURBULANCE</th>
        <td>{{ isset($model->suspected_wake_turbulance)?ucfirst($model->suspected_wake_turbulance):'' }}</td>
        <th>SIGN. VERTICAL ACCELARATION</th>
        <td>{{ isset($model->sign_verticle_accelaration)?ucfirst($model->sign_verticle_accelaration):''}}</td>
    </tr>

    <tr>
        <th>DETAILS OF AC WAKE TURBULANCE?</th>
        <td>{{ isset($model->details_ac_wake_turbulance)?ucfirst($model->details_ac_wake_turbulance):''}}</td>

        <th>ADVISE TO OTHER AIRCRAFT</th>
        <td>{{ isset($model->advice_other_aircraft)?ucfirst($model->advice_other_aircraft):'' }}</td>
        <th>Person Involved</th>
        <td>{{ isset($model->persion_involved)?ucfirst($model->persion_involved):''}}</td>
    </tr>

    <tr>
        <th>Function/Position</th>
        <td>{{ isset($model->function_position)?ucfirst($model->function_position):''}}</td>

        <th>TYPE OF INFLUENCE</th>
        <td>{{ isset($model->type_of_influence)?ucfirst($model->type_of_influence):'' }}</td>
        <th>COMMENTS</th>
        <td>{{ isset($model->comments)?ucfirst($model->comments):''}}</td>
    </tr>
</table>--}}


</body>
</html>