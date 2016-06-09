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
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Edit Maintenance Occurrence report</b></h4>
        </div>

        {!! Form::model($maintenance_occurrence, ['method' => 'PATCH', 'route'=> ['update-maintenance-occurrence', $maintenance_occurrence->id],'class' => 'form-horizontal','files'=>true]) !!}
        <div class="panel-body">
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                @include('slm::maintenance_occurrence._form')
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-12" style="text-align: center">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary','data-placement'=>'top']) !!}&nbsp;
                            <a href="{{ URL::previous() }}" class=" btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
                    </div>
                </div>
            </div>
        </div>


        {!! Form::close() !!}

    </div>

    <div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">


            </div>
        </div>
    </div>
    <!-- modal -->

@stop