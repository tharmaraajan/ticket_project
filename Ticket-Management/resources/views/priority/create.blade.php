@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Create priority</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('priority.index')}}">
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
                        <form method="post" action="{{route('priority.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="priority">Priority Name</label>
                                <input type="text" class="ct-input form-control" name="priority" id="priority" placeholder="Enter the Priority  name here...">
                                @error('priority')
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
