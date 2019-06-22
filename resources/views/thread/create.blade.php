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
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="title">
                            </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" rows="8" type="text" class="form-control" id="body"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Publish</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection