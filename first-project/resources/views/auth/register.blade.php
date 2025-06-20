<x-layout>
    <h1 class="title">Register</h1>
    <div class="mx-auto max-w-screen-sm card">
    <form action="{{route('register')}}" method="POST">
       {{--  güvenlik sağlar  --}}
        @csrf
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
         <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <button class="btn" >Register</button>
    </form>
    </div>
</x-layout>


