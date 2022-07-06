<?php  $utente = session('utente');?>
<!doctype html>
<html lang="en" class="md">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <link rel="apple-touch-icon" href="img/icona_arca.png">
    <link rel="icon" href="img/icona_arca.png">
    <link rel="stylesheet" href="vendor/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/materializeicon/material-icons.css">
    <link rel="stylesheet" href="vendor/swiper/css/swiper.min.css">
    <link id="theme" rel="stylesheet" href="css/style.css" type="text/css">
    <title>Arca Logistic</title>
</head>

<body class="color-theme-red push-content-right theme-light">
<div class="loader justify-content-center ">
    <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
<div class="wrapper">

    <!-- page main start -->
    <div class="page">
        <div class="page-content">
            <div class="content-sticky-footer">

                <div class="row" style="height:750px;overflow-y: none;">
                    <div class="col-md-6">
                        <div class="background bg-250" style="height:100%;" ><img src="img/background.png" alt="" style="height:100%;" > </div>
                        <div class="w-100">
                            <h6 style="float: right;color: white">Accesso effettuato da : <?php echo $utente->Cd_Operatore ?></h6>
                            <img src="img/logo_arca.png" style="width:80%;padding:10%;margin:0 auto;display:block;">

                            <h1 class="text-center text-white title-background" style="margin-top:0">
                                <small>Arca Logistic<br></small>
                                <?php  echo $ditta->RagioneSociale ?></h1>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding-left:0;">

                        <ul class="list-group" >
                            <li class="list-group-item">

                                <a href="<?php echo URL::ASSET('articoli') ?>" class="media">
                                    <div class="media-body">
                                        <h5>Articoli</h5>
                                        <p>Gestisci gli articoli di Arca</p>
                                    </div>
                                </a>

                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo URL::asset('magazzino') ?>" class="media">
                                    <div class="media-body">
                                        <h5>Magazzino</h5>
                                        <p>Gestisci il Magazzino di Arca</p>
                                    </div>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo URL::asset('magazzino/inventario') ?>" class="media">
                                    <div class="media-body">
                                        <h5>Inventario</h5>
                                        <p>Effettua Inventario Rettificando le Quantità</p>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a onclick="$('#modal_crea').modal('show')" class="media">
                                    <div class="media-body">
                                        <h5>CPI</h5>
                                        <p>Carico Produzione Interna</p>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo URL::asset('logout') ?>" class="media">
                                    <div class="media-body">
                                        <h5>Logout</h5>
                                        <p>Effettua il Logout</p>
                                    </div>
                                </a>
                            </li>
                        <!--
                            <li class="list-group-item">
                                <a href="<?php echo URL::asset('ordini') ?>" class="media">
                                    <div class="media-body">
                                        <h5>Passivo</h5>
                                        <p>Gestisci gli Ordini ancora non chiusi</p>
                                    </div>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo URL::asset('attivi') ?>" class="media">
                                    <div class="media-body">
                                        <h5>Attivo</h5>
                                        <p>Gestisci gli Ordini ancora non chiusi</p>
                                    </div>
                                </a>
                            </li>
-->
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- page main ends -->

</div>

<div class="modal" id="modal_crea" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crea Documento (CPI)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                     <label>Data Documento</label>
                    <input class="form-control" type="date" placeholder="Data Del Documento" id="DataDoc" value="<?php echo date('Y-m-d') ?>" placeholder="yyyy-mm-dd">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="crea();">Crea Documento</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    function crea(){
        data = document.getElementById('DataDoc').value;
        top.location.href="<?php echo URL::asset('magazzino/produzione3') ?>/"+data;
    }
</script>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>

<!-- Cookie jquery file -->
<script src="vendor/cookie/jquery.cookie.js"></script>

<!-- sparklines chart jquery file -->
<script src="vendor/sparklines/jquery.sparkline.min.js"></script>

<!-- Circular progress gauge jquery file -->
<script src="vendor/circle-progress/circle-progress.min.js"></script>

<!-- Swiper carousel jquery file -->
<script src="vendor/swiper/js/swiper.min.js"></script>

<!-- Application main common jquery file -->
<script src="js/main.js"></script>

<!-- page specific script -->
<script>
    $(window).on('load', function() {
        /* sparklines */
        $(".dynamicsparkline").sparkline([5, 6, 7, 2, 0, 4, 2, 5, 6, 7, 2, 0, 4, 2, 4], {
            type: 'bar',
            height: '25',
            barSpacing: 2,
            barColor: '#a9d7fe',
            negBarColor: '#ef4055',
            zeroColor: '#ffffff'
        });

        /* gauge chart circular progress */
        $('.progress_profile1').circleProgress({
            fill: '#169cf1',
            lineCap: 'butt'
        });
        $('.progress_profile2').circleProgress({
            fill: '#f4465e',
            lineCap: 'butt'
        });
        $('.progress_profile4').circleProgress({
            fill: '#ffc000',
            lineCap: 'butt'
        });
        $('.progress_profile3').circleProgress({
            fill: '#00c473',
            lineCap: 'butt'
        });

        /*Swiper carousel */
        var mySwiper = new Swiper('.swiper-container', {
            slidesPerView: 2,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            }
        });
        /* tooltip */
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    });

</script>
</body>

</html>
