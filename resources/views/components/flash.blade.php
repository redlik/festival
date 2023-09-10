@props([
    'type' => 'success',
    'colours' => [
        'normal' => 'bg-gray-100 border-gray-600 text-gray-600',
        'success' => 'bg-green-100 border-green-500',
        'warning' => 'bg-orange-100 border-orange-500',
        'error' => 'bg-red-100 border-red-500 text-red-700',
]
])

<div {{ $attributes->merge(['class' =>"{$colours[$type]} border p-2 rounded mt-4"]) }}>
    {{ $slot }}
</div>
