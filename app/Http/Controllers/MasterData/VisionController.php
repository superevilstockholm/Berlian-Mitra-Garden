<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

// Models
use App\Models\MasterData\Vision;

// Requests
use App\Http\Requests\MasterData\Vision\IndexRequest;
use App\Http\Requests\MasterData\Vision\StoreRequest;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): View
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 10;

        $query = Vision::query()->orderBy('order', 'asc');

        if (isset($validated['content'])) {
            $query->where('content', 'ILIKE', '%' . $validated['content'] . '%');
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

        $visions = $query->paginate($limit)->appends($request->except('page'));

        return view('pages.dashboard.master-data.vision.index', [
            'visions' => $visions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $allowedMaxOrder = Vision::count() + 1;
        return view('pages.dashboard.master-data.vision.index', [
            'allowedMaxOrder' => $allowedMaxOrder,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            Vision::where('order', '>=', $validated['order'])
                ->lockForUpdate()
                ->increment('order');
            Vision::create($validated);
        });

        return redirect()->route('dashboard.master-data.visions.index')->with('success', 'Berhasil menambahkan visi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vision $vision): View
    {
        return view('pages.dashboard.master-data.vision.show', [
            'vision' => $vision,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vision $vision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vision $vision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vision $vision)
    {
        //
    }
}
