@props([
    'props' => [],
])

@php
    $variant = (string) ($props['variant'] ?? 'primary');
    $trend = (string) ($props['trend'] ?? 'up');
@endphp

<div class="preview w-full p-6">
    <div class="mx-auto grid w-full max-w-3xl gap-4 md:grid-cols-3">
        <x-ui.stat-card title="Monthly revenue" value="$24.5K" icon="dollar-sign" :variant="$variant" :trend="$trend" trend-value="+12.4%" trend-label="vs last month" />
        <x-ui.stat-card title="Active customers" value="1,482" icon="users" variant="default" trend="up" trend-value="+8.1%" trend-label="this week" />
        <x-ui.stat-card title="Churn risk" value="2.4%" icon="triangle-alert" variant="warning" trend="down" trend-value="-1.2%" trend-label="after fixes" />
    </div>
</div>
