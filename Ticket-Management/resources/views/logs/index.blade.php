@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Ticket Logs</b></h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.No</th>
                                <th>Tcket ID</th>
                                <th>Tickets</th>
                                <th>Users</th>
                                <th>User Roles</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th>Date & Time</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->id}}</td>
                                        <td>{{$log->ticket_id}}</td>
                                        <td>{{$log->ticket_name}}</td>
                                        <td>{{$log->user_name}}</td>
                                        <td>{{$log->user_role}}</td>
                                        <td>{{$log->status}}</td>
                                        <td>{{$log->action}}</td>
                                        <td>{{$log->date_time}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="margin-top: 10px;">
                            {{$logs->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
