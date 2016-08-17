@extends('admin::layouts.master')
@section('sidebar')
@include('admin::layouts.sidebar')
@stop

@section('content')

        <!-- page start-->
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>Pdf Manager</em>"></span>
                @if($role_id == 1)
                <a class="btn btn-primary btn-xs pull-right" href="{{ route('pdf-form') }}" data-placement="top" data-content="click add new Bulletin">
                    <strong>Add new Bulletin</strong>
                </a>
                @endif
            </div>

            <div class="panel-body">
                {{-------------- Filter :Starts -------------------------------------------}}
                {!! Form::open(['route' => 'pdf-search']) !!}

                <div id="index-search">
                    <div class="col-sm-3">
                        {!! Form::text('title',@Input::get('title')? Input::get('title') : null,['class' => 'form-control','placeholder'=>'Type Title', 'title'=>'Type Title, then click "search" button']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::Select('year',array(''=>'--select year---','2013'=>'2013','2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'),null,['class'=>'form-control ']) !!}
                    </div>
                    <div class="col-sm-3 filter-btn">
                        {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left pop btn-search-height','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type file name in specific field then click search button for required information')) !!}
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
                            <th> Title </th>
                            <th> Year </th>
                            <th> Action &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-placement="top" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for delete informations"></span></th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(isset($data))
                            @foreach($data as $values)
                                <tr class="gradeX">
                                    <td>{{ucfirst($values->title)}}</td>
                                    <td>{{$values->year}}</td>
                                    @if(@$role_id == 1)
                                    <td>
                                        <a href="{{ route('view-pdf', $values->id) }}" class="btn btn-info btn-xs" target="_blank" data-placement="top" data-content="view"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('edit-pdf', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" data-content="update"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('delete-pdf', $values->id) }}" class="btn btn-danger btn-xs" data-placement="top" onclick="return confirm('Are you sure to Delete?')" data-content="delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{ route('view-pdf', $values->id) }}" class="btn btn-info btn-xs" data-placement="top" data-content="view"><i class="fa fa-eye"></i></a>
                                    </td>
                                    @endif
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
<!-- page end-->




@stop