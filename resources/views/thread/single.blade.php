@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <article>
                            <h1>{{ $thread->title }}</h1>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 style="color: mediumvioletred;"> replies : </h3>
                @foreach($thread->replies as $reply)
                    <div class="panel-heading">
                        <span style="color: dodgerblue;">{{ $reply->owner->name }}</span> said
                        {{ $reply->created_at->diffForHumans() }}
                    </div>
                    <div class="panel-body">{{ $reply->body }}</div>
                    <hr>
                @endforeach
            </div>
        </div>

    </div>
@endsection
