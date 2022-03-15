<?php

namespace App\Http\Requests;

use App\Rules\StateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchByRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        //Adding validation rule for state paramater
        if($this->request->has('by_state')) {
           return [
               'by_state' => ['required', 'string', new StateRule()]
           ];
       } elseif($this->request->has('by_type')){
         return [
             'by_type' => 'required|string|in:micro,nano,regional,brewpub,large,planning,bar,contract,proprieter,closed'
            ];
        } elseif($this->request->has('by_city')) {
            return [
                'by_city' => ['required', 'string']

            ];
        } else {
            return [
                'by_city' => ['nullable'],
                'by_type' =>['nullable'],
                'by_state' => ['nullable']

            ];
        }

    }

}
