@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')


    <div class="panel">
        <div style="background-color: #0490a6">
            <h3 class="text-center text-green"><b style="color: #f5f5f5">Dangerous Goods Occurrence report</b></h3>
        </div>

        <div>
            <a href="{{ route('dangerous-pdf', $operational_safety->id) }}" class="btn btn-primary pull-right col-xs-2"><strong>Print Pdf</strong></a>
        </div>

        <div style="height: 25px"></div>

        <div class="panel-body">

            <table class="table table-bordered table-responsive" width="100%">
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="7">GENERAL INFORMATION</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">
                        Mark type of Occurrence :
                        {!! Form::radio('type_of_occurrence','accident',(@$operational_safety->type_of_occurrence == 'accident'? 'checked': '')) !!} Accident
                        {!! Form::radio('type_of_occurrence','incident',(@$operational_safety->type_of_occurrence == 'incident'? 'checked': '')) !!} Incident
                        {!! Form::radio('type_of_occurrence','other_occurrence',(@$operational_safety->type_of_occurrence == 'other_occurrence'? 'checked': '')) !!} Other Occurrence
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">1. Operator : {{ isset($operational_safety->operator)?ucfirst($operational_safety->operator):''}}</th>
                    <th width="25%" style="border: 2px solid">2. Date of Occurrence : {{ isset($operational_safety->date_of_occurrence)?ucfirst($operational_safety->date_of_occurrence):''}}</th>
                    <th width="25%" style="border: 2px solid">3. Local time of Occurrence : {{ isset($operational_safety->local_time_of_occurrence)?ucfirst($operational_safety->local_time_of_occurrence):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">4. Flight date : {{ isset($operational_safety->flight_date)?ucfirst($operational_safety->flight_date):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">5. Flight no: : {{ isset($operational_safety->flight_no)?ucfirst($operational_safety->flight_no):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">6. Departure airport : {{ isset($operational_safety->departure_airport)?ucfirst($operational_safety->departure_airport):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">7. Destination airport : {{ isset($operational_safety->destination_airport)?ucfirst($operational_safety->destination_airport):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">8. Aircraft type : {{ isset($operational_safety->aircraft_type)?ucfirst($operational_safety->aircraft_type):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">9. Aircraft registration : {{ isset($operational_safety->aircraft_registration)?ucfirst($operational_safety->aircraft_registration):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">10. Location of occurrence : {{ isset($operational_safety->location_of_occurrence)?ucfirst($operational_safety->location_of_occurrence):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">11. Origin of the goods : {{ isset($operational_safety->origin_of_the_goods)?ucfirst($operational_safety->origin_of_the_goods):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">12. Description of the occurrence including details of injury, damage, etc.(if necessary continue on the next page) : {{ isset($operational_safety->description_of_the_occurrence)?ucfirst($operational_safety->description_of_the_occurrence):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">13. Proper shipping name (including the technical name) : {{ isset($operational_safety->proper_shipping_name)?ucfirst($operational_safety->proper_shipping_name):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">14. UN/ID no (when known) : {{ isset($operational_safety->un_or_id_no)?ucfirst($operational_safety->un_or_id_no):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">15. Class/division (when known) : {{ isset($operational_safety->class_or_division)?ucfirst($operational_safety->class_or_division):''}}</th>
                    <th width="25%" style="border: 2px solid">16. Subsidiary risk(s) : {{ isset($operational_safety->subsidiary_risks)?ucfirst($operational_safety->subsidiary_risks):''}}</th>
                    <th width="25%" style="border: 2px solid">17. Packing group : {{ isset($operational_safety->packing_group)?ucfirst($operational_safety->packing_group):''}}</th>
                    <th width="25%" style="border: 2px solid">18. Category, (class 7 only) : {{ isset($operational_safety->category)?ucfirst($operational_safety->category):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">19. Type of packaging : {{ isset($operational_safety->type_of_packaging)?ucfirst($operational_safety->type_of_packaging):''}}</th>
                    <th width="25%" style="border: 2px solid">20 Packaging specification marking : {{ isset($operational_safety->packaging_specification_marking)?ucfirst($operational_safety->packaging_specification_marking):''}}</th>
                    <th width="25%" style="border: 2px solid">21. No. of packages : {{ isset($operational_safety->no_of_packages)?ucfirst($operational_safety->no_of_packages):''}}</th>
                    <th width="25%" style="border: 2px solid">22. Quantity (or transport index. If applicable : {{ isset($operational_safety->quantity)?ucfirst($operational_safety->quantity):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">23. Reference no. of Airway bill : {{ isset($operational_safety->reference_no_of_airway_bill)?ucfirst($operational_safety->reference_no_of_airway_bill):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">24. Reference no. of courier pouch, baggage tag, or passenger ticket : {{ isset($operational_safety->reference_no_of_courier)?ucfirst($operational_safety->reference_no_of_courier):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">25. Name and address of shipper, agent, passenger, etc. : {{ isset($operational_safety->name_and_address_of_shipper_agent_passenger)?ucfirst($operational_safety->name_and_address_of_shipper_agent_passenger):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">26. Other relevant information (including suspected cause, any action taken) : {{ isset($operational_safety->other_relevant_information)?ucfirst($operational_safety->other_relevant_information):''}}</th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">27. Name and title of person making report : {{ isset($operational_safety->name_and_title_of_person_making_report)?ucfirst($operational_safety->name_and_title_of_person_making_report):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">28. Telephone no. : {{ isset($operational_safety->telephone_no)?ucfirst($operational_safety->telephone_no):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">29. Company dept. code, E-mail or Info Mail code : {{ isset($operational_safety->company_contact)?ucfirst($operational_safety->company_contact):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">30. Reporter ref : {{ isset($operational_safety->reporter_ref)?ucfirst($operational_safety->reporter_ref):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">31. Address : {{ isset($operational_safety->address)?ucfirst($operational_safety->address):''}}</th>
                    <th width="50%" style="border: 2px solid" colspan="2">32. Date / Signature : {{ isset($operational_safety->date_of_signature)?ucfirst($operational_safety->date_of_signature):''}}</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">33. Description of the occurrence (continuation) : {{ isset($operational_safety->description_of_the_occurrence)?ucfirst($operational_safety->description_of_the_occurrence):''}}</th>
                </tr>
            </table>

            <style>
                /*.border-double { border: 5px double #293a4a}*/
                .style_ol {
                    border: 1px solid #000000 !important;
                }
                .style_ol li {
                    padding: 2px;
                    line-height: 20px;
                }
            </style>
            <ol class="style_ol">
                <p style="text-align: left"><b>Note:</b></p>
                <li>Any type of dangerous goods occurrence must be reported, irrespective of whether the dangerous good are
                    contained in cargo, mail or baggage.</li>
                <li>A dangerous goods accident is an occurrence associated with and related to the transport of dangerous goods
                    which result in fatal or serious injury to a person or major property damage. For this purpose, serious injury is an
                    injury which is sustained by a person in an accident and which: (a) requires hospitalization for more than 48 hours,
                    commencing from the time the injury was received;(b) result in a fracture of any bones (except small fractures of
                    fingers, toes or nose) ;(c) involves lacerations which cause severe haemorrhage, nerve, muscle or tendon damage;
                    (d) involves injury to any internal organ; (e) involves second or third degree burns; or any burns affecting more than
                    5% of the body surface; or (f) involves verified exposure to infectious substances or injurious radiation. A dangerous
                    goods accident may also be an aircraft accident; in which case the normal procedure for dangerous goods accidents
                    must be followed.</li>
                <li>A dangerous goods incident is an occurrence, other than a dangerous goods accident, associated with and related
                    to the transport of dangerous goods, not necessarily occurring on board an aircraft, which results in injury to a
                    person, property damage, fire ,breakage ,spillage ,leakage of fluid or radiation or other evidence that the integrity of
                    the packing has not been maintained. Any occurrence relating to the transport of dangerous goods which seriously
                    jeopardizes the aircraft or its occupants is also deemed to constitute a dangerous goods incident.</li>
                <li>This form may also be used to report any occasion when undeclared or misdeclared dangerous goods are
                    discovered in cargo or when baggage contains dangerous goods which passengers are not permitted to take on
                    board aircraft.</li>
                <li>An initial report should be dispatched within 72 hours of the occurrence, unless exceptional circumstances prevent
                    this. The initial report may be made by any means but a written report should be sent as soon as possible, even if all
                    the information is not available.</li>
                <li>Completed reports are normally sent to the competent authority.</li>
                <li>Copies of all relevant documents should be included with the report.</li>
                <li>Providing it is safe to do so, all dangerous goods, packaging’s, documents etc. relating to the occurrence must be
                    retained until after the initial report has been made.</li>
                <li>Requirements and procedures differ from state to state, it is recommended that the local competent authority be
                    contacted in order to clarify the exact procedures to be followed in the event of a dangerous goods incident or
                    accident.</li>
            </ol>

            <div class="footer-form-margin-btn">
                <a href="{{ \URL::previous() }}" class="btn btn-info" data-placement="top" data-content="click close button for close this entry form">Back</a>
            </div>

        </div>

    </div>



@stop