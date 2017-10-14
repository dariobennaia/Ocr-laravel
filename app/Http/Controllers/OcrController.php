<?php

namespace App\Http\Controllers;

use App\Http\Requests\OcrRequest;
use Intervention\Image\ImageManagerStatic as Image;



class OcrController extends Controller
{

    public function convert(OcrRequest $ocrRequest)
    {

        if(!$ocrRequest->hasFile('imagem'))
            return json_encode(['resultado'=>'Ocorreu um erro ao fazer o upload!']);

        try {
            $imagem         = $ocrRequest->file('imagem');
            $novoNomeImagem = $imagem->store('');;
            $imagemResize   = Image::make($imagem->getRealPath());
            //$imagemResize->resize(300, 300);
            $caminhoImagem  = public_path('uploads/' .$novoNomeImagem);
            $imagemResize->save($caminhoImagem);

            $resultadoConversao = (new \TesseractOCR($caminhoImagem))->run();
        } catch(\Exception $e) {
            $resultadoConversao = $e->getMessage();
        }

        return json_encode(['resultado'=>$resultadoConversao]);

    }


}
