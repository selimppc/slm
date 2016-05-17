<div style="background-color: yellow; height: 20px;">
    <h5 class="text-center text-black"><b style="color: black">GENERAL INFORMATION</b></h5>
</div>

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
        {!! Form::input('date','date_of_occurrence', Input::old('date_of_occurrence'), ['id'=>'date_of_occurrence', 'class' => 'form-control','title'=>'enter date of occurrence']) !!}
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
        {!! Form::text('title_of_occurrence', Input::old('title_of_occurrence'), ['id'=>'title_of_occurrence', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title of occurrence']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('description_of_occurrence', 'Description of occurrence :', ['class' => 'control-label']) !!}
        {!! Form::textarea('description_of_occurrence', Input::old('description_of_occurrence'), ['id'=>'description_of_occurrence', 'class' => 'form-control','title'=>'Enter description of the occurrence']) !!}
    </div>
</div>