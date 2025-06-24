{{-- props ile msg isimli bir parametre aliyoruz --}}
@props(['msg','bg'=>'bg-green-500'])

<p class="mb-2 text-sm font-medium text-white {{ $bg }} px-3 py-2 rounded">{{$msg}}</p>