<x-layout>

   {{--  auth login olmuş kullanıcını görecek. --}}
    @auth
    <p>Authenticated</p>
        <h1>Hello {{auth()->user()->name}}</h1>
    @endauth

    {{-- auth login olmayan kullanıcının görecek. --}}
    @guest
    <p>Hello Guest</p>
    @endguest
</x-layout>

<x-alert>
   {{--  $slot değeri component dosyasına gönderiliyor --}}
    <strong>Whoops!</strong> Something went wrong!
</x-alert>

