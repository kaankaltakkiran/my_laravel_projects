<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- env dosyasi icindeki APP_NAME degiskenini buraya getiriyoruz --}}
    <title>{{env('APP_NAME')}}</title>
    {{-- css ve javascript dosyalarini buraya ekliyoruz --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
  <header class="bg-slate-800 shadow-lg">
    <nav>
       <a href="#" class="nav-link">Home</a>
      <div class=flex items-center gap-4">
        <a href="#" class="nav-link">Login</a>
        <a href="#" class="nav-link">Register</a>
      </div>
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