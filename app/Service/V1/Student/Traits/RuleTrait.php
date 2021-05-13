<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleTrait
 *
 * @author arikardnoir
 */

namespace App\Service\V1\Student\Traits;
trait RuleTrait
{

    public function rules($id = null)
    {
        return [
            'name' => 'required|string|max:100',
            'birthday' => 'required|date_format:m/d/Y' ,
            'class' => 'required|string',
            'cep' => 'required|string',
            'street' => 'required|string' ,
            'number' => 'required|integer',
            'building_complement' => 'required|string|max:50',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'mom_name' => 'required|string|max:100',
            'cpf' => 'required|string|max:255|unique:mom_infos,cpf' . ($id == null ? '' : ',' . $id),
            'payment_date' => 'required|date_format:m/d/Y',
        ];
    }

}
