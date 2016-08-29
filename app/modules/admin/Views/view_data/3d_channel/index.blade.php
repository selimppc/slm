@extends('admin::layouts.master')
@section('sidebar')
@include('admin::layouts.sidebar')
@stop

@section('content')

        <!-- page start-->
<div class="row">
    <a class="btn btn-info btn-xs pull-right pop" href="{{route('channel')}}" data-placement="left" data-content="Click to redirect in 3D Channel Letters page" style="margin-right:18px;">
        <strong>Go to 3D Channel Letters</strong>
    </a>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <div class="panel">

            <div class="panel-heading">
                <span class="panel-title">Material List</span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data[0] as $values)
                                <tr class="gradeX">
                                    <td>{{$values}}</td>
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
                <span class="panel-title">3D CHANNEL LETTERS</span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <tr>
                            <th>Price</th>
                            <td>SRD &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data[7])?number_format($data[7], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data[8])?number_format($data[8], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data[9])?number_format($data[9], 2, '.', ''):''}}
                            </td>
                        </tr>
                        <tr>
                            <th>Tax (10.0%)</th>
                             <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 {{isset($data[4])?number_format($data[4], 2, '.', ''):''}}
                             </td>
                             <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 {{isset($data[5])?number_format($data[5], 2, '.', ''):''}}
                             </td>
                             <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 {{isset($data[6])?number_format($data[6], 2, '.', ''):''}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data[1])?number_format($data[1], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data[2])?number_format($data[2], 2, '.', ''):''}}
                            </td>
                            <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{isset($data[3])?number_format($data[3], 2, '.', ''):''}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page end-->

@stop