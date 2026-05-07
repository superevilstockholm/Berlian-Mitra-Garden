<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\MasterData\CompanyValue;

// Requests
use App\Http\Requests\MasterData\CompanyValue\IndexRequest;

class CompanyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): View
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 10;

        $query = CompanyValue::query()->orderBy('order', 'asc');

        if (isset($validated['title'])) {
            $query->where('title', 'ILIKE', '%' . $validated['title'] . '%');
        }
        if (isset($validated['description'])) {
            $query->where('description', 'ILIKE', '%' . $validated['description'] . '%');
        }
        if (isset($validated['start_order'])) {
            $query->where('order', '>=', $validated['start_order']);
        }
        if (isset($validated['end_order'])) {
            $query->where('order', '<=', $validated['end_order']);
        }
        if (isset($validated['start_date'])) {
            $query->where('created_at', '>=', Carbon::parse($validated['start_date'])->startOfDay());
        }
        if (isset($validated['end_date'])) {
            $query->where('created_at', '<=', Carbon::parse($validated['end_date'])->endOfDay());
        }

        $company_values = $query->paginate($limit)->appends($request->except('page'));

        return view('pages.dashboard.master-data.company-value.index', [
            'company_values' => $company_values,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyValue $companyValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyValue $companyValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyValue $companyValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyValue $companyValue)
    {
        //
    }
}
