<?php namespace App\Modules\Backend\Requests;

use App\Modules\Backend\Requests\Request;

use Auth;

class ContactPostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::admin()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'building_name' => 'required',
            'building_name_en' => 'required',
            'address' => 'required',
            'address_en' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required|email',
        ];
    }
    
    public function messages(){
        return [
            'building_name.required' => 'Building name cannot be blank.',
            'building_name_en.required' => 'Building name(english) cannot be blank.',
            'address.required' => 'Address cannot be blank.',
            'address_en.required' => 'Address(english) cannot be blank.',
            'phone.required' => 'Phone cannot be blank.',
            'fax.required' => 'Fax cannot be blank.',
            'email.required' => 'Email cannot be blank.',
            'email.email' => 'Email format is not correct.',
        ];
    }
}
