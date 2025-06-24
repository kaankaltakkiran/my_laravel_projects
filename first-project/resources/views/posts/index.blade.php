<x-layout>
<h1 class="title">Latest Posts</h1>
{{-- controllerden gelen postları tek tek yazdırma --}}
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

