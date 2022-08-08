<?php
namespace App\Http\Requests\factura;
use Illuminate\Foundation\Http\FormRequest;

class StoreArchivosRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'factura_pdf' => 'nullable|required_with:factura_xlm|mimes:pdf|max:1024',
			'factura_xlm' => 'nullable|required_with:factura_pdf|mimes:xml|max:1024',
      'ppd_pdf' 		=> 'nullable|required_with:ppd_xlm|mimes:pdf|max:1024',
			'ppd_xlm' 		=> 'nullable|required_with:ppd_pdf|mimes:xml|max:1024',
    ];
  }
}