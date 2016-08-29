<div class="form-group">
    {!!  Form::label('Upload Excel') !!}
    {!! Form::file('excel_file',['class'=>'form-control','required'=>'required']) !!}
</div>

<div class="save-margin-btn">
    {!! Form::submit('Save changes', ['id'=>'btn-disabled','class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
    <a href="{{route('user-list')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>




