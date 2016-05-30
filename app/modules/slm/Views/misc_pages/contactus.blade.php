@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')
    <style>
        .csv-margin{
            margin-left: 10px !important;
        }
    </style>
    <!-- page start-->
    {{--<div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>all user role define from this page, example : system-user or admin</em>"></span>
                    <a class="btn btn-primary btn-xs pull-right csv-margin" href="{{ route('add-maintenance-occurrence') }}" data-placement="top" data-content="Click to add new Maintenance Occurrence report">
                        <strong>Add new Maintenance Occurrence report</strong>
                    </a>

                    <a href="{{ route('maintenance-csv') }}" class="btn btn-info btn-xs pull-right" data-placement="top"><strong>Download CSV</strong></a>

                </div>

                <div class="panel-body">
                    --}}{{-------------- Filter :Starts -------------------------------------------}}{{--
                    {!! Form::open(['route' => 'safety-search']) !!}

                    <div id="index-search">
                        <div class="col-sm-3">
                            {!! Form::text('full_name',@Input::get('full_name')? Input::get('full_name') : null,['class' => 'form-control','placeholder'=>'Type Full Name', 'title'=>'Type your required Name "full name", then click "search" button']) !!}
                        </div>
                        <div class="col-sm-3 filter-btn">
                            {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left pop btn-search-height','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type full name in specific field then click search button for required information')) !!}
                        </div>


                    </div>
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>

                    {!! Form::close() !!}

                    --}}{{-------------- Filter :Ends -------------------------------------------}}{{--
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Email</th>
                                <th> Telephone</th>
                                <th> Fax</th>
                                <th> Action &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-placement="top" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for delete informations"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($maintenance_occurrence))
                                @foreach($maintenance_occurrence as $values)
                                    <tr class="gradeX">
                                        <td>{{ucfirst($values->full_name)}}</td>
                                        <td>{{$values->email}}</td>
                                        <td>{{$values->telephone}}</td>
                                        <td>{{$values->fax}}</td>
                                        <td>
                                            --}}{{--@if(isset(Auth::user()->role_id))

                                                @if(Auth::user()->role_id == 1 && @$values->reference_no == null)
                                                    <a href="{{ route('reference-maintenance-occurrence', $values->id) }}" class="btn btn-info btn-xs glyphicon glyphicon-pencil" data-placement="top" data-toggle="modal" title="Enter Reference NO." data-target="#etsbModal"></a>
                                                @endif
                                                @if(Auth::user()->role_id == 1 && @$values->reference_no != null && @$values->sent_receive == 0)
                                                    <a href="{{ route('maintenance-sent-receive', $values->id) }}" class="btn btn-info btn-xs glyphicon glyphicon-envelope" data-placement="top" data-toggle="modal" title="Send Email" data-target="#etsbModal"></a>
                                                @endif

                                            @endif--}}{{--
                                            <a href="{{ route('view-maintenance-occurrence', $values->id) }}" class="btn btn-info btn-xs" data-placement="top" ><strong>View</strong></a>
                                            <a href="{{ route('edit-maintenance-occurrence', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" ><strong>Update</strong></a>
                                            <a href="{{ route('delete-maintenance-occurrence', $values->id) }}" class="btn btn-danger btn-xs" data-placement="top" onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <span class="pull-left">{!! str_replace('/?', '?', $maintenance_occurrence->appends(Input::except('page'))->render()) !!} </span>
                </div>
            </div>
        </div>
    </div>--}}
    <style>
        .contact-table { border: 0px!important;}
        .contact-table tr,.contact-table tr td { border:0px!important; }
        .border-1 {border-top:3px solid #c0c0c0;}
        .border-2 {border-top:3px solid #cc8989;}
        .border-3 {border-top:3px solid #89cc89;}
        .border-4 {border-top:3px solid #565689;}
        .heading-1 { color:#303030; font-size: 15px;}
        .heading-2 { color:#895656; font-size: 15px;}
        .heading-3 { color:#568956; font-size: 15px;}
        .heading-4 { color:#565689; font-size: 15px;}
        .contact-table tr td div { padding:10px 0; margin:0px; font-size:13px; background: linear-gradient(272deg,#f9f9f9,#ffffff); box-shadow: 2px 2px 5px #f0f0f0;  }
        .contact-table tr td div ul { list-style:none;}
        .contact-table tr td div ul li { line-height: 30px;}
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="panel" style="padding:2%;">
                <div class="table-primary">
                    <table class="table contact-table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th colspan="2" style="font-size:16px;">SAFETY DEPARTMENT CONTACT INFORMATION (PBM/SD/PY) : </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="border-1">
                                        <ul>
                                            <li><strong class="heading-1">Director of Safety :</strong></li>
                                            <li><strong>Mr. Steven R.V. Gonesh</strong></li>
                                            <li><span class="glyphicon glyphicon-earphone"></span> Tel: (+597) 464140 (direct)</li>
                                            <li><span class="glyphicon glyphicon-earphone"></span> Tel: (+597) 465700 ext.262</li>
                                            <li><span class="glyphicon glyphicon-phone"></span> Mobile: (+597) 8602002</li>
                                            <li><span class="glyphicon glyphicon-envelope"></span> E-Mail: s.gonesh@flyslm.com, srvgonesh@yahoo.com</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="border-2">
                                        <ul>
                                            <li><strong class="heading-2">Office :</strong></li>
                                            <li><strong>Mr. Jagernath Lachmonstraat 136</strong></li>
                                            <li>P.O. Box 2029</li>
                                            <li></li>Paramaribo</li>
                                            <li></li>Suriname</li>
                                            <li><span class="glyphicon glyphicon-envelope"></span> E-mail: safety@flyslm.com</li>
                                            <li><span style="color:#ffaaaa">(for reports ONLY)</span></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="border-3">
                                        <ul>
                                            <li><strong class="heading-3">Safety Officer :</strong></li>
                                            <li><strong>Mr. Orlando Mahendrepersad</strong></li>
                                            <li><span class="glyphicon glyphicon-earphone"></span> Tel: (+597) 465700 ext.364</li>
                                            <li><span class="glyphicon glyphicon-phone"></span> Mobile: (+597) 8553222</li>

                                            <li><span class="glyphicon glyphicon-envelope"></span> E-mail:  o.mahendrepersad@flyslm.com, orlando.mah@gmail.com</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="border-4">
                                        <ul>
                                            <li><strong class="heading-4">Technical Administrator :</strong></li>
                                            <li><strong>Mr. Lucas Tjin-Asjoe</strong></li>
                                            <li><span class="glyphicon glyphicon-earphone"></span> Tel: (+597) 465700 ext 313</li>
                                            <li><span class="glyphicon glyphicon-phone"></span> Mobile: (+597) 8711821</li>
                                            <li><span class="glyphicon glyphicon-envelope"></span> E-mail: safetytech@flyslm.com</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@stop