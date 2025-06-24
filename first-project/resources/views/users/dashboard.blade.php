<x-layout>
<h1 class="title">Hello {{auth()->user()->name}}</h1>
{{-- Giriş yapan kullancıların post oluşturmasu için form --}}

<div class="card mb-4">
    <h2 class="font-bold mb-4">Create Post</h2>
 {{--    Session message --}}
 <div >
    @if (session('success'))
    <div class="success text-green-500">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="error text-red-500">{{ session('error') }}</div>
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
</x-layout>


