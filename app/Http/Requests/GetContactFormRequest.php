<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;

class GetContactFormRequest extends FormRequest
{
    public $contactModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->contactModel =  Contact::query()
            ->where('id', $this->contact)
            ->where('user_id', auth()->id())
            ->first();

        return (bool)$this->contactModel;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get the validated model
     *
     * @return Contact
     */
    public function getValidatedContact(): Contact
    {
        return $this->contactModel;
    }

}
