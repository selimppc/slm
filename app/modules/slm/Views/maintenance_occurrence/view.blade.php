@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')


    <div class="panel">
        <div style="background-color: #0490a6" class="title-div">
            <h3 class="text-center text-green"><b style="color: #f5f5f5">Maintenance Occurrence Report</b></h3>
        </div>

        <div style="padding-right: 15px" class="buttons-div">
            <a href="{{ route('maintenance-pdf', $maintenance_occurrence->id) }}" class="btn btn-primary margin-bot-5"><strong>Export PDF</strong></a>
        </div>

        <div style="height: 25px"></div>

        <div class="panel-body">
            <table class="table table-bordered table-responsive report" width="100%">
                <tr>
                    <th width="100%" colspan="3" rowspan="2" style="border: 2px solid; text-align:center;"><img src="{{ URL::to('/') }}/assets/img/logo.png" alt="slm logo" style="width: 50%; padding-top: 30px;"></th>
                    <th width="100%" colspan="2" rowspan="2" style="border: 2px solid; text-align:right;">
                        <p style="font-weight: bolder; font-size:40px;" align="center">(OSR)</p>
                        <p style="font-weight: bolder; font-size:20px;" align="center">Operational Safety Report</p>
                    </th>
                    <th width="100%" colspan="2" style="border: 2px solid; text-align:right;"> Safety Department ref. nr : {{ $maintenance_occurrence->reference_no }}</th>
                </tr>
                <tr>
                    <th width="100%" colspan="2" style="border: 2px solid #6a6c6f; text-align: center; color:red; font-size: 25px; font-weight: bold">MAINTENANCE OCCURRENCE <br> REPORT</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; " colspan="7">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="background-color: yellow; height: 20px;">
                                <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
                            </div>
                            <div class="col-sm-4"></div>
                        </div></th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="7">1. FULL NAME AND CONTACT INFORMATION-( tel, extension, fax, email) : {{ isset($maintenance_occurrence->full_name)?ucfirst($maintenance_occurrence->full_name):''}},{{ isset($maintenance_occurrence->email)?ucfirst($maintenance_occurrence->email):''}},{{ isset($maintenance_occurrence->telephone)?ucfirst($maintenance_occurrence->telephone):''}},{{ isset($maintenance_occurrence->extension)?ucfirst($maintenance_occurrence->extension):''}},{{ isset($maintenance_occurrence->fax)?ucfirst($maintenance_occurrence->fax):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="28%" style="border: 2px solid" colspan="2">2. DATE OF OCCURRENCE :
                        {{ isset($maintenance_occurrence->date_of_occurrence)?date("M d, Y", strtotime($maintenance_occurrence->date_of_occurrence)):'' }}
                    </th>
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
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    {!! Form::label('attachment', 'Attachment:', ['class' => 'control-label']) !!}
                    @foreach($data_image as $image)

                        <?php $expld = explode('/',$image->image_path); ?>
                        @if(isset($image->image_path))
                            <div>
                                <span class="glyphicon glyphicon-file"></span>&nbsp; {{ $expld[1] }}
                                <a href="{{ URL::to($image->image_path) }}" class="btn btn-primary btn-xs" data-placement="top" download="download">Download</a><br><br>
                            </div>
                        @else
                            <div><span class="glyphicon glyphicon-remove-circle"></span> No Attachment Available</div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-sm-12 text-center">
                <a href="{{ \URL::previous() }}" class="btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
            </div>

        </div>

    </div>



@stop