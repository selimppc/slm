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
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Edit Confidential Safety report</b></h4>
        </div>

        {!! Form::model($confidential_safety, ['method' => 'PATCH', 'route'=> ['update-confidential-safety', $confidential_safety->id],'class' => 'form-horizontal']) !!}
        <div class="panel-body">
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                @include('slm::confidential_safety._form')
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-12">
                        <div class="footer-form-margin-btn">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary','data-placement'=>'top']) !!}&nbsp;
                            <a href="{{ URL::previous() }}" class=" btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {!! Form::close() !!}

    </div>

@stop