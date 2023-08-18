@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Create user</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('users.index')}}">
                                    <i class="bi bi-arrow-left-circle-fill"></i>
                                </a>
                            </li>
                        </ol>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success" style="width: 100%" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="form_box rwo mt-2">
                    <div class="form col-sm-6">
                        <form method="post" action="{{route('users.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="name">name</label>
                                <input type="text" class="ct-input form-control" name="name" id="name" placeholder="Enter the user name here...">
                                @error('name')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="from-group">
                                <label for="email">Email</label>
                                <input type="email" class="ct-input form-control" name="email" id="email" placeholder="Enter the user email here...">
                                @error('email')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label>Role</label>
                                <select id="role" class="ct-input form-control" name="role">
                                    <option value="">--select role--</option>
                                    <option value="Regular user">Regular user</option>
                                    <option value="Agent">Agent</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                                @error('role')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <button id="submit" class="ct-btn btn btn-sm btn-primary"><i class="bi bi-send-fill"></i> Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
