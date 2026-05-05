@php
    // Base classes applied to every button for consistent sizing and alignment
    $baseClasses = 'inline-flex justify-center items-center px-4 py-2 text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out';

    // Determine the color scheme based on the 'type' property
    if ($type === 'primary') {
        $colorClasses = 'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500 border border-transparent';
    } elseif ($type === 'secondary') {
        $colorClasses = 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-300 focus:ring-indigo-500';
    } elseif ($type === 'danger') {
        $colorClasses = 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 border border-transparent';
    } else {
        $colorClasses = 'bg-gray-200 text-gray-800 hover:bg-gray-300 border border-transparent'; // Fallback
    }
@endphp

<button {{ $attributes->merge(['class' => "$baseClasses $colorClasses"]) }}>
    {{ $slot }}
</button>