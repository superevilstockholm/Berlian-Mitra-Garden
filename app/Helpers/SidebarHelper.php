<?php

if (!function_exists('sidebarItems')) {
    function sidebarItems(): array
    {
        return [
            'main' => [
                ['label' => 'dashboard', 'icon' => 'ti ti-dashboard', 'route' => 'dashboard.index', 'activePattern' => 'dashboard.index'],
            ],
            'master data' => [
                ['label' => 'users', 'icon' => 'ti ti-user', 'route' => 'dashboard.master-data.users.index', 'activePattern' => 'dashboard.master-data.users.*'],
                ['label' => 'visions', 'icon' => 'ti ti-target', 'route' => 'dashboard.master-data.visions.index', 'activePattern' => 'dashboard.master-data.visions.*'],
                ['label' => 'missions', 'icon' => 'ti ti-list-check', 'route' => 'dashboard.master-data.missions.index', 'activePattern' => 'dashboard.master-data.missions.*'],
                ['label' => 'company values', 'icon' => 'ti ti-heart', 'route' => 'dashboard.master-data.company-values.index', 'activePattern' => 'dashboard.master-data.company-values.*'],
                ['label' => 'offerings', 'icon' => 'ti ti-briefcase', 'route' => 'dashboard.master-data.offerings.index', 'activePattern' => 'dashboard.master-data.offerings.*'],
                ['label' => 'partners', 'icon' => 'ti ti-heart-handshake', 'route' => 'dashboard.master-data.partners.index', 'activePattern' => 'dashboard.master-data.partners.*'],
                ['label' => 'contacts', 'icon' => 'ti ti-message', 'route' => 'dashboard.master-data.contacts.index', 'activePattern' => 'dashboard.master-data.contacts.*'],
            ],
            'setting' => [
                ['label' => 'activity logs', 'icon' => 'ti ti-history', 'route' => 'dashboard.setting.activity-logs.index', 'activePattern' => 'dashboard.master-data.activity-logs.*'],
            ],
        ];
    }
}
