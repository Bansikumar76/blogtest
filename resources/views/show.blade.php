@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-one">Blog List!</h1>
                </div>
                <div class="col-lg-4" style="padding-top: 20px">
                    <a href="/blogpost"><button class="btn btn-primary">Post List</button></a>
                    <a href="/create"><button class="btn btn-primary">Create Post</button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ $post['title'] }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div><img src="/image/{{ $post['image'] }}" width="500px"></div>
                </div>
                <div class="col-lg-6">
                    <p>{{ $post['description'] }}</p>
                    <strong>Tags : </strong><p>{{ $post['tags'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


@endsection
