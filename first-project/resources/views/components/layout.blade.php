<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- env dosyasi icindeki APP_NAME degiskenini buraya getiriyoruz --}}
    <title>{{env('APP_NAME')}}</title>
    {{-- alpinejs --}}
     <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- css ve javascript dosyalarini buraya ekliyoruz --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
  <header class="bg-slate-800 shadow-lg">
    <nav>
        {{-- route fonksiyonu ile ilgili route name yazılarak route işlemi gerçekleşir. --}}
       <a href="{{route('home')}}" class="nav-link">Home</a>

       {{-- giriş yapmış kullanıcılar için --}}
       @auth
         <div class="relative grid place-items-center" x-data="{open:false}">
          <button x-on:click="open = !open" type="button" class="round-btn"
          <img src="https://picsum.photos/200" alt="user">
          </button>
          {{--   dropdown menü --}}
          <div x-show="open" @click.outside="open = false"  class="bg-white shadow-lg  absolute top-10 right-0 rounded-lg overflow-hidden font-light">

            <p class="usurname">{{auth()->user()->name}}</p>
            <a href="{{route('dashboard')}}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Dashboard</a>
            {{--  logout butonu --}}
            <form action="{{route('logout')}}" method="POST">
              @csrf
              <button type="submit" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Logout</button>
            </form>
            
          </div>
         </div>

     {{--   <a href="{{route('logout')}}" class="nav-link">Logout</a> --}}
       @endauth
       
       {{-- giriş yapmamış misafirler için --}}
      @guest
               <div class=flex items-center gap-4">
        <a href="{{route('login')}}" class="nav-link">Login</a>
        <a href="{{route('register')}}" class="nav-link">Register</a>
      </div>
      @endguest
    
 
    </nav>
  </header>
  <main class="py-8 px-4 mx-auto max-w-screen-lg  ">
    {{-- yield bir keywordtur ve buraya main isimli bir sectioni buraya getiriyoruz 
    @yield('main')
    --}}
    {{-- $slot bir keywordtur ve buraya main isimli bir sectioni buraya getiriyoruz --}}
   {{ $slot }}
  </main>
  {{--   <h1 class="text-3xl">Merhabsa</h1>
    @if (true)
    <p class="text-xl">True</p>
        
    @else
        <p>False</p>
    @endif --}}
</body>
</html>