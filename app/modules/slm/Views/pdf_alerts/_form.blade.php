@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')

    <script src="assets/bitd/js/jquery.min.js"></script>

    <style>
        #panel_padding {
            padding: 20px;
        }
    </style>

    <div class="panel" id="panel_padding">
        {{--<div class="panel-heading" style="background-color: #0490a6">--}}
        <div style="background-color: #0490a6; height: 25px;">
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Add new Alert</b></h4>
        </div>

        {!! Form::open(['route' => 'store-pdf','files'=>'true','class' => 'form-horizontal','id' => 'form_2']) !!}

        <div class="panel-body">

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                        {!! Form::text('title', Input::old('title'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('year', 'Year:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::Select('year',array('2013'=>'2013','2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'),2016,['class'=>'form-control ','required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::hidden('pdf_type','alerts' ) !!}
                </div>

                <div style="height: 20px;"></div>

                <div class="fileupload fileupload-new btn btn-white btn-file fileupload-new fileupload-exists" data-provides="fileupload">
                    <i class="glyphicon glyphicon-file"></i>Select file</span>
                    {!! Form::file('attchment[]', array('multiple'=>true,'class'=>'default','accept'=>'application/pdf')) !!}
                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                </div>

                <div style="height: 20px;"></div>

                <div class="footer-form-margin-btn">
                    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                    <a href="{{route('alerts')}}" class=" btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
                </div>


            </div>
        </div>


        {!! Form::close() !!}

    </div>




    <script>




        //document.onload = function() {
        $(function () {
            $("#form_2").validate({
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

            $("#form_2").validate({
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