<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

// Models
use App\Models\MasterData\Vision;
use App\Models\MasterData\Mission;

class PublicController extends Controller
{
    public function index_view(): View
    {
        $visions = Vision::orderBy('order', 'asc')->get();
        $missions = Mission::orderBy('order', 'asc')->get();

        $data = [
            'visions' => $visions,
            'missions' => $missions,
        ];

        return view('pages.index', $data);
    }
}
