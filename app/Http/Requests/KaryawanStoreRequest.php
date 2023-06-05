<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaryawanStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        if(request()->isMethod('post')) {
            return [
                'nik' => 'required|string|max:30',
                'nama' => 'required|string|max:258',
                'umur' => 'required|string',
                'alamat' => 'required|string|max:258',
                'notelp' => 'required|string|max:14',
                'email' => 'required|string|max:258',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                
            ];
        }else{
            return [
                'nik' => 'required|string|max:30',
                'nama' => 'required|string|max:258',
                'umur' => 'required|string',
                'alamat' => 'required|string|max:258',
                'notelp' => 'required|string|max:14',
                'email' => 'required|string|max:258',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                
            ];
        }
    }

    public function message()
    {
        if(request()->isMethod('post')) {

            return [
                'nik.required' => 'NIK is required',
                'nama.required' => 'Nama is required',
                'umur.required' => 'Umur is required',
                'alamat.required' => 'Alamat is required',
                'notelp.required' => 'No Telepon is required',
                'email.required' => 'Email is required',
                'foto.required' => 'Image is required',
            ];
        } else {
            return [
                'nik.required' => 'NIK is required',
                'nama.required' => 'Nama is required',
                'umur.required' => 'Umur is required',
                'alamat.required' => 'Alamat is required',
                'notelp.required' => 'No Telepon is required',
                'email.required' => 'Email is required',
            ];
        }
    }
}