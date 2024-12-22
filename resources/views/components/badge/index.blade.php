@props([
    'color' => 'default',
])

@inject('badgeService', 'RealZone22\PenguBlade\Services\PenguBlade\BadgeCvaService')

<span {{ $attributes->twMerge($badgeService::new()(['color' => $color])) }}>
    {{ $slot }}
</span>
