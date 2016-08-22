@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')

    <style>
        .tbl { margin: 0px !important;
            border: 2px solid;
            border-bottom:0px !important;
            width: 100%;
        }
        .tbl tr td { }

        .report_img{
            height: 100px!important;
            text-align: center!important;
            padding: 15px 10px 18px 10px!important;
        }

    </style>

    <?php  ?>

    <div class="panel">
        <div style="background-color: #0490a6" class="title-div">
            <h3 class="text-center text-green"><b style="color: #f5f5f5">Cabin Crew report</b></h3>
        </div>

        <div style="padding-right: 15px" class="buttons-div">
            <a href="{{ route('cabin-pdf', $cabin_crew->id) }}" class="btn btn-primary margin-bot-5"><strong>Export PDF</strong></a>
        </div>

        <div style="height: 25px"></div>

        <div class="panel-body">

            <table class="table table-bordered table-responsive tbl report">
                <tr>
                    <th rowspan="2" style="border-right: 2px solid" width="33%" class="report_img"><img src="{{ URL::to('/') }}/assets/img/logo.png" alt="bZm Graphics" style="width: 50%; padding-top: 30px;"></th>
                    <th rowspan="2" style="border-right: 2px solid" width="33%">
                        <p style="height: 40px; font-weight: bolder; font-size:35px;" align="center">OSR</p>
                        <p style="height: 25px"; align="center"><font size="+2";><u>Operational Safety</u></font></p>
                        <p style="height: 25px" align="center"><font size="+2";><u>Report</u></font></p>
                    </th>
                    <th width="34%" style="border-bottom: 2px solid;vertical-align: top; font-size: 20px; text-align: left;">Safety Department<br> ref. nr : {{ $cabin_crew->reference_no }}</th>
                </tr>
                <tr>
                    <th width="34%" style="text-align: center; color:red; font-size: 35px; font-weight: bold">CABIN CREW REPORT</th>
                </tr>
            </table>
            <table class="table table-bordered table-responsive no-spacing report" width="100%">
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; " colspan="5">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="background-color: yellow; height: 20px;">
                                <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
                            </div>
                            <div class="col-sm-4"></div>
                        </div></th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="5">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : {{ isset($cabin_crew->full_name)?ucfirst($cabin_crew->full_name):''}},{{ isset($cabin_crew->email)?ucfirst($cabin_crew->email):''}},{{ isset($cabin_crew->telephone)?ucfirst($cabin_crew->telephone):''}},{{ isset($cabin_crew->extension)?ucfirst($cabin_crew->extension):''}},{{ isset($cabin_crew->fax)?ucfirst($cabin_crew->fax):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="40%" style="border: 2px solid" colspan="2">
                        2. CAPTAIN :
                        {{ isset($cabin_crew->captain)?ucfirst($cabin_crew->captain):''}}<br>&nbsp;&nbsp;
                        PF  {!! Form::radio('pf_pnf', 'pf', (@$cabin_crew->pf_pnf == 'pf' ? 'checked': '')) !!}
                        PNF  {!! Form::radio('pf_pnf', 'pnf', (@$cabin_crew->pf_pnf == 'pnf' ? 'checked': '')) !!}
                    </th>
                    <th width="40%" style="border: 2px solid" colspan="2">
                        3. CO-PILOT : {{ isset($cabin_crew->co_pilot)?ucfirst($cabin_crew->co_pilot):'' }}<br>&nbsp;&nbsp;
                        PF   {!! Form::radio('pf_pnf2', 'pf', (@$cabin_crew->pf_pnf2 == 'pf' ? 'checked': '')) !!}
                        PNF  {!! Form::radio('pf_pnf2', 'pnf', (@$cabin_crew->pf_pnf2 == 'pnf' ? 'checked': '')) !!}
                    </th>
                    <th width="20%" style="border: 2px solid">4. OTHER : {{ isset($cabin_crew->others)?ucfirst($cabin_crew->others):'' }}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="40%" style="border: 2px solid" colspan="2">5. PURSER : {{ isset($cabin_crew->purser)?ucfirst($cabin_crew->purser):'' }}</th>
                    <th width="20%" style="border: 2px solid">6. DATE : {{ isset($cabin_crew->date)?date("M d, Y", strtotime($cabin_crew->date)):''}} </th>
                    <th width="20%" style="border: 2px solid">
                        7. TIME : {{ isset($cabin_crew->time)?ucfirst($cabin_crew->time):''}}<br>
                        UTC  {!! Form::radio('utc_local', 'utc', (@$cabin_crew->utc_local == 'utc' ? 'checked': '')) !!}
                        Local   {!! Form::radio('utc_local', 'local', (@$cabin_crew->utc_local == 'local' ? 'checked': '')) !!}
                    </th>
                    <th width="20%" style="border: 2px solid">8. AIRCRAFT TYPE : {{ isset($cabin_crew->air_craft_type)?ucfirst($cabin_crew->air_craft_type):'' }}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="20%" style="border: 2px solid">9. REGISTRATION : {{ isset($cabin_crew->registration)?ucfirst($cabin_crew->registration):''}}</th>
                    <th width="20%" style="border: 2px solid">10. FLIGHT NR. : {{ isset($cabin_crew->flight_no)?ucfirst($cabin_crew->flight_no):''}}</th>
                    <th width="20%" style="border: 2px solid">11. FROM : {{ isset($cabin_crew->from)?ucfirst($cabin_crew->from):'' }}</th>
                    <th width="20%" style="border: 2px solid">12. TO : {{ isset($cabin_crew->to)?ucfirst($cabin_crew->to):''}}</th>
                    <th width="20%" style="border: 2px solid">13. FLT DIVERTED TO : {{ isset($cabin_crew->flt_diverted_to)?ucfirst($cabin_crew->flt_diverted_to):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="40%" style="border: 2px solid" colspan="2">14. ASSIGNED DOOR : {{ isset($cabin_crew->assigned_door)?ucfirst($cabin_crew->assigned_door):'' }}</th>
                    <th width="20%" style="border: 2px solid">15. POS. DURING EVENT : {{ isset($cabin_crew->position_during_event)?ucfirst($cabin_crew->position_during_event):''}}</th>
                    <th width="20%" style="border: 2px solid">16. NR OF PAX : {{ isset($cabin_crew->nr_of_pax)?ucfirst($cabin_crew->nr_of_pax):''}}</th>
                    <th width="20%" style="border: 2px solid">17. NR OF CREW : {{ isset($cabin_crew->nr_of_crew)?ucfirst($cabin_crew->nr_of_crew):'' }}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="5">18. PREVIOUS FLIGHTS : {{ isset($cabin_crew->previous_flights)?ucfirst($cabin_crew->previous_flights):''}}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="5">19. NR OF LANDINGS OF THE DAY : {{ isset($cabin_crew->nr_of_landings_of_the_day)?ucfirst($cabin_crew->nr_of_landings_of_the_day):''}}</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="5">
                        20. FLIGHT PHASE:
                        <br>
                        PARKED  {!! Form::radio('flight_phase', 'parked', (@$cabin_crew->flight_phase == 'parked' ? 'checked': '')) !!}  &nbsp;&nbsp;&nbsp;&nbsp;
                        PUSH BACK  {!! Form::radio('flight_phase', 'push_back', (@$cabin_crew->flight_phase == 'push_back' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        TAXI OUT  {!! Form::radio('flight_phase', 'taxi_out', (@$cabin_crew->flight_phase == 'taxi_out' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        TAKE OFF  {!! Form::radio('flight_phase', 'take_off', (@$cabin_crew->flight_phase == 'take_off' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        INITIAL CLIMB  {!! Form::radio('flight_phase', 'initial_climb', (@$cabin_crew->flight_phase == 'initial_climb' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        CLIMB  {!! Form::radio('flight_phase', 'climb', (@$cabin_crew->flight_phase == 'climb' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                        CRUISE  {!! Form::radio('flight_phase', 'cruise', (@$cabin_crew->flight_phase == 'cruise' ? 'checked': '')) !!}  &nbsp;&nbsp;&nbsp;&nbsp;
                        HOLDING  {!! Form::radio('flight_phase', 'holding', (@$cabin_crew->flight_phase == 'holding' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        DESCENT  {!! Form::radio('flight_phase', 'descent', (@$cabin_crew->flight_phase == 'descent' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        APPROACH  {!! Form::radio('flight_phase', 'approach', (@$cabin_crew->flight_phase == 'approach' ? 'checked': '')) !!} &nbsp;&nbsp;&nbsp;&nbsp;
                        LANDING   {!! Form::radio('flight_phase', 'landing', (@$cabin_crew->flight_phase == 'landing' ? 'checked': '')) !!} &nbsp;&nbsp;
                        TAXI IN  {!! Form::radio('flight_phase', 'taxi_in', (@$cabin_crew->flight_phase == 'taxi_in' ? 'checked': '')) !!}
                    </th>
                </tr>
                <tr>
                    <th width="100%" height="300px" style="border: 2px solid" colspan="5">21. DESCRIPTION OF OCCURRENCE ( add forms if necessary):<p> {{ isset($cabin_crew->description_of_occurrence)?ucfirst($cabin_crew->description_of_occurrence):''}} </p></th>
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
            <div class="height-5">&nbsp;</div>

        </div>

    </div>



@stop