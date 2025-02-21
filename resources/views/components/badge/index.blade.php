@props([
    'color' => 'default',
])

@inject('badgeService', 'App\Services\PenguBlade\BadgeCvaService')

<span {{ $attributes->twMerge($badgeService::new()(['color' => $color])) }}>
    {{ $slot }}
</span>
