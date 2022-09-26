<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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
        $contacts = Contact::latest()->paginate(5);

        return view('contacts.index',compact('contacts'))
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
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        $contact = new Contact();
        $contact->fill($request->all());

        // upload and store photo url data
        if($request->hasFile('photo')){
            $path = Storage::disk('s3')->put('uploads', $request->photo);
            $path = Storage::disk('s3')->url($path);
            $contact->photo = $path;
        }

        $contact->save();

        return redirect()->route('contacts.index')
            ->with('success','Contact created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     * @return Response
     */
    public function show(Contact $contact)
    {
        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     * @return Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $contact->fill($request->all());

        // upload and store photo url data
        if($request->hasFile('photo')){
            $path = Storage::disk('s3')->put('uploads', $request->photo);
            $path = Storage::disk('s3')->url($path);
            $contact->photo = $path;
        }

        $contact->save();

        return redirect()->route('contacts.index')
            ->with('success','Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success','Contact deleted successfully');
    }
}
