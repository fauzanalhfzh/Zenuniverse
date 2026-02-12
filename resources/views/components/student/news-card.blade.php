@props(['title', 'time', 'image'])

<div class="bg-white p-4 rounded-3xl border-2 border-slate-50 shadow-sm flex gap-4 card-hover">
    <div class="w-20 h-20 rounded-2xl bg-blue-50 overflow-hidden flex-shrink-0">
        <img src="{{ $image }}" alt="News" class="w-full h-full object-cover">
    </div>
    <div>
        <h6 class="font-bold text-slate-800 text-sm leading-tight mb-1">{{ $title }}</h6>
        <p class="text-xs text-slate-500">{{ $time }}</p>
    </div>
</div>
