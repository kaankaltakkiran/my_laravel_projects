<x-layout>
    <h1 class="title">Reset Your Password</h1>
    <div class="mx-auto max-w-screen-sm card">
    <form action="{{route('password.update')}}" method="POST">
       {{--  güvenlik sağlar  --}}
        @csrf
      {{--   password tokeni --}}
        <input type="hidden" name="token" value="{{ $token }}">

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
        <button class="primary-btn" >Reset Password</button>
    </form>
    </div>
</x-layout>


