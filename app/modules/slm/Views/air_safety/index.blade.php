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
    <div class="col-sm-6">
        <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>all user role define from this page, example : system-user or admin</em>"></span>
    </div>
    <div class="col-sm-6">
        <a class="btn btn-primary btn-xs pull-right btn-sm col-xs-2 csv-margin" href="{{ route('safety-form') }}" data-placement="top" data-content="Click to add new Air Safety report">Add new Air Safety report</a>
        <a href="{{ route('view-csv') }}" class="btn btn-info btn-xs pull-right" data-placement="top"><strong>Download CSV</strong></a>
    </div>
</div>--}}

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="col-md-6 title-div">
                    <span class="panel-title">{{ $pageTitle }}</span>{{--&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>all user role define from this page, example : system-user or admin</em>"></span>--}}
                    <div class="padding-tb"></div>
                </div>

                <div class="col-md-6 buttons-div">
                    {{--<a class="btn btn-primary btn-xs pull-right btn-sm col-xs-2 csv-margin" href="{{ route('safety-form') }}" data-placement="top" data-content="Click to add new Air Safety report">Add new Air Safety report</a>--}}
                    <a class="btn btn-primary btn-xs margin-bot-5" href="{{ route('safety-form') }}"><strong>Add new Air Safety report</strong></a>
                    <a href="{{ route('view-csv') }}" class="btn btn-info btn-xs margin-bot-5" data-placement="top"><strong>Download CSV</strong></a>
                    <div class="padding-tb"></div>
                </div>
            </div>

            <div class="panel-body">
                {{-------------- Filter :Starts -------------------------------------------}}
                {!! Form::open(['route' => 'safety-search']) !!}

                <div id="index-search">
                    <div class="col-sm-3">
                        {!! Form::text('full_name',@Input::get('full_name')? Input::get('full_name') : null,['class' => 'form-control','placeholder'=>'Type Full Name', 'title'=>'Type your required Name "full name", then click "search" button']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::Select('year',array(''=>'--select year---','2013'=>'2013','2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'),null,['class'=>'form-control ']) !!}
                    </div>
                    <div class="col-sm-3 filter-btn">
                        {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left pop','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
                    </div>
                </div>
                <p> &nbsp;</p>
                <p> &nbsp;</p>

                {!! Form::close() !!}

                {{-------------- Filter :Ends -------------------------------------------}}
                <div class="col-sm-12">
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-responsive ml-table" id="jq-datatables-example">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Email</th>
                                <th> Captain</th>
                                <th> Year </th>
                                <th> Date </th>
                                <th> From </th>
                                <th> To </th>
                                <th> Action &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-placement="top" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for delete informations"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($data))
                                @foreach($data as $values)
                                    <tr class="gradeX">
                                        <td>{{ucfirst($values->full_name)}}</td>
                                        <td>{{ucfirst($values->email)}}</td>

                                        <td>{{$values->captain}}</td>
                                        <td>{{$values->year}}</td>
                                        <td>{{date("M d, Y", strtotime($values->date))}}</td>
                                        <td>{{$values->from}}</td>
                                        <td>{{$values->to}}</td>
                                        <td>
                                            <a href="{{ route('view-safety', $values->id) }}" class="btn btn-info btn-xs" data-placement="top"><strong>View</strong></a>
                                            <a href="{{ route('upd-safety', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top"><strong>Update</strong></a>
                                            <a href="{{ route('delete-safety', $values->id) }}" class="btn btn-danger btn-xs" data-placement="top" onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-trash-o"></i></a>

                                            @if(count($values->relSaftyImage)>0)
                                                <button class="btn btn-primary btn-xs" style="cursor: default;"><span class="glyphicon glyphicon-ok"></span></button>

                                            @else
                                                <button class="btn btn-default btn-xs" style="cursor: default;"><span class="glyphicon glyphicon-remove"></span></button>
                                                {{--<a href="{{ URL::to($values->attachment) }}" class="btn btn-primary btn-xs" data-placement="top" download="download"><span class="glyphicon glyphicon-ok"></span></a>--}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                <span class="pull-left">{!! str_replace('/?', '?', $data->appends(Input::except('page'))->render()) !!} </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page end-->




@stop