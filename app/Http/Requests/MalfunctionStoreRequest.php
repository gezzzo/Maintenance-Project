<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MalfunctionStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->isMethod('post')) {
            return [
                'name' => 'required|string|max:258',
                'description' => 'required|string',
                'location' => 'required|string',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'customer_id' => 'required|integer'

            ];
        } else {
            return [
                'name' => 'required|string|max:258',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'description' => 'required|string',
                'location' => 'required|string',
                'customer_id' => 'required|integer'
            ];
        }
    }

    public function messages(): array
    {
        if(request()->isMethod('post')) {
            return [
                'name.required' => 'Name is required!',
                'img.required' => 'Image is required!',
                'location.required' => 'Location is required!',
                'description.required' => 'Descritpion is required!',
                'customer_id.required' => 'Customer is required!'

            ];
        } else {
            return [
                'name.required' => 'Name is required!',
                'location.required' => 'Location is required!',
                'description.required' => 'Descritpion is required!',
                'customer_id.required' => 'Customer is required!'
                ];
        }
    }


}
