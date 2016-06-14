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
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                {{--<span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>all user role define from this page, example : system-user or admin</em>"></span>
                <a class="btn btn-primary btn-xs pull-right csv-margin" href="{{ route('add-operational-safety') }}" data-placement="top" data-content="Click to add new Dangerous Goods Occurrence report">
                    <strong>Add new Dangerous Goods Occurrence report</strong>
                </a>

                <a href="{{ route('operation-csv') }}" class="btn btn-info btn-xs pull-right" data-placement="top"><strong>Download CSV</strong></a>--}}
                <div class="col-md-6 title-div">
                    <span class="panel-title">{{ $pageTitle }}</span>
                    <div class="padding-tb"></div>
                </div>

                <div class="col-md-6 buttons-div">
                    <a class="btn btn-primary btn-xs margin-bot-5" href="{{ route('add-operational-safety') }}" data-placement="top" data-content="Click to add new Dangerous Goods Occurrence report">
                        <strong>Add new Dangerous Goods Occurrence report</strong>
                    </a>
                    <a href="{{ route('operation-csv') }}" class="btn btn-info btn-xs margin-bot-5 " data-placement="top"><strong>Download CSV</strong></a>

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
                                    {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left pop btn-search-height','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type full name in specific field then click search button for required information')) !!}
                                </span>
                            </div>

                            {!! Form::close() !!}
                            {{-------------- Filter :Ends -------------------------------------------}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered ml-table-1" id="jq-datatables-example">
                            <thead>
                            <tr>
                                <th> Operator </th>
                                <th> Occurrence Date</th>
                                <th> Flight Date</th>
                                <th> Flight No</th>
                                <th> Action &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-placement="top" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for delete informations"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($operational_safety))
                                @foreach($operational_safety as $values)
                                    <tr class="gradeX">
                                        <td>{{ucfirst($values->operator)}}</td>
                                        <td>{{ date("M d, Y", strtotime($values->date_of_occurrence)) }}</td>
                                        <td>{{ date("M d, Y", strtotime($values->flight_date)) }}</td>
                                        <td>{{$values->flight_no}}</td>
                                        <td>
                                            {{--@if(isset(Auth::user()->role_id))

                                                @if(Auth::user()->role_id == 1 && @$values->reference_no == null)
                                                    <a href="{{ route('reference-operational-safety', $values->id) }}" class="btn btn-info btn-xs glyphicon glyphicon-pencil" data-placement="top" data-toggle="modal" title="Enter Reference NO." data-target="#etsbModal"></a>
                                                @endif
                                                @if(Auth::user()->role_id == 1 && @$values->reference_no != null && @$values->sent_receive == 0)
                                                    <a href="{{ route('operational-sent-receive', $values->id) }}" class="btn btn-info btn-xs glyphicon glyphicon-envelope" data-placement="top" data-toggle="modal" title="Send Email" data-target="#etsbModal"></a>
                                                @endif

                                            @endif--}}
                                            <a href="{{ route('view-operational-safety', $values->id) }}" class="btn btn-info btn-xs" data-placement="top" ><strong>View</strong></a>
                                            <a href="{{ route('edit-operational-safety', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" ><strong>Update</strong></a>
                                            <a href="{{ route('delete-operational-safety', $values->id) }}" class="btn btn-danger btn-xs" data-placement="top" onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-trash-o"></i></a>
                                            @if($values->attachment=="")
                                                <button class="btn btn-default btn-xs" style="cursor: default;"><span class="glyphicon glyphicon-remove"></span></button>
                                            @else
                                                <button class="btn btn-warning btn-xs" style="cursor: default;"><span class="glyphicon glyphicon-ok"></span></button>
                                                {{--<a href="{{ URL::to($values->attachment) }}" class="btn btn-primary btn-xs" data-placement="top" download="download"><span class="glyphicon glyphicon-ok"></span></a>--}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <span class="pull-left">{!! str_replace('/?', '?', $operational_safety->appends(Input::except('page'))->render()) !!} </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page end-->

<div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


        </div>
    </div>
</div>
<!-- modal -->



@stop