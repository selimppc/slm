@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')
    <style>
        #panel_padding {
            padding: 20px;
        }
    </style>

    <div class="panel" id="panel_padding">
        <div style="background-color: #0490a6; height: 25px;">
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Add new Dangerous Goods Occurrence report</b></h4>
        </div>

        {!! Form::open(['route' => 'store-operational-safety','class' => 'form-horizontal','files'=>true]) !!}
        <div class="panel-body">

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                @include('slm::operational_safety._form')
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12" style="text-align: center;">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary','id'=>'i_submit']) !!}&nbsp;
                        <a href="{{ URL::to('operational-safety') }}" class=" btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
                    </div>
                </div>
            </div>
        </div>


        {!! Form::close() !!}

    </div>

    {{--@include('slm::operational_safety._script')--}}
@stop