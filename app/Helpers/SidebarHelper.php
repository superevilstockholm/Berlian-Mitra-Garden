<?php

if (!function_exists('sidebarItems')) {
    function sidebarItems(): array
    {
        return [
            'main' => [
                ['label' => 'dashboard', 'icon' => 'ti ti-dashboard', 'route' => 'dashboard.index', 'activePattern' => 'dashboard.index'],
            ],
            'master data' => [
                ['label' => 'visions', 'icon' => 'ti ti-target', 'route' => 'dashboard.master-data.visions.index', 'activePattern' => 'dashboard.mamster-data.visions.*'],
            ],
        ];
    }
}
