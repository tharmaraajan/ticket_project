@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Update label</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('label.index')}}">
                                    <i class="bi bi-arrow-left-circle-fill"></i>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="form_box rwo mt-2">
                        <div class="form col-sm-6">
                            <form method="post" action="{{route('label.update',$label->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="label">Label Name</label>
                                    <input type="text" class="ct-input form-control" value="{{$label->labels_name}}" name="label" id="label" placeholder="Enter the label name here...">
                                    @error('label')
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
