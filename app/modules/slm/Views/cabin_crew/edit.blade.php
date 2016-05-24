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
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Edit Cabin Crew report</b></h4>
        </div>

{{--        {!! Form::open(['route' => 'store-cabin-crew','class' => 'form-horizontal','id' => 'form_2']) !!}--}}
        {!! Form::model($cabin_crew, ['method' => 'PATCH', 'route'=> ['update-cabin-crew', $cabin_crew->id],'id' => 'jq-validation-form']) !!}
        <div class="panel-body">

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div style="background-color: yellow; height: 20px;">
                    <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
                </div>
                @include('slm::cabin_crew._form')
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