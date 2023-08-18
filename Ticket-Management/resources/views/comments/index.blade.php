@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-size: 50px" class="m-0">
                            <b>
                                <a data-toggle="tooltip" title="Click ticket icon to go back to the ticket view page!!!" href="{{ route('tickets.index') }}">
                                    <i class="bi bi-ticket"></i>
                                </a> {{$ticket->titles}}
                            </b>
                        </h1>
                        <div class="form-inline">
                            <label style="color: grey">Priority: </label>
                            <div style="margin-left: 0.5%">{{$ticket->priority}}</div>
                            <label style="margin-left: 2%;color: grey">Status: </label>
                            <div style="margin-left: 0.5%">{{$ticket->status}}</div>
                        </div>
                    </div>
                    <div style="margin-left: 35%;font-size: 30px;" class=" float-right">
                        <label><i class="bi bi-person"></i> {{$ticket->user->name}}</label><br>
                    </div>
                    <div class="form_box">
                        <div class="row">
                            <div style="margin-left: 2%" class="col">
                            <div class="form-group">
                                <label style="font-size: 30px;color: grey"><i style="font-size: 20px" class="bi bi-chat-square-text"></i>
                                    Message
                                </label>
                                <p style="font-size: 20px">{{$ticket->text_descriptions}}</p>
                            </div>
                            <div class="form-group">
                                <label style="font-size: 30px;color: grey"><i style="font-size: 20px;" class="bi bi-tag"></i>
                                    Labels
                                </label>
                                <div style="margin-left: 4%;font-size: 20px">
                                    @foreach($ticket->label as $label)
                                        <i class="bi bi-check-lg">{{$label->labels_name}}</i>
                                    @endforeach
                                </div>
                                <label style="font-size: 30px;color: grey"><i style="font-size: 20px;" class="bi bi-ui-checks-grid"></i>
                                    Categories
                                </label>
                                <div style="margin-left: 4%;font-size: 20px">
                                    @foreach($ticket->category as $category)
                                        <i class="bi bi-check-lg">{{$category->categories_name}}</i>
                                    @endforeach
                                </div>
                            </div>
                            </div>
                            <div class="col">
                                <form method="post" action="{{route('comments.store',$ticket->id)}}">
                                    @csrf
                                    <label for="comment" style="font-size: 30px;color: grey">Comment</label>
                                    <textarea class="form-control" name="comment" placeholder="Enter your Comment here..."></textarea>
                                    @error('comment')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror<br>
                                    <button type="submit" style="margin-top: 1%" class="btn btn-sm btn-secondary">Submit</button>
                                </form>
                                <hr>
                                <div>
                                    <label style="font-size: 30px;color: grey">Files</label><br>
                                    @foreach($ticket->files as $file)
                                        <a href="{{$file->location}}">
                                            <img src="{{$file->location}}" class="img-responsive brand-image img-circle elevation-3" style="width: 10%;height: 50%;border-radius: 20px" alt="File">
                                        </a>
                                    @endforeach<br>
                                    <span>Do you want to view image in full size? then .. Click image!!</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div style="margin-left: 2%" class="col">
                                <label style="font-size: 30px;color: grey"><i style="font-size: 20px;" class="bi bi-chat-text"></i>
                                    Comments:
                                </label><br>
                                <div>
                                    @foreach($comments as $comment)
                                        <div class="card">
                                            <div class="card-body">
                                                {{$comment->comments}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                {{$comments->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
