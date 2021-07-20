@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-one">Blog List!</h1>
                </div>
                <div class="col-lg-4" style="text-align: right; padding-top: 20px">
                    <h2>{{$user_id->name}}</h2>
                    <a href="/create"><button class="btn btn-primary">Create Post</button></a>
                    <a href="{{ url('/logout') }}"><button class="btn btn-success">Logout</button></a>
                </div>
            </div>
            @forelse($blogposts as $post)
                <ul>
                    <li>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="/image/{{ $post['image'] }}" width="300px">
                                </div>
                                <div class="col-lg-6">
                                    <h2>{{ $post['title'] }}</h2>
                                    <p>{{ $post['description'] }}</p>
                                    <p>{{ $post['tags'] }}</p>
                                    <a href="{{ url('show', $post->id) }}"><button class="btn btn-primary" value="{{$post->id}}">Show Post</button></a>

                                    @if($user_id->id == $post->user_id)
                                        <a href="{{ url('edit', $post->id) }}"><button class="btn btn-primary" value="{{$post->id}}">Edit Post</button></a>
                                        <button class="btn btn-danger delete_post" value="{{$post->id}}">Delete Post</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @empty
                <p class="text-warning"> No Blog Post Available</p>
            @endforelse
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    $(document).on('click', '.delete_post', function(){
        var post_id = $(this).val();

        var url = "{{ URL('deletepost') }}";

        $.ajax({
            type : "DELETE",
            url : url+"/"+post_id,
            data : {
                "_token": "{{ csrf_token() }}",
                "_method": 'DELETE',
                "id" : post_id,
            },

            success: function (data) {
                setTimeout(function(){
                    location.reload();
                }, 100);
            },

            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
