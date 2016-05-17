@extends('admin::layouts.master')
@section('sidebar')
@include('admin::layouts.sidebar')
@stop

@section('content')
{{--<script>
    $(window).load(function() {
        alert('sfsfsd');
        var ischecked = $(this).is(':checked');
        if (!ischecked) {
            $('#installation').hide();
        } else {
            $('#installation').show();
        }
    });
</script>--}}
        <!-- page start-->
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">{{ isset($pageTitle)?$pageTitle:'3D Channel Letters' }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>we can show all user in this page<br> and add new department, update, delete from this page</em>"></span>
            </div>

            {!! Form::open(['route' => 'store-channel', 'id' => 'form_2']) !!}
            <div class="panel-body">
                <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <div class="col-sm-8">
                            {!! Form::label('tekst', 'TEKST', ['class' => 'control-label']) !!}
                            {!! Form::text('tekst',@Input::get('tekst')? Input::get('tekst') : null,['class' => 'form-control','placeholder'=>'Enter Tekst','required','title'=>'Enter Tekst','id'=>'tekst','onkeyup'=>"Sum();"]) !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::label('aantal_letter', 'AANTAL LETTERS', ['class' => 'control-label']) !!}
                            {!! Form::text('aantal_letter',@Input::get('aantal_letter')? Input::get('aantal_letter') : null,['class' => 'form-control','required','title'=>'Enter AANTAL LETTERS', 'readonly','id'=>'aantal_letter']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('letter_hoogte', 'LETTER HOOGTE', ['class' => 'control-label']) !!}
                            {!! Form::input('number', 'letter_hoogte', @Input::get('letter_hoogte')? Input::get('letter_hoogte') : null, ['class' => 'form-control','placeholder'=>'enter letter hoogte (positive numbers only)','title'=>'enter letter hoogte','required','id'=>'letter-hoogte','onclick'=>"Sum();",'min'=>"0.0", "step"=>"0.1",'onkeyup'=>"Sum();"]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('lengte_tekst', 'LENGTE TEKST', ['class' => 'control-label']) !!}
                            {!! Form::input('number','lengte_tekst',@Input::get('lengte_tekst')? Input::get('lengte_tekst') : null,['class' => 'form-control','id'=>'lengte-tekst','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('model', 'MODEL', ['class' => 'control-label']) !!}
                            {{--{!! Form::Select('model',array('block'=>'Block','front'=>'Front','front_back'=>'Front+Back','back'=>'Back'),@Input::get('model')? Input::get('model') : null,['class'=>'form-control ','required']) !!}--}}
                            <div class="radio" style="margin-top: 0;">
                                <label>
                                    <input type="radio" name="model" id="r1" value="block" {{@$request_model == 'block' ? 'checked': '' }} required class="px">
                                    <span class="lbl">Block</span>
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="model" id="r2" value="front" {{@$request_model == 'front' ? 'checked': '' }} required class="px">
                                    <span class="lbl">Front</span>
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="model" id="r3" value="front_back" {{@$request_model == 'front_back' ? 'checked': '' }} required class="px">
                                    <span class="lbl">Front+Back</span>
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="model" id="r4" value="back" {{@$request_model == 'back' ? 'checked': '' }} required class="px">
                                    <span class="lbl">Back</span>
                                </label><br>	
								<div class="models">
									<img src="{{ URL::to('/') }}/assets/img/block.jpg" alt="block" class="block" style="width: 7%;">
									<img src="{{ URL::to('/') }}/assets/img/front.jpg" alt="front" class="front" style="width: 7%;">
									<img src="{{ URL::to('/') }}/assets/img/front_back.jpg" alt="front_back" class="front_back" style="width: 7%;">
									<img src="{{ URL::to('/') }}/assets/img/back.jpg" alt="back" class="back" style="width: 7%;">
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-------------Installation-----------------------------------------------------------------------------}}
                <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t" id="installation" style="display: none">
                    <p>&nbsp;</p>
                    <div class="panel-heading">
                        <span class="panel-title" style="margin-left: -13px;">Installation</span>&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>we can show all user in this page<br> and add new department, update, delete from this page</em>"></span>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('location', 'LOCATIE', ['class' => 'control-label']) !!}
                            {!! Form::Select('location',isset($inst_list['locatie_list'])?$inst_list['locatie_list']:'',@Input::get('location')? Input::get('location') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('background', 'ACHTERGROND', ['class' => 'control-label']) !!}
                            {!! Form::Select('background',isset($inst_list['achtergrond_list'])?$inst_list['achtergrond_list']:'',@Input::get('background')? Input::get('background') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('workheight', 'WERKHOOGTE', ['class' => 'control-label']) !!}
                            {!! Form::Select('workheight',isset($inst_list['werkhoogte_list'])?$inst_list['werkhoogte_list']:'',@Input::get('workheight')? Input::get('workheight') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('bracket', 'BRACKET', ['class' => 'control-label']) !!}
                            {!! Form::Select('bracket',isset($inst_list['bracket_list'])?$inst_list['bracket_list']:'',@Input::get('bracket')? Input::get('bracket') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                </div>

                {{--<input type="checkbox" name="myCheck" id="myCheck" onclick="check();" checked="" value="true">--}}
                @if(isset($check_value))
                    {!!  Form::checkbox('myCheck', 1, true) !!}
                @else
                    {!!  Form::checkbox('myCheck', 0, false) !!}
                @endif
                <strong>Installatie?</strong>

                <div class="form-margin-btn" style="margin-left:92%" id="bereken">
                    {!! Form::submit('Bereken', ['class' => 'btn btn-info','data-placement'=>'top','onclick'=>'myFunction();']) !!}&nbsp;
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@if(isset($data))
<div class="row">
    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><h4 class="text-center">Material List</h4></span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                              <th>Materiaal</th>
                              <th>Aantal</th>
                              <th>Eenheid</th>
                        </thead>
                        <tbody>
                        @if(isset($data['materiaal_list_details']))
                            @foreach($data['materiaal_list_details'] as $materiaal)
                                <tr class="gradeX">
                                     <td>{{$materiaal['label']}}</td>
                                     <td>{{$materiaal['aantal']}}</td>
                                     <td>{{$materiaal['eenheid']}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><h5 class="text-center">3D CHANNEL LETTERS</h5></span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <tr>
                            <th>Price</th>
                            <td>SRD &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['srd']['price'])?number_format($data['materiaal_amount']['srd']['price'], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['usd']['price'])?number_format($data['materiaal_amount']['usd']['price'], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['euro']['price'])?number_format($data['materiaal_amount']['euro']['price'], 2, '.', ''):''}}
                            </td>
                        </tr>
                        <tr>
                            <th>Tax (10.0%)</th>
                            <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['srd']['tax'])?number_format($data['materiaal_amount']['srd']['tax'], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['usd']['tax'])?number_format($data['materiaal_amount']['usd']['tax'], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['euro']['tax'])?number_format($data['materiaal_amount']['euro']['tax'], 2, '.', ''):''}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['srd']['subtotal'])?number_format($data['materiaal_amount']['srd']['subtotal'], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['usd']['subtotal'])?number_format($data['materiaal_amount']['usd']['subtotal'], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data['materiaal_amount']['euro']['subtotal'])?number_format($data['materiaal_amount']['euro']['subtotal'], 2, '.', ''):''}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!---------------------Installation----------------------------------->
    @if(isset($data['installment_amount']))
            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><h5 class="text-center">INSTALLATION</h5></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-primary">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <tr>
                                    <th>Price</th>
                                    <td>SRD &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['srd']['price'])?number_format($data['installment_amount']['srd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['usd']['price'])?number_format($data['installment_amount']['usd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['euro']['price'])?number_format($data['installment_amount']['euro']['price'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tax (8.0%)</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['srd']['tax'])?number_format($data['installment_amount']['srd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['usd']['tax'])?number_format($data['installment_amount']['usd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['euro']['tax'])?number_format($data['installment_amount']['euro']['tax'], 2, '.', ''):''}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['srd']['subtotal'])?number_format($data['installment_amount']['srd']['subtotal'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['usd']['subtotal'])?number_format($data['installment_amount']['usd']['subtotal'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['euro']['subtotal'])?number_format($data['installment_amount']['euro']['subtotal'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><h5 class="text-center">TOTAAL</h5></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-primary">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <tr>
                                    <th>Price</th>
                                    <td>SRD &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['srd']['price'])?number_format($data['final_amount']['srd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['usd']['price'])?number_format($data['final_amount']['usd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['euro']['price'])?number_format($data['final_amount']['euro']['price'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tax (10.0%)</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['srd']['tax'])?number_format($data['final_amount']['srd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['usd']['tax'])?number_format($data['final_amount']['usd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['euro']['tax'])?number_format($data['final_amount']['euro']['tax'], 2, '.', ''):''}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['srd']['total'])?number_format($data['final_amount']['srd']['total'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['usd']['total'])?number_format($data['final_amount']['usd']['total'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['euro']['total'])?number_format($data['final_amount']['euro']['total'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{----------------------Total------------------------}}
@endif





<!-- page end-->

<script src="assets/bitd/js/jquery.min.js"></script>
<!--script for this page only-->
@if($errors->any())
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });

    </script>
@endif

<script>

    function Sum(){
            var tekst = $('#tekst').val();
            var tekst_length =tekst.length ;
            ///alert(tekst.replace(/\s/g, "").length);

            $tekst = tekst.replace(/\s/g, "").length;

            var data = (tekst.replace(/\s/g, "").length) * parseFloat($('#letter-hoogte').val());
            $('#lengte-tekst').val(data.toFixed(2));
            $('#aantal_letter').val($tekst);
    }


</script>

<script>

    //document.onload = function() {
    $(function () {
        $("#form_2").validate({
            rules: {
                name: {
                    required: true,
                },
                password: {
                    required: true,
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                max: {
                    required: true,
                    maxlength: 4
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $("#form_2").validate({
            rules: {
                name: {
                    required: true,
                },
                username: {
                    required: true,
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                last_name: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                number: {
                    required: "(Please enter your phone number)",
                    number: "(Please enter valid phone number)"
                },
                last_name: {
                    required: "This is custom message for required",
                    minlength: "This is custom message for min length"
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
            errorPlacement: function (error, element) {
                $(element)
                        .closest("form")
                        .find("label[for='" + element.attr("id") + "']")
                        .append(error);
            },
            errorElement: "span",
        });
    });
    //}
</script>

    <script>
        window.onload = function() {
            $("input:checkbox").change(function () {
                var ischecked = $(this).is(':checked');
                if (!ischecked) {
                    $('#installation').hide();
                } else {
                    $('#installation').show();
                }
            });

            var ischecked = $("input:checkbox").val();
            if (ischecked == 0) {
                $('#installation').hide();
            } else {
                $('#installation').show();
            }
        }



    </script>


@stop