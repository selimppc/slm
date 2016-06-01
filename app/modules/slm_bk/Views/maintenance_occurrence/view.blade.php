@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')


    <div class="panel">
        <div style="background-color: #0490a6">
            <h3 class="text-center text-green"><b style="color: #f5f5f5">View Maintenance Occurrence report</b></h3>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-responsive" width="100%">
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="7">GENERAL INFORMATION</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="7">1. FULL NAME AND CONTACT INFORMATION-( tel, extension, fax, email) : {{ isset($maintenance_occurrence->full_name)?ucfirst($maintenance_occurrence->full_name):''}},{{ isset($maintenance_occurrence->email)?ucfirst($maintenance_occurrence->email):''}},{{ isset($maintenance_occurrence->telephone)?ucfirst($maintenance_occurrence->telephone):''}},{{ isset($maintenance_occurrence->extension)?ucfirst($maintenance_occurrence->extension):''}},{{ isset($maintenance_occurrence->fax)?ucfirst($maintenance_occurrence->fax):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="28%" style="border: 2px solid" colspan="2">2. DATE OF OCCURRENCE : {{ isset($maintenance_occurrence->date_of_occurrence)?ucfirst($maintenance_occurrence->date_of_occurrence):'' }}</th>
                    <th width="14%" style="border: 2px solid">3. TIME OF OCCURRENCE : {{ isset($ground_handling->time_of_occurrence)?ucfirst($ground_handling->time_of_occurrence):'' }}</th>
                    <th width="14%" style="border: 2px solid">4. SHIFT : {{ isset($maintenance_occurrence->shift)?ucfirst($maintenance_occurrence->shift):'' }}</th>
                    <th width="14%" style="border: 2px solid">5. LOCATION OF OCCURRENCE : {{ isset($maintenance_occurrence->location_of_occurrence)?ucfirst($maintenance_occurrence->location_of_occurrence):'' }}</th>
                    <th width="30%" style="border: 2px solid" colspan="2">6. SUB LOCATION : {{ isset($maintenance_occurrence->sub_location_of_occurrence)?ucfirst($maintenance_occurrence->sub_location_of_occurrence):'' }}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="14%" style="border: 2px solid">7. MANDATORY : {{ isset($maintenance_occurrence->mandatory)?ucfirst($maintenance_occurrence->mandatory):'' }}</th>
                    <th width="14%" style="border: 2px solid">8. AIRCRAFT TYPE : {{ isset($maintenance_occurrence->aircraft_type)?ucfirst($maintenance_occurrence->aircraft_type):'' }}</th>
                    <th width="14%" style="border: 2px solid">9. REGISTRATION : {{ isset($maintenance_occurrence->registration)?ucfirst($maintenance_occurrence->registration):'' }}</th>
                    <th width="14%" style="border: 2px solid">10. OPERATOR : {{ isset($maintenance_occurrence->operator)?ucfirst($maintenance_occurrence->operator):'' }}</th>
                    <th width="14%" style="border: 2px solid">11. ETOPS : {{ isset($maintenance_occurrence->etops)?ucfirst($maintenance_occurrence->etops):'' }}</th>
                    <th width="14%" style="border: 2px solid">12. TECHNICAL LOG REF : {{ isset($maintenance_occurrence->technical_log_ref)?ucfirst($maintenance_occurrence->technical_log_ref):'' }}</th>
                    <th width="16%" style="border: 2px solid">13. TAG/DEMAND NO : {{ isset($maintenance_occurrence->tag_or_demand_no)?ucfirst($maintenance_occurrence->tag_or_demand_no):'' }}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="28%" style="border: 2px solid" colspan="2">14. COMPONENT : {{ isset($maintenance_occurrence->component)?ucfirst($maintenance_occurrence->component):'' }}</th>
                    <th width="14%" style="border: 2px solid">15. PART NUMBER : {{ isset($maintenance_occurrence->part_number)?ucfirst($maintenance_occurrence->part_number):'' }}</th>
                    <th width="14%" style="border: 2px solid">16. SERIAL NUMBER : {{ isset($maintenance_occurrence->serial_number)?ucfirst($maintenance_occurrence->serial_number):'' }}</th>
                    <th width="14%" style="border: 2px solid">17. QUARANTINED : {{ isset($maintenance_occurrence->quarantined)?ucfirst($maintenance_occurrence->quarantined):'' }}</th>
                    <th width="14%" style="border: 2px solid">18. ATA CODE : {{ isset($maintenance_occurrence->ata_code)?ucfirst($maintenance_occurrence->ata_code):'' }}</th>
                    <th width="16%" style="border: 2px solid">19. ATA SUB CODE : {{ isset($maintenance_occurrence->ata_sub_code)?ucfirst($maintenance_occurrence->ata_sub_code):'' }}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="7">20. TITLE OF OCCURRENCE : {{ isset($maintenance_occurrence->title_of_occurrence)?ucfirst($maintenance_occurrence->title_of_occurrence):'' }}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="7">21. DESCRIPTION OF OCCURRENCE : <p>{{ isset($maintenance_occurrence->description_of_occurrence)?ucfirst($maintenance_occurrence->description_of_occurrence):'' }}</p></th>
                </tr>
            </table>


            <div class="footer-form-margin-btn">
                <a href="{{ \URL::previous() }}" class="btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
            </div>

        </div>

    </div>



@stop