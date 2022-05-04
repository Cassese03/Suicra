<?php $magazzino_prova = DB::select('SELECT MG.*,MGUbicazione.Cd_MGUbicazione from MG LEFT JOIN MGUbicazione on MGUbicazione.Cd_MG = MG.Cd_MG'); ?>
<?php $magazzino_ord = DB::select('SELECT * from MG');?>
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
                <a style="padding-left:20px;" href="/magazzino/scarico03/<?php echo $cliente->Id_CF;echo "/";echo $documento->Cd_Do?>" ><i class="material-icons">arrow_back_ios</i></a>
            </div>
            <div class="col center">
                <a href="#" class="logo"><figure><img src="/img/logo_arca.png" alt=""></figure>Aggiungi Articoli</a>
            </div>
            <div class="right">
                <a style="padding-left:20px;" href="/" ><i class="material-icons">home</i></a>
            </div>
            <!--
            <div class="right">
                <a style="padding-left:20px;" href="/" ><i class="material-icons">assignment_return</i></a>
            </div>
            -->
        </header>

        <div class="page-content">
            <div class="content-sticky-footer">
                <input type="text" id="cerca_articolo2" style="width:0" onkeyup="controllo_articolo_smart();"  autofocus autocomplete="off">

                <div class="background bg-125"><img src="/img/background.png" alt=""></div>
                <div class="w-100">
                    <h1 class="text-center text-white title-background"><?php echo $cliente->Descrizione ?><br><small><?php echo $documento->Cd_Do ?> N.<?php echo $documento->NumeroDoc ?> Del <?php echo date('d/m/Y',strtotime($documento->DataDoc)) ?></small></h1>
                </div>

                <button style="margin-top:0px !important;width:80%;margin:0 auto;display:block;margin-bottom:0;" class="btn btn-primary" onclick="$('#modal_cerca_articolo').modal('show');">Aggiungi Prodotto</button>

                <?php if(sizeof($documento->righe) > 0){ ?>


                <div class="row">

                    <div class="col-sm-6">
                        <ul class="list-group">

                            <?php foreach($documento->righe as $r){ $totale = 0; ?>
                            <?php if($r->QtaEvadibile>0){?>
                            <li class="list-group-item">
                                <a href="#" onclick="" class="media">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <h5 <?php if($r->QtaEvadibile==0)echo 'style="color: red"'?>><?php echo $r->Cd_AR.' '.$r->Descrizione;?><br><?php  echo  'Magazzino di Partenza: '.$r->Cd_MG_P;if($r->Cd_MGUbicazione_A != null) echo ' - '.$r->Cd_MGUbicazione_A;?><br><?php if($r->Cd_ARLotto != Null)echo 'Lotto: '.$r->Cd_ARLotto;?></h5>
                                                <p <?php if($r->QtaEvadibile==0)echo 'style="color: red"'?>>Quantita': <?php echo floatval($r->QtaEvadibile) ?></p>
                                            </div>


                                            <form  method="post" onsubmit="return confirm('Vuoi Eliminare Questa Riga ?')">

                                                <input type="hidden" id="codice" value="<?php echo $r->Cd_AR ?>">

                                                <div class="row" style="padding-left:25px;padding-right:25px;">
                                                    <div class="col-3 col-xs-6 col-sm-6 col-md-6 col-sm-6" style="padding-right: 5px;padding-left: 5px;">
                                                        <button  style="width:100%;" type="reset"  name="segnalazione" value="" class="btn btn-warning btn-sm" onclick="$('#modal_segnalazione<?php echo $r->Id_DORig?>').modal('show');" ><i class="fa fa-exclamation-triangle" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                                                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                                                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                                                </svg></i></button>
                                                    </div>

                                                    <div class="col-3 col-xs-6 col-sm-6 col-md-6 col-sm-6" style="padding-right: 5px;padding-left: 5px;">
                                                        <button  style="width:100%;" type="reset"  name="modifica_riga" value="<?php echo $r->Cd_AR;?>" class="btn btn-primary btn-sm" onclick="$('#modal_modifica_<?php echo $r->Id_DORig ?>').modal('show');" ><i class="bi bi-pencil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                                </svg></i></button>
                                                    </div>

                                                    <div class="col-3 col-xs-6 col-sm-6 col-md-6 col-sm-6" style="padding-right: 5px;padding-left: 5px;">
                                                        <button  style="width:100%;" type="reset" name="evadi_riga" value="<?php echo $r->Cd_AR;?>" class="btn btn-success btn-sm" onclick="$('#modal_evadi_riga_<?php echo $r->Id_DORig ?>').modal('show');" ><i class="bi bi-check-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                                </svg></i></button>
                                                    </div>

                                                    <div class="col-3 col-xs-6 col-sm-6 col-md-6 col-sm-6" style="padding-right: 5px;padding-left: 5px;">
                                                        <button  style="width:100%;" type="submit" name="elimina_riga" value="Elimina" class="btn btn-danger btn-sm" ><i class="bi bi-trash-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                                </svg></i></button>
                                                    </div>


                                                    <input type="hidden"  name="Id_DORig" value="<?php echo $r->Id_DORig ?>">


                                                </div>

                                            </form>

                                        </div>
                                    </div>

                                </a>
                            </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
                <?php if(sizeof($documento->righe) > 0){/*?>
                    <button style="margin-top:35px !important;width:80%;margin:0 auto;display:block;background-color:red;border: red" class="btn btn-primary" onclick="$('#modal_evadi_documento').modal('show');">Evadi Documento</button>*/?>
                <button style="margin-top:10px !important;width:80%;margin:0 auto;display:block;background-color:#007bff;border: #007bff" class="btn btn-primary" onclick="$('#modal_salva_documento').modal('show');">Salva Documento</button>
                <?php } ?>
            </div>
        </div>

    </div>
    <!-- page main ends -->

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
                    <input class="form-control" type="text" id="cerca_articolo"  placeholder="Inserisci barcode,codice o nome dell'articolo" autocomplete="off" autofocus>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="cerca_articolo_smart();">Cerca Articolo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal_lista_articoli_daevadere" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Articolo da Evadere</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <label>Articolo</label>
                    <input class="form-control" type="text" id="modal_controllo_articolo" value=""  autocomplete="off" readonly>

                    <label>Quantita' Ordinata</label>
                    <input class="form-control" type="text" id="modal_controllo_quantita" value=""   autocomplete="off" readonly>

                    <label>Lotto</label>
                    <input class="form-control" type="text" id="modal_controllo_lotto" value=""  autocomplete="off" readonly>

                    <input class="form-control" type="hidden" id="modal_controllo_dorig" value=""  autocomplete="off" readonly>

                    <label>Data di Scadenza</label>
                    <input class="form-control" type="text" id="modal_controllo_data" value=""  autocomplete="off" readonly>

                    <input class="form-control" type="hidden" id="modal_controllo_confezione" value="" autocomplete="off" readonly>

                    <?php if(str_replace(' ','',$documento->Cd_Do)=='PRV' ||str_replace(' ','',$documento->Cd_Do)=='OC'){?>
                    <label>Quantita' da evadere</label>
                    <?php }else{ ?>
                    <label>Colli</label>
                    <?php }?>
                    <input class="form-control" type="text" id="modal_controllo_collo" value=""   autocomplete="off">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="evadi_articolo1();">Evadi Riga</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal_salva_documento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Salvataggio Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <label>Vuoi Salvare il Documento ? </label>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">No</button>
                    <button type="button" class="btn btn-primary" onclick="salva_documento()">Si</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal_lista_salva" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Righe non Evase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="ajax_lista_documenti_1">
                </div>
                <?php foreach($documento->righe as $r) {?>
                <input type="hidden" name="modal_Cd_ARLotto_c_<?php echo $r->Id_DORig?>" id="modal_Cd_ARLotto_c_<?php echo $r->Id_DORig?>">
                <input type="hidden" name="modal_Cd_AR_c_<?php echo $r->Id_DORig?>" id="modal_Cd_AR_c_<?php echo $r->Id_DORig?>">
                <input type="hidden" name="modal_Qta_c_<?php echo $r->Id_DORig?>" id="modal_Qta_c_<?php echo $r->Id_DORig?>">
                <?php } ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="checkDoc();">Salva Documento</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal_lista_documenti" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Righe da Evadere</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="ajax_lista_documenti"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="evadi_documento1()">Evadi Documento</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php foreach($documento->righe as $r){ ?>
<div class="modal" id="modal_segnalazione<?php echo $r->Id_DORig?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Segnalazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="number" class="form-control" id="Segnala_riga" value="<?php echo $r->Id_DORig;?>" readonly><br>
                    <input type="text" class="form-control" id="Segnalazione" value="" placeholder="Inserire Segnalazione..." autofocus autocomplete="off">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="segnalazione();">Invia Segnalazione</button>
                </div>

            </div>
        </form>
    </div>
</div>
<?php } ?>
<div class="modal" id="modal_lista_articoli" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carica Articolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ajax_modal_carico"></div>
                    <input type="hidden" name="Cd_AR" id="modal_Cd_AR">
                    <label>Colli</label>
                    <input class="form-control" type="number" id="modal_quantita" value="" required placeholder="Inserisci una Quantità" autocomplete="off" >
                    <!--

                        <label>Prezzo (&euro;)</label>
                        <input class="form-control" type="number" id="modal_prezzo" value="" required placeholder="Inserisci un Prezzo" autocomplete="off">
                        -->
                    <label>Magazzino Partenza</label>
                    <select class="form-control" type="number" id="modal_magazzino_P" value="" required placeholder="Inserisci un Magazzino" autocomplete="off";>
                    </select>


                    <input class="form-control" type="hidden" id="modal_lotto" value="Nessun Lotto" required placeholder="Inserisci un Lotto" autocomplete="off";>




                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="carica_articolo();">Carica Articolo</button>
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
                    <input class="form-control" type="text" id="modal_inserimento_barcode" value="" autocomplete="off";>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ajax_modal_modifica"></div>

                    <label>Quantita</label>
                    <input class="form-control" type="number" name="Qta" value="<?php echo intval($r->Qta) ?>" required placeholder="Inserisci una Quantità" autocomplete="off";>

                    <label>Quantita Evadibile</label>
                    <input class="form-control" type="number" name="QtaEvadibile" value="<?php echo intval($r->QtaEvadibile) ?>" required placeholder="Inserisci una Quantità" autocomplete="off";>
                <!--

                    <label>Prezzo (&euro;)</label>
                    <input class="form-control" type="number" name="PrezzoUnitarioV" value="<?php echo intval($r->PrezzoUnitarioV) ?>" required placeholder="Inserisci un Prezzo" autocomplete="off"; step="0.01">
                -->
                    <input type="hidden" class="form-control"  name="modal_magazzino_P_m" id="modal_magazzino_P_m" value="00001 - MagazzinoWOW" required placeholder="Inserisci un Magazzino" autocomplete="off";>

                    <input type="hidden" class="form-control"  name="modal_magazzino_A_m" id="modal_magazzino_A_m" value="00001 - MagazzinoWOW" required placeholder="Inserisci un Magazzino" autocomplete="off";>

                    <input type="hidden" class="form-control"  name="modal_lotto_m" id="modal_Cd_ARLotto" value="0" required autocomplete="off">
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

<?php foreach($documento->righe as $r ) { ?>
<div class="modal" id="modal_evadi_riga_<?php  echo $r->Id_DORig ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Evadi Articolo <?php echo $r->Cd_AR ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ajax_modal_evadi_riga_<?php  echo $r->Id_DORig ?>"></div>

                    <label>Quantita</label>
                    <input class="form-control" type="number" id="modal_Qta_<?php  echo $r->Id_DORig ?>" min="0" max="<?php echo floatval($r->QtaEvadibile)?>" value="<?php echo floatval($r->QtaEvadibile) ?>" required placeholder="Inserisci la Quantità da evadere" step="0.01" readonly>
                    <br>
                    <label>Documento da Evadere in :</label>
                    <select style="width:100%;border:none;font-size:medium;background:transparent;" id="modal_inserimento_flusso_<?php  echo $r->Id_DORig ?>">
                        <?php foreach($flusso as $f){ ?>
                        <option class="form-control" type="text"  value="<?php echo str_replace(' ','',$f->Cd_Do) ?>"><?php echo $f->Cd_Do ?></option>
                        <?php } ?>
                    </select>
                    <br><br>
                    <label>Magazzino :</label>
                    <?php if(str_replace(' ','',$documento->Cd_Do)=='PRV' ||str_replace(' ','',$documento->Cd_Do)=='FA' || str_replace(' ','',$documento->Cd_Do)=='B2' ||str_replace(' ','',$documento->Cd_Do)=='OC'){?>
                    <select class="form-control">
                        <?php foreach($magazzino_ord as $mag){?>
                        <option id="modal_inserimento_magazzino_<?php echo $r->Id_DORig?>" value="<?php echo $mag->Cd_MG.' - '.$mag->Descrizione ?>"><?php echo $mag->Cd_MG.' - '.$mag->Descrizione ?></option>
                        <?php } ?>
                    </select>
                    <?php }else{?>
                    <input class="form-control" type="hidden" id="modal_inserimento_magazzino_<?php echo $r->Id_DORig?>" value=" <?php echo $mag[0]->Cd_MG.' - '.$mag[0]->Descrizione?>">
                    <?php } ?>
                    <br>
                    <label>Lotto</label>
                    <input class="form-control" type="text" id="modal_lotto_<?php  echo $r->Id_DORig ?>"  value="<?php if($r->Cd_ARLotto !='') echo $r->Cd_ARLotto;else echo '0';?>" required placeholder="Inserisci il lotto" autocomplete="off">
                    <br>
                    <label>Quantita' da evadere</label>
                    <input class="form-control" type="text" id="modal_collo_<?php  echo $r->Id_DORig ?>"  value="<?php echo intval($r->xqtaconf)?>" required placeholder="Inserisci la Quantita\' da evadere i colli" autocomplete="off" onchange="cambiocollo2(<?php echo $r->Id_DORig?>)">
                    <label>Colli</label>
                    <input class="form-control" type="text" id="modal_collo2_<?php  echo $r->Id_DORig ?>"  value="<?php echo '1'?>" required placeholder="Inserisci  i colli" autocomplete="off" onchange="cambiocollo3(<?php echo $r->Id_DORig?>)">
                    <input type="hidden" id="modal_magazzino_<?php  echo $r->Id_DORig ?>" value="<?php echo $r->Cd_MG_P; if($r->Cd_MG_P=='') echo $r->Cd_MG_A;?>">
                    <input type="hidden" id="modal_codice_<?php  echo $r->Id_DORig ?>" value="<?php echo $r->Cd_AR?>">
                    <input type="hidden" id="modal_ubicazione_<?php  echo $r->Id_DORig ?>" value="<?php echo $r->Cd_MGUbicazione_P?>">
                    <input type="hidden" id="modal_confezione_<?php  echo $r->Id_DORig ?>" value="<?php echo $r->xqtaconf?>">
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="evadi_articolo_sub(<?php echo $r->Id_DORig ?>)">Evadi</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>
<?php /*
<div class="modal" id="modal_evadi_documento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserire Flusso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h5>Sei sicuro di voler evadere tutto il documento?</h5>

                    <input  class="form-control" type="hidden" id="modal_inserimento_flusso" value="<?php echo $flusso[0]->Cd_Do ?>">
                    <input class="form-control" type="hidden" id="modal_inserimento_magazzino_A" value="<?php echo $mag[0]->Cd_MG.' - '.$mag[0]->Descrizione?>">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="evadi_documento()">Evadi Documento</button>
                </div>
            </div>
        </form>
    </div>
</div>
*/?>
<div class="modal" id="modal_alertSegnalazione" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Success!</strong><br> Segnalazione Effettuata</a>.
    </div>
</div>

<div class="modal" id="modal_alertQuantita0" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Alert!</strong> <br>Impossibile Evadere la Quantita' Evadibile a zero </a>.
    </div>
</div>

<div class="modal" id="modal_alertQuantita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Alert!</strong> <br>Inserire una quantita </a>.
    </div>
</div>

<div class="modal" id="modal_alertInserimento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Success!</strong><br> Articolo Inserito Correttamente </a>.
    </div>
</div>

<div class="modal" id="modal_alertEvase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Success!</strong> <br>Le righe sono state completamente Evase</a>.
    </div>
</div>

<div class="modal" id="modal_alertUbicazione" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Alert!</strong><br> Ubicazione inserita non corretta o inesistente</a>.
    </div>
</div>

<div class="modal" id="modal_alertTrovare" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Alert!</strong> <br>Nessun Articolo Trovato </a>.
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
    cd_cf =  '<?php echo $cliente->Cd_CF ?>';
    function cambiocollo(){
        confezione = document.getElementById('modal_controllo_confezione').value;
        quantita   = document.getElementById('modal_controllo_quantita').value;
        if('<?php echo str_replace(' ','',$documento->Cd_Do)?>' == 'OC' || '<?php echo str_replace(' ','',$documento->Cd_Do)?>' == 'PRV')
            document.getElementById('modal_controllo_collo').value = quantita;
        else
            document.getElementById('modal_controllo_collo').value = quantita/confezione;
    }
    function cambiocollo2(id_dorig){
        confezione = document.getElementById('modal_confezione_'+id_dorig).value;
        qta =  document.getElementById('modal_collo_'+id_dorig).value;
        collo = Math.ceil(parseFloat(qta)/parseFloat(confezione));
        document.getElementById('modal_collo2_'+id_dorig).value = collo;
    }
    function cambiocollo3(id_dorig){
        confezione = document.getElementById('modal_confezione_'+id_dorig).value;
        qta =  document.getElementById('modal_collo2_'+id_dorig).value;
        collo = parseFloat(qta)*parseFloat(confezione);
        document.getElementById('modal_collo_'+id_dorig).value = collo;
    }

    function evadi_articolo_sub(dorig){
        lotto = document.getElementById('modal_lotto_'+dorig).value;
        if(lotto == null)
            lotto = 0;
        collo = document.getElementById('modal_collo_'+dorig).value;
        evadi_articolo(dorig,lotto,collo);
    }
    function segnalazione(){
        Id_DoRig     = document.getElementById('Segnala_riga').value;
        Segnalazione = document.getElementById('Segnalazione').value;
        if(Id_DoRig!=''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/segnalazione') ?>/<?php echo $id_dotes ?>/"+ Id_DoRig + "/-" + encodeURIComponent(Segnalazione)
            }).done(function (result) {
                $('#modal_alertSegnalazione').modal('show');
                location.reload();
            });
        }
    }
    function evadi_documento(){

        Cd_Do       = document.getElementById('modal_inserimento_flusso').value;
        Id_DoTes    = '<?php echo $id_dotes?>';
        magazzino_A = document.getElementById('modal_inserimento_magazzino_A').value;
        if(magazzino_A==null){
            magazzino_A='0';
        }
        if(Id_DoTes!='')
            $.ajax({
                url: "<?php echo URL::asset('ajax/evadi_documento1')?>/"+Id_DoTes+"/"+Cd_Do+"/"+magazzino_A.substring(0,5)

            }).done(function(result) {


                $('#modal_evadi_documento').modal('hide');
                $('#modal_lista_documenti').modal('show');
                $('#ajax_lista_documenti').html(result);

            });

    }
    function salva_documento(){

        Cd_Do       = '0';
        Id_DoTes    = '<?php echo $id_dotes?>';
        magazzino_A = '0';
        if(magazzino_A==null){
            magazzino_A='0';
        }
        if(Cd_Do==null){
            Cd_Do='0';
        }
        if(Id_DoTes!='')
            $.ajax({
                url: "<?php echo URL::asset('ajax/salva_documento1')?>/"+Id_DoTes+"/"+Cd_Do+"/"+magazzino_A.substring(0,5)

            }).done(function(result) {


                $('#modal_evadi_documento').modal('hide');
                $('#modal_lista_salva').modal('show');
                $('#ajax_lista_documenti_1').html(result);

            });

    }
    function evadi_documento1(){

        Cd_Do        = document.getElementById('modal_inserimento_flusso').value;
        Id_DoTes     = '<?php echo $id_dotes?>';
        magazzino_A  = document.getElementById('modal_inserimento_magazzino_A').value;
        if(magazzino_A==null){
            magazzino_A='0';
        }
        if(Id_DoTes!='')
            $.ajax({
                url: "<?php echo URL::asset('ajax/evadi_documento')?>/"+Id_DoTes+"/"+Cd_Do+"/"+magazzino_A.substring(0,5)

            }).done(function(result) {
                $('#modal_alertEvase').modal('show');
                location.reload();

            });

    }

    function evadi_articolo1(){
        dorig = document.getElementById('modal_controllo_dorig').value;
        lotto = document.getElementById('modal_controllo_lotto').value;
        collo = document.getElementById('modal_controllo_collo').value;
        evadi_articolo(dorig,lotto,collo);
    }
    function evadi_articolo(dorig,lotto,collo){

        codice          = $('#modal_codice_'+dorig).val();
        documento       = $('#modal_inserimento_flusso_'+dorig).val();
        magazzino_A     = $('#modal_inserimento_magazzino_'+dorig).val();
        magazzino       = $('#modal_magazzino_'+dorig).val();
        ubicazione      = $('#modal_ubicazione_'+dorig).val();
        quantita_evasa  = $('#modal_Qta_'+dorig).val();

        if(magazzino_A==null){
            magazzino_A='0';
        }
        if(ubicazione==''){
            ubicazione='0';
        }
        if(quantita_evasa != ''||quantita_evasa == '0'){
            $.ajax({
                url: "<?php echo URL::asset('ajax/evadi_articolo')?>/"+dorig+"/"+quantita_evasa+"/"+magazzino.substring(0,5)+"/"+ubicazione+"/"+lotto+"/"+cd_cf+"/"+documento+"/"+codice+"/"+magazzino_A.substring(0,5)+"/"+collo
            }).done(function(result) {
                if(result.length>1)
                    $('#modal_alertQuantita0').modal('show');
                location.reload();

            });

        } else
            $('#modal_alertQuantita').modal('show');
    }

    function carica_articolo(){

        codice    =      $('#modal_Cd_AR').val();
        quantita  =      $('#modal_quantita').val();
        magazzino_A =    '0';
        magazzino_P =    $('#modal_magazzino_P').val();
        lotto     =      $('#modal_lotto').val();



        if (quantita != '') {
            $.ajax({
                url: "<?php echo URL::asset('ajax/aggiungi_articolo_ordine') ?>/<?php echo $id_dotes ?>/" + codice + "/" + quantita  + "/" + magazzino_A.substring(0,5) + "/" + 'ND' + "/" + lotto+"/"+ magazzino_P.substring(0,5) + "/" + 'ND'
            }).done(function (result) {
                $('#modal_carico').modal('hide');
                $('#modal_Cd_AR').val('');
                $('#modal_quantita').val('');

                location.reload();

            });

        } else
            $('#modal_alertQuantita').modal('show');
    }
    function modifica_articolo(){

        codice      =      document.getElementById('codice').value;
        quantita    =      $('#modal_quantita_m').val();
        magazzino_P =      $('#modal_magazzino_P_m').val();
        magazzino_A =      $('#modal_magazzino_A_m').val();
        lotto       =      $('#modal_lotto_m').val();
        if(quantita != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/modifica_articolo_ordine') ?>/<?php echo $id_dotes ?>/"+codice+"/"+quantita+"/"+ magazzino_A.substring(0,5) + "/" + 'ND' + "/" + lotto+"/"+ magazzino_P.substring(0,5) + "/" + 'ND'

            }).done(function(result) {
                $('#modal_modifica').modal('hide');
                $('#modal_Cd_AR').val('');
                $('#modal_quantita').val('');
                $('#modal_magazzino').val();
                location.reload();

            });

        } else
            $('#modal_alertQuantita').modal('show');
    }
    function crea_articolo(){

        barcode = $('#modal_inserimento_barcode').val();
        if(barcode != '') {
            top.location.href = '/nuovo_articolo?redirect=/magazzino/scarico4/<?php echo $cliente->Id_CF ?>/<?php echo $id_dotes ?>&barcode=' + barcode;
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


    function cerca_articolo_smart(){
        testo = $('#cerca_articolo').val();
        testo = testo.trimEnd();
        if(testo != '') {

            $.ajax({
                url: "<?php echo URL::asset('ajax/cerca_articolo_smart') ?>/" + encodeURIComponent(testo)+"/"+cd_cf,
                context: document.body
            }).done(function (result) {
                if(result != '') {

                    $('#modal_cerca_articolo').modal('hide');
                    $('#modal_lista_articoli').modal('show');
                    $('#ajax_lista_articoli').html(result);
                } else
                    $('#modal_alertTrovare').modal('show');

            });

        }

    }
    function cerca_articolo_codice(fornitore,codice,lotto,qta){

        $.ajax({
            url: "/ajax/cerca_articolo_codice/<?php echo $cliente->Cd_CF ?>/"+codice+"/"+lotto+"/"+qta,
            context: document.body
        }).done(function(result) {

            if(result != '') {
                $('#modal_carico').modal('show');
                $('#ajax_modal_carico').html(result);
            } else {
                $('#modal_inserimento').modal('show');
                $('#modal_inserimento_barcode').val(code);
            }
        });
    }

    function controllo_articolo_smart() {

        testo    = $('#cerca_articolo2').val();
        id_dorig = "*****";

        if (testo != '') {

            $.ajax({
                url: "<?php echo URL::asset('ajax/controllo_articolo_smart') ?>/" + testo + "/" + '<?php echo $id_dotes?>',
                context: document.body
            }).done(function (result) {
                if (result != '') {
                    $('#modal_cerca_articolo').modal('hide');
                    $('#modal_lista_articoli_daevadere').modal('show');
                    $('#ajax_lista_articoli').html(result);
                } else {
                    $('#modal_alertTrovare').modal('show');
                    segnalazioneControllo(id_dotes, id_dorig, testo);
                    location.href= '/magazzino/scarico4/<?php echo $cliente->Id_CF.'/'.$id_dotes?>';
                }
            });

        }
    }

    function checkDoc(){
        <?php foreach($documento->righe as $r){ ?>

            articolo = $('#modal_Cd_AR_c_<?php echo $r->Id_DORig?>').val();
        quantita = $('#modal_Qta_c_<?php echo $r->Id_DORig?>').val();
        lotto    = $('#modal_Cd_ARLotto_c_<?php echo $r->Id_DORig?>').val();
        id_dorig = '00000';
        if (articolo != '' && quantita != '') {
            if (lotto != '')
                testo = 'Articolo ' + articolo + ' del lotto ' + lotto + ' con quantita ' + quantita + ' non evaso ';
            else
                testo = 'Articolo ' + articolo + ' con quantita ' + quantita + ' non evaso ';
            $.ajax({
                url: "<?php echo URL::asset('ajax/segnalazione_salva') ?>/<?php echo $id_dotes ?>/" + id_dorig + "/" + testo ,

            }).done(function (result) {
                top.location.href='/';
            });
        }
        <?php } ?>

            top.location.href='/';


    }

    function segnalazioneControllo(id_dotes,id_dorig,Segnalazione){

        if(id_dotes!=''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/segnalazione') ?>/<?php echo $id_dotes ?>/"+ id_dorig + "/" + Segnalazione
            }).done(function (result) {
                $('#modal_alertSegnalazione').modal('show');
                location.reload();
            });
        }
    }

    if(window.innerWidth > 800) {
        $('#interactive').css('display','none');
    }
    function check(){
        check = document.getElementById('cerca_articolo').value;
        if(check=='')
            check= document.getElementById('cerca_articolo2').value;

        lunghezza = check.length;
        if(check.substring(0,3)==']C1'){
            document.getElementById('cerca_articolo').value=check.substring(3,lunghezza);
            check = document.getElementById('cerca_articolo').value;
            alert('GS1 Code aggiustato riprovare a cercare');
        }

    }
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });
</script>
