<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactFormRequest;
use App\Http\Requests\GetContactFormRequest;
use App\Http\Requests\UpdateContactFormRequest;
use App\Models\Contact;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contacts = Contact::where('user_id', auth()->id())
            ->latest()->paginate(5);

        return view('contacts.index', compact('contacts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateContactFormRequest $request)
    {
        $contact = new Contact();
        $contact->fill($request->all());

        // upload and store photo url data
        if ($request->hasFile('photo')) {
            $path = Storage::disk('s3')->put('uploads', $request->photo);
            $path = Storage::disk('s3')->url($path);
            $contact->photo = $path;
        }

        $contact->user_id = auth()->id();
        $contact->save();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     * @return Response
     */
    public function show(GetContactFormRequest $request)
    {
        $contact = $request->getValidatedContact();
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     * @return Response
     */
    public function edit(GetContactFormRequest $request)
    {
        $contact = $request->getValidatedContact();
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContactFormRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateContactFormRequest $request)
    {
        $contact = $request->getValidatedContact();

        $contact->fill($request->all());

        // upload and store photo url data
        if ($request->hasFile('photo')) {
            $path = Storage::disk('s3')->put('uploads', $request->photo);
            $path = Storage::disk('s3')->url($path);
            $contact->photo = $path;
        }
        $contact->save();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GetContactFormRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(GetContactFormRequest $request): JsonResponse
    {
        $isDeleted = $request->getValidatedContact()->delete();
        return response()->json(['status' => $isDeleted], 200);
    }
}
