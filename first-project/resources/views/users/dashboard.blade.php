<x-layout>
<h1 class="title">Welcome {{auth()->user()->name}}, you have {{$posts->total()}} posts</h1>
{{-- Giriş yapan kullancıların post oluşturmasu için form --}}

<div class="card mb-4">
    <h2 class="font-bold mb-4">Create Post</h2>
  
 {{--    Session message --}}
 <div >
    @if (session('success'))
    {{-- istersek bg parametresini de verebiliriz  --}}
     <x-flashMsg msg="{{ session('success') }}" />
    @endif
    @if (session('delete'))
  
     <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
    @endif
 </div>

   {{--  posts.store çünkü controllerdaki bu fonksiyon veri tabanına yeni bir post ekler --}}
    <form action="{{route('posts.store')}}" method="POST">
        @csrf
        <input type="text" name="title" value="{{old('title')}}" placeholder="Title" class="@error('title') ring-red-500 @enderror">
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror
        <textarea name="body" placeholder="Body" value="{{old('body')}}" class="@error('body') ring-red-500 @enderror"></textarea>
        @error('body')
            <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit" class="primary-btn">Create</button>
    </form>
</div>
{{-- Kullanıcı postları  --}}
<h2 class="font-bold mb-4">Your latest Posts</h2>
<div class="grid grid-cols-2 gap-6">
@foreach ($posts as $post)
{{-- postCard componentini kullanarak postları tek tek yazdırma --}}
<x-postCard :post="$post" >
 {{-- Delete post--}}
 <form action="{{route('posts.destroy', $post)}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
</form>

</x-postCard>
@endforeach
</div>
{{-- Sayfalama --}}
{{-- links sayfalama öğelerini getirir. --}}
{{$posts->links()}}
</x-layout>


