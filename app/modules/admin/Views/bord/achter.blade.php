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
                <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>we can show all user in this page<br> and add new department, update, delete from this page</em>"></span>
            </div>

            <div class="panel-body">
                {!! Form::open(['id' => 'achter']) !!}
                <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('shoort_bord', 'SOORT BORD', ['class' => 'control-label']) !!}
                            {!! Form::Select('shoort_bord',array('banner'=>'Banner','banner_met_grip'=>'Banner Met Grip','acm'=>'ACM (Maxmetal)','acm_hd'=>'ACM (Maxmetal HD) '),Input::old('shoort_bord'),['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('lengte_bord', 'LENGTE BORD', ['class' => 'control-label']) !!}
                            {!! Form::input('number','lengte_bord',Input::old('lengte_bord'),['class' => 'form-control','placeholder'=>'Enter lengte bord (numbers only)','required','title'=>'Enter lengte bord']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('breedte_bord', 'BREEDTE BORD', ['class' => 'control-label']) !!}
                            {!! Form::input('number','breedte_bord',Input::old('breedte_bord'),['class' => 'form-control','placeholder'=>'Enter breedte bord (numbers only)','required','title'=>'Enter breedte bord']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('acm_spuiten', 'ACM Spuiten ?', ['class' => 'control-label']) !!}
                            {!! Form::Select('acm_spuiten',array('ja'=>'Ja','nee'=>'Nee'),Input::old('acm_spuiten'),['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-margin-btn" style="margin-left:92%">
                    {!! Form::submit('Bereken', ['class' => 'btn btn-info','data-placement'=>'top']) !!}&nbsp;
                    {{--<a href="{{route('bord')}}" class="pull-right btn btn-info" data-placement="top" data-content="click close button for close this entry form">Bereken</a>--}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- page end-->

<script src="assets/bitd/js/jquery.min.js"></script>
<!--script for this page only-->
@if($errors->any())
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });

    </script>
@endif




<script>

    //document.onload = function() {
    $(function () {
        $("#achter").validate({
            rules: {
                name: {
                    required: true,
                },
                password: {
                    required: true,
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                max: {
                    required: true,
                    maxlength: 4
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $("#achter").validate({
            rules: {
                name: {
                    required: true,
                },
                username: {
                    required: true,
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                last_name: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                number: {
                    required: "(Please enter your phone number)",
                    number: "(Please enter valid phone number)"
                },
                last_name: {
                    required: "This is custom message for required",
                    minlength: "This is custom message for min length"
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
            errorPlacement: function (error, element) {
                $(element)
                        .closest("form")
                        .find("label[for='" + element.attr("id") + "']")
                        .append(error);
            },
            errorElement: "span",
        });
    });
    //}
</script>

@stop