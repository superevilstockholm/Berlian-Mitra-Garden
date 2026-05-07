<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\MasterData\Offering;

// Requests
use App\Http\Requests\MasterData\Offering\IndexRequest;

class OfferingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): View
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 10;

        $query = Offering::query()->orderBy('created_at', 'desc');

        if (isset($validated['name'])) {
            $query->where('name', 'ILIKE', '%' . $validated['name'] . '%');
        }
        if (isset($validated['description'])) {
            $query->where('description', 'ILIKE', '%' . $validated['description'] . '%');
        }
        if (isset($validated['type'])) {
            $query->where('type', $validated['type']);
        }
        if (isset($validated['start_date'])) {
            $query->where('created_at', '>=', Carbon::parse($validated['start_date'])->startOfDay());
        }
        if (isset($validated['end_date'])) {
            $query->where('created_at', '<=', Carbon::parse($validated['end_date'])->endOfDay());
        }

        $offerings = $query->paginate($limit)->appends($request->except('page'));

        return view('pages.dashboard.master-data.offering.index', [
            'offerings' => $offerings,
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
    public function show(Offering $offering)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offering $offering)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offering $offering)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offering $offering)
    {
        //
    }
}
