@php
    use Illuminate\Support\Str;
    $owlGradientId = 'owlGradient-' . Str::random(6);
    $codeGradientId = 'codeGradient-' . Str::random(6);
@endphp

<svg class="w-32 h-32" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="{{ $owlGradientId }}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#4c1d95"/>
            <stop offset="100%" style="stop-color:#1e3a8a"/>
        </linearGradient>
        <linearGradient id="{{ $codeGradientId }}" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:#6366f1"/>
            <stop offset="100%" style="stop-color:#4f46e5"/>
        </linearGradient>
    </defs>

    <!-- Background circle -->

    <rect x="10" y="10" width="180" height="180" rx="20" fill="#ffffff" opacity="0.4"/>

    <path d="M100 40 C60 40 30 70 30 110 C30 150 60 180 100 180 C140 180 170 150 170 110 C170 70 140 40 100 40" fill="url(#{{ $owlGradientId }})"/>

    <circle cx="70" cy="90" r="20" fill="#e0e7ff"/>
    <circle cx="130" cy="90" r="20" fill="#e0e7ff"/>
    <circle cx="70" cy="90" r="12" fill="#312e81"/>
    <circle cx="130" cy="90" r="12" fill="#312e81"/>
    <circle cx="73" cy="87" r="4" fill="#e0e7ff"/>
    <circle cx="133" cy="87" r="4" fill="#e0e7ff"/>

    <path d="M90 110 L100 120 L110 110 Z" fill="#6366f1"/>

    <rect x="60" y="130" width="80" height="30" rx="8" fill="url(#{{ $codeGradientId }})"/>
    <text x="75" y="150" font-family="monospace" font-size="16" fill="#e0e7ff">{"..."}</text>

    <path d="M55 75 Q70 65 85 75" fill="none" stroke="#6366f1" stroke-width="3"/>
    <path d="M115 75 Q130 65 145 75" fill="none" stroke="#6366f1" stroke-width="3"/>

    <path d="M40 110 Q50 120 40 130" fill="none" stroke="#6366f1" stroke-width="3"/>
    <path d="M160 110 Q150 120 160 130" fill="none" stroke="#6366f1" stroke-width="3"/>
</svg>
