<x-layout>
    <h1 class="mb-4"> Please verify your email address. Your through the email we sent to you.</h1>

    <p>Did not receive the verification email?</p>
    <form action="{{route('verification.send')}}" method="POST">
        @csrf
        <button type="submit" class="btn">Send Again</button>
    </form>
</x-layout>