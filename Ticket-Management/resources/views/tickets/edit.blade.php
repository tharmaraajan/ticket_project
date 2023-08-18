@extends('layouts.nav')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Update ticket</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('tickets.index')}}">
                                    <i class="bi bi-arrow-left-circle-fill"></i>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="form_box rwo mt-2">
                        <div class="form col-sm-6">
                            <form method="post" action="{{route('tickets.update',$ticket->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="titles">Title<span style="color: red"> *</span></label>
                                    <input type="text" class="ct-input form-control" value="{{$ticket->titles}}"
                                           name="titles" id="titles" placeholder="Enter the ticket title here...">
                                    @error('titles')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Message<span style="color: red"> *</span></label>
                                    <textarea name="description" class="ct-input form-control" id="description"
                                              placeholder="Enter the message here...">{{$ticket->text_descriptions}}</textarea>
                                    @error('description')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="from-group">
                                    <label for="label">Labels<span style="color: red"> *</span></label><br>
                                    @foreach($labels as $label)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="ct-check form-check-input" value="{{$label->id}}" @foreach($ticket->label as $ticket_label) @if($ticket_label->id == $label->id) checked @endif @endforeach name="labels[]'">
                                            <label class="form-check-label">{{$label->labels_name}}</label>
                                        </div>
                                    @endforeach
                                    <br>
                                    @error('labels')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <div style="margin-top: 1%" class="form-group">
                                    <label for="categories">Categories<span style="color: red"> *</span></label><br>
                                    @foreach($categories as $category)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="ct-check form-check-input" value="{{$category->id}}" @foreach($ticket->category as $ticket_category) @if($ticket_category->id == $category->id) checked @endif @endforeach name="categories[]" id="categories" >
                                            <label class="form-check-label">{{$category->categories_name}}</label>
                                        </div>
                                    @endforeach
                                    <br>
                                    @error('categories')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                @if(Auth::user()->roles == 'Administrator')
                                    <div class="form-group">
                                        <label>Status<span style="color: red"> *</span></label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="open" name="status" id="status" {{ $ticket->status == 'open' ? 'checked' : '' }}>
                                            <label class="form-check-label">Open</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="close" name="status" id="status" {{ $ticket->status == 'close' ? 'checked' : '' }}>
                                            <label class="form-check-label">Close</label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Priority<span style="color: red"> *</span></label>
                                    <select id="priority" class="ct-input form-control" name="priority">
                                        <option value="">--select priority--</option>
                                        @foreach($priorities as $priority)
                                                <option value="{{$priority->priority_name}}" {{ $ticket->priority == $priority->priority_name ? 'selected' : '' }}>{{$priority->priority_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('priority')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                @if(Auth::user()->roles == 'Administrator')
                                    <div class="form-group">
                                        <label>Agent</label>
                                        <select id="agent" class="ct-input form-control" name="agent">
                                            <option value="">--select agent--</option>
                                            @foreach($users as $user)
                                                @if($user->roles == 'Agent')
                                                    <option value="{{ $user->id }}" {{ $ticket->agent_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('agent')
                                        <span style="color: red;">{{$message}}</span>
                                        @enderror
                                    </div>
                                @endif
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
