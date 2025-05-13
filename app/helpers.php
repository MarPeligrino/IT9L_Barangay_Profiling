<?php

use App\Models\RecentActivity;

if (!function_exists('log_activity')) {
    function log_activity($description)
    {
        RecentActivity::create([
            'description' => $description,
        ]);
    }
}
