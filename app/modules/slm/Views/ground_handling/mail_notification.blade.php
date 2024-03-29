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

<div style="background-color: #0490a6; height: 25px;">
    <h3 class="text-center text-green"><b style="color: #f5f5f5">New Ground Handling Information</b></h3>
</div>



<table width="100%">
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="4">GENERAL INFORMATION</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: left" colspan="4">1. FULL NAME AND CONTACT INFORMATION : {{ isset($ground_handling['full_name'])?ucfirst($ground_handling['full_name']):''}},{{ isset($ground_handling['email'])?ucfirst($ground_handling['email']):''}},{{ isset($ground_handling['telephone'])?ucfirst($ground_handling['telephone']):''}},{{ isset($ground_handling['extension'])?ucfirst($ground_handling['extension']):''}},{{ isset($ground_handling['fax'])?ucfirst($ground_handling['fax']):''}}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="75%" style="border: 2px solid" colspan="3">2. LOCATION OF OCCURRENCE : {{ isset($ground_handling['location_of_occurrence'])?ucfirst($ground_handling['location_of_occurrence']):'' }}</th>
        <th width="25%" style="border: 2px solid">3. RAMP CONDITION : {{ isset($ground_handling['ramp_condition'])?ucfirst($ground_handling['ramp_condition']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="25%" style="border: 2px solid">4. DATE : {{ isset($ground_handling['date'])?ucfirst($ground_handling['date']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">
            5. TIME: {{ isset($ground_handling['time'])?ucfirst($ground_handling['time']):'' }}&nbsp;&nbsp;
            {!! Form::radio('utc_local', 'utc', (@$ground_handling['utc_local'] == 'utc' ? 'checked': '')) !!} UTC
            {!! Form::radio('utc_local', 'local', (@$ground_handling['utc_local'] == 'local' ? 'checked': '')) !!} Local
        </th>
        <th width="25%" style="border: 2px solid">6. OPERATIONAL PHASE : {{ isset($ground_handling['operational_phase'])?ucfirst($ground_handling['operational_phase']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="25%" style="border: 2px solid">7. OPERATOR : {{ isset($ground_handling['operator'])?ucfirst($ground_handling['operator']):'' }}</th>
        <th width="25%" style="border: 2px solid">8. FLIGHT NUMBER : {{ isset($ground_handling['flight_number'])?ucfirst($ground_handling['flight_number']):'' }}</th>
        <th width="25%" style="border: 2px solid">9. AIRCRAFT TYPE : {{ isset($ground_handling['aircraft_type'])?ucfirst($ground_handling['aircraft_type']):'' }}</th>
        <th width="25%" style="border: 2px solid">10. REGISTRATION : {{ isset($ground_handling['registration'])?ucfirst($ground_handling['registration']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="25%" style="border: 2px solid">11. FROM : {{ isset($ground_handling['from'])?ucfirst($ground_handling['from']):'' }}</th>
        <th width="25%" style="border: 2px solid">12. TO : {{ isset($ground_handling['to'])?ucfirst($ground_handling['to']):'' }}</th>
        <th width="25%" style="border: 2px solid">13. DELAY (min) : {{ isset($ground_handling['delay'])?ucfirst($ground_handling['delay']):'' }}</th>
        <th width="25%" style="border: 2px solid">14. DIVERSION : {{ isset($ground_handling['diversion'])?ucfirst($ground_handling['diversion']):'' }}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="4">15. THIRD PARTY INVOLVED (Contractor) {{ isset($ground_handling['third_party_involved'])?ucfirst($ground_handling['third_party_involved']):'' }}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="4">16. DESCRIPTION OF OCCURRENCE ( add forms if necessary) <p>{{ isset($ground_handling['description_of_occurrence'])?ucfirst($ground_handling['description_of_occurrence']):'' }}</p></th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; ; background-color: yellow" colspan="4">DANGEROUS GOODS</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="50%" style="border: 2px solid" colspan="2">17. ORIGIN OF THE GOODS : {{ isset($ground_handling['origin_of_the_goods'])?ucfirst($ground_handling['origin_of_the_goods']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">18. IATA UN/ID : {{ isset($ground_handling['iata_un_or_id'])?ucfirst($ground_handling['iata_un_or_id']):'' }}</th>
    </tr>

    <tr style="border: 2px solid">
        <th width="50%" style="border: 2px solid" colspan="2">19. CLASS / DIVISION : {{ isset($ground_handling['class_or_division'])?ucfirst($ground_handling['class_or_division']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">20. SUBSIDIARY RISK : {{ isset($ground_handling['subsidiary_risk'])?ucfirst($ground_handling['subsidiary_risk']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="50%" style="border: 2px solid" colspan="2">
            21. PACKING GROUP :
            {!! Form::radio('packing_group','I',(@$ground_handling['packing_group'] == 'I' ? 'I': '')) !!} I
            {!! Form::radio('packing_group','II',(@$ground_handling['packing_group'] == 'II'? 'II': '')) !!} II
            {!! Form::radio('packing_group','III',(@$ground_handling['packing_group'] == 'III'? 'III': '')) !!} III
        </th>
        <th width="50%" style="border: 2px solid" colspan="2">
            22.CLASS 7 CATEGORY :
            {!! Form::radio('class_7_category','I',(@$ground_handling['class_7_category'] == 'I'? 'I': '')) !!} I
            {!! Form::radio('class_7_category','II',(@$ground_handling['class_7_category'] == 'II'? 'II': '')) !!} II
            {!! Form::radio('class_7_category','III',(@$ground_handling['class_7_category'] == 'III'? 'III': '')) !!} III
        </th>
    </tr>
    <tr style="border: 2px solid">
        <th width="50%" style="border: 2px solid" colspan="2">23. TYPE OF PACKING : {{ isset($ground_handling['type_of_packing'])?ucfirst($ground_handling['type_of_packing']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">24. PACKING SPEC. MARKING : {{ isset($ground_handling['packing_spec_marking'])?ucfirst($ground_handling['packing_spec_marking']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="50%" style="border: 2px solid" colspan="2">25. NUMBER OF PACKAGES : {{ isset($ground_handling['number_of_packages'])?ucfirst($ground_handling['number_of_packages']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">26. QUANTITY-OF TRANSPORT INDEX : {{ isset($ground_handling['quantity_of_transport_index'])?ucfirst($ground_handling['quantity_of_transport_index']):'' }}</th>
    </tr>

    <tr style="border: 2px solid">
        <th width="50%" style="border: 2px solid" colspan="2">27.AIRWAY-BILL REFERENCE : {{ isset($ground_handling['airway_bill_reference'])?ucfirst($ground_handling['airway_bill_reference']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">28. COURIER POUCH /BAG TAG/ TKT REF : {{ isset($ground_handling['courier_pouch_reference'])?ucfirst($ground_handling['courier_pouch_reference']):'' }}</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="50%" style="border: 2px solid" colspan="2">29. SHIPPING AGENT : {{ isset($ground_handling['shipping_agent'])?ucfirst($ground_handling['shipping_agent']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">30. SHIPPING NAME : {{ isset($ground_handling['shipping_name'])?ucfirst($ground_handling['shipping_name']):'' }}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid; text-align: center; ; background-color: yellow" colspan="4">VEHICLE & RAMP EQUIPMENT DAMAGE</th>
    </tr>
    <tr style="border: 2px solid">
        <th width="25%" style="border: 2px solid">31. DAMAGE TO : {{ isset($ground_handling['damage_to'])?ucfirst($ground_handling['damage_to']):'' }}</th>
        <th width="25%" style="border: 2px solid">32. DAMAGE BY : {{ isset($ground_handling['damage_by'])?ucfirst($ground_handling['damage_by']):'' }}</th>
        <th width="50%" style="border: 2px solid" colspan="2">33. AREA (STAND) : {{ isset($ground_handling['area'])?ucfirst($ground_handling['area']):'' }}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="4">34.ENVIROMENTAL CONDITIONS (weather, surface, lighting) : {{ isset($ground_handling['enviromental_condition'])?ucfirst($ground_handling['enviromental_condition']):'' }}</th>
    </tr>
    <tr>
        <th width="100%" style="border: 2px solid" colspan="4">35. DETAILS OF DAMAGE (add forms if necessary) : <p>{{ isset($ground_handling['details_of_damage'])?ucfirst($ground_handling['details_of_damage']):'' }}</p></th>
    </tr>

</table>

</body>
</html>