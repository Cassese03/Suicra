<?php $magazzino_prova = DB::select('SELECT * from MG'); ?>
<?php if(sizeof($doc) != 0) {?>

<!doctype html>
<html lang="en" class="md">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <link rel="apple-touch-icon" href="img/icona_arca.png">
    <link rel="icon" href="img/icona_arca.png">
    <link rel="stylesheet" href="/vendor/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/materializeicon/material-icons.css">
    <link rel="stylesheet" href="/vendor/swiper/css/swiper.min.css">
    <link id="theme" rel="stylesheet" href="/css/style.css" type="text/css">
    <title>Arca Logistic</title>
</head>

<style>
    @charset "UTF-8";
    .collapsable-source pre {
        font-size: small;
    }

    .input-field {
        display: flex;
        align-items: center;
        width: 260px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .input-field label {
        flex: 0 0 auto;
        padding-right: 0.5rem;
    }

    .input-field input {
        flex: 1 1 auto;
        height: 20px;
    }

    .input-field button {
        flex: 0 0 auto;
        height: 28px;
        font-size: 20px;
        width: 40px;
    }

    .icon-barcode {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZD0iTTAgNGg0djIwaC00ek02IDRoMnYyMGgtMnpNMTAgNGgydjIwaC0yek0xNiA0aDJ2MjBoLTJ6TTI0IDRoMnYyMGgtMnpNMzAgNGgydjIwaC0yek0yMCA0aDF2MjBoLTF6TTE0IDRoMXYyMGgtMXpNMjcgNGgxdjIwaC0xek0wIDI2aDJ2MmgtMnpNNiAyNmgydjJoLTJ6TTEwIDI2aDJ2MmgtMnpNMjAgMjZoMnYyaC0yek0zMCAyNmgydjJoLTJ6TTI0IDI2aDR2MmgtNHpNMTQgMjZoNHYyaC00eiI+PC9wYXRoPjwvc3ZnPg==);
    }

    .overlay {
        overflow: hidden;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.3);
    }

    .overlay__content {
        top: 50%;
        position: absolute;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-height: 90%;
        max-width: 800px;
    }

    .overlay__close {
        position: absolute;
        right: 0;
        padding: 0.5rem;
        width: 2rem;
        height: 2rem;
        line-height: 2rem;
        text-align: center;
        background-color: white;
        cursor: pointer;
        border: 3px solid black;
        font-size: 1.5rem;
        margin: -1rem;
        border-radius: 2rem;
        z-index: 100;
        box-sizing: content-box;
    }

    .overlay__content video {
        width: 100%;
        height: 100%;
    }

    .overlay__content canvas {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
    }

    #interactive.viewport {
        position: relative;
    }

    #interactive.viewport > canvas, #interactive.viewport > video {
        max-width: 100%;
        width: 100%;
    }

    canvas.drawing, canvas.drawingBuffer {
        position: absolute;
        left: 0;
        top: 0;
    }

    /* line 16, ../sass/_viewport.scss */
    .controls fieldset {
        border: none;
        margin: 0;
        padding: 0;
    }
    /* line 19, ../sass/_viewport.scss */
    .controls .input-group {
        float: left;
    }
    /* line 21, ../sass/_viewport.scss */
    .controls .input-group input, .controls .input-group button {
        display: block;
    }
    /* line 25, ../sass/_viewport.scss */
    .controls .reader-config-group {
        float: right;
    }
    /* line 28, ../sass/_viewport.scss */
    .controls .reader-config-group label {
        display: block;
    }
    /* line 30, ../sass/_viewport.scss */
    .controls .reader-config-group label span {
        width: 9rem;
        display: inline-block;
        text-align: right;
    }
    /* line 37, ../sass/_viewport.scss */
    .controls:after {
        content: '';
        display: block;
        clear: both;
    }

    /* line 22, ../sass/_viewport.scss */
    #result_strip {
        margin: 10px 0;
        border-top: 1px solid #EEE;
        border-bottom: 1px solid #EEE;
        padding: 10px 0;
    }
    /* line 28, ../sass/_viewport.scss */
    #result_strip ul.thumbnails {
        padding: 0;
        margin: 0;
        list-style-type: none;
        width: auto;
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
    }
    /* line 37, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li {
        display: inline-block;
        vertical-align: middle;
        width: 160px;
    }
    /* line 41, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail {
        padding: 5px;
        margin: 4px;
        border: 1px dashed #CCC;
    }
    /* line 46, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail img {
        max-width: 140px;
    }
    /* line 49, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail .caption {
        white-space: normal;
    }
    /* line 51, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail .caption h4 {
        text-align: center;
        word-wrap: break-word;
        height: 40px;
        margin: 0px;
    }
    /* line 61, ../sass/_viewport.scss */
    #result_strip ul.thumbnails:after {
        content: "";
        display: table;
        clear: both;
    }

    @media (max-width: 603px) {
        /* line 2, ../sass/phone/_core.scss */
        #container {
            margin: 10px auto;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
    }
    @media (max-width: 603px) {
        /* line 5, ../sass/phone/_viewport.scss */
        .reader-config-group {
            width: 100%;
        }

        .reader-config-group label > span {
            width: 50%;
        }

        .reader-config-group label > select, .reader-config-group label > input {
            max-width: calc(50% - 2px);
        }

        #interactive.viewport {
            width: 100%;
            height: auto;
            overflow: hidden;
        }

        /* line 20, ../sass/phone/_viewport.scss */
        #result_strip {
            margin-top: 5px;
            padding-top: 5px;
        }

        #result_strip ul.thumbnails {
            width: 100%;
            height: auto;
        }

        /* line 24, ../sass/phone/_viewport.scss */
        #result_strip ul.thumbnails > li {
            width: 150px;
        }
        /* line 27, ../sass/phone/_viewport.scss */
        #result_strip ul.thumbnails > li .thumbnail .imgWrapper {
            width: 130px;
            height: 130px;
            overflow: hidden;
        }
        /* line 31, ../sass/phone/_viewport.scss */
        #result_strip ul.thumbnails > li .thumbnail .imgWrapper img {
            margin-top: -25px;
            width: 130px;
            height: 180px;
        }
    }
</style>
<body class="color-theme-red push-content-right theme-light">

<div class="loader justify-content-center ">
    <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
<div class="wrapper">

    <!-- page main start -->
    <div class="page">
        <form class="searchcontrol">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="input-group-text close-search"><i class="material-icons">keyboard_backspace</i></button>
                </div>
                <input type="text" id="cerca" class="form-control border-0" placeholder="Cerca Fornitore..." aria-label="Username">
            </div>
        </form>
        <header class="row m-0 fixed-header">
            <div class="left">
                <a style="padding-left:20px;" href="/magazzino/trasporto3/<?php echo $Cd_AR ?>/<?php  echo $Cd_Do?>/<?php echo $Cd_Cf ?>/<?php  echo $Cd_MG ?>/<?php echo $Cd_MGUbicazione_P ?>/<?php echo $Cd_ARLotto?>/<?php echo $Id_DoTes?>" ><i class="material-icons">arrow_back_ios</i></a>
            </div>
            <div class="col center">
                <a href="#" class="logo"><figure><img src="/img/logo_arca.png" alt=""></figure>Definisci Quantita'</a>
            </div>
            <div class="right">
                <a style="padding-left:20px;" href="/" ><i class="material-icons">home</i></a>
            </div>
        </header>

        <div class="page-content">
            <div class="content-sticky-footer">

                <div class="background bg-125"><img src="/img/background.png" alt=""></div>

                <div class="w-100">
                    <h1 class="text-center text-white title-background">Inserire la Quantita'<br><small>BCV(<?php echo $Id_DoTes ?>)</small></h1>
                </div>

                <div style="text-align: center">
                    <h6 style="padding-top: 25px">Stai spostando l'articolo </h6><h6 style="color: red"><?php echo $Cd_AR?></h6>
                    <h6> dal magazzino </h6><h6 style="color: red"><?php echo $Cd_MG?></h6><h6> al magazzino </h6><h6 style="color: red"><?php echo $Cd_Mg_A ?> </h6>
                </div>

                <div class="media-body">
                    <div class="col-xs-6 col-sm-6 col-md-6">





                <?php foreach($docu->righe as $r){  ?>
                <div style="text-align: center">

                    <li class="list-group-item" style="padding-top: 10px">
                        <a href="#" onclick="" class="media">
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <h5><?php echo $r->Cd_AR.' '.$r->Descrizione.' - Quantita: '.intval($r->Qta)?></h5>
                                        <p>Partenza: <?php echo 'Magazzino: '.$r->Cd_MG_P;if($r->Cd_MGUbicazione_P != null)echo ' - '.$r->Cd_MGUbicazione_P; if($r->Cd_ARLotto != Null)echo ' - Lotto: '.$r->Cd_ARLotto?></p>
                                        <p>Arrivo: <?php echo 'Magazzino: '.$r->Cd_MG_A;if($r->Cd_MGUbicazione_A != null) echo ' - '.$r->Cd_MGUbicazione_A; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                </div>

                <?php } ?>
                    <div style="text-align: center;padding-top: 20px">
                        <form action="#" onsubmit="finito()">
                        <div>
                            <button type="button" style="background-color: indianred ;font-size:0;height: 30px;position:absolute;left:125px" onclick="diminuisci()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>

                            <input type="number" id='quantita' style="height: 30px;width:55px;margin-bottom: 10px;text-align:center"  autocomplete="off"  value="0.00" required>



                            <button type="button" style="background-color: mediumseagreen;font-size:0;height: 30px;position:absolute;right:125px" onclick="aumenta()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                        </div>
                            <input type="hidden" id="Cd_AR" value="<?php echo $Cd_AR ?>">
                            <input type="hidden" id="Cd_Do" value="<?php echo $Cd_Do ?>">
                            <input type="hidden" id="Cd_MG" value="<?php echo $Cd_MG ?>">
                            <input type="hidden" id="Cd_MGUbicazione_P" value="<?php echo $Cd_MGUbicazione_P ?>">
                            <input type="hidden" id="Cd_MGUbicazione_A" value="<?php echo $Cd_MGUbicazione_A ?>">
                            <input type="hidden" id="Cd_Mg_A" value="<?php echo $Cd_Mg_A ?>">
                            <input type="hidden" id="Cd_Cf" value="<?php echo $Cd_Cf ?>">
                            <input type="hidden" id="Cd_ARLotto" value="<?php echo $Cd_ARLotto ?>">
                            <input type="hidden" id="Id_DoTes" value="<?php echo $doc[0]->Id_DOTes ?>"><br>
                            <div  style="padding-top: 10px">
                                <button  type="submit" class="btn btn-danger btn-sm" style="background-color: cadetblue;"  onclick="trasporto_articolo()">Inserisci Quantita'</button>

                                <button  type="button" class="btn btn-danger btn-sm" style="background-color: cadetblue;" onclick="$('#modal_cerca_articolo').modal('show')">Cambia Articolo</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        function cerca_articolo(){

            codice          = document.getElementById('cerca_ar').value;

            $.ajax({
                url: "<?php echo URL::asset('ajax/cerca_articolo_trasporto') ?>/"+encodeURIComponent(codice),
                context: document.body
            }).done(function(result) {
                $('#ajax_risposta').html(result);
            });
        }
        function cambio_articolo(codice,lotto){

            top.location.href =('/magazzino/trasporto4/'+codice+'/<?php  echo $Cd_Do?>/<?php echo $Cd_Cf ?>/<?php  echo $Cd_MG?>/<?php echo $Cd_MGUbicazione_P ?>/<?php  echo $Cd_Mg_A ?>/<?php echo $Cd_MGUbicazione_A ?>/'+lotto+'/<?php echo $Id_DoTes ?>');

        }
        function finito(){
            quantita        = document.getElementById('quantita').value;
            if(quantita>0)
                alert('Transazione Completata');
            else
                alert('Inserire una Quantita\' maggiore di 0');

        }
        function aumenta(){
            quantita = document.getElementById('quantita').value;
            quantita++
            document.getElementById("quantita").value = quantita.toFixed(2);
        }
        function diminuisci(){
            quantita = document.getElementById('quantita').value;
            if(quantita > 0)
                quantita --;
            document.getElementById("quantita").value = quantita.toFixed(2);
        }

        function trasporto_articolo(){

            codice          = document.getElementById('Cd_AR').value;
            documento       = document.getElementById('Cd_Do').value;
            magazzino       = document.getElementById('Cd_MG').value;
            magazzino_A     = document.getElementById('Cd_Mg_A').value;
            ubicazione_A    = document.getElementById('Cd_MGUbicazione_A').value;
            ubicazione_P    = document.getElementById('Cd_MGUbicazione_P').value;
            fornitore       = document.getElementById('Cd_Cf').value;
            quantita        = document.getElementById('quantita').value;
            lotto           = document.getElementById('Cd_ARLotto').value;
            dotes           = document.getElementById('Id_DoTes').value;

            if(quantita != ''){
                $.ajax({
                    url: "<?php echo URL::asset('ajax/trasporto_articolo') ?>/"+documento+"/"+codice+"/"+quantita+"/"+magazzino+"/"+ubicazione_P+"/"+magazzino_A+"/"+ubicazione_A+"/"+fornitore+"/"+lotto+"/"+dotes
                }).done(function(result) {

                    top.location.href =('/magazzino/trasporto4/<?php echo $Cd_AR ?>/<?php  echo $Cd_Do?>/<?php echo $Cd_Cf ?>/<?php  echo $Cd_MG?>/<?php echo $Cd_MGUbicazione_P ?>/<?php  echo $Cd_Mg_A ?>/<?php echo $Cd_MGUbicazione_A ?>/<?php echo $Cd_ARLotto.'/'.$doc[0]->Id_DOTes ?>');

                });

            } else alert('Inserire Una Quantità');
        }
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>
    <script src="/vendor/cookie/jquery.cookie.js"></script>
    <script src="/vendor/sparklines/jquery.sparkline.min.js"></script>
    <script src="/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="/vendor/swiper/js/swiper.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
    <script src="/dist/quagga.js" type="text/javascript"></script>
    <script src="/js/live_w_locator.js" type="text/javascript"></script>
    <script src="/js/jquery.scannerdetection.js" type="text/javascript"></script>
<div class="modal fade" id="modal_cerca_articolo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerca Articolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <label>Cambia Articolo</label>
                    <input class="form-control" type="text" id="cerca_ar" placeholder="Inserisci barcode,codice o nome dell'articolo" autocomplete="off" autofocus>

                    <div id="ajax_risposta"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="cerca_articolo();">Cambia Articolo</button>
                </div>

            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php } else {?>
<!doctype html>
<html lang="en" class="md">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <link rel="apple-touch-icon" href="img/icona_arca.png">
    <link rel="icon" href="img/icona_arca.png">
    <link rel="stylesheet" href="/vendor/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/materializeicon/material-icons.css">
    <link rel="stylesheet" href="/vendor/swiper/css/swiper.min.css">
    <link id="theme" rel="stylesheet" href="/css/style.css" type="text/css">
    <title>Arca Logistic</title>
</head>

<style>
    @charset "UTF-8";

    .collapsable-source pre {
        font-size: small;
    }

    .input-field {
        display: flex;
        align-items: center;
        width: 260px;
    }

    .input-field label {
        flex: 0 0 auto;
        padding-right: 0.5rem;
    }

    .input-field input {
        flex: 1 1 auto;
        height: 20px;
    }

    .input-field button {
        flex: 0 0 auto;
        height: 28px;
        font-size: 20px;
        width: 40px;
    }

    .icon-barcode {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZD0iTTAgNGg0djIwaC00ek02IDRoMnYyMGgtMnpNMTAgNGgydjIwaC0yek0xNiA0aDJ2MjBoLTJ6TTI0IDRoMnYyMGgtMnpNMzAgNGgydjIwaC0yek0yMCA0aDF2MjBoLTF6TTE0IDRoMXYyMGgtMXpNMjcgNGgxdjIwaC0xek0wIDI2aDJ2MmgtMnpNNiAyNmgydjJoLTJ6TTEwIDI2aDJ2MmgtMnpNMjAgMjZoMnYyaC0yek0zMCAyNmgydjJoLTJ6TTI0IDI2aDR2MmgtNHpNMTQgMjZoNHYyaC00eiI+PC9wYXRoPjwvc3ZnPg==);
    }

    .overlay {
        overflow: hidden;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.3);
    }

    .overlay__content {
        top: 50%;
        position: absolute;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-height: 90%;
        max-width: 800px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .overlay__close {
        position: absolute;
        right: 0;
        padding: 0.5rem;
        width: 2rem;
        height: 2rem;
        line-height: 2rem;
        text-align: center;
        background-color: white;
        cursor: pointer;
        border: 3px solid black;
        font-size: 1.5rem;
        margin: -1rem;
        border-radius: 2rem;
        z-index: 100;
        box-sizing: content-box;
    }

    .overlay__content video {
        width: 100%;
        height: 100%;
    }

    .overlay__content canvas {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
    }

    #interactive.viewport {
        position: relative;
    }

    #interactive.viewport > canvas, #interactive.viewport > video {
        max-width: 100%;
        width: 100%;
    }

    canvas.drawing, canvas.drawingBuffer {
        position: absolute;
        left: 0;
        top: 0;
    }

    /* line 16, ../sass/_viewport.scss */
    .controls fieldset {
        border: none;
        margin: 0;
        padding: 0;
    }
    /* line 19, ../sass/_viewport.scss */
    .controls .input-group {
        float: left;
    }
    /* line 21, ../sass/_viewport.scss */
    .controls .input-group input, .controls .input-group button {
        display: block;
    }
    /* line 25, ../sass/_viewport.scss */
    .controls .reader-config-group {
        float: right;
    }
    /* line 28, ../sass/_viewport.scss */
    .controls .reader-config-group label {
        display: block;
    }
    /* line 30, ../sass/_viewport.scss */
    .controls .reader-config-group label span {
        width: 9rem;
        display: inline-block;
        text-align: right;
    }
    /* line 37, ../sass/_viewport.scss */
    .controls:after {
        content: '';
        display: block;
        clear: both;
    }

    /* line 22, ../sass/_viewport.scss */
    #result_strip {
        margin: 10px 0;
        border-top: 1px solid #EEE;
        border-bottom: 1px solid #EEE;
        padding: 10px 0;
    }
    /* line 28, ../sass/_viewport.scss */
    #result_strip ul.thumbnails {
        padding: 0;
        margin: 0;
        list-style-type: none;
        width: auto;
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
    }
    /* line 37, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li {
        display: inline-block;
        vertical-align: middle;
        width: 160px;
    }
    /* line 41, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail {
        padding: 5px;
        margin: 4px;
        border: 1px dashed #CCC;
    }
    /* line 46, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail img {
        max-width: 140px;
    }
    /* line 49, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail .caption {
        white-space: normal;
    }
    /* line 51, ../sass/_viewport.scss */
    #result_strip ul.thumbnails > li .thumbnail .caption h4 {
        text-align: center;
        word-wrap: break-word;
        height: 40px;
        margin: 0px;
    }
    /* line 61, ../sass/_viewport.scss */
    #result_strip ul.thumbnails:after {
        content: "";
        display: table;
        clear: both;
    }

    @media (max-width: 603px) {
        /* line 2, ../sass/phone/_core.scss */
        #container {
            margin: 10px auto;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
    }
    @media (max-width: 603px) {
        /* line 5, ../sass/phone/_viewport.scss */
        .reader-config-group {
            width: 100%;
        }

        .reader-config-group label > span {
            width: 50%;
        }

        .reader-config-group label > select, .reader-config-group label > input {
            max-width: calc(50% - 2px);
        }

        #interactive.viewport {
            width: 100%;
            height: auto;
            overflow: hidden;
        }

        /* line 20, ../sass/phone/_viewport.scss */
        #result_strip {
            margin-top: 5px;
            padding-top: 5px;
        }

        #result_strip ul.thumbnails {
            width: 100%;
            height: auto;
        }

        /* line 24, ../sass/phone/_viewport.scss */
        #result_strip ul.thumbnails > li {
            width: 150px;
        }
        /* line 27, ../sass/phone/_viewport.scss */
        #result_strip ul.thumbnails > li .thumbnail .imgWrapper {
            width: 130px;
            height: 130px;
            overflow: hidden;
        }
        /* line 31, ../sass/phone/_viewport.scss */
        #result_strip ul.thumbnails > li .thumbnail .imgWrapper img {
            margin-top: -25px;
            width: 130px;
            height: 180px;
        }
    }
</style>
<body class="color-theme-red push-content-right theme-light">

<div class="loader justify-content-center ">
    <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
<div class="wrapper">

    <!-- page main start -->

    <div class="page">
        <form class="searchcontrol">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="input-group-text close-search"><i class="material-icons">keyboard_backspace</i></button>
                </div>
                <input type="text" id="cerca" class="form-control border-0" placeholder="Cerca Fornitore..." aria-label="Username">
            </div>
        </form>

        <header class="row m-0 fixed-header">
            <div class="left">
                <a style="padding-left:20px;" href="/magazzino/trasporto3/<?php echo $Cd_AR ?>/<?php  echo $Cd_Do?>/<?php echo $Cd_Cf ?>/<?php  echo $Cd_MG ?>/<?php echo $Cd_MGUbicazione_P ?>/<?php echo $Cd_ARLotto?>/<?php echo $Id_DoTes?>" ><i class="material-icons">arrow_back_ios</i></a>
            </div>
            <div class="col center">
                <a href="#" class="logo"><figure><img src="/img/logo_arca.png" alt=""></figure>Definisci Quantita'</a>
            </div>
            <div class="right">
                <a style="padding-left:20px;" href="/" ><i class="material-icons">home</i></a>
            </div>
        </header>

        <div class="page-content">
            <div class="content-sticky-footer">

                <div class="background bg-125"><img src="/img/background.png" alt=""></div>

                <div class="w-100">
                    <h1 class="text-center text-white title-background">Inserire la Quantita'<br><small>BCV(<?php echo $Id_DoTes ?>)</small></h1>
                </div>

                <div style="text-align: center">
                    <h6 style="padding-top: 25px">Stai spostando l'articolo </h6><h6 style="color: red"><?php echo $Cd_AR?></h6>
                    <h6> dal magazzino </h6><h6 style="color: red"><?php echo $Cd_MG?></h6><h6> al magazzino </h6><h6 style="color: red"><?php echo $Cd_Mg_A ?> </h6>
                </div>

                <div class="media-body" >
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div style="text-align: center">
                            <form action="#" onsubmit="finito()">
                                <button type="button" style="background-color: indianred ;font-size:0;height: 30px;position:absolute;left:125px" onclick="diminuisci()">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                    </svg>
                                </button>

                                <input type="number" id='quantita' style="height: 30px;width:55px;margin-bottom: 10px;text-align:center"  autocomplete="off"  value="0.00" required>

                                <button type="button" style="background-color: mediumseagreen;font-size:0;height: 30px;position:absolute;right:125px" onclick="aumenta()">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </button>
                                <input type="hidden" id="Cd_AR" value="<?php echo $Cd_AR ?>">
                                <input type="hidden" id="Cd_Do" value="<?php echo $Cd_Do ?>">
                                <input type="hidden" id="Cd_MG" value="<?php echo $Cd_MG ?>">
                                <input type="hidden" id="Cd_MGUbicazione_P" value="<?php echo $Cd_MGUbicazione_P ?>">
                                <input type="hidden" id="Cd_MGUbicazione_A" value="<?php echo $Cd_MGUbicazione_A ?>">
                                <input type="hidden" id="Cd_Mg_A" value="<?php echo $Cd_Mg_A ?>">
                                <input type="hidden" id="Cd_Cf" value="<?php echo $Cd_Cf ?>">
                                <input type="hidden" id="Cd_ARLotto" value="<?php echo $Cd_ARLotto ?>">
                                <input type="hidden" id="Id_DoTes" value="<?php echo $Id_DoTes ?>">

                                <div style="padding-top: 10px">
                                    <button  type="submit" class="btn btn-danger btn-sm"  onclick="trasporto_articolo()">Inserisci Quantita'</button>
                                    <button  type="button" class="btn btn-danger btn-sm" style="background-color:blue;" onclick="$('#modal_cerca_articolo').modal('show')">Cambia Articolo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>





                <?php /* foreach($docu->righe as $r){  ?>
                <li class="list-group-item" style="padding-top: 25px">
                    <a href="#" onclick="" class="media">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <h5><?php echo $r->Cd_AR.' '.$r->Descrizione.' - Quantita: '.intval($r->Qta)?></h5>
                                    <p>Partenza: <?php echo 'Magazzino: '.$r->Cd_MG_P;if($r->Cd_MGUbicazione_P != null)echo ' - '.$r->Cd_MGUbicazione_P; if($r->Cd_ARLotto != Null)echo ' - Lotto: '.$r->Cd_ARLotto?></p>
                                    <p>Arrivo: <?php echo 'Magazzino: '.$r->Cd_MG_A;if($r->Cd_MGUbicazione_A != null) echo ' - '.$r->Cd_MGUbicazione_A; ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php }*/ ?>

            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">

        function finito(){
            quantita        = document.getElementById('quantita').value;
            if(quantita>0)
            alert('Transazione Completata');
            else
                alert('Inserire una Quantita\' maggiore di 0');
        }
        function cerca_articolo(){

            codice = document.getElementById('cerca_ar').value;

            $.ajax({
                url: "<?php echo URL::asset('ajax/cerca_articolo_trasporto') ?>/"+encodeURIComponent(codice),
                context: document.body
            }).done(function(result) {
                $('#ajax_risposta').html(result);
            });
        }
        function cambio_articolo(codice,lotto){

            top.location.href =('/magazzino/trasporto4/'+codice+'/<?php  echo $Cd_Do?>/<?php echo $Cd_Cf ?>/<?php  echo $Cd_MG?>/<?php echo $Cd_MGUbicazione_P ?>/<?php  echo $Cd_Mg_A ?>/<?php echo $Cd_MGUbicazione_A ?>/'+lotto+'/<?php echo $Id_DoTes ?>');

        }
        function aumenta(){
            quantita = document.getElementById('quantita').value;
            quantita ++;
            document.getElementById("quantita").value = quantita.toFixed(2);
        }
        function diminuisci(){
            quantita = document.getElementById('quantita').value;
            quantita --;
            document.getElementById("quantita").value = quantita.toFixed(2);
        }
        function trasporto_articolo(){

            codice          = document.getElementById('Cd_AR').value;
            documento       = document.getElementById('Cd_Do').value;
            magazzino       = document.getElementById('Cd_MG').value;
            magazzino_A     = document.getElementById('Cd_Mg_A').value;
            ubicazione_A    = document.getElementById('Cd_MGUbicazione_A').value;
            ubicazione_P    = document.getElementById('Cd_MGUbicazione_P').value;
            fornitore       = document.getElementById('Cd_Cf').value;
            quantita        = document.getElementById('quantita').value;
            lotto           = document.getElementById('Cd_ARLotto').value;
            dotes           = document.getElementById('Id_DoTes').value;

            if(quantita != ''){
                $.ajax({
                    url: "<?php echo URL::asset('ajax/trasporto_articolo') ?>/"+documento+"/"+codice+"/"+quantita+"/"+magazzino+"/"+ubicazione_P+"/"+magazzino_A+"/"+ubicazione_A+"/"+fornitore+"/"+lotto+"/"+dotes
                }).done(function(result) {

                    top.location.href =('/magazzino/trasporto4/<?php echo $Cd_AR ?>/<?php  echo $Cd_Do?>/<?php echo $Cd_Cf ?>/<?php  echo $Cd_MG?>/<?php echo $Cd_MGUbicazione_P ?>/<?php  echo $Cd_Mg_A ?>/<?php echo $Cd_MGUbicazione_A ?>/<?php echo $Cd_ARLotto.'/'.$Id_DoTes ?>');

                });

            } else alert('Inserire Una Quantità');
        }
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>
    <script src="/vendor/cookie/jquery.cookie.js"></script>
    <script src="/vendor/sparklines/jquery.sparkline.min.js"></script>
    <script src="/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="/vendor/swiper/js/swiper.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
    <script src="/dist/quagga.js" type="text/javascript"></script>
    <script src="/js/live_w_locator.js" type="text/javascript"></script>
    <script src="/js/jquery.scannerdetection.js" type="text/javascript"></script>


<div class="modal" id="modal_cerca_articolo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerca Articolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"s>
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <label>Cambia Articolo</label>
                    <input class="form-control" type="text" id="cerca_ar" placeholder="Inserisci barcode,codice o nome dell'articolo" autocomplete="off" autofocus>
                    <div id="ajax_risposta"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="cerca_articolo();">Cambia Articolo</button>
                </div>

            </div>
        </form>
    </div>
</div>


</body>
</html>
<?php } ?>
