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
            <h4 class="text-center text-green"><b style="color: #f5f5f5">Safety Bulletin Update Informations</b></h4>
        </div>

        {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-pdf', $data->id],'files'=>'true','id' => 'jq-validation-form']) !!}

        <div class="panel-body">

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                        {!! Form::text('title', Input::old('title'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::hidden('pdf_type','bulletin' ) !!}
                </div>


                <div style="height: 20px;"></div>

                <div class="fileupload fileupload-new btn btn-white btn-file fileupload-new fileupload-exists" data-provides="fileupload">
                    <i class="glyphicon glyphicon-file"></i>Select file</span>
                    {!! Form::file('attchment[]', array('multiple'=>true,'class'=>'default','accept'=>'application/pdf')) !!}
                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                </div>

                <div class="form-group">
                    @if(isset($data))
                            <div class="row">
                                <div>
                                    <a href="{{ URL::to($data->file_name) }}" onclick="return confirm('Are you sure to Download?')" download>
                                        <img src="{{ URL::to('file.png') }}" height="60px" width="60px" alt="{{$data->file_name}}" />
                                        {{$data->file_name}}
                                    </a>
                                    {{--<span style="cursor:pointer" class="btn-danger" onclick="deleteFile(this.id)" id="{{ $data->id }}" ><i class="icon-trash"></i>Delete </span>--}}
                                </div>
                            </div>
                    @endif
                </div>

                <div style="height: 20px;"></div>

                <div class="footer-form-margin-btn">
                    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                    <a href="{{route('safety-bulletin')}}" class=" btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
                </div>


            </div>
        </div>


        {!! Form::close() !!}

    </div>

    <script>
        function deleteFile(id){

            var confirm_message = confirm('Are you sure');
            if(confirm_message) {
                var msg_id = id;
                $.ajax({
                    url: '{{URL::to("delete-files")}}/'+msg_id,
                    type: 'GET',
                    //data: { id: message_id },
                    success: function(response)
                    {
                        $( "#"+msg_id+"" ).remove();
                        alert("successfully deleted");

                    }
                });
            }

        }


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