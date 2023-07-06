<?php

namespace Modules\Membership\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveMembershipRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     protected $availableAttributes = 'membership::attributes';

    public function rules()
    {
         return [
            'price' => 'required',
            'title' => 'required',
           
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   
}
