<x-layout>
    <h1 class="title">Login</h1>
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
<div class="flex items-center gap-2">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>
</div>

   @error('failed')
            <div class="error">{{ $message }}</div>
        @enderror

        <button class="btn" >Login</button>
    </form>
    </div>
</x-layout>


