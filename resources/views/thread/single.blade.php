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
    </div>
@endsection
