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
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Add new Cabin Crew report</b></h4>
        </div>

        {!! Form::open(['route' => 'store-cabin-crew','class' => 'form-horizontal','id' => 'form_2']) !!}

        <div class="panel-body">

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

                @include('slm::cabin_crew._form')
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-12">
                        <div class="footer-form-margin-btn">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                            <a href="{{route('air-safety')}}" class=" btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
                        </div>
                    </div>
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