<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(auth()->user()->type == 'patient'){
            return [
                'service_id' => "required",
                'service_type' => "required",
                'start_date' => "required",
                // 'end_date' => "required",
                'start_time' => "required",
                'end_time' => "required",
            ];
        }else{
            return [
                'status' => "required",
            ];
        }
        
    }
    
    public function messages(){
		return [
			'patient_id.required' => "The Patient field is required.",
			'service_id.required' => "The Service field is required.",
		];
	}
}
