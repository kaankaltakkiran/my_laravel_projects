<x-layout>
    <h1 class="title">Request a Password Reset Email</h1>
    {{--    Session message --}}
 <div >
    @if (session('status'))
    {{-- istersek bg parametresini de verebiliriz  --}}
     <x-flashMsg msg="{{ session('status') }}" />
    @endif
 </div>
    <div class="mx-auto max-w-screen-sm card">
    <form action="{{route('password.request')}}" method="POST">
       {{--  güvenlik sağlar  --}}
        @csrf
        <input type="text" name="email" value="{{old('email')}}" placeholder="Email" class="@error('email') ring-red-500 @enderror">

             @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <button class="btn primary-btn" >Send Password Reset Links</button>
    </form>
    </div>
</x-layout>


