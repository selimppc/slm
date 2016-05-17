@extends('user::layouts.signup')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3><b>Registration</b></h3>

            </div>
            <div class="hpanel">
                <div class="panel-body">

                    {!! Form::open(['route' => 'signup','id'=>'form_2']) !!}
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Username</label>
                                {!! Form::text('username', Input::old('username'), ['name'=>'username', 'class' => 'form-control','required','placeholder'=>'Username','autofocus', 'title'=>'Enter User Name']) !!}
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Email Address</label>
                                {!! Form::email('email', Input::old('email'), ['id'=>'email','class' => 'form-control','required','placeholder'=>'E-mail','title'=>'Enter Email Address']) !!}
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Password</label>
                                {!! Form::password('password', ['id'=>'regis-user-password','class' => 'form-control','required','placeholder'=>'Password','title'=>'Enter Password']) !!}
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Repeat Password</label>
                                {!! Form::password('repeat_password', ['id'=>'regis-password','class' => 'form-control','required','placeholder'=>'Password','title'=>'Enter Password','onkeyup'=>"validation()"]) !!}
                                <span id='rs-show-message'></span>
                            </div>

                        </div>
                        <div class="pull-right">
                            <button class="btn btn-success" id="resg-btn-disabled">Register</button>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

{{--<script src="assets/bitd/js/jquery.min.js"></script>--}}
<script>

    function validation() {
        $('#regis-password').on('keyup', function () {
            if ($(this).val() == $('#regis-user-password').val()) {

                $('#rs-show-message').html('');
                document.getElementById("resg-btn-disabled").disabled = false;
                return false;
            }
            else $('#rs-show-message').html('confirm password do not match with new password,please check.').css('color', 'red');
            document.getElementById("resg-btn-disabled").disabled = true;
        });
    }

</script>
