
{!! Form::open(['route' => 'create-user', 'id' => 'form_2', 'files'=>'true']) !!}


<div class="panel-heading">
    <div class="col-md-6 title-div">
        <div class="padding-tb"></div>
    </div>

    <div class="col-md-6 buttons-div">
        <a href="{{ route('download-user-excel') }}" class="btn btn-info btn-xs pull-right" data-placement="top"><strong>Download User Excel</strong></a>
    </div>
</div>


<div class="form-group">
    {!!  Form::label('Upload Excel') !!}
    {!! Form::file('excel_file',['class'=>'form-control','required'=>'required']) !!}
</div>

<div class="save-margin-btn">
    {!! Form::submit('Save changes', ['id'=>'btn-disabled','class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
    <a href="{{route('user-list')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>



{!! Form::close() !!}
