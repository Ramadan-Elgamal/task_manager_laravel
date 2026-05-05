@php
$baseClasses = 'inline-flex justify-center items-center px-4 py-2 text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out';

if ($type === 'primary') {
$colorClasses = 'bg-[var(--task-accent)] text-[var(--task-canvas)] hover:bg-[var(--task-accent-active)] focus:ring-[var(--task-accent)] border border-transparent';
} elseif ($type === 'secondary') {
$colorClasses = 'bg-[var(--task-surface)] text-[var(--task-text)] hover:bg-[var(--task-surface-strong)] border border-[var(--task-border)] focus:ring-[var(--task-accent)]';
} elseif ($type === 'danger') {
$colorClasses = 'bg-[var(--task-danger)] text-white hover:bg-[#d63d52] focus:ring-[var(--task-danger)] border border-transparent';
} else {
$colorClasses = 'bg-[var(--task-surface-strong)] text-[var(--task-text)] hover:bg-[var(--task-surface)] border border-transparent';
}
@endphp

<button {{ $attributes->merge(['class' => "$baseClasses $colorClasses"]) }}>
    {{ $slot }}
</button>