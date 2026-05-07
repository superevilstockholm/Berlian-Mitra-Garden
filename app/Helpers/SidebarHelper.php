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
                ['label' => 'missions', 'icon' => 'ti ti-list-check', 'route' => 'dashboard.master-data.missions.index', 'activePattern' => 'dashboard.mamster-data.missions.*'],
                ['label' => 'company values', 'icon' => 'ti ti-heart', 'route' => 'dashboard.master-data.company-values.index', 'activePattern' => 'dashboard.mamster-data.company-values.*'],
            ],
        ];
    }
}
