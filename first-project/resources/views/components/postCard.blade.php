{{-- props ile post isimli bir parametre aliyoruz --}}
@props(['post','full'=>false])   
   
   <div class="card">
    {{-- post image --}}
    {{-- assset dosya yoluna bakar --}}
    <div class="h-52 rounded-md mb-4 w-full object-cover overflow-hidden">
    @if ($post->image)
    <img src="{{asset('storage/'.$post->image)}}" alt="post image">
    @else
    <img src="https://picsum.photos/200" alt="post image">
    @endif
</div>
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>
    <div class="text-xs font-light mb-4">
        <span>{{ $post->created_at->diffForHumans() }}</span>
       {{--  post user burdaki user parametresi route fonksiyonuna gönderilir --}}
        <a href="{{route('posts.user', $post->user)}}" class="text-blue-500 font-medium">{{ $post->user->name }}</a>
    </div>
    @if ($full)
            <div class="text-sm">
         full attribute true olduğunda postun tüm body'sini gösterir.
        <span>{{$post->body}}</span>
    </div>
        
    @else
            <div class="text-sm">
     {{--    str words ile belirli uzunlukta bir string oluşturur. --}}
        <span>{{Str::words($post->body, 15)}}</span>
        <a href="{{route('posts.show', $post)}}" class="text-blue-500 font-medium hover:underline">Read More &rarr;</a>
    </div>
    @endif
<div class="flex items-center justify-end gap-4 mt-6">
{{$slot}}
</div>
</div>