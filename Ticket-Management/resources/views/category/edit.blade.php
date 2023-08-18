@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Update category</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('category.index')}}">
                                    <i class="bi bi-arrow-left-circle-fill"></i>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="form_box rwo mt-2">
                        <div class="form col-sm-6">
                            <form method="post" action="{{route('category.update',$category->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="category">Category Name</label>
                                    <input type="text" class="ct-input form-control" value="{{$category->categories_name}}" name="category" id="category" placeholder="Enter the category name here...">
                                    @error('category')
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
