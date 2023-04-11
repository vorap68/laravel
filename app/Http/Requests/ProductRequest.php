<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

   public function rules()
    {
         if($this->route()->named('products.update')){
        $rules = [
           'code' => 'required|min:3|max:255',
             'name'=>'required|min:3|max:50',
             'description'=>'required|min:3',
            'price'=>'required',
            'count'=>'required|min:0',
        ];
         } else {
              $rules = [
           'code' => 'required|min:3|max:255|unique:products,code',
             'name'=>'required|min:3|max:50',
             'description'=>'required|min:3|',
                   'price'=>'required',
        ];
         }
         return $rules;
    }
    
   public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'code.min' => 'Поле код должно содержать не менее :min символов',
        ];
    }
}
