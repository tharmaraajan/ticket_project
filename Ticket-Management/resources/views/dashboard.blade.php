@extends('layouts.nav')
@section('main-content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Dashboard</b></h1>
                </div>
            </div>
            <div id="ticket-box" class="row mt-2">
                <img src="dist/img/ticker.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <label id="ticket-label">Total tickets <div style="margin-left: 15%">{{Session::get('total_ticket_count')}}</div></label>
            </div>
            <div id="ticket-box" class="row mt-2">
                <img src="dist/img/ticker.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <label id="ticket-label">Total Open tickets <div style="margin-left: 15%">{{Session::get('open_ticket_count')}}</div></label>
            </div>
            <div id="ticket-box" class="row mt-2">
                <img src="dist/img/ticker.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <label id="ticket-label">Total closed tickets <div style="margin-left: 15%">{{Session::get('closed_ticket_count')}}</div></label>
            </div>
        </div>
    </div>
</div>
@endsection
