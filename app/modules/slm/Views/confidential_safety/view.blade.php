@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')


    <div class="panel">
        <div style="background-color: #0490a6" class="title-div">
            <h3 class="text-center text-green"><b style="color: #f5f5f5">Confidential Safety report</b></h3>
        </div>

        <div style="padding-right: 15px" class="buttons-div">
            <a href="{{ route('confidential-pdf', $confidential_safety->id) }}" class="btn btn-primary margin-bot-5"><strong>Export PDF</strong></a>
        </div>

        <div style="height: 25px"></div>

        <div class="panel-body">
            <table cellspacing="0" cellpadding="0" class="table table-bordered table-responsive tbl3">
                <tr>
                    <th width="50%" style="border: 2px solid; text-align:center;"><img src="{{ URL::to('/') }}/assets/img/logo.png" alt="slm logo" style="width: 50%; padding-top: 30px;"></th>

                    <th width="50%" style="border: 2px solid; text-align:left;"> <p style="font-weight: bolder; font-size:20px;" align="left">Confidential Safety Report</p></th>
                </tr>
                <tr>
                    <th width="100%" style="text-align: center" colspan="2">
                        <p>This voluntary report should be submitted to the Safety Department within 24 hours after the incident. FAX: +597-430230</p>
                        <p>This form can also be submitted via the company website: www.flyslm.com</p>
                    </th>
                </tr>
            </table>

            <table class="table table-bordered table-responsive report">
                <tr>
                    <th width="20%">NAME</th>
                    <td width="80%">{{ isset($confidential_safety->name)?ucfirst($confidential_safety->name):''}}</td>
                </tr>
                <tr>
                    <th>ADDRESS</th>
                    <td>{{ isset($confidential_safety->address)?ucfirst($confidential_safety->address):'' }}</td>
                </tr>
                <tr>
                    <th>E-MAIL</th>
                    <td>{{ isset($confidential_safety->email)?ucfirst($confidential_safety->email):'' }}</td>
                </tr>
                <tr>
                    <th>TEL #</th>
                    <td>{{ isset($confidential_safety->telephone)?ucfirst($confidential_safety->telephone):'' }}</td>
                </tr>
            </table>

            <style>
                /*.border-double { border: 5px double #293a4a}*/
                .style_ol {
                    border: 1px solid #000000 !important;
                }
                .style_ol li {
                    padding: 2px;
                    line-height: 20px;
                }
            </style>
            <ol class="style_ol">
                <li>Your personal details are required only to enable the Director of Safety to contact you for further
                    details about any part of your report</li>
                <li>This is a voluntary reporting method</li>
                <li>Entering your personal details is optional</li>
                <li>You will receive an acknowledgement as soon as possible</li>
            </ol>

            <table class="table table-bordered table-responsive report" style="border: 2px solid" >
                <tr style="border: 2px solid">
                    <th width="30%" style="border: 2px solid">Function : {{ isset($confidential_safety->function)?ucfirst($confidential_safety->function):'' }}</th>
                    <th width="35%" style="border: 2px solid">Department : {{ isset($confidential_safety->department)?ucfirst($confidential_safety->department):'' }}</th>
                    <th width="35%" style="border: 2px solid">Aircraft Involved : {{ isset($confidential_safety->aircraft_involved)?ucfirst($confidential_safety->aircraft_involved):'' }}</th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="30%" style="border: 2px solid">Type of Operation : {{ isset($confidential_safety->type_of_operation)?ucfirst($confidential_safety->type_of_operation):'' }}</th>
                    <th width="35%" style="border: 2px solid">Weather : {{ isset($confidential_safety->weather)?ucfirst($confidential_safety->weather):'' }}</th>
                    <th width="35%" style="border: 2px solid">Flight Phase : {{ isset($confidential_safety->flight_phase)?ucfirst($confidential_safety->flight_phase):'' }}</th>
                </tr>

                <tr>
                    <th colspan="3"><p>Account of event – (please continue on other side or attach additional sheets if necessary)</p></th>
                </tr>
                <tr>
                    <td colspan="3" height="300px">{{ isset($confidential_safety->account_of_event)?ucfirst($confidential_safety->account_of_event):'' }}</td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    {!! Form::label('attachment', 'Attachment:', ['class' => 'control-label']) !!}
                    @if($confidential_safety->attachment)
                        <?php $expld = explode('/',$confidential_safety->attachment); ?>
                        <div>
                            <span class="glyphicon glyphicon-file"></span>&nbsp; {{ $expld[1] }}
                            <a href="{{ URL::to($confidential_safety->attachment) }}" class="btn btn-primary btn-xs" data-placement="top" download="download">Download</a><br><br>
                        </div>
                    @else
                        <div><span class="glyphicon glyphicon-remove-circle"></span> No Attachment Available</div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <a href="{{ \URL::previous() }}" class="btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
            </div>

        </div>

    </div>



@stop