@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Users</b></h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('users.create')}}">
                                    <i class="bi bi-person-fill-add" style="color: green"></i>
                                </a>
                            </li>
                        </ol>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->roles}}</td>
                                    <td>
                                        <a href="{{route('users.edit',$user->id)}}"  @if($user->roles == 'Administrator') class="btn btn-sm btn-secondary disabled" @else class="btn btn-sm btn-secondary" @endif><i
                                                class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="{{ route('users.delete', $user->id) }}" method="post"
                                              class="d-inline">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit" @if($user->roles == 'Administrator') disabled @endif><i
                                                    class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="margin-top: 10px;">
                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
