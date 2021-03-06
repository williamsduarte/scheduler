<?php

namespace App\Domains\Patient\Validations;

use App\Support\Validation\Validation;
use Illuminate\Validation\Rule;

class UpdatePatientByIdValidation extends Validation
{
    /**
     * @var $data
     */
    protected $data;

    /**
     * CreateNewDoctorValidation constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('patients', 'email')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })->ignore($this->data['id']),
                'email'
            ],
            'cpf' => [
                'required',
                Rule::unique('patients', 'cpf')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })->ignore($this->data['id']),
                'cpf'
            ]
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'cpf.cpf' => 'CPF is invalid.'
        ];
    }
}
