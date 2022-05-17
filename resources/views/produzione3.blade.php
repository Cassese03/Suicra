<?php $magazzino_prova = DB::select('SELECT MG.*,MGUbicazione.Cd_MGUbicazione from MG LEFT JOIN MGUbicazione on MGUbicazione.Cd_MG = MG.Cd_MG');?>
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
        autocomplete:off;
    }

    .input-field label {
        flex: 0 0 auto;
        padding-right: 0.5rem;
        autocomplete:off;

    }
    ::-webkit-scrollbar {
        width: 5px;
        height: 2px;
    }
    .input-field input {
        flex: 1 1 auto;
        height: 20px;
        autocomplete:off;

    }

    .input-field button {
        flex: 0 0 auto;
        height: 28px;
        font-size: 20px;
        width: 40px;
        autocomplete:off;

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

    ::placeholder {
        color: blue;
        opacity: 1;
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
        autocomplete:off;

    }
    /* line 21, ../sass/_viewport.scss */
    .controls .input-group input, .controls .input-group button {
        display: block;
        autocomplete:off;

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

    .form__group {
        position: relative;
        padding: 15px 0 0;
        margin-top: 10px;
        width: 50%;
    }

    .form__field {
        font-family: inherit;
        width: 100%;
        border: 0;
        border-bottom: 2px solid #9b9b9b;
        outline: 0;
        font-size: 1.3rem;
        color: black;
        padding: 7px 0;
        background: transparent;
        transition: border-color 0.2s;

    ::placeholder {
         color: transparent;
     }

    :placeholder-shown ~ .form__label {
         font-size: 1.3rem;
         cursor: text;
         top: 20px;
     }
    }

    .form__label {
        position: absolute;
        top: 0;
        display: block;
        transition: 0.2s;
        font-size: 1rem;
        color: #9b9b9b;
    }

    .form__field:focus {
    ~ .form__label {
        position: absolute;
        top: 0;
        display: block;
        transition: 0.2s;
        font-size: 1rem;
        color: #11998e;
        font-weight:700;
    }
    padding-bottom: 6px;
    font-weight: 700;
    border-width: 3px;
    border-image: linear-gradient(to right, #11998e,#38ef7d;);
    border-image-slice: 1;
    }
    /* reset input */
    .form__field{
    :required,:invalid { box-shadow:none; }
    }
    /* demo */
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
            autocomplete:off;

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
                <a style="padding-left:20px;" href="/" ><i class="material-icons">arrow_back_ios</i></a>
            </div>
            <div class="col center">
                <a href="#" class="logo"><figure><img src="/img/logo_arca.png" alt=""></figure><small><?php echo $documento->Cd_Do ?> N.<?php echo $documento->NumeroDoc ?> del </small><?php echo date('d/m/Y',strtotime($documento->DataDoc)) ?></a>
            </div>
            <div class="right">
                <a style="padding-left:20px;" href="/" ><i class="material-icons">home</i></a>
            </div>
        </header>

        <div class="page-content">
            <div class="content-sticky-footer">
            <?php /*
                <div class="background bg-125" style="height:95px;"><img src="/img/background.png" alt=""></div>
                <div class="w-100">
                    <h1 class="text-center text-white title-background" style="margin-top:-0.5rem;"><?php echo $fornitore->Descrizione ?><br><small><?php echo $documento->Cd_Do ?> N.<?php echo $documento->NumeroDoc ?> del </small><?php echo date('d/m/Y',strtotime($documento->DataDoc)) ?></h1>
                </div>

            <?php $capannone1_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'1\'')[0]->Qta_Max;?>
            <?php $capannone3_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'3\'')[0]->Qta_Max;?>
            <?php $capannone4_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'4\'')[0]->Qta_Max;?>
            <?php $capannone5_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'5\'')[0]->Qta_Max;?>
            <?php $capannoneA_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'A\'')[0]->Qta_Max;
            if($capannoneA_max =='0')
                $capannoneA_max = '1';?>
            <?php $capannoneB_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'B\'')[0]->Qta_Max;?>
            <?php $capannone6_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'6\'')[0]->Qta_Max;?>
 */?>
            <!--
                <fieldset class="reader-config-group" style="margin-top:50px;">
                    <label>
                        <span>Barcode-Type</span>
                        <select name="decoder_readers">
                            <option value="ean">EAN</option>
                            <option value="ean_8">EAN-8</option>
                        </select>
                    </label>
                </fieldset>
				-->


                <div style="padding-right:30px;padding-left: 30px">
                    <button style="width:50%;display:block;height: 30px;float: left;alignment: left" class="btn btn-primary" onclick="<?php //$('#modal_cerca_articolo').modal('show');?>aggiungi()"><h6 style="color: white">Aggiungi Prodotto</h6></button>
                    <button type="button" style="width:50%;display:block;background-color:red;border-color:red;height: 30px;float: right;alignment: right"   name="esplodi_riga" value="<?php echo $documento->Id_DoTes;?>" class="btn btn-primary" onclick="$('#modal_esplodi').modal('show')"><h6 style="color: white">Conferma Documento</h6></button>
                </div>
<?php //                <input type="text" id="cerca_articolo1" onchange="scarica_articolo1();" autofocus autocomplete="off" style="border:none;">?>
                <br>
                <div class="form__group field" style="width: 100%;">
                    <div class="row" style="text-align:center">
                        <div class="col-sm-12">
                          <input type="input" class="col-xs-4 col-sm-4 col-md-4 form__field" placeholder="Articolo" list="articoli" name="cerca_articolo1" id='cerca_articolo1' required />
                            <datalist id="articoli">
                                <?php foreach($articolo as $a){?>
                                <option value="<?php echo $a->Cd_AR?>"><?php echo $a->Cd_AR.' - '.$a->Descrizione ?></option>
                                <?php } ?>
                            </datalist>
                          <input type="input" class="col-xs-4 col-sm-4 col-md-4 form__field" placeholder="Quantita" name="cerca_quantita1" id='cerca_quantita1' required />
                          <input type="input" class="col-xs-3 col-sm-3 col-md-3 form__field" placeholder="Lotto" name="cerca_lotto1" id='cerca_lotto1' required />
                        </div>
                    </div>
                </div>
                <br>
            <?php if(sizeof($documento->righe) > 0){ ?>
                <div class="row">
                    <div class="col-sm-12">
                        <table style="width: 100%">
                            <thead>
                            <tr>

                                <th class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                    <label style="color:black;">Articolo</label>
                                </th>

                                <th class="col-xs-3 col-sm-3 col-md-3" style="text-align: center">
                                    <label style="color:black;">Quantita'</label>
                                </th>

                                <th class="col-xs-2 col-sm-2 col-md-2" style="text-align: center">
                                    <label style="color:black;">Lotto</label>
                                </th>

                                <th class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                    <label style="color:black;">Azioni</label>
                                </th>

                            </tr>

                            </thead>

                            <tbody>
                            <?php foreach($documento->righe as $r){ $totale = 0; ?>
                            <?php if($r->TipoPC != ''){?>
                            <tr style="border:1px solid black;border-collapse: collapse;border-radius: 10px;">
                                <div class="row">
                                    <?php if($r->TipoPC == 'P'){?>
                                        <td class="col-xs-1 col-sm-1 col-md-1" style="height: 35px;text-align: left;padding-left: -5px;">
                                            <label style="color:black;margin-bottom:-0.5rem;font-size:14px;font-weight:bold"><?php echo substr($r->Cd_AR.' - '.$r->Descrizione,'0','52')?></label>
                                        </td>
                                    <?php }else{?>
                                        <td class="col-xs-1 col-sm-1 col-md-1" style="height: 35px;text-align: left;padding-left:50px;">
                                            <input style="width: 125%;border-color: transparent;color:blue;margin-bottom:-0.5rem;font-size:14px;font-weight:bold" list="articoli" id="articolo_<?php echo $r->Id_DORig?>" onblur="cambiaarticolo(<?php echo $r->Id_DORig?>)" placeholder="<?php echo substr($r->Cd_AR.' - '.$r->Descrizione,'0','52')?>">
                                            <datalist id="articoli">
                                                <?php foreach($articolo as $a){?>
                                                <option value="<?php echo $a->Cd_AR?>"><?php echo $a->Cd_AR.' - '.$a->Descrizione ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </td>
                                    <?php } ?>
                                    <?php if($r->TipoPC == 'P'){?>

                                    <td class="col-xs-3 col-sm-3 col-md-3" style="height: 35px;text-align: right">
                                        <label style="color:black;font-size:14px;margin-bottom:-0.5rem;font-weight: bold;width:50%"><?php echo number_format($r->Qta, 3, '.', '');?></label>
                                    </td>

                                    <td class="col-xs-2 col-sm-2 col-md-2" style="height: 35px;text-align: center">
                                        <label style="color:black;font-size:14px;margin-bottom:-0.5rem;font-weight: bold;width:50%"><?php echo $r->Cd_ARLotto?></label>
                                    </td>

                                    <?php }else{ ?>

                                    <td class="col-xs-3 col-sm-3 col-md-3" style="height: 35px;text-align: right">
                                        <input style="border-color: transparent;color:blue;font-size:14px;margin-bottom:-0.5rem;font-weight: bold;text-align: right;width:150%" id="qta_<?php echo $r->Id_DORig ?>" onblur="cambiaqta(<?php echo $r->Id_DORig?>)" value="<?php echo number_format($r->Qta, 3, '.', '');?>">
                                    </td>

                                    <td class="col-xs-2 col-sm-2 col-md-2" style="height: 35px;text-align: right">
                                        <input style="border-color: transparent;color:blue;font-size:14px;margin-bottom:-0.5rem;font-weight: bold;text-align: center;width:150%" id="lotto_<?php echo $r->Id_DORig?>" onblur="cambialotto(<?php echo $r->Id_DORig?>)" value="<?php echo $r->Cd_ARLotto?>">
                                    </td>

                                    <?php } ?>

                                    <td class="col-xs-1 col-sm-1 col-md-1" style="height: 35px;text-align: center;margin-bottom: -0.5rem;">
                                        <form  method="post" onsubmit="return confirm('Vuoi Eliminare Questa Riga ?')">
                                            <?php if($r->TipoPC != 'P'){?>
                                            <input type="hidden" id="codice" value="<?php echo $r->Cd_AR ?>">
                                            <!--
                                                <button style="width: 44px;background-color: #17A2B8;border: #17A2B8;height: 26px;" type="button" name="modifica_riga" value="<?php echo $r->Cd_AR;?>" class="btn btn-danger btn-sm" onclick="$('#modal_modifica_<?php echo $r->Id_DORig ?>').modal('show');"><i class="bi bi-pencil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 18" style="margin-bottom: 10px;margin-right:20px">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg></i></button>
                                            -->
                                            <input type="hidden" name="Id_DORig" value="<?php echo $r->Id_DORig ?>">
                                            <button  style="width: 44px;height: 26px;" type="submit" name="elimina_riga" value="Elimina" class="btn btn-danger btn-sm" ><i class="bi bi-trash-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-trash-fill" viewBox="2 0 16 18" style="margin-bottom: 10px;margin-right:20px">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg></i></button>
                                            <?php } ?>
                                        </form>
                                    </td>
                                </div>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
<!-- page main ends -->
            </div>
        </div>
    </div>
<div class="modal" id="modal_cerca_articolo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carica Articolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <label>Cerca Articolo</label>
                    <input class="form-control" type="text" id="cerca_articolo" value=""  placeholder="Inserisci barcode,codice o nome dell'articolo" autocomplete="off" autofocus>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="cerca_articolo_smart();check();">Cerca Articolo</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal" id="modal_lista_articoli" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carica Articolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="ajax_lista_articoli"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="cerca_articolo_smart();">Carica Articolo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal_carico" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carica Articolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ajax_modal_carico"></div>
                    <input type="hidden" name="Cd_AR" id="modal_Cd_AR">
                    <label>Colli</label>
                    <input class="form-control" type="number" id="modal_colli" value="1" required placeholder="Inserisci una Quantità" autocomplete="off">
                    <input class="form-control" type="hidden" id="modal_prezzo" value="0" required placeholder="Inserisci un Prezzo" autocomplete="off">
                    <label>Magazzino</label>
                    <select class="form-control" type="number" id="modal_magazzino"  autocomplete="off" >
                        <?php foreach($magazzino_prova as $mp){?>
                        <option><?php echo $mp->Cd_MG.' - '.$mp->Descrizione;?></option>
                        <?php }?>
                    </select>
                    <label>Lotto</label>
                    <select class="form-control" type="number" id="modal_lotto" value="" required placeholder="Inserisci un Lotto" autocomplete="off">

                    </select>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()"> Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="scarica_articolo();">Carica Articolo</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal" id="modal_inserimento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Articolo Mancante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input class="form-control" type="text" id="modal_inserimento_barcode" value="" autocomplete="off">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="crea_articolo();">Crea Articolo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php foreach($documento->righe as $r ) { ?>
<div class="modal" id="modal_modifica_<?php  echo $r->Id_DORig ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifica Articolo <?php echo $r->Cd_AR ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ajax_modal_modifica"></div>
<?php /*
                    <label>Colli</label>
                    <input class="form-control" type="number" name="Qta" value="<?php echo floatval($r->xcolli) ?>" required placeholder="Inserisci una Quantità" autocomplete="off">

                    <input class="form-control" type="hidden" name="QtaEvadibile" value="<?php echo intval($r->QtaEvadibile) ?>" required placeholder="Inserisci una Quantità" autocomplete="off">


                    <input class="form-control" type="hidden" name="PrezzoUnitarioV" value="<?php echo intval($r->PrezzoUnitarioV) ?>" required placeholder="Inserisci un Prezzo" autocomplete="off">
*/?>
                    <label>Magazzino</label>
                    <select class="form-control" type="number" name="magazzino"  required  autocomplete="off">
                        <?php  foreach($magazzino_prova as $mp){?>
                        <option><?php echo $mp->Cd_MG.' - '.$mp->Descrizione;?></option>
                        <?php } ?>
                    </select>

                    <label>Lotto</label>
                    <select class="form-control" type="number" name="Cd_ARLotto"  required  autocomplete="off">
                        <option>Nessun Lotto</option>
                        <?php if($r->Cd_ARLotto != null ) {?>
                        <option selected><?php echo $r->Cd_ARLotto ?></option>
                        <?php } ?>
                        <?php foreach($r->lotti as $l) { ?>
                        <option><?php echo $l->Cd_ARLotto ?></option>
                        <?php } ?>
                    </select>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="Id_DORig" value="<?php echo $r->Id_DORig ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="submit" name="modifica_riga" value="Salva" class="btn btn-primary">Salva</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>

<div class="modal" id="modal_esplodi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Salva Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <label>Sei sicuro di voler salvare il Documento?</label>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="Id_DoTes" value="<?php echo $documento->Id_DoTes;?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">No</button>
                    <button type="button"  onclick="top.location.href = '/'" class="btn btn-primary">Si</button>
                </div>
            </div>
        </form>
    </div>
</div>

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

</body>
</html>

<script type="text/javascript">

    function aggiungi(){
        codice = document.getElementById('cerca_articolo1').value;
        pos = codice.search(' - ');
        codice = codice.substr(0,pos);
        lotto  = document.getElementById('cerca_lotto1').value;
        quantita = document.getElementById('cerca_quantita1').value;
        scarica_articolo();
    }

    cd_cf =  '<?php echo $fornitore->Cd_CF ?>';

    function check(){
        check = document.getElementById('cerca_articolo').value;
        lunghezza = check.length;
        if(check.substring(0,3)==']C1'){
            document.getElementById('cerca_articolo').value=check.substring(3,lunghezza);
            check = document.getElementById('cerca_articolo').value;
            alert('GS1 Code aggiustato riprovare a cercare');
        }


    }/*
    function esplodi(){
        id_dorig = document.getElementById('esplodi_riga').value;
        if(id_dorig != ''){

            $.ajax({
                url: "<?php echo URL::asset('ajax/esplodi') ?>/"+id_dorig,
            }).done(function(result) {
                alert(result);
                location.reload();

            });

        } else alert('Errore');
    }*/

    function scarica_articolo(){

        codice    =      $('#cerca_articolo1').val();
        quantita  =      $('#cerca_quantita1').val();
        magazzino =     '00001';
        lotto     =      $('#cerca_lotto1').val();





        if(quantita != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/aggiungi_articolo_ordine') ?>/<?php echo $id_dotes ?>/"+codice+"/"+quantita+"/"+"0/ND"+"/"+lotto+"/"+magazzino.substring(0,5)+"/ND"
            }).done(function(result) {
                $('#modal_carico').modal('hide');
                $('#modal_Cd_AR').val('');
                $('#modal_quantita').val('');
                magazzino = $('#modal_magazzino').val();
                location.reload();

            });

        } else alert('Inserire Una Quantità');
    }


    document.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("cerca_articolo1").focus();
        }
    });
    document.getElementById("cerca_articolo1").addEventListener("paste", pasteIntercept, false)


    /*
        document.addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById("cerca_articolo1").focus();
            focus continuo su cerca_articolo
        });*/
    function cambiaqta(dorig){

        qta = document.getElementById('qta_'+dorig).value;
        if(qta != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/cambia_qta') ?>/"+dorig+"/"+qta,
            }).done(function(result) {
                location.reload();
            });

        }
        location.reload();
    }
    function cambialotto(dorig){

        lotto = document.getElementById('lotto_'+dorig).value;

        if(lotto != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/cambia_lotto') ?>/"+dorig+"/"+lotto,
            }).done(function(result) {
                location.reload();
            });

        }
        location.reload();
    }
    function cambiaarticolo(dorig){

        articolo = document.getElementById('articolo_'+dorig).value;

        if(articolo != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/cambia_articolo') ?>/"+dorig+"/"+articolo,
            }).done(function(result) {
                location.reload();
            });

        }
        location.reload();
    }

    function scarica_articolo1(){

        q = $('#cerca_articolo1').val();
        q  = q.trimEnd();
        testo = q.substr(0,5);
        pos = testo.substr(0,1);
        if(pos == 0)
            testo = testo.substr(1);
        pos = testo.substr(0,1);
        if(pos == 0)
            testo = testo.substr(1);
        pos = testo.substr(0,1);
        if(pos == 0)
            testo = testo.substr(1);
        pos = testo.substr(0,1);
        if(pos == 0)
            testo = testo.substr(1);
        pos = testo.substr(0,1);
        if(pos == 0)
            testo = testo.substr(1);
        /*
        pos = testo.strpos(0);
        while(pos == '0'){
            pos++;
            testo = substr(testo,pos);
            pos = strpos(testo,"0");
            if(pos > 0 || !is_numeric(pos) ) {
                pos = '1';
            }
        }*/
        codice = testo.toUpperCase();
        lotto = q.substr(8,6);
        quantita = '1';
        magazzino= '00001';

        if(quantita != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/aggiungi_articolo_ordine') ?>/<?php echo $id_dotes ?>/"+codice+"/"+quantita+"/"+"0/ND"+"/"+lotto+"/"+magazzino.substring(0,5)+"/ND"
            }).done(function(result) {
                $('#modal_carico').modal('hide');
                $('#modal_Cd_AR').val('');
                $('#modal_quantita').val('');
                magazzino = $('#modal_magazzino').val();
                location.reload();

            });

        } else alert('Inserire Una Quantità');
    }

    function modifica_articolo(){

        codice    =      document.getElementById('codice').value;
        quantita  =      $('#modal_quantita_m').val();
        magazzino =      $('#modal_magazzino_m').val();
        lotto     =      $('#modal_lotto_m').val();


        if(quantita != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/modifica_articolo_ordine') ?>/<?php echo $id_dotes ?>/"+codice+"/"+quantita+"/"+magazzino.substring(0,5)+"/"+magazzino.split(' ').pop().split(' ')+"/"+lotto

            }).done(function(result) {
                $('#modal_modifica').modal('hide');
                $('#modal_Cd_AR').val('');
                $('#modal_quantita').val('');
                $('#modal_magazzino').val();
                location.reload();

            });

        } else alert('Inserire Una Quantità');
    }

    function crea_articolo(){

        barcode = $('#modal_inserimento_barcode').val();
        if(barcode != '') {
            top.location.href = '/nuovo_articolo?redirect=/magazzino/carico4/<?php echo $fornitore->Id_CF ?>/<?php echo $id_dotes ?>&barcode=' + barcode;
        }
    }

    document.addEventListener("keydown", function(e) {
        if(e.which == 114){
            console.log(e.which);
            e.preventDefault();
            $('#modal_cerca_articolo').modal('show');
        } else if(e.which == 13){
            e.preventDefault();
        }
    });

    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });
    function cerca_articolo_smart(){

        testo = $('#cerca_articolo').val();
        testo  = testo.trimEnd();

        if(testo != '') {

            $.ajax({
                url: "<?php echo URL::asset('ajax/cerca_articolo_smart') ?>/" + encodeURIComponent(testo)+"/"+cd_cf,
                context: document.body

            }).done(function (result) {
                $('#cerca_articolo').value='';
                if(result != '') {
                    $('#modal_cerca_articolo').modal('hide');
                    $('#modal_lista_articoli').modal('show');
                    $('#ajax_lista_articoli').html(result);
                } else alert('nessun prodotto trovato');

            });

        }
        $('#cerca_articolo').value='';
    }


    /*  $(document).scannerDetection({
          timeBeforeScanTest: 200, // wait for the next character for upto 200ms
          startChar: [120], // Prefix character for the cabled scanner (OPL6845R)
          endChar: [13], // be sure the scan is complete if key 13 (enter) is detec
          // ted
          avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
          onComplete: function(code, qty){

              $.ajax({
                  url: "/ajax/cerca_articolo_barcode/<?php echo $fornitore->Cd_CF ?>/"+code,
                context: document.body
            }).done(function(result) {

                if(result != '') {
                    $('#modal_carico').modal('show');
                    $('#ajax_modal_carico').html(result);
                    $('#modal_prezzo').focus();
                } else {
                    $('#modal_inserimento').modal('show');
                    $('#modal_inserimento_barcode').val(code);
                }
            });

        } // main callback function
    });
*/
    function cerca_articolo_codice(fornitore,codice,lotto){
        fornitore = '<?php echo $fornitore->Cd_CF ?>';
        fornitore = fornitore.trimEnd();
        $.ajax({
            url: "/ajax/cerca_articolo_codice/"+fornitore+"/"+codice+"/"+lotto+"/1",
            context: document.body
        }).done(function(result) {

            if(result != '') {
                $('#modal_carico').modal('show');
                $('#ajax_modal_carico').html(result);
            } else {
                $('#modal_inserimento').modal('show');
                $('#modal_inserimento_barcode').val(codice);
            }
        });
    }

    if(window.innerWidth > 800) {
        $('#interactive').css('display','none');
    }
</script>
