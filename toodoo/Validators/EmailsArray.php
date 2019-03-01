<?php

namespace Toodoo\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as Validation;

class EmailsArray extends Validator
{
    public function validateSpecificValidation($attribute, $value)
    {
        $rules = [
            'email' => 'required|email',
        ];

        foreach ($value as $email) {
            $data = [
                'email' => $email
            ];

            $validator = Validation::make($data, $rules);

            if ($validator->fails()) {
                return false;
            }
        }

        return true;
    }
}
