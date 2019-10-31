<?php

namespace Agileti\IOFinanceiro;

use Dataview\IntranetOne\IORequest;
use Illuminate\Validation\Rule;

class FinanceiroRequest extends IORequest
{
    public function sanitize()
    {
        $input = parent::sanitize();
        /*$input['cidade_id'] = $input['cidade_id'];
        $input['cpf_cnpj'] = preg_replace('/\D/', '', $input['cpf_cnpj']);
        $input['cep'] = preg_replace('/\D/', '', $input['cep']);

        if (is_array($input['tipo'])) {
            $input['tipo'] = implode(',', $input['tipo']);
        }
        */
        if (isset($input['vencimento_submit'])) {
            $input['vencimento'] = $input['vencimento_submit'];
        }

        $this->replace($input);
        return $input;
    }

    public function rules()
    {
        $input = $this->sanitize();
            return [
                'vencimento' => 'required',
                'valorp' => 'required',
                'parcela' => 'required'
            ];
    }

    public function messages()
    {
        //
    }
}
