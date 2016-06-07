@extends('admin::layouts.master')
@section('sidebar')
@include('admin::layouts.sidebar')
@stop

@section('content')

<script src="assets/bitd/js/jquery.min.js"></script>

<div class="panel">
    <div style="background-color: #0490a6">
        <h3 class="text-center text-green"><b style="color: #f5f5f5">View PDF Manager Information</b></h3>
    </div>

    <div class="panel-body">
        <table id="" class="table table-bordered table-hover table-striped">
            <tr>
                <th class="col-lg-2">File Name</th>
                <td>{{ isset($data->file_name)?ucfirst($data->file_name):''}}</td>
            </tr>

            <tr>
                <th class="col-lg-2">File Path</th>
                <td>{{ isset($data->file_path)?ucfirst($data->file_path):''}}</td>
            </tr>

        </table>

        <div class="footer-form-margin-btn">
            <a href="{{route('safety-manuals')}}" class="btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
        </div>

    </div>

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