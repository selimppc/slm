<!----- For Reference Number ----------------->
<div>
    @if(isset($maintenance_occurrence_verification))
        {{--@foreach($ground_handling_verification as $values)--}}
        <div class="col-md-6" style="padding: 0px;">
            @if(isset(Auth::user()->role_id))

                {{--@if(Auth::user()->role_id == 1 && @$values->reference_no == null)
                    <a href="{{ route('reference-ground-handling', $values->id) }}" class="btn btn-info btn-xs glyphicon glyphicon-pencil" data-placement="top" data-toggle="modal" title="Enter Reference NO." data-target="#etsbModal"></a>
                @endif--}}
                @if(Auth::user()->role_id == '1' && @$maintenance_occurrence_verification->reference_no != null && @$maintenance_occurrence_verification->sent_receive == '0')
                    {{--<a href="{{ route('ground-sent-receive', $maintenance_occurrence_verification->id) }}" class="btn btn-info btn-xl" data-placement="top" data-toggle="modal" title="Send Received Report" data-target="#etsbModal">Send Received Report</a>--}}
                    <a href="{{ route('maintenance-sent-receive', $maintenance_occurrence_verification->id) }}" class="btn btn-info btn-xl" data-placement="top" data-toggle="modal" title="Send Email" data-target="#etsbModal">Send Received Report</a>
                @endif

            @endif
        </div>
        <div class="col-md-6" style="padding: 0px;">
            {!! Form::label('reference_no', 'Reference Number:', []) !!}
            @if(Auth::user()->role_id == '1' && $maintenance_occurrence_verification->reference_no == null)
                {!! Form::text('reference_no', $maintenance_occurrence_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256']) !!}
            @else
                {!! Form::text('reference_no', $maintenance_occurrence_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256','title'=>'enter reference number','readonly']) !!}
            @endif
        </div>
        {{--@endforeach--}}
    @endif
    <div class="clearfix"></div>

</div>
<!-----------------End of Reference Number ------>



<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4" style="background-color: yellow; height: 20px;">
        <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
    </div>
    <div class="col-sm-4"></div>
</div>

@if(isset($maintenance_occurrence_verification) && $maintenance_occurrence_verification->full_name)
<div class="row">
    <div class="col-sm-4">
        {!! Form::label('full_name', 'Full Name:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('full_name', $maintenance_occurrence_verification->full_name, ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::email('email',$maintenance_occurrence_verification->email,['maxlength'=>256,'class' => 'form-control','placeholder'=>'Email Address','required','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
        {!! Form::text('telephone', $maintenance_occurrence_verification->telephone, ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('extension', 'Extension:', ['class' => 'control-label']) !!}
        {!! Form::text('extension', $maintenance_occurrence_verification->extension, ['id'=>'extension', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
        {!! Form::text('fax', $maintenance_occurrence_verification->fax, ['id'=>'fax', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>

</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('date_of_occurrence', 'Date of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('date_of_occurrence', $maintenance_occurrence_verification->date_of_occurrence, ['id'=>'date_id','class' => 'form-control','readonly']) !!}
    </div>

    <div class="col-sm-4">
        {!! Form::label('time_of_occurrence', 'Time of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('time_of_occurrence', $maintenance_occurrence_verification->time_of_occurrence, ['id'=>'time_of_occurrence', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('shift', 'Shift:', ['class' => 'control-label']) !!}
        {!! Form::text('shift', $maintenance_occurrence_verification->shift, ['id'=>'shift', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('location_of_occurrence', 'Location of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('location_of_occurrence', $maintenance_occurrence_verification->location_of_occurrence, ['id'=>'location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('sub_location_of_occurrence', 'Sub-location of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('sub_location_of_occurrence', $maintenance_occurrence_verification->sub_location_of_occurrence, ['id'=>'sub_location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('mandatory', 'Mandatory:', ['class' => 'control-label']) !!}
        {!! Form::text('mandatory', $maintenance_occurrence_verification->mandatory, ['id'=>'mandatory', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('aircraft_type', 'Aircraft type:', ['class' => 'control-label']) !!}
        {!! Form::text('aircraft_type', $maintenance_occurrence_verification->aircraft_type, ['id'=>'aircraf_type', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
        {!! Form::text('registration', $maintenance_occurrence_verification->registration, ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('operator', 'Operator:', ['class' => 'control-label']) !!}
        {!! Form::text('operator', $maintenance_occurrence_verification->operator, ['id'=>'operator', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('etops', 'ETOPS:', ['class' => 'control-label']) !!}
        {!! Form::text('etops', $maintenance_occurrence_verification->etops, ['id'=>'etops', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('technical_log_ref', 'Technical log ref:', ['class' => 'control-label']) !!}
        {!! Form::text('technical_log_ref', $maintenance_occurrence_verification->technical_log_ref, ['id'=>'technical_log_ref', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('tag_or_demand_no', 'Tag/Demand No:', ['class' => 'control-label']) !!}
        {!! Form::text('tag_or_demand_no', $maintenance_occurrence_verification->tag_or_demand_no, ['id'=>'tag_or_demand_no', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('component', 'Component:', ['class' => 'control-label']) !!}
        {!! Form::text('component', $maintenance_occurrence_verification->component, ['id'=>'component', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('part_number', 'Part number:', ['class' => 'control-label']) !!}
        {!! Form::text('part_number', $maintenance_occurrence_verification->part_number, ['id'=>'part_number', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('serial_number', 'Serial number:', ['class' => 'control-label']) !!}
        {!! Form::text('serial_number', $maintenance_occurrence_verification->serial_number, ['id'=>'serial_number', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('quarantined', 'Quarantined:', ['class' => 'control-label']) !!}
        {!! Form::text('quarantined', $maintenance_occurrence_verification->quarantined, ['id'=>'quarantined', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('ata_code', 'ATA Code:', ['class' => 'control-label']) !!}
        {!! Form::text('ata_code', $maintenance_occurrence_verification->ata_code, ['id'=>'ata_code', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('ata_sub_code', 'ATA Sub Code:', ['class' => 'control-label']) !!}
        {!! Form::text('ata_sub_code', $maintenance_occurrence_verification->ata_sub_code, ['id'=>'ata_sub_code', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>

    <div class="col-sm-12">
        {!! Form::label('title_of_occurrence', 'Title of Occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('title_of_occurrence', $maintenance_occurrence_verification->title_of_occurrence, ['id'=>'title_of_occurrence', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('description_of_occurrence', 'Description of occurrence :', ['class' => 'control-label']) !!}
        {!! Form::textarea('description_of_occurrence', $maintenance_occurrence_verification->description_of_occurrence, ['id'=>'description_of_occurrence', 'class' => 'form-control','readonly']) !!}
    </div>

    <div class="col-md-12">
        <hr>
        {!! Form::label('attachment', 'Attachment:', ['class' => 'control-label']) !!}
        @if($maintenance_occurrence_verification->attachment)
            <?php $expld = explode('/',$maintenance_occurrence_verification->attachment); ?>
            <div>
                <span class="glyphicon glyphicon-file"></span>&nbsp; {{ $expld[1] }}
                <a href="{{ URL::to($maintenance_occurrence_verification->attachment) }}" class="btn btn-primary btn-xs" data-placement="top" download="download">Download</a><br><br>
            </div>
        @else
            <div><span class="glyphicon glyphicon-remove-circle"></span> No Attachment Available</div>
        @endif
        {!! Form::file('attachment',  ['id'=>'attachment', 'class' => 'form-control','title'=>'Add an attachment','disabled']) !!}
    </div>

</div>

@else

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('full_name', 'Full Name:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('full_name', Input::old('full_name'), ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::email('email',Input::old('email'),['maxlength'=>256,'class' => 'form-control','placeholder'=>'Email Address','required', 'title'=>'Enter User Email Address']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
        {!! Form::text('telephone', Input::old('telephone'), ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('extension', 'Extension:', ['class' => 'control-label']) !!}
        {!! Form::text('extension', Input::old('extension'), ['id'=>'extension', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
        {!! Form::text('fax', Input::old('fax'), ['id'=>'fax', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
    </div>

</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('date_of_occurrence', 'Date of occurrence:', ['class' => 'control-label']) !!}
        <div class="input-group date">
            {!! Form::text('date_of_occurrence', Input::old('date_of_occurrence'), ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date of occurrence']) !!}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>

    <div class="col-sm-4">
        {!! Form::label('time_of_occurrence', 'Time of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('time_of_occurrence', Input::old('time_of_occurrence'), ['id'=>'time_of_occurrence', 'class' => 'form-control','maxlength'=>'64','title'=>'enter time of occurrence']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('shift', 'Shift:', ['class' => 'control-label']) !!}
        {!! Form::text('shift', Input::old('shift'), ['id'=>'shift', 'class' => 'form-control','maxlength'=>'64','title'=>'enter time of occurrence']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('location_of_occurrence', 'Location of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('location_of_occurrence', Input::old('location_of_occurrence'), ['id'=>'location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','title'=>'enter location of occurrence']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('sub_location_of_occurrence', 'Sub-location of occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('sub_location_of_occurrence', Input::old('sub_location_of_occurrence'), ['id'=>'sub_location_of_occurrence', 'class' => 'form-control','maxlength'=>'64','title'=>'enter sub-location of occurrence']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('mandatory', 'Mandatory:', ['class' => 'control-label']) !!}
        {!! Form::text('mandatory', Input::old('mandatory'), ['id'=>'mandatory', 'class' => 'form-control','maxlength'=>'64','title'=>'enter mandatory']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('aircraft_type', 'Aircraft type:', ['class' => 'control-label']) !!}
        {!! Form::text('aircraft_type', Input::old('aircraft_type'), ['id'=>'aircraf_type', 'class' => 'form-control','maxlength'=>'64','title'=>'enter aircraft type']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
        {!! Form::text('registration', Input::old('registration'), ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','title'=>'enter registration']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('operator', 'Operator:', ['class' => 'control-label']) !!}
        {!! Form::text('operator', Input::old('operator'), ['id'=>'operator', 'class' => 'form-control','maxlength'=>'64','title'=>'enter operator']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('etops', 'ETOPS:', ['class' => 'control-label']) !!}
        {!! Form::text('etops', Input::old('etops'), ['id'=>'etops', 'class' => 'form-control','maxlength'=>'64','title'=>'enter etops']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('technical_log_ref', 'Technical log ref:', ['class' => 'control-label']) !!}
        {!! Form::text('technical_log_ref', Input::old('technical_log_ref'), ['id'=>'technical_log_ref', 'class' => 'form-control','maxlength'=>'64','title'=>'enter technical log ref']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('tag_or_demand_no', 'Tag/Demand No:', ['class' => 'control-label']) !!}
        {!! Form::text('tag_or_demand_no', Input::old('tag_or_demand_no'), ['id'=>'tag_or_demand_no', 'class' => 'form-control','maxlength'=>'64','title'=>'enter tag/demand no']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('component', 'Component:', ['class' => 'control-label']) !!}
        {!! Form::text('component', Input::old('component'), ['id'=>'component', 'class' => 'form-control','maxlength'=>'64','title'=>'enter component']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('part_number', 'Part number:', ['class' => 'control-label']) !!}
        {!! Form::text('part_number', Input::old('part_number'), ['id'=>'part_number', 'class' => 'form-control','maxlength'=>'64','title'=>'enter part number']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('serial_number', 'Serial number:', ['class' => 'control-label']) !!}
        {!! Form::text('serial_number', Input::old('serial_number'), ['id'=>'serial_number', 'class' => 'form-control','maxlength'=>'64','title'=>'enter serial number']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('quarantined', 'Quarantined:', ['class' => 'control-label']) !!}
        {!! Form::text('quarantined', Input::old('quarantined'), ['id'=>'quarantined', 'class' => 'form-control','maxlength'=>'64','title'=>'enter quarantined']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('ata_code', 'ATA Code:', ['class' => 'control-label']) !!}
        {!! Form::text('ata_code', Input::old('ata_code'), ['id'=>'ata_code', 'class' => 'form-control','maxlength'=>'64','title'=>'enter ATA code']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('ata_sub_code', 'ATA Sub Code:', ['class' => 'control-label']) !!}
        {!! Form::text('ata_sub_code', Input::old('ata_sub_code'), ['id'=>'ata_sub_code', 'class' => 'form-control','maxlength'=>'64','title'=>'enter ATA sub code']) !!}
    </div>

    <div class="col-sm-12">
        {!! Form::label('title_of_occurrence', 'Title of Occurrence:', ['class' => 'control-label']) !!}
        {!! Form::text('title_of_occurrence', Input::old('title_of_occurrence'), ['id'=>'title_of_occurrence', 'class' => 'form-control','title'=>'enter title of occurrence']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('description_of_occurrence', 'Description of occurrence :', ['class' => 'control-label']) !!}
        {!! Form::textarea('description_of_occurrence', Input::old('description_of_occurrence'), ['id'=>'description_of_occurrence', 'class' => 'form-control','title'=>'Enter description of the occurrence']) !!}
    </div>

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
</div>
@endif