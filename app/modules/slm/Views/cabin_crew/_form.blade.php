<!----- For Reference Number ----------------->
<div>
    @if(isset($cabin_crew_verification))
        {{--@foreach($ground_handling_verification as $values)--}}
        <div class="col-md-6" style="padding: 0px;">
            @if(isset(Auth::user()->role_id))

                @if(Auth::user()->role_id == '1' && @$cabin_crew_verification->reference_no != null && @$cabin_crew_verification->sent_receive == '0')
                    <a href="{{ route('cabin-sent-receive', $cabin_crew_verification->id) }}" class="btn btn-info btn-xl" data-placement="top" data-toggle="modal" title="Send Received Report" data-target="#etsbModal">Send Received Report</a>
                @endif

            @endif
        </div>
        <div class="col-md-6" style="padding: 0px;">
            {!! Form::label('reference_no', 'Reference Number:', []) !!}
            @if(Auth::user()->role_id == '1' && $cabin_crew_verification->reference_no == null)
                {!! Form::text('reference_no', $cabin_crew_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256']) !!}
            @else
                {!! Form::text('reference_no', $cabin_crew_verification->reference_no, ['id'=>'reference_no', 'class' => 'form-control','maxlength'=>'256','title'=>'enter reference number','readonly']) !!}
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
@if(isset($cabin_crew_verification) && $cabin_crew_verification->full_name)
<div class="row">
    <div class="col-sm-4">
        {!! Form::label('full_name', 'Full Name:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('full_name', $cabin_crew_verification->full_name, ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::email('email',$cabin_crew_verification->email,['class' => 'form-control','placeholder'=>'Email Address','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('telephone', $cabin_crew_verification->telephone, ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('extension', 'Extension:', ['class' => 'control-label']) !!}
        {!! Form::text('extension', $cabin_crew_verification->extension, ['id'=>'extension', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
        {!! Form::text('fax', $cabin_crew_verification->fax, ['id'=>'fax', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('captain', 'Captain:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('captain', $cabin_crew_verification->captain, ['id'=>'captain', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-2">
        <br>
        {!! Form::radio('pf_pnf', 'pf', false,array('disabled')) !!} PF
        {!! Form::radio('pf_pnf', 'pnf', true,array('disabled')) !!} PNF




    </div>
    <div class="col-sm-4">
        {!! Form::label('co_pilot', 'Co Pilot:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('co_pilot', $cabin_crew_verification->co_pilot, ['id'=>'co_pilot', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-2">
        <br>
        {!! Form::radio('pf_pnf2', 'pf', false,array('disabled')) !!} PF
        {!! Form::radio('pf_pnf2', 'pnf', true,array('disabled')) !!} PNF
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('others', 'Others:', ['class' => 'control-label']) !!}
        {!! Form::text('others', $cabin_crew_verification->others, ['id'=>'others', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('purser', 'Purser:', ['class' => 'control-label']) !!}
        {!! Form::text('purser', $cabin_crew_verification->purser, ['id'=>'purser', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('date', $cabin_crew_verification->date, ['class' => 'form-control','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
        {!! Form::text('time', $cabin_crew_verification->time, ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>

    <div class="col-sm-4">
        <br>
        {!! Form::radio('utc_local', 'utc', (@$request_model == 'utc' ? 'checked': ''),array('disabled')) !!} UTC
        {!! Form::radio('utc_local', 'local', (@$request_model == 'local' ? 'checked': ''),array('disabled')) !!} Local
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('air_craft_type', 'Air Craft Type:', ['class' => 'control-label']) !!}
        {!! Form::text('air_craft_type', $cabin_crew_verification->air_craft_type, ['id'=>'air_craft_type', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('registration', $cabin_crew_verification->registration, ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('flight_no', 'Flight No:', ['class' => 'control-label']) !!}
        {!! Form::text('flight_no', $cabin_crew_verification->flight_no, ['id'=>'flight_no', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('from', 'From:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('from', $cabin_crew_verification->from, ['id'=>'from', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('to', 'To:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('to', $cabin_crew_verification->to, ['id'=>'to', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('flt_diverted_to', 'FLT Diverted To:', ['class' => 'control-label']) !!}
        {!! Form::text('flt_diverted_to', $cabin_crew_verification->flt_diverted_to, ['id'=>'flt_diverted_to', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
</div>



<div class="row">
    <div class="col-sm-4">
        {!! Form::label('assigned_door', 'Assigned Door:', ['class' => 'control-label']) !!}
        {!! Form::text('assigned_door', $cabin_crew_verification->assigned_door, ['id'=>'assigned_door', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('position_during_event', 'Position During Event:', ['class' => 'control-label']) !!}
        {!! Form::text('position_during_event', $cabin_crew_verification->position_during_event, ['id'=>'position_during_event', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('nr_of_pax', 'NR of Pax:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_pax', $cabin_crew_verification->nr_of_pax, ['id'=>'nr_of_pax', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('nr_of_crew', 'NR of Crew:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_crew', $cabin_crew_verification->nr_of_crew, ['id'=>'nr_of_crew', 'class' => 'form-control','maxlength'=>'64','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('previous_flights', 'Previous Flights', ['class' => 'control-label']) !!}
        {!! Form::text('previous_flights', $cabin_crew_verification->previous_flights, ['id'=>'previous_flights', 'class' => 'form-control','maxlength'=>'200','readonly']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('nr_of_landings_of_the_day', 'NR of Landings of the Day:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_landings_of_the_day', $cabin_crew_verification->nr_of_landings_of_the_day, ['id'=>'nr_of_landings_of_the_day', 'class' => 'form-control','maxlength'=>'200','readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        {!! Form::label('flight_phase', 'Flight Phase:', ['class' => 'control-label']) !!}
        <br>
        {!! Form::radio('flight_phase', 'parked', true,array('disabled')) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'push_back', false,array('disabled')) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'taxi_out', false,array('disabled')) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'take_off', false,array('disabled')) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'initial_climb', false,array('disabled')) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'climb', false,array('disabled')) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;

        {!! Form::radio('flight_phase', 'cruise', false,array('disabled')) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'holding', false,array('disabled')) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'descent', false,array('disabled')) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'approach', false,array('disabled')) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'landing', false,array('disabled')) !!} LANDING&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'taxi_in', false,array('disabled')) !!} TAXI IN
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        {!! Form::label('description_of_occurrence', 'Description Of Occurrence:', ['class' => 'control-label']) !!}
        {!! Form::textarea('description_of_occurrence', @$data[0]['description_of_occurrence'], ['size' => '6x5', 'class' => 'form-control','readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        {!! Form::label('attachment', 'Attachment:', ['class' => 'control-label']) !!}
        @if($cabin_crew_verification->attachment)
            <?php $expld = explode('/',$cabin_crew_verification->attachment); ?>
            <div>
                <span class="glyphicon glyphicon-file"></span>&nbsp; {{ $expld[1] }}
                <a href="{{ URL::to($cabin_crew_verification->attachment) }}" class="btn btn-primary btn-xs" data-placement="top" download="download">Download</a><br><br>
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
        {!! Form::text('full_name', Input::old('full_name'), ['id'=>'full_name', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::email('email',Input::old('email'),['class' => 'form-control','placeholder'=>'Email Address','required', 'title'=>'Enter User Email Address']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('telephone', 'Telephone No:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('telephone', Input::old('telephone'), ['id'=>'telephone', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
</div>

<div class="row">
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
        {!! Form::label('captain', 'Captain:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('captain', Input::old('captain'), ['id'=>'captain', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-2">
        <br>
        {!! Form::radio('pf_pnf', 'pf', true, ['onClick' => 'abc(this.value)']) !!} PF
        {!! Form::radio('pf_pnf', 'pnf', false, ['onClick' => 'abc(this.value)']) !!} PNF


    </div>
    <div class="col-sm-4">
        {!! Form::label('co_pilot', 'Co Pilot:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('co_pilot', Input::old('co_pilot'), ['id'=>'co_pilot', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-2">
        <br>
        {!! Form::radio('pf_pnf2', 'pf', null, ['id'=>'pf2']) !!} PF
        {!! Form::radio('pf_pnf2', 'pnf', null,  ['id'=>'pnf2']) !!} PNF
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('others', 'Others:', ['class' => 'control-label']) !!}
        {!! Form::text('others', Input::old('others'), ['id'=>'others', 'class' => 'form-control','maxlength'=>'64','title'=>'enter other']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('purser', 'Purser:', ['class' => 'control-label']) !!}
        {!! Form::text('purser', Input::old('purser'), ['id'=>'purser', 'class' => 'form-control','maxlength'=>'64','title'=>'enter purser']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        <div class="input-group date">
            {!! Form::text('date', Input::old('date'), ['class' => 'form-control bs-datepicker-component','title'=>'select date','required']) !!}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="col-sm-4">
        {!! Form::label('time', 'Time:', ['class' => 'control-label']) !!}
        {!! Form::text('time', Input::old('time'), ['id'=>'time', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name']) !!}
    </div>

    <div class="col-sm-4">
        <br>
        {!! Form::radio('utc_local', 'utc', (@$request_model == 'utc' ? 'checked': '')) !!} UTC
        {!! Form::radio('utc_local', 'local', (@$request_model == 'local' ? 'checked': '')) !!} Local
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('air_craft_type', 'Air Craft Type:', ['class' => 'control-label']) !!}
        {!! Form::text('air_craft_type', Input::old('air_craft_type'), ['id'=>'air_craft_type', 'class' => 'form-control','maxlength'=>'64','title'=>'enter air craft type']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('registration', 'Registration:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('registration', Input::old('registration'), ['id'=>'registration', 'class' => 'form-control','maxlength'=>'64','title'=>'enter full name','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('flight_no', 'Flight No:', ['class' => 'control-label']) !!}
        {!! Form::text('flight_no', Input::old('flight_no'), ['id'=>'flight_no', 'class' => 'form-control','maxlength'=>'64','title'=>'enter Flight No']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('from', 'From:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('from', Input::old('from'), ['id'=>'from', 'class' => 'form-control','maxlength'=>'64','title'=>'enter From Flight','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('to', 'To:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('to', Input::old('to'), ['id'=>'to', 'class' => 'form-control','maxlength'=>'64','title'=>'enter To Flight','required']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('flt_diverted_to', 'FLT Diverted To:', ['class' => 'control-label']) !!}
        {!! Form::text('flt_diverted_to', Input::old('flt_diverted_to'), ['id'=>'flt_diverted_to', 'class' => 'form-control','maxlength'=>'64','title'=>'enter FLT diverted to']) !!}
    </div>
</div>



<div class="row">
    <div class="col-sm-4">
        {!! Form::label('assigned_door', 'Assigned Door:', ['class' => 'control-label']) !!}
        {!! Form::text('assigned_door', Input::old('assigned_door'), ['id'=>'assigned_door', 'class' => 'form-control','maxlength'=>'64','title'=>'Enter assigned door']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('position_during_event', 'Position During Event:', ['class' => 'control-label']) !!}
        {!! Form::text('position_during_event', Input::old('position_during_event'), ['id'=>'position_during_event', 'class' => 'form-control','maxlength'=>'64','title'=>'enter position during event']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('nr_of_pax', 'NR of Pax:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_pax', Input::old('nr_of_pax'), ['id'=>'nr_of_pax', 'class' => 'form-control','maxlength'=>'64','title'=>'enter NR of pax']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('nr_of_crew', 'NR of Crew:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_crew', Input::old('nr_of_crew'), ['id'=>'nr_of_crew', 'class' => 'form-control','maxlength'=>'64','title'=>'enter NR of crew']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('previous_flights', 'Previous Flights', ['class' => 'control-label']) !!}
        {!! Form::text('previous_flights', Input::old('previous_flights'), ['id'=>'previous_flights', 'class' => 'form-control','maxlength'=>'200','title'=>'enter previous flights']) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('nr_of_landings_of_the_day', 'NR of Landings of the Day:', ['class' => 'control-label']) !!}
        {!! Form::text('nr_of_landings_of_the_day', Input::old('nr_of_landings_of_the_day'), ['id'=>'nr_of_landings_of_the_day', 'class' => 'form-control','maxlength'=>'200','title'=>'enter NR of landings of the day']) !!}
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        {!! Form::label('flight_phase', 'Flight Phase:', ['class' => 'control-label']) !!}
        <br>
        {!! Form::radio('flight_phase', 'parked', true) !!} PARKED &nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'push_back', false) !!} PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'taxi_out', false) !!} TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'take_off', false) !!} TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'initial_climb', false) !!} INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'climb', false) !!} CLIMB&nbsp;&nbsp;&nbsp;&nbsp;

        {!! Form::radio('flight_phase', 'cruise', false) !!} CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'holding', false) !!} HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'descent', false) !!} DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'approach', false) !!} APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'landing', false) !!} LANDING&nbsp;&nbsp;
        {!! Form::radio('flight_phase', 'taxi_in', false) !!} TAXI IN
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        {!! Form::label('description_of_occurrence', 'Description Of Occurrence:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::textarea('description_of_occurrence', @$data[0]['description_of_occurrence'], ['size' => '6x5', 'class' => 'form-control','title'=>'enter description of occurrence','required']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
        {!! Form::label('attachment', 'Attachment:', ['class' => 'control-label']) !!}
        <small class="required">(max size 300kb)</small>
        {!! Form::file('attachment', Input::old('attachment'), ['id'=>'attachment', 'class' => 'form-control','title'=>'Add an attachment']) !!}
    </div>
</div>
@endif

<script>

    $(document).ready(function () {
        $("#pnf2").prop('checked', true);
    });

    function abc(val){
        if(val=='pf'){
            $('#pnf2').prop('checked', true);
        }else if(val=='pnf'){
            $('#pf2').prop('checked', true);
        }
    }

</script>