<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongRequest extends FormRequest
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
            'cate_id' => 'not_in:0',
            'name' => 'required',
            'art_id' => 'not_in:0',
            'link' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'cate_id.not_in' => trans('song.cateRequired'),
            'name.required' => trans('song.nameRequired'),
            'art_id.not_in' => trans('song.artRequired'),
            'link.required' => trans('song.linkRequired'),
            'link.unique' => trans('song.linkUnique'),
            'image.required' => trans('song.imageRequired'),
            'image.mimes' => trans('song.imageExtension'),
        ];
    }
}
