<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/conversao_ocr.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('node_modules/dropify/dist/css/demo.css') }}">
        <link rel="stylesheet" href="{{ asset('node_modules/dropify/dist/css/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/conversao_ocr.css') }}">

    </head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">

                {{ Form::open(['enctype' => 'multipart/form-data', 'id' => 'form_upload']) }}
                    <input type="file" name="imagem" id="input_file_now" class="dropify">
                {{ Form::close() }}

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 progress-top">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                         aria-valuemin="0" aria-valuemax="100">
                        0%
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="resultado-ocr" id="resultado_ocr">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="button" id="limpar_resultado" class="btn btn-danger btn-block dropify-clear">Limpar Resultado</button>
            </div>
        </div>
    </div>

    </body>
    <script src="{{ asset('node_modules/dropify/dist/js/dropify.min.js') }}"></script>
    <script>


        $(document).ready(function() {
            let getConversaoOcr = new ConversaoOcr();

            getConversaoOcr.initDropify();

            $('#input_file_now').change(function () {
                getConversaoOcr.converter('{{ url('/ocr/convert') }}');
            });

            $('#limpar_resultado, .dropify-clear').click(function () {
                getConversaoOcr.limparResultado();
            });
        });


    </script>
</html>
