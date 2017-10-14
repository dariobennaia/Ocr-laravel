class ConversaoOcr {

    constructor() { }

    barraProgresso(percentComplete) {
        let progressBar = $('.progress-bar');
        progressBar.css('width', percentComplete+'%');
        progressBar.html('(' + percentComplete + '%)');
    }

    resultado(dados) {
        $('#resultado_ocr').html(dados);
    }

    eventoBtnLimparResultado(disable) {
        $('#limpar_resultado').prop('disabled', disable);
    }

    eventoBloqueioUpload(disable) {
        $('#input_file_now').prop('disabled', disable);
    }

    converter(url) {
        this.barraProgresso(1);
        this.eventoBtnLimparResultado(true);

        $('#form_upload').ajaxForm({
            uploadProgress: function (event, position, total, percentComplete) {
                let getConversaoOcr = new ConversaoOcr();
                getConversaoOcr.barraProgresso((percentComplete - 10));
                getConversaoOcr.eventoBloqueioUpload(true);
            },
            success: function (data) {
                let getConversaoOcr = new ConversaoOcr();
                getConversaoOcr.resultado(data.resultado);
                getConversaoOcr.eventoBtnLimparResultado(false);
                getConversaoOcr.eventoBloqueioUpload(false);
                return true;
            },
            complete: function (xhr) {
                let getConversaoOcr = new ConversaoOcr();
                getConversaoOcr.barraProgresso(100);
            },
            error: function () {
                let getConversaoOcr = new ConversaoOcr();
                getConversaoOcr.resultado('Ocorreu um erro durante o upload das imagens!');
            },
            dataType: 'json',
            url: url,
            type: 'POST'
        }).submit();
    }


    limparResultado() {
        this.resultado(" ");
        this.barraProgresso(0);

    }

    initDropify() {
        $('.dropify').dropify();
    }
}