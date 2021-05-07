<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuiaStoreRequest extends FormRequest
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
        $rules = [
            'checklist_item_id' => ['required','integer','unique:guia'],  
            'descricao' => ['required','string']
        ];

        if ($this->getMethod() == 'PUT') {
            $rules = [
                'checklist_item_id' => ['required','integer'],  
                'descricao' => ['required','string']
            ];
        }

        

        return $rules;
    }

    public function messages()
    {
        return [
            'checklist_item_id.required' => 'Macroitem / Item é obrigatório!',
            'descricao.required' => 'Descrição é obrigatória!',
            'checklist_item_id.unique' => 'Somente um guia por item é permitido!'
        ];
    }
}
