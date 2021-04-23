@props(['post'=>$post])

<div class="mb-4">
    <a href="{{route('users.posts',$post->user)}}" class="font-bold">{{$post->user->name}}</a>
    <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>

    <p>{{$post->body}}</p>

    @can('delete',$post)
    <form action="{{route('posts.destroy',$post)}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-blue-500 text-sm">Delete</button>
    </form>
    @endcan

    <div class="flex items-center">
        @auth
        @if (!$post->likedBy(auth()->user()))
        <form action="{{route('posts.likes',$post)}}" method="post" class="mr-1">
            @csrf
            <button type="submit" class="text-blue-500 text-sm">Like</button>
        </form>
        @else
        <form action="{{route('posts.likes',$post)}}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500 text-sm">Unlike</button>
        </form>
        @endif
        @endauth

        <span class="text-sm ml-1">{{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}}</span>
    </div>
</div>