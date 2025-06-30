@props(['color', 'icon', 'title', 'description'])

@php
    $bgColor = match($color) {
        'red' => 'bg-red-500',
        'blue' => 'bg-blue-500',
        'indigo' => 'bg-indigo-500',
        'teal' => 'bg-teal-500',
        'orange' => 'bg-orange-500',
        'yellow' => 'bg-yellow-500',
        'purple' => 'bg-purple-500',
        'green' => 'bg-green-500',
        'fuchsia' => 'bg-fuchsia-500',
        default => 'bg-gray-500',
    };
@endphp

<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-gray-800 cursor-pointer">
    <div class="flex items-center space-x-4">
        <div class="{{ $bgColor }} text-white p-3 rounded-full">
            <i class="{{ $icon }} text-xl"></i>
        </div>
        <div>
            <h3 class="text-lg font-semibold">{{ $title }}</h3>
            <p class="text-sm text-gray-500">{{ $description }}</p>
        </div>
    </div>
</div>
