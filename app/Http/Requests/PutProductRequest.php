<?php

namespace App\Http\Requests;

use App\Enums\CurrencyEnum;
use App\Enums\ProducerEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function Symfony\Component\Translation\t;

class PutProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|',
            'producer' => ['required', Rule::in(ProducerEnum::values())],
            'description' => 'required|string',
            'price' => 'required|decimal:2',
            'image' => 'file',
            'currency' => [Rule::in(CurrencyEnum::values())]

        ];
    }
}
