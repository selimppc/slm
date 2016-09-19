

<div class="row">
    {!! Form::label('name', 'Name:', ['class' => 'control-label col-md-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', Input::old('name'), ['class' => 'form-control','maxlength'=>'64','title'=>'Enter name']) !!}
    </div>
</div><br>
<div class="row">
    {!! Form::label('address', 'Address:', ['class' => 'control-label col-md-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('address', Input::old('address'), ['id'=>'address', 'class' => 'form-control','maxlength'=>'200','title'=>'Enter address']) !!}
    </div>
</div><br>
<div class="row">
    {!! Form::label('email', 'Email:', ['class' => 'control-label col-md-3']) !!}
    <div class="col-sm-6">
        {!! Form::email('email', Input::old('email'), ['id'=>'email', 'class' => 'form-control','maxlength'=>'256','title'=>'Enter email']) !!}
    </div>
</div><br>
<div class="row">
    {!! Form::label('telephone', 'Telephone:', ['class' => 'control-label col-md-3']) !!}

    <div class="col-sm-6">
        {!! Form::text('telephone', Input::old('telephone'), ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter telephone']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div  style="border: double 1px black;padding: 20px;margin:30px;">
            <ul>
                <li>Your personal details are required only to enable the Director of Safety to contact you for further
                    details about any part of your report</li>
                <li>This is a voluntary reporting method</li>
                <li>Entering your personal details is optional</li>
                <li>You will receive an acknowledgement as soon as possible</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        {!! Form::label('function', 'Function:', ['class' => 'control-label']) !!}
        {!! Form::text('function', Input::old('function'), ['id'=>'function', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter function']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('department', 'Department:', ['class' => 'control-label']) !!}
        {!! Form::text('department', Input::old('department'), ['id'=>'department', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter department']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('aircraft_involved', 'Aircraft Involved:', ['class' => 'control-label']) !!}
        {!! Form::text('aircraft_involved', Input::old('aircraft_involved'), ['id'=>'aircraft_involved', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter aircraft_involved']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('type_of_operation', 'Type of Operation:', ['class' => 'control-label']) !!}
        {!! Form::text('type_of_operation', Input::old('type_of_operation'), ['id'=>'type_of_operation', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter type_of_operation']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('weather', 'Weather:', ['class' => 'control-label']) !!}
        {!! Form::text('weather', Input::old('weather'), ['id'=>'weather', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter weather']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('flight_phase', 'Flight Phase:', ['class' => 'control-label']) !!}
        {!! Form::text('flight_phase', Input::old('flight_phase'), ['id'=>'flight_phase', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter flight_phase']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('account_of_event', 'Account of Event:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::textarea('account_of_event', Input::old('account_of_event'), ['id'=>'account_of_event', 'class' => 'form-control','title'=>'Enter account_of_event','required'=>'required']) !!}
    </div>

    @if(isset($cabin_crew_verification) && $cabin_crew_verification->name)

    <div class="col-md-12">
        <hr>
        {!! Form::label('attachment', 'Attachment:', ['class' => 'control-label']) !!}
        @foreach($data_image as $image)

            <?php $expld = explode('/',$image->image_path); ?>
            @if(isset($image->image_path))
                <div>
                    <span class="glyphicon glyphicon-file"></span>&nbsp; {{ $expld[1] }}
                    <a href="{{ URL::to($image->image_path) }}" class="btn btn-primary btn-xs" data-placement="top" download="download">Download</a><br><br>
                </div>
            @else
                <div><span class="glyphicon glyphicon-remove-circle"></span> No Attachment Available</div>
            @endif
        @endforeach
    </div>

    @else

    <div class="col-md-12">
        <hr>
        {!! Form::label('attachment', 'Attachment:', ['class' => 'control-label']) !!}
        <small class="required"></small>
        {{--{!! Form::file('attachment', Input::old('attachment'), ['id'=>'attachment', 'class' => 'form-control','title'=>'Add an attachment']) !!}--}}
        <div class="col-md-12 image-center">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                {{--<div class="fileupload-new thumbnail" style="width: 120px; height: 120px;   ">--}}
                {{--@if($data['image'] != '')
                    <a href="{{ route('gal_image.image.show', $data['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data['image']) }}" height="50px" width="50px" alt="{{$data['image']}}" />
                    </a>
                @else--}}
                {{--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />--}}
                {{--{!! Form::file('images[]', array('multiple'=>true)) !!}--}}
                {{--@endif--}}
                {{--</div>--}}
                {{--<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>--}}
                <div class="image-center">
                    <input type="file" name="attachment[]" id="attachment" class="default" multiple />
                </div>
            </div>
            {{--<span class="label label-danger"><font size="1">NOTE!</font></span>
            <span style="color: white"><font size="1">System will allow these types of image(png,jpeg,jpg Format)</font></span>--}}
        </div>
    </div>

    @endif
</div>