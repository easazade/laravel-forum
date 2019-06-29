@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">create a new thread</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('threads.store')}}">
                            {{csrf_field()}}

                            <div class="form-group ">
                                <label for="channel_id">choose a channel</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">choose one</option>
                                    @foreach($channels as $channel)
                                        <option
                                            value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                            {{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" value="{{old('title')}}" class="form-control" name="title" id="title"
                                       placeholder="title" required>
                            </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" rows="8" type="text" class="form-control" id="body" required>
                                    {{old('body')}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
