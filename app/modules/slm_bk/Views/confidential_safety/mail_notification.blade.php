<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
       /* table {
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
        }*/
       table {
           border:1px solid #000000;
           width: 100% !important;
       }
       table, td, th {
           border: 1px solid black;
       }

    </style>
</head>
<body>


<table cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="2">Confidential Safety Information</th>
    </tr>
    <tr>
        <th width="20%">NAME</th>
        <td width="80%">{{ isset($model['name'])?ucfirst($model['name']):''}}</td>
    </tr>
    <tr>
        <th>ADDRESS</th>
        <td>{{ isset($model['address'])?ucfirst($model['address']):'' }}</td>
    </tr>
    <tr>
        <th>E-MAIL</th>
        <td>{{ isset($model['email'])?ucfirst($model['email']):'' }}</td>
    </tr>
    <tr>
        <th>TEL #</th>
        <td>{{ isset($model['telephone'])?ucfirst($model['telephone']):'' }}</td>
    </tr>
</table>


<ol style="border: 1px solid #000000">
    <li style="padding: 2px;line-height: 20px;">Your personal details are required only to enable the Director of Safety to contact you for further
        details about any part of your report</li>
    <li>This is a voluntary reporting method</li>
    <li>Entering your personal details is optional</li>
    <li>You will receive an acknowledgement as soon as possible</li>
</ol>

<table cellpadding="0" cellspacing="0" style="border: 2px solid; width: 100% !important;">
    <tr style="border: 2px solid black;">
        <th width="30%" style="border: 2px solid">Function : {{ isset($model['function'])?ucfirst($model['function']):'' }}</th>
        <th width="35%" style="border: 2px solid">Department : {{ isset($model['department'])?ucfirst($model['department']):'' }}</th>
        <th width="35%" style="border: 2px solid">Aircraft Involved : {{ isset($model['aircraft_involved'])?ucfirst($model['aircraft_involved']):'' }}</th>
    </tr>

    <tr style="border: 2px solid black;">
        <th width="30%" style="border: 2px solid">Type of Operation : {{ isset($model['type_of_operation'])?ucfirst($model['type_of_operation']):'' }}</th>
        <th width="35%" style="border: 2px solid">Weather : {{ isset($model['weather'])?ucfirst($model['weather']):'' }}</th>
        <th width="35%" style="border: 2px solid">Flight Phase : {{ isset($model['flight_phase'])?ucfirst($model['flight_phase']):'' }}</th>
    </tr>

    <tr style="border: 2px solid black;">
        <th colspan="3" style="text-align: left">Account of event – (please continue on other side or attach additional sheets if necessary)</th>
    </tr>
    <tr style="border: 2px solid black;">
        <td colspan="3"><p>{{ isset($model['account_of_event'])?ucfirst($model['account_of_event']):'' }}</p></td>
    </tr>
</table>



{{--<table border="0">
    <tr>
        <th colspan="2">Confidential Safety Information</th>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($model['name'])?ucfirst($model['name']):''}}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ isset($model['address'])?ucfirst($model['address']):'' }}</td>
    </tr>
    <tr>
        <th>Email Address</th>
        <td>{{ isset($model['email'])?ucfirst($model['email']):'' }}</td>
    </tr>
    <tr>
        <th>Telephone No</th>
        <td>{{ isset($model['telephone'])?ucfirst($model['telephone']):'' }}</td>
    </tr>
    <tr>
        <th>Function</th>
        <td>{{ isset($model['function'])?ucfirst($model['function']):'' }}</td>
    </tr>
    <tr>
        <th>Department</th>
        <td>{{ isset($model['department'])?ucfirst($model['department']):'' }}</td>
    </tr>
    <tr>
        <th>Aircraft Involved</th>
        <td>{{ isset($model['aircraft_involved'])?ucfirst($model['aircraft_involved']):'' }}</td>
    </tr>
    <tr>
        <th>Type of Operation</th>
        <td>{{ isset($model['type_of_operation'])?ucfirst($model['type_of_operation']):'' }}</td>
    </tr>
    <tr>
        <th>Weather</th>
        <td>{{ isset($model['weather'])?ucfirst($model['weather']):'' }}</td>
    </tr>
    <tr>
        <th>Flight Phase</th>
        <td>{{ isset($model['flight_phase'])?ucfirst($model['flight_phase']):'' }}</td>
    </tr>
    <tr>
        <th>Account of Event</th>
        <td>{{ isset($model['account_of_event'])?ucfirst($model['account_of_event']):'' }}</td>
    </tr>
</table>--}}


</body>
</html>