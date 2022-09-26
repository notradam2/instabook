<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    /**
     * Send the composed email
     *
     * @param Request $request
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function sendEmail(Request $request, Contact $contact)
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
}
