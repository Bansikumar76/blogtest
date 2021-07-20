@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h2>Add New Post</h2>
        </div>
        <div class="col-lg-6" style="padding-top: 20px; text-align: right">
            <a href="/blogpost"><button class="btn btn-primary">Post List</button></a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="container border border-dark w-50">
    <form action="{{ route('blogtest.store') }}" method="POST" id="blogtest_form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="title" placeholder="Title">
        </div>

        <div class="form-group">
            <label for="description">Title</label>
            <textarea class="form-control" placeholder="Description" name="description" id="description"></textarea>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" name="tags" class="form-control" id="tags" aria-describedby="tags" placeholder="Tags">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" id="image" aria-describedby="image" placeholder="Image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
@endsection
