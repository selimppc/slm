{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-maintenance-ref', $data], 'files'=>true]) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }} &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>system fill account type and voucher number <br> Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>

<div class="modal-body">

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-12">
        <div>
            {!! Form::label('reference_no', 'Reference Number:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('reference_no', null, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256','title'=>'enter reference number','required']) !!}
        </div>
    </div>

</div>

<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('maintenance-occurrence')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>

{!! Form::close() !!}