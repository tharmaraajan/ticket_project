@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Update user</b></h1>
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
                    <div class="form_box rwo mt-2">
                        <div class="form col-sm-6">
                            <form method="post" action="{{route('users.update',$user->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="ct-input form-control" value="{{$user->name}}" name="name" id="name" placeholder="Enter the user name here...">
                                    @error('name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="from-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="ct-input form-control" value="{{$user->email}}" name="email" id="email" placeholder="Enter the user email here...">
                                    @error('email')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select id="role" class="ct-input form-control" name="role">
                                        <option value="">--select role--</option>
                                        <option value="Regular user" {{ $user->roles == 'Regular user' ? 'selected' : '' }}>Regular user</option>
                                        <option value="Agent" {{ $user->roles == 'Agent' ? 'selected' : '' }}>Agent</option>
                                        <option value="Administrator" {{ $user->roles == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                    </select>
                                    @error('role')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <button id="submit" class="ct-btn btn btn-sm btn-primary"><i class="bi bi-arrow-bar-up"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
