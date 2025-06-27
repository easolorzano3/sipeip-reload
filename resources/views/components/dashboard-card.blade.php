@props(['color', 'icon', 'title', 'description'])

<a href="#" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-gray-800">
    <div class="flex items-center space-x-4">
        <div class="bg-{{ $color }}-500 text-white p-3 rounded-full">
            <i class="{{ $icon }} text-xl"></i>
        </div>
        <div>
            <h3 class="text-lg font-semibold">{{ $title }}</h3>
            <p class="text-sm text-gray-500">{{ $description }}</p>
        </div>
    </div>
</a>
