<?php
namespace App\Http\Requests;

class TagUpdateRequest extends Request
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
            'title' => 'required',
            'subtitle' => 'required',
            'layout' => 'required',
        ];
    }
}


/**
 * You could use just one Form Request by using the code below
*/
//public function rules()
//{
//    $rules = [
//
//        'title' => 'required',
//        'subtitle' => 'required',
//        'layout' => 'required',
//    ];
//
//    if ($this->method() === 'POST') {
//        $rules['tag'] = 'required|unique:tags,tag';
//    }
//    return $rules;
//}