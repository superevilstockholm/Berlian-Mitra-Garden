<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\MasterData\Offering;

// Requests
use App\Http\Requests\MasterData\Offering\IndexRequest;
use App\Http\Requests\MasterData\Offering\StoreRequest;
use App\Http\Requests\MasterData\Offering\UpdateRequest;

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
    public function create(): View
    {
        return view('pages.dashboard.master-data.offering.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            $validated['image_path'] = $request->file('image_file')->store('offering', 'public');
        }

        $offering = Offering::create($validated);

        return redirect()->route('dashboard.master-data.offerings.index')->with('success', 'Berhasil membuat ' . $offering->type->label() . '.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offering $offering): View
    {
        return view('pages.dashboard.master-data.offering.show', [
            'offering' => $offering,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offering $offering): View
    {
        return view('pages.dashboard.master-data.offering.edit', [
            'offering' => $offering,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Offering $offering): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_file')) {
            if ($offering->image_path && Storage::disk('public')->exists($offering->image_path)) {
                Storage::disk('public')->delete($offering->image_path);
            }
            $validated['image_path'] = $request->file('image_file')->store('offering', 'public');
        }

        $offering->update($validated);

        return redirect()->route('dashboard.master-data.offerings.index')->with('success', 'Berhasil memperbarui ' . $offering->type->label() . '.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offering $offering): RedirectResponse
    {
        if ($offering->image_path && Storage::disk('public')->exists($offering->image_path)) {
            Storage::disk('public')->delete($offering->image_path);
        }
        $offering->delete();

        return redirect()->route('dashboard.master-data.offerings.index')->with('success', 'Berhasil menghapus ' . $offering->type->label() . '.');
    }
}
