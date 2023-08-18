@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Tickets <span style="color: red;font-size: 20px;"  class="float-left">{{Session::get('ticket_count')}}</span></b></h1>
                        <span>Click ticket title to move on to the comment page!!!</span>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                @if(Auth::user()->roles != 'Agent')
                                    <a href="{{route('tickets.create')}}">
                                        <i class="bi bi-patch-plus-fill" style="color: green"></i>
                                    </a>
                                @endif
                            </li>
                        </ol>
                    </div>
                    @if (session('success'))
                        <div style="width: 100%" class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div style="background-color: white;border-radius: 5px" class="card-body">
                        <form action="" method="get">
                            @csrf
                            <div style="margin-left: 10%" class="row form-group">
                                <div class="col-md-3">
                                    <select name="status" style="width: 75%" class="form-control" aria-label="Default select example">
                                        <option value="">Filter by status</option>
                                        <option value="open">Open</option>
                                        <option value="close">Close</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="priority" style="width: 75%" class="form-control" aria-label="Default select example">
                                        <option value="">Filter by priority</option>
                                        @foreach($priorities as $priority)
                                            <option value="{{$priority->priority_name}}">{{$priority->priority_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="category" style="width: 75%" class="form-control" aria-label="Default select example">
                                        <option value="">Filter by category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->categories_name}}">{{$category->categories_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="padding-bottom: 1%" class="col-md-2">
                                    <button type="submit" class="btn btn-secondary"><i class="bi bi-funnel-fill"></i> Filter</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Categories</th>
                                <th>Labels</th>
                                @if(Auth::user()->roles != 'Regular user')
                                    <th colspan="2">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $key => $ticket)
                                <tr>
                                    <td>{{$ticket->id}}</td>
                                    <td><b><a href="{{route('comments.index',$ticket->id)}}">{{$ticket->titles}}</a></b></td>
                                    <td>{{$ticket->text_descriptions}}</td>
                                    <td>{{$ticket->priority}}</td>
                                    <td>{{$ticket->status}}</td>
                                    <td>
                                        @foreach($ticket->category as $category)
                                            {{$category->categories_name}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($ticket->label as $label )
                                            {{$label->labels_name}}<br>
                                        @endforeach
                                    </td>
                                    @if(Auth::user()->roles != 'Regular user')
                                        <td>
                                            <a style="width: 100%" href="{{route('tickets.edit',$ticket->id)}}"
                                               class="btn btn-sm btn-secondary"><i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            @if (Auth::user()->roles == 'Administrator')
                                                <form action="{{ route('tickets.delete', $ticket->id) }}" method="post"
                                                      class="d-inline">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                    <button style="width: 100%" class="btn btn-sm mt-2 btn-danger" type="submit"><i class="bi bi-trash"></i>Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="margin-top: 10px;">
                            {{$tickets->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
