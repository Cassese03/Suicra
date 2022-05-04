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
                <input type="text" id="cerca" class="form-control border-0" placeholder="Cerca Fornitore..." aria-label="Username" autocomplete="off">
            </div>
        </form>
        <header class="row m-0 fixed-header">
            <div class="left">
                <a style="padding-left:20px;" href="/magazzino/scarico2/<?php echo $cd_do; ?>" ><i class="material-icons">arrow_back_ios</i></a>
            </div>
            <div class="col center">
                <a href="#" class="logo"><figure><img src="/img/logo_arca.png" alt=""></figure>Documenti (<?php echo $cd_do ?>)</a>
            </div>
            <div class="right">
                <a style="padding-left:20px;" href="/" ><i class="material-icons">home</i></a>
            </div>
        </header>

        <div class="page-content">
            <div class="content-sticky-footer">

                <div class="background bg-125"><img src="/img/background.png" alt=""></div>
                <div class="w-100">
                    <h1 class="text-center text-white title-background">Lista Documenti (<?php echo $cd_do ?>)<br><small><?php echo $cliente->Descrizione ?></small></h1>
                </div>

                <div class="row mx-0" style="margin-bottom:10px;">
                    <div class="col-12">
                        <a href="#" class="btn btn-success btn-sm" style="width:100%" onclick="apri_modal_documento();">+ Crea Nuovo Documento</a>
                    </div>
                </div>

                <ul class="list-group" id="ajax" style="max-height:500px;">

                    <?php  foreach($documenti as $do){ ?>

                        <li class="list-group-item">
                            <a href="/magazzino/scarico4/<?php echo $cliente->Id_CF ?>/<?php echo $do->Id_DoTes ?>" class="media">
                                <div class="media-body">
                                    <h5><?php echo $cd_do ?> N.<?php echo $do->NumeroDoc ?> Del <?php echo date('d/m/Y',strtotime($do->DataDoc)) ?></h5>
                                </div>
                            </a>
                        </li>

                        <?php } if(sizeof($documenti)==10){ ?>

                        <button type="button"  class="btn btn-success btn-sm" style="width:100%;background-color: red" onclick="gotobolla()"> Mostra Tutti i Documenti</button>
                    <?php }  ?>
                </ul>



            </div>
        </div>
    </div>
    <!-- page main ends -->

</div>


<div class="modal" id="modal_documento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crea Documento (<?php echo $cd_do ?>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h3>Cliente:<br><small><?php echo $cliente->Descrizione ?></small></h3>
                    <label>Numero Documento</label>
                    <input class="form-control" type="number" placeholder="Inserisci Numero Documento" id="NumeroDoc" value="<?php echo $numero_documento ?>" readonly>
                    <label>Data Documento</label>
                    <input class="form-control" type="text" placeholder="Data Del Documento" id="DataDoc" value="<?php echo date('Y-m-d') ?>" readonly>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="crea_documento();">Crea Documento</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal" id="modal_alertDocumento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" onclick="location.reload()">&times;</button>
        <strong>Success!</strong> Documento Creato con successo </a>.
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
</body>

</html>

<script type="text/javascript">

    function gotobolla(){
        top.location.href = "/magazzino/scarico3_tot/<?php echo $cliente->Id_CF?>/<?php echo $cd_do?>";
    }

    function apri_modal_documento(){
        $('#modal_documento').modal('show');
    }

    function crea_documento(){

        numero = $('#NumeroDoc').val();
        data = $('#DataDoc').val();

        if(numero != '' && data != ''){

            $.ajax({
                url: "<?php echo URL::asset('ajax/crea_documento') ?>/<?php echo $cliente->Cd_CF ?>/<?php echo $cd_do ?>/"+numero+"/"+data
            }).done(function(result) {
                $('#modal_alertDocumento').modal('show');
                location.reload();
            });

        } else alert('Inserire Numero e Data Del Documento');
    }

</script>
