@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Lables</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('label.create')}}">
                                    <i class="bi bi-patch-plus-fill" style="color: green"></i>
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
                                <th>Labels</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($labels as $label)
                                <tr>
                                    <td>{{$label->id}}</td>
                                    <td>{{$label->labels_name}}</td>
                                    <td>
                                        <a href="{{route('label.edit',$label->id)}}" class="btn btn-sm btn-secondary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="{{ route('label.delete', $label->id) }}" method="post" class="d-inline">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="margin-top: 10px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
