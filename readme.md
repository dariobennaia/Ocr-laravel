## DBSystemOCR

O DBSystemOCR é um sistema que se baseia na tecnologia OCR para a conversão de imagens, que contenham textos, frases ou qualquer enunciado, e o converte para o formato texto. O sistema tenta idendificar todo caractere da imgagem para o converter.

##  Requisitos:

- PHP 7.0 >=
- Composer
- Tesseract OCR: <br> 
  [Linux] -> sudo apt-get install tesseract-ocr
          
## Instalação:

Para instalar o sistema rode o seguinte comando.

- git clone https://github.com/dariobennaia/ocr.git path

Substitua "path" pelo nome do seu projeto.
Após isso entre na pasta do seu projeto rode o comando 

- composer install

Crie o .env e gere a APP_KEY do framework Laravel

- php artisan key:generate

Após esses procedimentos basta acessar:

[SEU_LOCAL_HOST]/[NOME_APLICACAO]/public/
