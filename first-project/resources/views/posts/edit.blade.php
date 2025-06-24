<x-layout>
   <a href="{{route('dashboard')}}" class="block mb-2 text-sm text-blue-500"> &larr; Back to Your Dashboard</a>
    <div class="card">
         <h1 class="font-bold mb-4">Update Your Post</h1>
   <form action="{{route('posts.update',$post)}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$post->title}}" placeholder="Title" class="@error('title') ring-red-500 @enderror">
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror
        <textarea name="body" rows="10" class="input @error('body') ring-red-500 @enderror">{{$post->body}}</textarea>

        @error('body')
            <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit" class="primary-btn">Update Post</button>
    </form>
    </div>
</x-layout>