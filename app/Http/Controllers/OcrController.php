<?php

namespace App\Http\Controllers;

use App\Http\Requests\OcrRequest;
use Intervention\Image\ImageManagerStatic as Image;

class OcrController extends Controller
{

    /** Função responsavel por converter imagem em texto, de acordo com a biblioteca tesseract
     * @param OcrRequest $ocrRequest
     * @return string
     * @author Dário Santos
     */
    public function convert(OcrRequest $ocrRequest)
    {
        #verifica se foi informado alguma imagem.
        if(!$ocrRequest->hasFile('imagem'))
            return json_encode(['resultado'=>'Ocorreu um erro ao fazer o upload!']);

        #tenta fazer a conversão.
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

        #retorna o erro ou o resultado da conversão.
        return json_encode(['resultado'=>$resultadoConversao]);
    }


}
