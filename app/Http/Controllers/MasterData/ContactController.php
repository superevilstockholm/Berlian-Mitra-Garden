<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

// Models
use App\Models\MasterData\Contact;

// Requests
use App\Http\Requests\MasterData\Contact\IndexRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): View
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 10;

        $query = Contact::query()->orderBy('order', 'asc');

        if (isset($validated['name'])) {
            $query->where('name', 'ILIKE', '%' . $validated['name'] . '%');
        }
        if (isset($validated['email'])) {
            $query->where('email', 'ILIKE', '%' . $validated['email'] . '%');
        }
        if (isset($validated['message'])) {
            $query->where('message', 'ILIKE', '%' . $validated['message'] . '%');
        }
        if (isset($validated['start_date'])) {
            $query->where('created_at', '>=', Carbon::parse($validated['start_date'])->startOfDay());
        }
        if (isset($validated['end_date'])) {
            $query->where('created_at', '<=', Carbon::parse($validated['end_date'])->endOfDay());
        }

        $contacts = $query->paginate($limit)->appends($request->except('page'));

        return view('pages.dashboard.master-data.contact.index', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): View
    {
        return view('pages.dashboard.master-data.contact.show', [
            'contact' => $contact,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
