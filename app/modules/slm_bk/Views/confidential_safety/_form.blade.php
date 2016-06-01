

<div class="row">
    {!! Form::label('name', 'Name:', ['class' => 'control-label col-md-3']) !!}
    <small class="required">(Required)</small>
    <div class="col-sm-6">
        {!! Form::text('name', Input::old('name'), ['id'=>'name', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter name','required'=>'required']) !!}
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
    <small class="required">(Required)</small>
    <div class="col-sm-6">
        {!! Form::email('email', Input::old('email'), ['id'=>'email', 'class' => 'form-control','maxlength'=>'256','title'=>'Enter email','required'=>'required']) !!}
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
        {!! Form::textarea('account_of_event', Input::old('account_of_event'), ['id'=>'account_of_event', 'class' => 'form-control','title'=>'Enter account_of_event']) !!}
    </div>
</div>