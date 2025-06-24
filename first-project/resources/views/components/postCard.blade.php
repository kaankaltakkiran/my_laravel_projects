{{-- props ile post isimli bir parametre aliyoruz --}}
@props(['post'])   
   
   <div class="card">
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>
    <div class="text-xs font-light mb-4">
        <span>{{ $post->created_at->diffForHumans() }}</span>
       {{--  post user burdaki user parametresi route fonksiyonuna gönderili --}}r.
        <a href="{{route('posts.user', $post->user)}}" class="text-blue-500 font-medium">{{ $post->user->name }}</a>
    </div>
    <div class="text-sm">
     {{--    str words ile belirli uzunlukta bir string oluşturur. --}}
        <p>{{Str::words($post->body, 15)}}</p>
    </div>
</div>