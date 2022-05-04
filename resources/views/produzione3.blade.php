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
                <a style="padding-left:20px;" href="/magazzino/produzione2/<?php echo $documento->Cd_Do?>" ><i class="material-icons">arrow_back_ios</i></a>
            </div>
            <div class="col center">
                <a href="#" class="logo"><figure><img src="/img/logo_arca.png" alt=""></figure><small><?php echo $documento->Cd_Do ?> N.<?php echo $documento->NumeroDoc ?> del </small><?php echo date('d/m/Y',strtotime($documento->DataDoc)) ?></a>
            </div>
            <input type="text" id="cerca_articolo1" onchange="scarica_articolo1();" autofocus autocomplete="off" style="border:none;color:#f4465e;height: 0px!important;width: 0px!important;background-color: #f4465e">
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
 */?>
            <?php $capannone1_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'1\'')[0]->Qta_Max;?>
            <?php $capannone3_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'3\'')[0]->Qta_Max;?>
            <?php $capannone4_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'4\'')[0]->Qta_Max;?>
            <?php $capannone5_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'5\'')[0]->Qta_Max;?>
            <?php $capannoneA_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'A\'')[0]->Qta_Max;
            if($capannoneA_max =='0')
                $capannoneA_max = '1';?>
            <?php $capannoneB_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'B\'')[0]->Qta_Max;?>
            <?php $capannone6_max = DB::SELECT('SELECT * FROM xCapannoni WHERE Cd_xCapannoni = \'6\'')[0]->Qta_Max;?>

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
                    <button style="width:50%;display:block;height: 30px;float: left;alignment: left" class="btn btn-primary" onclick="$('#modal_cerca_articolo').modal('show');"><h6 style="color: white">Aggiungi Prodotto</h6></button>
                    <button type="button" style="width:50%;display:block;background-color:red;border-color:red;height: 30px;float: right;alignment: right"   name="esplodi_riga" value="<?php echo $documento->Id_DoTes;?>" class="btn btn-primary" onclick="$('#modal_esplodi').modal('show')"><h6 style="color: white">Conferma Documento</h6></button>
                </div>
                <?php if(sizeof($documento->righe) > 0){ ?>
                <div class="row">
                    <div class="col-sm-12">
                        <table>
                            <thead>
                            <tr>

                                <th class="col-xs-3 col-sm-3 col-md-3" style="text-align: center">
                                    <label style="color:black;">Articolo</label>
                                </th>

                                <th class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                    <label style="color:black;">Colli</label>
                                </th>

                                <th class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                    <label style="color:black;">Lotto</label>
                                </th>

                                <th class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                    <label style="color:black;">Ordinati</label>
                                </th>

                                <th class="col-xs-2 col-sm-2 col-md-2" style="text-align: center">
                                    <label style="color:black;">Azioni</label>
                                </th>

                            </tr>

                            </thead>

                            <tbody>
                            <?php foreach($documento->righe as $r){ $totale = 0; ?>
                            <?php if($r->TipoPC != 'P'){?>
                            <tr style="border:1px solid black;border-collapse: collapse;border-radius: 10px;">
                                <div class="row">

                                    <td class="col-xs-3 col-sm-3 col-md-3" style="text-align: left;">
                                        <label style="color:black;margin-bottom:-0.5rem;font-size:14px;font-weight:bold"><?php echo substr($r->Cd_AR.' - '.$r->Descrizione,'0','52')?></label>
                                    </td>

                                    <?php if($r->TipoPC == 'P'){?>
                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center;background-color: #B2FF66">
                                        <input type="text" id="modifica_collo<?php echo $r->Id_DORig?>"  style="text-align:center;border:none;background-color: #B2FF66;font-weight: bold;margin-bottom: -0.5rem;" value="<?php echo floatval($r->xcolli)?>" readonly >
                                    </td>
                                    <?php }else{?>
                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center;background-color: #B2FF66">
                                        <input type="text" id="modifica_collo<?php echo $r->Id_DORig?>"  style="text-align:center;border:none;background-color: #B2FF66;font-weight: bold;margin-bottom: -0.5rem;" value="<?php echo floatval($r->xcolli)?>" onblur="cambiacollo(<?php echo $r->Id_DORig?>)">
                                    </td>
                                    <?php }?>

                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                        <label style="color:black;font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo $r->Cd_ARLotto?></label>
                                    </td>
                                    <?php foreach ($r->ordini as $d){?>
                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                        <label style="color:black;font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo $d->Colli_Ordinati ?></label>
                                    </td>
                                    <?php } ?>

                                    <td class="col-xs-2 col-sm-2 col-md-2" style="text-align: center;margin-bottom: -0.5rem;">
                                        <form  method="post" onsubmit="return confirm('Vuoi Eliminare Questa Riga ?')">
                                            <?php if($r->TipoPC != 'P'){?>
                                            <input type="hidden" id="codice" value="<?php echo $r->Cd_AR ?>">
                                            <button style="width: 44px;background-color: #17A2B8;border: #17A2B8;height: 26px;" type="button" name="modifica_riga" value="<?php echo $r->Cd_AR;?>" class="btn btn-danger btn-sm" onclick="$('#modal_modifica_<?php echo $r->Id_DORig ?>').modal('show');"><i class="bi bi-pencil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 18" style="margin-bottom: 10px;margin-right:20px">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg></i></button>
                                            <input type="hidden" name="Id_DORig" value="<?php echo $r->Id_DORig ?>">
                                            <button  style="width: 44px;height: 26px;" type="submit" name="elimina_riga" value="Elimina" class="btn btn-danger btn-sm" ><i class="bi bi-trash-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 18" style="margin-bottom: 10px;margin-right:20px">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg></i></button>
                                            <?php } ?>
                                        </form>
                                    </td>
                                </div>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                            <?php if($documento->giornata!= null ){foreach($documento->giornata as $d){ $totale = 0; ?>

                            <tr style="border:1px solid black;border-collapse: collapse;border-radius: 10px;">
                                <div class="media-body">
                                    <div class="row">

                                        <td class="col-xs-3 col-sm-3 col-md-3" style="text-align: left;">
                                            <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo substr($d[0]->Articolo,'0','52')?></label>
                                        </td>
                                        <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                            <input type="text"  id="modifica_collo" style="text-align:center;border:none;font-weight: bold;margin-bottom: -0.5rem;" value="" onfocus="cerca_articolo1.focus()" readonly >
<?php //                                            <input type="text"  style="text-align:center;border:none;font-weight: bold;margin-bottom: -0.5rem;" value="<?php echo $d[0]->Colli_Prodotti;?><?php //" onfocus="cerca_articolo1.focus()" readonly > ?>
                                        </td>
                                        <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                            <label style="color:black;font-size:14px;margin-bottom:-0.5rem;font-weight: bold"></label>
                                        </td>
                                        <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                            <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo $d[0]->Colli_Ordinati?></label>
                                        </td>
                                        <td class="col-xs-2 col-sm-2 col-md-2" style="text-align: center;margin-bottom: -0.5rem;">

                                        </td>
                                        <?php /*
                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center;<?php /*background-color: #B2FF66 *//*?>">
                                        <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo floatval(floatval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))?></label>
                                    </td>

                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center;background-color: #E4F551<?php if(floatval(floatval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))-(floatval($d[0]->Colli_Ordinati))<0)echo ';background-color: #ff6969 !important;'?>">
                                        <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php if(floatval(floatval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))-(floatval($d[0]->Colli_Ordinati))<0)echo intval(intval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))-(floatval($d[0]->Colli_Ordinati)); else echo '0'; ?> </label>
                                    </td>

                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                        <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo floatval($d[0]->Colli_Prodotti) ?></label>
                                    </td>
*/?>
                                    </div>
                                </div>
                            </tr>

                            <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php /*
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if($documento->giornata != null){ ?>

                            <table <?php /*style="margin-right: 10px;margin-left:10px"*//*?>>
                                <tbody>
                                <?php foreach($documento->giornata as $d){ $totale = 0; ?>

                                <tr style="border:1px solid black;border-collapse: collapse;border-radius: 10px;">
                                    <div class="media-body">
                                        <div class="row">

                                            <td class="col-xs-3 col-sm-3 col-md-3" style="text-align: left;">
                                                <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo /*substr($d[0]->Articolo,'0','21')*/ /*$d[0]->Articolo?></label>
                                            </td>
                                            <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                                <label style="color:black;font-size:14px;margin-bottom:-0.5rem;font-weight: bold"></label>
                                            </td>
                                            <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                                <label style="color:black;font-size:14px;margin-bottom:-0.5rem;font-weight: bold"></label>
                                            </td>
                                            <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                                <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo $d[0]->Colli_Ordinati?></label>
                                            </td>
                                            <td class="col-xs-2 col-sm-2 col-md-2" style="text-align: center;margin-bottom: -0.5rem;">

                                            </td>

                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center;<?php /*background-color: #B2FF66 *//*?>">
                                        <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo floatval(floatval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))?></label>
                                    </td>

                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center;background-color: #E4F551<?php if(floatval(floatval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))-(floatval($d[0]->Colli_Ordinati))<0)echo ';background-color: #ff6969 !important;'?>">
                                        <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php if(floatval(floatval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))-(floatval($d[0]->Colli_Ordinati))<0)echo intval(intval($d[0]->Colli_Magazzino)/floatval($d[0]->QtaConfezione))-(floatval($d[0]->Colli_Ordinati)); else echo '0'; ?> </label>
                                    </td>

                                    <td class="col-xs-1 col-sm-1 col-md-1" style="text-align: center">
                                        <label style="font-size:14px;margin-bottom:-0.5rem;font-weight: bold"><?php echo floatval($d[0]->Colli_Prodotti) ?></label>
                                    </td>

                                        </div>
                                    </div>
                                </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                            <?php } ?>
                        </div>
                    </div>

                    <button type="button" style="margin-top:10px !important;margin-bottom:15px !important;width:80%;margin:0 auto;display:block;background-color:red;border-color:red;height: 35px"   name="esplodi_riga" value="<?php echo $documento->Id_DoTes;?>" class="btn btn-primary" onclick="$('#modal_esplodi').modal('show')"><h6 style="color: white">Conferma Documento</h6></button>

                  <div style="margin-top:15px !important;">  */?>
                <div>
                    <div class="progress-bar-wrapper" style="width: 33%;padding-left: 50px;padding-right: 50px;float: left; alignment: left;">
                        <h6 style="text-align: center;">IERI</h6>
                        <div class="progress-bar-label" <?php if($capannone1_I < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone1_I < '0')echo 'style="color: red"'?>>Capannone 1 : Disponibile <?php echo $capannone1_I?>  su <?php echo $capannone1_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone1_I)/floatval($capannone1_max))*100?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone3_I < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone3_I < '0')echo 'style="color: red"'?>>Capannone 3 : Disponibile <?php echo $capannone3_I?>  su <?php echo $capannone3_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone3_I)/floatval($capannone3_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax=""></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone4_I < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone4_I < '0')echo 'style="color: red"'?>>Capannone 4 : Disponibile <?php echo $capannone4_I?>  su <?php echo $capannone4_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone4_I)/floatval($capannone4_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone5_I < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone5_I < '0')echo 'style="color: red"'?>>Capannone 5 : Disponibile <?php echo $capannone5_I?>  su <?php echo $capannone5_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone5_I)/floatval($capannone5_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone6_I < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone6_I < '0')echo 'style="color: red"'?>>Capannone 6 : Disponibile <?php echo $capannone6_I?>  su <?php echo $capannone6_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone6_I)/floatval($capannone6_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannoneA_I < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannoneA_I < '0')echo 'style="color: red"'?>>Capannone A : Disponibile <?php echo $capannoneA_I?>  su <?php if($capannoneA_max != '1') echo $capannoneA_max ; else echo '0';?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannoneA_I)/floatval($capannoneA_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannoneB_I < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannoneB_I < '0')echo 'style="color: red"'?>>Capannone B : Disponibile <?php echo $capannoneB_I?>  su <?php echo $capannoneB_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannoneB_I)/floatval($capannoneB_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>
                    <div class="progress-bar-wrapper" style="width: 33%;padding-left: 50px;padding-right: 50px;float: left; alignment: left;">
                        <h6 style="text-align: center">OGGI </h6>

                        <div class="progress-bar-label" <?php if($capannone1 < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone1 < '0')echo 'style="color: red"'?>>Capannone 1 : Disponibile <?php echo $capannone1?>  su <?php echo $capannone1_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone1)/floatval($capannone1_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone3 < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone3 < '0')echo 'style="color: red"'?>>Capannone 3 : Disponibile <?php echo $capannone3?>  su <?php echo $capannone3_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone3)/floatval($capannone3_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax=""></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone4 < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone4 < '0')echo 'style="color: red"'?>>Capannone 4 : Disponibile <?php echo $capannone4?>  su <?php echo $capannone4_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone4)/floatval($capannone4_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone5 < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone5 < '0')echo 'style="color: red"'?>>Capannone 5 : Disponibile <?php echo $capannone5?>  su <?php echo $capannone5_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone5)/floatval($capannone5_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone6 < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone6 < '0')echo 'style="color: red"'?>>Capannone 6 : Disponibile <?php echo $capannone6?>  su <?php echo $capannone6_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone6)/floatval($capannone6_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannoneA < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannoneA < '0')echo 'style="color: red"'?>>Capannone A : Disponibile <?php echo $capannoneA?>  su <?php if($capannoneA_max != '1') echo $capannoneA_max ; else echo '0';?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannoneA)/floatval($capannoneA_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannoneB < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannoneB < '0')echo 'style="color: red"'?>>Capannone B : Disponibile <?php echo $capannoneB?>  su <?php echo $capannoneB_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannoneB)/floatval($capannoneB_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>
                    <div class="progress-bar-wrapper" style="width: 33%;padding-left: 50px;padding-right: 50px;float: left; alignment: left;">
                        <h6 style="text-align: center">DOMANI</h6>

                        <div class="progress-bar-label" <?php if($capannone1_D < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone1_D < '0')echo 'style="color: red"'?>>Capannone 1 : Disponibile <?php echo $capannone1_D?>  su <?php echo $capannone1_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone1_D)/floatval($capannone1_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone3_D < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone3_D < '0')echo 'style="color: red"'?>>Capannone 3 : Disponibile <?php echo $capannone3_D?>  su <?php echo $capannone3_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone3_D)/floatval($capannone3_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax=""></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone4_D < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone4_D < '0')echo 'style="color: red"'?>>Capannone 4 : Disponibile <?php echo $capannone4_D?>  su <?php echo $capannone4_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone4_D)/floatval($capannone4_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone5_D < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone5_D < '0')echo 'style="color: red"'?>>Capannone 5 : Disponibile <?php echo $capannone5_D?>  su <?php echo $capannone5_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone5_D)/floatval($capannone5_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannone6_D < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannone6_D < '0')echo 'style="color: red"'?>>Capannone 6 : Disponibile <?php echo $capannone6_D?>  su <?php echo $capannone6_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannone6_D)/floatval($capannone6_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannoneA_D < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannoneA_D < '0')echo 'style="color: red"'?>>Capannone A : Disponibile <?php echo $capannoneA_D?>  su <?php if($capannoneA_max != '1') echo $capannoneA_max ; else echo '0';?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannoneA_D)/floatval($capannoneA_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="progress-bar-label" <?php if($capannoneB_D < '0')echo 'style="color: red"'?>><label style="font-weight: bold "<?php if($capannoneB_D < '0')echo 'style="color: red"'?>>Capannone B : Disponibile <?php echo $capannoneB_D?>  su <?php echo $capannoneB_max?></label></div>
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo (floatval($capannoneB_D)/floatval($capannoneB_max))*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- page main ends -->


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

                    <label>Colli</label>
                    <input class="form-control" type="number" name="Qta" value="<?php echo floatval($r->xcolli) ?>" required placeholder="Inserisci una Quantità" autocomplete="off">

                    <input class="form-control" type="hidden" name="QtaEvadibile" value="<?php echo intval($r->QtaEvadibile) ?>" required placeholder="Inserisci una Quantità" autocomplete="off">


                    <input class="form-control" type="hidden" name="PrezzoUnitarioV" value="<?php echo intval($r->PrezzoUnitarioV) ?>" required placeholder="Inserisci un Prezzo" autocomplete="off">

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
                    <h5 class="modal-title" id="exampleModalLabel">Esplodi Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <label>Sei sicuro di voler far esplodere tutti gli articoli</label>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="Id_DoTes" value="<?php echo $documento->Id_DoTes;?>">
                    <input type="hidden" name="Id_DoTes_I" value="<?php echo $Id_DoTes_I;?>">
                    <input type="hidden" name="Id_DoTes_D" value="<?php echo $Id_DoTes_D;?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">No</button>
                    <button type="submit"  name="esplodi_riga" value="Esplodi" class="btn btn-primary">Si</button>
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

        codice    =      $('#modal_Cd_AR').val();
        quantita  =      $('#modal_colli').val();
        magazzino =      $('#modal_magazzino').val();
        lotto     =      $('#modal_lotto').val();





        if(quantita != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/aggiungi_articolo_ordine') ?>/<?php echo $id_dotes ?>/"+codice+"/"+quantita+"/"+"0/ND"+"/"+lotto+"/"+magazzino.substring(0,5)+"/ND"
            }).done(function(result) {
                $('#modal_carico').modal('hide');
                $('#modal_Cd_AR').val('');
                $('#modal_quantita').val('');
                magazzino = $('#modal_magazzino').val();
                alert(result);
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
    function cambiacollo(dorig){

        colli = document.getElementById('modifica_collo'+dorig).value;
        if(colli != ''){
            $.ajax({
                url: "<?php echo URL::asset('ajax/cambia_collo') ?>/"+dorig+"/"+colli,
            }).done(function(result) {
                location.reload();
            });

        }
        location.reload();
    }
    function ciao(){alert('ciao');}
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
