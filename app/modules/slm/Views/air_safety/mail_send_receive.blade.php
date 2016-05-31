<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        .tbl {
            margin: 0px !important;
            border: 2px solid;
            width: 100%;
        }

    </style>

</head>
<body>

<table class="table table-bordered table-responsive tbl">
    <tr>
        <th style="border-right: 2px solid">
            <IMG style="width: 600px; height: 10px;" src="http://app.sr/slm/public/assets/img/signature_logo2.jpg">
        </th>
    </tr>

    <tr>
        <p style="padding-left: 50px">
            Paramaribo, {{$ground_handling['current_date']}}<br><br><br><br>


            Dear Mr(s). {{ $ground_handling['full_name'] }},<br><br>

            I herewith inform you that the Safety Department has received your trip
            {{ $ground_handling['report'] }}, dated {{$ground_handling['created_at']}} regarding {{$ground_handling['regards']}}.<br><br>

            You will be informed regarding the action(s) taken with respect to your
            report.<br><br>

            Thank you for your cooperation.<br><br><br><br><br>

            <i>On behalf of the<i><br>
            <span style="font-style: normal !important;">Director of Safety<br>
            Capt. Steven Gonesh</span><br><br>

            <img src="{{ $message->embed(public_path() . '/'.$ground_handling['image_path'] ) }}" alt="SLM" />

            <br><br>




            <span style="font-style: normal !important;">
            Regards,<br><br>
            Lucas Tjin-Asjoe<br>
            Technical Administrator<br>
            Safety Department
            </span>


            <br><br><br><br>



            REPORTING OCCURRENCES NOT ONLY HELPS TO ENHANCE SAFETY,<br>
            BUT CAN SAVE LIVES AS WELL!! SO, KEEP REPORTING……………<br>YOU CAN MAKE A DIFFERENCE.
        </p>
    </tr>
</table>

</body>
</html>