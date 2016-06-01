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
    <h4><b style="color: #f5f5f5">Cabin Crew Information</b></h4>
</div>

<table width="100%">
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="7">GENERAL INFORMATION</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="7">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : {{ isset($model['full_name'])?ucfirst($model['full_name']):''}},{{ isset($model['email'])?ucfirst($model['email']):''}},{{ isset($model['telephone'])?ucfirst($model['telephone']):''}},{{ isset($model['extension'])?ucfirst($model['extension']):''}},{{ isset($model['fax'])?ucfirst($model['fax']):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="28%" style="border: 2px solid" colspan="2">
            2. CAPTAIN :
            {{ isset($model['captain'])?ucfirst($model['captain']):''}}
            {!! Form::radio('pf_pnf', 'pf', (@$model['pf_pnf'] == 'pf' ? 'checked': '')) !!} PF
            {!! Form::radio('pf_pnf', 'pnf', (@$model['pf_pnf'] == 'pnf' ? 'checked': '')) !!} PNF
        </th>
        <th width="14%" style="border: 2px solid" colspan="2">
            3. CO-PILOT : {{ isset($model['co_pilot'])?ucfirst($model['co_pilot']):'' }}&nbsp;&nbsp;
            {!! Form::radio('pf_pnf2', 'pf', (@$model['pf_pnf2'] == 'pf' ? 'checked': '')) !!} PF
            {!! Form::radio('pf_pnf2', 'pnf', (@$model['pf_pnf2'] == 'pnf' ? 'checked': '')) !!} PNF
        </th>
        <th width="14%" style="border: 2px solid">4. OTHER : {{ isset($model['others'])?ucfirst($model['others']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="28%" style="border: 2px solid" colspan="2">5. PURSER : {{ isset($model['purser'])?ucfirst($model['purser']):'' }}</th>
        <th width="14%" style="border: 2px solid">6. DATE : {{ isset($model['date'])?ucfirst($model['date']):''}}</th>
        <th width="14%" style="border: 2px solid">
            7. TIME : {{ isset($model['time'])?ucfirst($model['time']):''}}
            {!! Form::radio('utc_local', 'utc', (@$model['utc_local'] == 'utc' ? 'checked': '')) !!} UTC
            {!! Form::radio('utc_local', 'local', (@$model['utc_local']== 'local' ? 'checked': '')) !!} Local
        </th>
        <th width="14%" style="border: 2px solid">8. AIRCRAFT TYPE : {{ isset($model['air_craft_type'])?ucfirst($model['air_craft_type']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="28%" style="border: 2px solid">9. REGISTRATION : {{ isset($model['registration'])?ucfirst($model['registration']):''}}</th>
        <th width="14%" style="border: 2px solid">10. FLIGHT NR. : {{ isset($model['flight_no'])?ucfirst($model['flight_no']):''}}</th>
        <th width="14%" style="border: 2px solid">11. FROM : {{ isset($model['from'])?ucfirst($model['from']):'' }}</th>
        <th width="14%" style="border: 2px solid">12. TO : {{ isset($model['to'])?ucfirst($model['to']):''}}</th>
        <th width="30%" style="border: 2px solid">13. FLT DIVERTED TO : {{ isset($model['flt_diverted_to'])?ucfirst($model['flt_diverted_to']):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="28%" style="border: 2px solid" colspan="2">14. ASSIGNED DOOR : {{ isset($model['assigned_door'])?ucfirst($model['assigned_door']):'' }}</th>
        <th width="14%" style="border: 2px solid">15. POS. DURING EVENT : {{ isset($model['position_during_event'])?ucfirst($model['position_during_event']):''}}</th>
        <th width="14%" style="border: 2px solid">16. NR OF PAX : {{ isset($model['nr_of_pax'])?ucfirst($model['nr_of_pax']):''}}</th>
        <th width="14%" style="border: 2px solid">17. NR OF CREW : {{ isset($model['nr_of_crew'])?ucfirst($model['nr_of_crew']):'' }}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="7">18. PREVIOUS FLIGHTS : {{ isset($model['previous_flights'])?ucfirst($model['previous_flights']):''}}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="7">19. NR OF LANDINGS OF THE DAY : {{ isset($model['nr_of_landings_of_the_day'])?ucfirst($model['nr_of_landings_of_the_day']):''}}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="7">
            20. FLIGHT PHASE:
            <br>
            {!! Form::radio('flight_phase', 'parked', (@$model['flight_phase'] == 'parked' ? 'checked': '')) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'push_back', (@$model['flight_phase'] == 'push_back' ? 'checked': '')) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'taxi_out', (@$model['flight_phase'] == 'taxi_out' ? 'checked': '')) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'take_off', (@$model['flight_phase'] == 'take_off' ? 'checked': '')) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'initial_climb', (@$model['flight_phase'] == 'initial_climb' ? 'checked': '')) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'climb', (@$model['flight_phase'] == 'climb' ? 'checked': '')) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
            <br>
            {!! Form::radio('flight_phase', 'cruise', (@$model['flight_phase'] == 'cruise' ? 'checked': '')) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'holding', (@$model['flight_phase'] == 'holding' ? 'checked': '')) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'descent', (@$model['flight_phase'] == 'descent' ? 'checked': '')) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'approach', (@$model['flight_phase'] == 'approach' ? 'checked': '')) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'landing', (@$model['flight_phase'] == 'landing' ? 'checked': '')) !!} LANDING&nbsp;&nbsp;
            {!! Form::radio('flight_phase', 'taxi_in', (@$$model['flight_phase'] == 'taxi_in' ? 'checked': '')) !!} TAXI IN
        </th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="7">21. DESCRIPTION OF OCCURRENCE ( add forms if necessary):<p> {{ isset($model['description_of_occurrence'])?ucfirst($model['description_of_occurrence']):''}} </p></th>
    </tr>
</table>



</body>
</html>