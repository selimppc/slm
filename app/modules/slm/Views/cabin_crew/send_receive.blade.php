{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-cabin-sendreceive', $data], 'files'=>true]) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }} &nbsp;&nbsp;<?php //print_r($signature); ?><span style="color: #A54A7B" class="user-guideline" data-content="<em>system fill account type and voucher number <br> Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>

<div class="modal-body">

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-12">
        <div>
            {!! Form::label('regards', 'Regards:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('regards', null, ['id'=>'regards', 'class' => 'form-control','maxlength'=>'256','title'=>'enter regards','required']) !!}
        </div>
    </div>

</div>


<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('cabin-crew')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>

{!! Form::close() !!}

<script>

    $(function () {
        $('form').submit(function(){
            if (typeof ($("#image")[0].files) != "undefined") {
                var size = parseFloat($("#image")[0].files[0].size / 1024).toFixed(2);
                if(size>100){
                    alert( "File Size Greater than 100 KB.");
                    return false;
                }else{
                    return true;
                }

            } else {
                alert("This browser does not support HTML5.");
                return false;
            }
        });
    });



</script>