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
                <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>all user role define from this page, example : system-user or admin</em>"></span>
                <a class="btn btn-primary btn-xs pull-right csv-margin" href="{{ route('add-cabin-crew') }}" data-placement="top" data-content="Click to add new Cabin Crew report">
                    <strong>Add new Cabin Crew report</strong>
                </a>

                <a href="{{ route('cabin-csv') }}" class="btn btn-info btn-xs pull-right" data-placement="top"><strong>Download CSV</strong></a>

            </div>

            <div class="panel-body">
                {{-------------- Filter :Starts -------------------------------------------}}
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

                {{-------------- Filter :Ends -------------------------------------------}}
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
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

                        @if(isset($cabin_crews))
                            @foreach($cabin_crews as $values)
                                <tr class="gradeX">
                                    <td>{{ucfirst($values->full_name)}}</td>
                                    <td>{{ucfirst($values->email)}}</td>
                                    <td>{{$values->captain}}</td>
                                    <td>{{$values->date}}</td>
                                    <td>{{$values->from}}</td>
                                    <td>{{$values->to}}</td>
                                    <td>
                                        <a href="{{ route('view-cabin-crew', $values->id) }}" class="btn btn-info btn-xs" data-placement="top" ><strong>View</strong></a>
                                        <a href="{{ route('edit-cabin-crew', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" ><strong>Update</strong></a>
                                        <a href="{{ route('delete-cabin-crew', $values->id) }}" class="btn btn-danger btn-xs" data-placement="top" onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <span class="pull-left">{!! str_replace('/?', '?', $cabin_crews->appends(Input::except('page'))->render()) !!} </span>
            </div>
        </div>
    </div>
</div>
<!-- page end-->



@stop