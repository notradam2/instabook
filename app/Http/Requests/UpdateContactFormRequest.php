<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactFormRequest extends GetContactFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ];
    }

}
