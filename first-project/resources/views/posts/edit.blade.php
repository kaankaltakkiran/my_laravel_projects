<x-layout>
   <a href="{{route('dashboard')}}" class="block mb-2 text-sm text-blue-500"> &larr; Back to Your Dashboard</a>
    <div class="card">
         <h1 class="font-bold mb-4">Update Your Post</h1>
   <form action="{{route('posts.update',$post)}}" method="POST" enctype="multipart/form-data">
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

            <div class="h-52 rounded-md mb-4 w-full object-cover overflow-hidden">
    @if ($post->image)
    <label for="image">Cover photo</label>
    <img src="{{asset('storage/'.$post->image)}}" alt="post image">
    @endif
      <div class="mb-4">
            <label for="image">Cover photo</label>
            <input type="file" name="image" id="image">
               @error('image')
            <div class="error">{{ $message }}</div>
        @enderror
        </div>
</div>
 
        <button type="submit" class="primary-btn">Update Post</button>
    </form>
    </div>
</x-layout>