<x-layout>
<h1 class="title">Latest Posts</h1>
{{-- controllerden gelen postları tek tek yazdırma --}}
<div class="grid grid-cols-2 gap-6">
@foreach ($posts as $post)
   <div class="card">
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>
    <div class="text-xs font-light mb-4">
        <span>{{ $post->created_at->diffForHumans() }}</span>
        <a href="" class="text-blue-500 font-medium">Usurname</a>
    </div>
    <div class="text-sm">
     {{--    str words ile belirli uzunlukta bir string oluşturur. --}}
        <p>{{Str::words($post->body, 15)}}</p>
    </div>
</div> 
@endforeach
{{-- Sayfalama --}}
{{-- links sayfalama öğelerini getirir. --}}
{{$posts->links()}}
</div>
</x-layout>

