<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OpinionItemStoreRequest
 * @package App\Http\Requests
 * @property integer $tierlist_item_id
 * @property integer $vote
 */
class OpinionItemStoreRequest extends FormRequest
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
        return [
            'tierlist_item_id' => 'required|integer',
            'vote' => 'required|digits_between:1,5'
        ];
    }
}
