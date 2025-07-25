<x-layout>
    <h1 class="title">Login</h1>
        {{--    Session message --}}
 <div >
    @if (session('status'))
    {{-- istersek bg parametresini de verebiliriz  --}}
     <x-flashMsg msg="{{ session('status') }}" />
    @endif
 </div>
    <div class="mx-auto max-w-screen-sm card">
    <form action="{{route('login')}}" method="POST">
       {{--  güvenlik sağlar  --}}
        @csrf

        <input type="text" name="email" value="{{old('email')}}" placeholder="Email" class="@error('email') ring-red-500 @enderror">

             @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

      {{--   password name değeri confirmation ile aynı olmalı
        secret:> secret_confirmation --}}

        <input type="password" name="password" placeholder="Password" class="@error('password') ring-red-500 @enderror">

           @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
<div class="mb-4 flex justify-between items-center">
    <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>
        </div>
      {{--   password Reset --}}
        <a class="text-blue-500" href="{{route('password.request')}}">Forgot Password?</a>
</div>

   @error('failed')
            <div class="error">{{ $message }}</div>
        @enderror

        <button class="btn primary-btn" >Login</button>
    </form>
    </div>
</x-layout>


