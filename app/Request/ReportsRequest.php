<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class ReportsRequest extends FormRequest
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
        return [
            'report_date'=>'required',
            'pharmacy_address'=>'required',
            'notes_user'=>'required',
            'district'=>'required',
            'commercial_name'=>'required',
            'material_name'=>'required',
            'drug_picture'=>'required|mimes:png,jpg,jpeg',
            'companies_name'=>'required',
            'agent_name'=>'required',
            'presented_report'=>'required',
            'report_status'=>'required',
            'app_user_no'=>'required',
            'type_report_no'=>'required',
            'drug_no'=>'required',
            'report_details_no'=>'required',
            'site_no'=>'required',

        ];
    }


    public function messages()
    {

        return [
            'report_date'.'required'=>'هذاالحقل مطلوب',
            'pharmacy_address'.'required'=>'هذاالحقل مطلوب',
            'notes_user'.'required'=>'هذاالحقل مطلوب',
            'district'.'required'=>'هذاالحقل مطلوب',
            'commercial_name'.'required'=>'هذاالحقل مطلوب',
            'material_name'.'required'=>'هذاالحقل مطلوب',
            'drug_picture'.'required'=>' هذاالحقل مطلوب',
            'drug_picture'.'mimes'=>'هذي الصوره غير صالحة',
            'companies_name'.'required'=>'هذاالحقل مطلوب',
            'agent_name'.'required'=>'هذاالحقل مطلوب',
            'presented_report'.'required'=>'هذاالحقل مطلوب',
            'report_status'.'required'=>'هذاالحقل مطلوب',
            'app_user_no'.'required'=>'هذاالحقل مطلوب',
            'type_report_no'.'required'=>'هذاالحقل مطلوب',
            'drug_no'.'required'=>'هذاالحقل مطلوب',
            'report_details_no'.'required'=>'هذاالحقل مطلوب',
            'site_no'.'required'=>'هذاالحقل مطلوب',


        ];
    }
}
