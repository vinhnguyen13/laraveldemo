<?php namespace App\Modules\Backend\Requests;

use App\Modules\Backend\Requests\Request;

use Auth;

class MenuPostRequest extends Request
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
            'title' => 'required',
            'title_en' => 'required',
            
        ];
    }
    
    public function messages(){
        return [
            'title.required' => 'Title cannot be blank.',
            'title_en.required' => 'Title(English) cannot be blank.',
        ];
    }
}
