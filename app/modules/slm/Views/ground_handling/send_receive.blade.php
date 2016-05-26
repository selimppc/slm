{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-ground-sendreceive', $data], 'files'=>true]) !!}

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
{{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-12">

    {!! Form::label('Signature Upload', 'Signature Upload:', []) !!}
    <small class="required">(Required)</small>

    <div class="col-md-12 image-center">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 120px; height: 120px;">
                --}}{{--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />--}}{{--
                @if(isset($signature))
                    <img src="{{ URL::to($signature->thumbnail) }}" width="100px" height="100px">
                @endif
            </div>
            --}}{{--<div class="image-center">
                <input type="file" name="image" id="image" class="default" max-size="32154" />
            </div>--}}{{--
        </div>


        --}}{{--<input type="file" id="fileUpload" />
        <input type="button" value="Upload" onclick="Upload()" />--}}{{--


        <span class="label label-danger">NOTE!</span>
                                             <span>
                                             System will allow these types of image(png,jpeg,jpg Format)
                                             </span>
    </div>
</div>--}}

<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('ground-handling')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
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