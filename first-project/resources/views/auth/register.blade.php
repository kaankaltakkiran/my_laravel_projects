<x-layout>
    <h1 class="title">Register</h1>
    <div class="mx-auto max-w-screen-sm card">
    <form action="{{route('register')}}" method="POST">
       {{--  güvenlik sağlar  --}}
        @csrf

        {{-- old ile gelen veriyi tekrar kullanabiliriz --}}

        <input type="text" name="username" value="{{old('username')}}" placeholder="Username" class="@error('username') ring-red-500 @enderror">
        
  {{--       gönderilen requestte hata varsa @error ile hata mesajını gösterm --}}
        @error('username')
            <div class="error">{{ $message }}</div>
        @enderror

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

         <input type="password" name="password_confirmation" placeholder="Confirm Password" class="@error('password') ring-red-500 @enderror">

            @error('password_confirmation')
            <div class="error">{{ $message }}</div>
        @enderror

        <button class="btn" >Register</button>
    </form>
    </div>
</x-layout>


