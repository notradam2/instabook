<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\ContactSendMail;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
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
    public function sendMail(Request $request, $contactId)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
        ]);

        $contact = Contact::findOrFail($contactId);

        $details = [
            'email' => $contact->email,
            'subject' => $request->subject,
            'body' => $request->body
        ];

        //Mail::to($contact->email)->send(new ContactSendMail($details));
        SendEmail::dispatch($details);

        return redirect()->route('contacts.index')
            ->with('success','Email sent successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     * @return Response
     */
    public function createMail(Request $request)
    {
        $contact = Contact::findOrFail($request->contact_id);
        return view('mails.create',compact('contact'));
    }
}
