<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\MasterData\Partner;

// Requests
use App\Http\Requests\MasterData\Partner\IndexRequest;
use App\Http\Requests\MasterData\Partner\StoreRequest;
use App\Http\Requests\MasterData\Partner\UpdateRequest;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): View
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 10;

        $query = Partner::query()->orderBy('order', 'asc');

        if (isset($validated['name'])) {
            $query->where('name', 'ILIKE', '%' . $validated['name'] . '%');
        }
        if (isset($validated['website_url'])) {
            $query->where('website_url', 'ILIKE', '%' . $validated['website_url'] . '%');
        }
        if (isset($validated['description'])) {
            $query->where('description', 'ILIKE', '%' . $validated['description'] . '%');
        }
        if (isset($validated['is_featured'])) {
            if ($request->boolean('is_featured')) {
                $query->where('is_featured', true);
            }
            if (!$request->boolean('is_featured')) {
                $query->where('is_featured', false);
            }
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

        $partners = $query->paginate($limit)->appends($request->except('page'));

        return view('pages.dashboard.master-data.partner.index', [
            'partners' => $partners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $allowedMaxOrder = Partner::count() + 1;
        return view('pages.dashboard.master-data.partner.create', [
            'allowedMaxOrder' => $allowedMaxOrder,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('logo_file')) {
            $validated['logo_path'] = $request->file('logo_file')->store('partner', 'public');
        }

        Partner::create($validated);

        return redirect()->route('dashboard.master-data.partners.index')->with('success', 'Berhasil membuat partner.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner): View
    {
        return view('pages.dashboard.master-data.partner.show', [
            'partner' => $partner,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner): View
    {
        $allowedMaxOrder = Partner::count();
        return view('pages.dashboard.master-data.partner.edit', [
            'partner' => $partner,
            'allowedMaxOrder' => $allowedMaxOrder,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('logo_file')) {
            if ($partner->logo_path && Storage::disk('public')->exists($partner->logo_path)) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            $validated['logo_path'] = $request->file('logo_file')->store('partner', 'public');
        }

        $partner->update($validated);

        return redirect()->route('dashboard.master-data.partners.index')->with('success', 'Berhasil memperbarui partner.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        if ($partner->logo_path && Storage::disk('public')->exists($partner->logo_path)) {
            Storage::disk('public')->delete($partner->logo_path);
        }

        $partner->delete();
        
        return redirect()->route('dashboard.master-data.partners.index')->with('success', 'Berhasil menghapus partner.');
    }
}
