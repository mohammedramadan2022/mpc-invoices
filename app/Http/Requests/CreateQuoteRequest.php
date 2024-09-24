<?php

namespace App\Http\Requests;

use App\Models\Quote;
use App\Rules\UniqueWithClient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateQuoteRequest extends FormRequest
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
     */
    public function rules()
    {



        return [
            'client_id'  => 'required|exists:clients,id',
            'quote_id'   => [
                'required',
                new UniqueWithClient('quotes', 'quote_id', 'client_id', null)
            ],
            'quote_date' => 'required',
            'due_date'   => 'required',
            'shop_name'  => 'required',
            'location'   => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => __('messages.quote.client_id_required'),
            'quote_date.required' => 'The Quote date field is required.',
            'due_date' => 'The Quote Due date field is required.',
        ];
    }
}
