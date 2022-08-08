<?php
namespace App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo\archivoInventario;
use Illuminate\Foundation\Http\FormRequest;

class  StoreArchivosInventarioRequest extends  FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      "imagenes"     =>    "required|array",
      "imagenes.*"   =>    "required|image|max:1024",
    ];
  }
} 