<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TierlistStoreRequest
 * @package App\Http\Requests
 * @property integer $items_count
 * @property string $name
 * @property
 */
class TierlistStoreRequest extends FormRequest
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
            'items_count' => 'integer',
            'name' => 'string|required',
            'items' => 'required|array',
            'items.*' => 'image'
        ];
    }
}
