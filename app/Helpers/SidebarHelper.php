<?php

if (!function_exists('sidebarItems')) {
    function sidebarItems(): array
    {
        return [
            'main' => [
                ['label' => 'dashboard', 'icon' => 'ti ti-dashboard', 'route' => 'dashboard.index', 'activePattern' => 'dashboard.index'],
            ]
        ];
    }
}
