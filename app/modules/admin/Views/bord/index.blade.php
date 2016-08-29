@extends('admin::layouts.master')
@section('sidebar')
@include('admin::layouts.sidebar')
@stop

@section('content')

        <!-- page start-->
<div class="row">
    {{--3D Channel Letters--}}
    <div class="col-lg-4">
        <div class="hpanel">
            <div class="panel-body text-center">
                <br>
                <a class="" data-toggle="modal" href="{{route('channel')}}" data-placement="top" data-content="3D channel letters entry form" style="margin-left:1%"><i class="channel fa fa-file-text"></i>
                    <br>
                    <span style="font-size:medium;">3D Channel Letters</span>
                </a>
                <br>
            </div>
        </div>
    </div>

    {{--addAchter--}}
    <div class="col-lg-4">
        <div class="hpanel">
            <div class="panel-body text-center">
                <br>
                <a class="" data-toggle="modal" href="{{route('achtergrond')}}" data-placement="top" data-content="achtergrond bord entry form" style="margin-left:1%"> <i class="achter fa fa-file-text"></i>
                    <br>
                    <span style="font-size:medium">Achtergrond Bord</span>
                </a>
                <br>
            </div>
        </div>
    </div>

    {{--Lichtbakken--}}
    <div class="col-lg-4">
        <div class="hpanel">
            <div class="panel-body text-center">
                <br>
                <a class="" data-toggle="modal" href="{{route('lichtbakken')}}" data-placement="top" data-content="lichtbakken entry form" style="margin-left:1%"><i class="lich fa fa-file-text"></i>
                    <br>
                    <span style="font-size:medium">Lichtbakken</span>
                </a>
                <br>
            </div>
        </div>
    </div>
</div>
<!-- page end-->


@stop