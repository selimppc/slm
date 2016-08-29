<script src="assets/bitd/js/jquery.min.js"></script>
<script src="assets/bitd/js/bootstrap.min.js"></script>

<script src="assets/bitd/js/validation.js"></script>


<link rel="stylesheet" href="assets/bitd/css/bootstrap-datepicker3.min.css">

{{--datepicker--}}
<script src="assets/bitd/js/bootstrap-datepicker.min.js"></script>

<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>


<div class="modal-body">
        {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-user', $data->id],'id'=>'update']) !!}
        {!! Form::hidden('id', $data->id) !!}

    <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::label('username', 'UserName:', ['class' => 'control-label']) !!}
                {!! Form::text('username',Input::old('username'),['class' => 'form-control','placeholder'=>'User Name','required','autofocus', 'title'=>'Enter User Name']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
                {!! Form::email('email',Input::old('email'),['class' => 'form-control','placeholder'=>'Email Address','required', 'title'=>'Enter User Email Address']) !!}
            </div>
        </div>
    </div>

    <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="row">
            <div class="col-sm-6">
               {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
                <div class="checkbox" style="margin: 0;">
                    <label>
                        <input type="checkbox" value="yes" class="px" id="checkbox">
                        <span class="lbl narration">Do you want to change password?</span>
                    </label>
                </div>
                <div id="pass-old">
                    {!! Form::hidden('password',$data['password']) !!}
                    {!! Form::text('password1',null,['class' => 'form-control','placeholder'=>'Password','title'=>'Enter User Password','readonly']) !!}
                </div>
                <div style="display: none;" id="field-password">
                    {!! Form::password('password2',['id'=>'edit-user-password','class' => 'form-control','placeholder'=>'Password','title'=>'Enter User Password','required'=>'required']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div style="margin-top: 20px;">
                    {!! Form::label('confirm_password', 'Confirm Password') !!}
                    <div id="re-pass">
                        {!! Form::password('re_password',['class' => 'form-control','placeholder'=>'Re-Enter New Password','name'=>'re_password','onkeyup'=>"validation()",'title'=>'Enter Confirm Password That Must Be Match With New Password.','readonly']) !!}
                    </div>
                    <div style="display: none" id="field-con-password">
                        {!! Form::password('re_password',['class' => 'form-control','placeholder'=>'Re-Enter New Password','id'=>'user-re-password','name'=>'re_password','onkeyup'=>"validation()",'title'=>'Enter Confirm Password That Must Be Match With New Passowrd.','required'=>'required']) !!}
                    </div>
                </div>
                <span id='user-show-message'></span>

            </div>
        </div>
    </div>
    <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::label('role_id', 'User Role:', ['class' => 'control-label']) !!}
                {!! Form::Select('role_id',$role, Input::old('role_id'),['style'=>'text-transform:capitalize','class' => 'form-control','required','title'=>'select role name']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::label('department_id', 'Department:', ['class' => 'control-label']) !!}
                    {!! Form::Select('department_id', $department_data, Input::old('department_id'),['class' => 'form-control','required','title'=>'select department name']) !!}
            </div>
        </div>
    </div>
    <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::label('expire_date', 'Expire Date:', ['class' => 'control-label']) !!}
                <div class="input-group date">
                    @if(isset($data->expire_date))
                        {!! Form::text('expire_date', Input::old('expire_date'), ['class' => 'form-control bs-datepicker-component','required','title'=>'select expire date']) !!}
                    @else
                        {!! Form::text('expire_date', $days, ['class' => 'form-control bs-datepicker-component','required','title'=>'select expire date']) !!}
                    @endif

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-sm-6">
                {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
                <small class="narration">(Inactive status Selected)</small>
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['class'=>'form-control ','required']) !!}
            </div>
        </div>
    </div>

    <div class="save-margin-btn">
        {!! Form::submit('Save changes', ['id'=>'user-btn-disabled','class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        <a href="{{route('user-list')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>

        {!! Form::close() !!}
</div>

<script>
    $(function(){

        $('.datapicker2').datepicker({
            format: 'yyyy/mm/dd (D)',
        });
        $('.input-group.date').datepicker({
        });
        $('.input-daterange').datepicker({ });

    });
</script>


<script>

    $(".btn").popover({ trigger: "manual" , html: true, animation:false})
            .on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide");
                    }
                }, 300);
            });


    $(".form-control").tooltip();
    $('input:disabled, button:disabled').after(function (e) {
        d = $("<div>");
        i = $(this);
        d.css({
            height: i.outerHeight(),
            width: i.outerWidth(),
            position: "absolute",
        })
        d.css(i.offset());
        d.attr("title", i.attr("title"));
        d.tooltip();
        return d;
    });

    function validation() {
        $('#user-re-password').on('keyup', function () {
            if ($(this).val() == $('#edit-user-password').val()) {

                $('#user-show-message').html('');
                document.getElementById("user-btn-disabled").disabled = false;
                return false;
            }
            else $('#user-show-message').html('confirm password do not match with new password,please check.').css('color', 'red');
            document.getElementById("user-btn-disabled").disabled = true;
        });
    }


    //change password checkbox....
    $('#checkbox').change(function (){

        var check_value = $("#checkbox").is(":checked");
        if(check_value){
            $('#pass-old').hide();
            $('#re-pass').hide();
            $('#field-password').show();
            $('#field-con-password').show();
        }else{
            $('#pass-old').show();
            $('#re-pass').show();
            $('#field-password').hide();
            $('#field-con-password').hide();
        }

    })

</script>

<script>


    $(function () {
        $("#update").validate({
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

        $("#update").validate({
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

</script>


