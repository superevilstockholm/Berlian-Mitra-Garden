<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

// Models
use App\Models\MasterData\Vision;
use App\Models\MasterData\Mission;
use App\Models\MasterData\CompanyValue;

class PublicController extends Controller
{
    public function index_view(): View
    {
        $visions = Vision::orderBy('order', 'asc')->get();
        $missions = Mission::orderBy('order', 'asc')->get();
        $company_values = CompanyValue::orderBy('order', 'asc')->get();

        $data = [
            'visions' => $visions,
            'missions' => $missions,
            'company_values' => $company_values,
        ];

        return view('pages.index', $data);
    }
}
