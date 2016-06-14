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
                <div class="container-fluid">
                    <div class="col-sm-12">
                        <div class="row padding-tb">
                            {{-------------- Filter :Starts -------------------------------------------}}
                            {!! Form::open(['route' => 'safety-search']) !!}

                                <div class="input-group">
                                    {!! Form::text('full_name',@Input::get('full_name')? Input::get('full_name') : null,['class' => 'form-control','placeholder'=>'Type Full Name', 'title'=>'Type your required Name "full name", then click "search" button']) !!}
                                    <span class="input-group-btn">
                                          {!! Form::submit('Search', array('class'=>'btn btn-primary','id'=>'button', 'data-placement'=>'right','style="padding:6px; font-size:11px"')) !!}
                                      </span>
                                </div>

                            {!! Form::close() !!}
                            {{-------------- Filter :Ends -------------------------------------------}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-responsive ml-table" id="jq-datatables-example">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Email</th>
                                <th> Captain</th>
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
                                        <td>{{date("M d, Y", strtotime($values->date))}}</td>
                                        <td>{{$values->from}}</td>
                                        <td>{{$values->to}}</td>
                                        <td>
                                            <a href="{{ route('view-safety', $values->id) }}" class="btn btn-info btn-xs" data-placement="top"><strong>View</strong></a>
                                            <a href="{{ route('upd-safety', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top"><strong>Update</strong></a>
                                            <a href="{{ route('delete-safety', $values->id) }}" class="btn btn-danger btn-xs" data-placement="top" onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-trash-o"></i></a>
                                            @if($values->attachment=="")
                                                <button class="btn btn-default btn-xs" style="cursor: default;"><span class="glyphicon glyphicon-remove"></span></button>
                                            @else
                                                <button class="btn btn-primary btn-xs" style="cursor: default;"><span class="glyphicon glyphicon-ok"></span></button>
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