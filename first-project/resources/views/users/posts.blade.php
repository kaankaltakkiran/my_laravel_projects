<x-layout>
    <h1 class="title">{{ $user->name }}'s Posts {{ $posts->total() }}</h1>
<div class="grid grid-cols-2 gap-6">
@foreach ($posts as $post)
{{-- postCard componentini kullanarak postları tek tek yazdırma --}}
<x-postCard :post="$post" />
@endforeach
{{-- Sayfalama --}}
{{-- links sayfalama öğelerini getirir. --}}
{{$posts->links()}}
</div>
    </x-layout>
    