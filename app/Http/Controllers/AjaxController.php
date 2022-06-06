<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use PhpParser\Node\Stmt\Else_;
use Spatie\GoogleCalendar\Event;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use NGT\Barcode\GS1Decoder\Decoder;
use Symfony\Component\VarDumper\Cloner\Data;
use function PHPUnit\Framework\returnArgument;


/**
 * Controller principale del webticket
 * Class HomeController
 * @package App\Http\Controllers
 */

class AjaxController extends Controller{
/*
    public function invio(){

        $path = 'C:/Users/Work4/Desktop/Screenshot_4.png';
        $base64 = base64_encode(file_get_contents($path));

        $oggetto = array('immagine' => $base64);

        $newJsonString = json_encode($oggetto);

        //file_put_contents(base_path('provajson'), stripslashes($newJsonString));

        //  $newJsonString  = base64_encode($newJsonString);

        // API URL

        $url = 'https://arcalogisticsuicra.local/ajax/provajson';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $newJsonString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_PORT, 443);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);

    }

    public function provajson(Request $request){


        $dati = $request->all();
        print_r($dati);
        $img = $dati['immagine'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $rand = rand(1,100);
        $fp = fopen ( "C:/Users/Work4/Desktop/" .$rand.".png","w+");
        fwrite($fp,$data) ;
        /* echo 'Token :'.$token.'<br>';
         echo 'Messaggio :'.$dati['messaggio'];
         echo 'Contatto :'.$dati['Contatto'];
         $json = 'Token :'.$token.'<br>Messaggio :'.$dati['messaggio'].'Contatto :'.$dati['Contatto'];*/
       /*echo 'C:/Users/Work4/Desktop/'.$rand.'.png';
        echo '<img src="public/image/61.png" alt="DDT" style="width:100%;z-index:1">';
        exit();

        $jsonString  = base64_decode($jsonString);


        //$jsonString2 = file_get_contents(base_path('provajson'));
/*
        $data = json_decode($jsonString, true);

        echo $data['immagine'];

        file_put_contents($data, file_get_contents($jsonString));
    }*/
    public function cambia_qta($dorig,$qta)
    {

        DB::UPDATE("UPDATE DORIG SET Qta = '$qta' WHERE Id_DORig = '$dorig'");
    }
    public function cambia_articolo($dorig,$articolo)
    {

        $controllo = DB::SELECT('SELECT * FROM AR WHERE Cd_AR = \''.$articolo.'\'');
        if(sizeof($controllo) > 0 ){
            $descrizione = $controllo[0]->Descrizione;
            $descrizione = str_replace('\'','',$descrizione);
            DB::UPDATE("UPDATE DORIG SET Cd_AR = '$articolo', Descrizione = '$descrizione  ' WHERE Id_DORig = '$dorig'");
        }
    }

    public function cambia_lotto($dorig,$lotto)
    {
        $riga = DB::SELECT('SELECT * FROM DORIG WHERE Id_DORig = \''.$dorig.'\'')[0];
        $controllo_lotto = DB::SELECT('SELECT * FROM ARLotto where Cd_AR = \''.$riga->Cd_AR.'\' and Cd_ARLotto = \''.$lotto.'\'');
        if(sizeof($controllo_lotto) != '0')
            DB::UPDATE("UPDATE DORIG SET Cd_ARLotto = '$lotto' WHERE Id_DORig = '$dorig'");
        else {
            DB::table('ARLotto')->insertGetId(['Cd_AR' => $riga->Cd_AR, 'Cd_ARLotto' => $lotto, 'Descrizione' => 'Lotto '.$lotto]);
            DB::UPDATE("UPDATE DORIG SET Cd_ARLotto = '$lotto' WHERE Id_DORig = '$dorig'");
        }
    }

    public function cerca_articolo($q){

        $articoli = DB::select('SELECT [Id_AR],[Cd_AR],[Descrizione] FROM AR where (Cd_AR = \''.$q.'\' or  Descrizione = \''.$q.'\' or CD_AR IN (SELECT CD_AR from ARAlias where Alias = \''.$q.'\'))  Order By Id_AR DESC');
        if(sizeof($articoli)=='0') {
            $decoder = new Decoder($delimiter = '');
            $barcode = $decoder->decode($q);
            $where = ' where 1=1 ';

            foreach ($barcode->toArray()['identifiers'] as $field) {

                if ($field['code'] == '01') {
                    $testo = trim($field['content'], '*,');
                    $where .= ' and AR.Cd_AR Like \'' . $testo . '\'';
                }

            }
            $articoli = DB::select('SELECT [Id_AR],[Cd_AR],[Descrizione] FROM AR ' . $where . '  Order By Id_AR DESC');
        }
        if( sizeof($articoli) != '0')
            foreach($articoli as $articolo){ ?>

                <li class="list-group-item">
                    <a href="/modifica_articolo/<?php echo $articolo->Id_AR ?>" class="media">
                        <div class="media-body">
                            <h5><?php echo $articolo->Descrizione ?></h5>
                            <p>Codice: <?php echo $articolo->Cd_AR ?></p>
                        </div>
                    </a>
                </li>

            <?php }


    }

    public function cerca_articolo_trasporto($q)
    {

        $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto ON AR.Cd_AR = ARLotto.Cd_AR where (AR.Cd_AR Like \''.$q.'%\' or  AR.Descrizione Like \'%'.$q.'%\' or AR.CD_AR IN (SELECT CD_AR from ARAlias where Alias LIKE \'%'.$q.'%\'))  Order By AR.Id_AR DESC');
        if(sizeof($articoli)=='0') {
            $decoder = new Decoder($delimiter = '');
            $barcode = $decoder->decode($q);
            $where = ' where 1=1 ';

            foreach ($barcode->toArray()['identifiers'] as $field) {

                if ($field['code'] == '01') {
                    $testo = trim($field['content'], '*,');
                    $where .= ' and AR.Cd_AR Like \'' . $testo . '\'';
                }
                if ($field['code'] == '10') {
                    $where .= ' and ARLotto.Cd_ARLotto Like \'%' . $field['content'] . '%\'';
                }

            }
            $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto on AR.Cd_AR = ARLotto.Cd_AR ' . $where . '  Order By Id_AR DESC');
        }
        foreach($articoli as $articolo){?>

            <li class="list-group-item">
                <a onclick="cambio_articolo(<?php echo $articolo->Cd_AR.','?><?php if($articolo->Cd_ARLotto != '')echo $articolo->Cd_ARLotto; else echo '0';?>)" class="media">
                    <div class="media-body">
                        <h5><?php echo $articolo->Descrizione;if($articolo->Cd_ARLotto != '')echo '  Lotto: '.$articolo->Cd_ARLotto?></h5>
                        <p>Codice: <?php echo $articolo->Cd_AR ?></p>
                    </div>
                </a>
            </li>

        <?php }
    }
    public function visualizza_lotti($articolo){
        $data = strtotime('today');
        $data = date('d-m-Y',$data);
        $lotto = DB::SELECT('SELECT * FROM ARLotto where Cd_AR =\''.$articolo.'\' and  Cd_ARLotto in (select Cd_ARLotto from MGMov group by Cd_ARLotto having SUM(QuantitaSign) > 0) and DataScadenza >= \''.$data.'\'  ORDER BY Cd_ARLotto DESC ');
        /*
            $lotto2 = DB::SELECT('SELECT * FROM ARLotto where Cd_AR =\''.$articolo.'\' and  Cd_ARLotto in (select Cd_ARLotto from MGMov group by Cd_ARLotto having SUM(QuantitaSign) > 0) and DataScadenza >= \''.$data.'\'ORDER BY Cd_ARLotto DESC  ');
            foreach ($lotto2 as $l1){
                 $l1->Cd_ARLotto=str_replace('/','slash',$l1->Cd_ARLotto);
             }
         */
        foreach ($lotto as $l){//foreach ($lotto2 as $l1){
            ?>
            <li class="list-group-item" >
                <a class="media" onclick="">
                    <div class="media-body" onclick="storialotto('<?php echo $l->Cd_AR ?>','<?php echo $l->Cd_ARLotto?>')">
                        <h5><?php echo $l->Cd_ARLotto;if($l->Cd_CF != '')echo '  (Fornitore: '.$l->Cd_CF.')'?></h5>
                        <p>Codice: <?php echo $l->Cd_AR?> - Scade il : <?php echo date("d-m-Y",strtotime($l->DataScadenza)) ?></p>
                    </div>
                </a>
            </li>
        <?php } // }
    }

    public function visualizza_giacenza_lotto($articolo){

        $data = strtotime('today');

        $data = date('d-m-Y',$data);

        $giacenza = DB::SELECT('SELECT SUM(QuantitaSign) as Giacenza,Cd_AR,Cd_ARLotto FROM MGMov WHERE Cd_AR = \''.$articolo.'\'  GROUP BY Cd_AR,Cd_ARLotto HAVING SUM(QuantitaSign) > 0  ');

        foreach ($giacenza as $g){
            ?>
            <li class="list-group-item" >
                <a class="media" onclick="">
                    <div class="media-body">
                        <h5>Lotto : <?php echo $g->Cd_ARLotto;?></h5>
                        <p>Giacenza: <?php echo $g->Giacenza ?></p>
                    </div>
                </a>
            </li>
        <?php }
    }

    public function visualizza_giacenza($articolo){

        $data = strtotime('today');

        $data = date('d-m-Y',$data);

        $giacenza = DB::SELECT('SELECT SUM(QuantitaSign) as Giacenza,Cd_AR,Cd_MG FROM MGMov WHERE Cd_AR = \''.$articolo.'\' GROUP BY Cd_AR,Cd_MG ORDER BY Cd_MG ASC');

        foreach ($giacenza as $g){
            ?>
            <li class="list-group-item" >
                <a class="media" onclick="">
                    <div class="media-body">
                        <h5><?php echo $g->Cd_MG ?> - Giacenza: <?php echo $g->Giacenza ?></h5>
                    </div>
                </a>
            </li>
        <?php }
    }

    public function storialotto($articolo,$lotto){
        //echo 'SELECT SUM(QuantitaSign) as Giacenza,Cd_AR,Cd_MG,Cd_ARLotto FROM MGMov WHERE Cd_AR = \''.$articolo.'\' AND Cd_ARLotto = \''.$lotto.'\' GROUP BY Cd_AR,Cd_ARLotto,Cd_MG HAVING SUM(QuantitaSign)>0';
        foreach ($lotto1 as $l){?>
            <li class="list-group-item">
                <a class="media">
                    <div class="media-body">
                        <h5><?php echo $l->Cd_ARLotto ?></h5>
                        <p>Azione : <?php
                            if($l->Ini=='1') echo 'Iniziale';
                            if($l->Ret=='1') echo 'Rettifica';
                            if($l->Car=='1') echo 'Carico';
                            if($l->Sca=='1') echo 'Scarico';?></p>
                        <small>Magazzino : <?php echo  $l->Cd_MG ?></small>
                        <small>Quantita' : <?php echo floatval($l->QuantitaSign) ?></small>
                    </div>
                </a>
            </li>
        <?php } ?>
        <li class="list-group-item">
            <a class="media">
                <div class="media-body">
                    <h5><?php echo $giacenza[0]->Cd_ARLotto ?></h5>
                    <p><?php echo 'Giacenza Attuale'?></p>
                    <small>Magazzino : <?php echo  $giacenza[0]->Cd_MG ?></small>
                    <small>Quantita' : <?php echo floatval($giacenza[0]->Giacenza) ?></small>
                </div>
            </a>
        </li>
    <?php }

    public function inserisci_lotto($lotto,$articolo,$fornitore,$descrizione,$fornitore_pallet,$pallet){
        $esiste = DB::SELECT('SELECT * FROM ARLotto WHERE Cd_AR = \''.$articolo.'\' and Cd_ARLotto = \''.$lotto.'\' ');
        if(sizeof($esiste)>0){
            echo 'Impossibile creare il lotto in quanto già esistente';
        }else {
            if($fornitore!='0') {
                $fornitori = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Fornitore = 1 and (Cd_CF Like \'%' . $fornitore . '%\' or  Descrizione Like \'%' . $fornitore . '%\')  Order By Id_CF DESC');
                if ($fornitori == null) {
                    echo 'Fornitore non trovato';
                    exit();
                } else
                    $fornitori = $fornitori[0]->Cd_CF;
            }
            $id_Lotto = DB::table('ARLotto')->insertGetId(['Cd_AR' => $articolo, 'Cd_ARLotto' => $lotto, 'Descrizione' => $descrizione]);
            if($fornitore!='0') {
                DB::update("UPDATE ARLotto Set Cd_CF = '$fornitori' where Id_ARLotto = '$id_Lotto' ");
            }
            if($fornitore_pallet!='0'){
                DB::update("UPDATE ARLotto Set xNr_PalletFornitore = '$fornitore_pallet' where Id_ARLotto = '$id_Lotto' ");
            }
            if($pallet!='0'){
                DB::update("UPDATE ARLotto Set xCd_xPallet = '$pallet' where Id_ARLotto = '$id_Lotto' ");
            }
            echo 'Lotto Inserito Correttamente';
        }
    }

    public function segnalazione_salva($id_dotes,$id_dorig,$testo){
        $testo = str_replace('*','',$testo);
        $esiste = DB::SELECT('SELECT * FROM DoTes WHERE Id_DoTes = \''.$id_dotes.'\' ')[0]->NotePiede;
        if($esiste != null){
            $esiste.='                                    ';
            $esiste .= $testo;
            DB::update('Update DoTes set NotePiede = \''.$esiste.'\' where Id_DoTes = \''.$id_dotes.'\' ');
        }
        else
            DB::update('Update DOTes set NotePiede = \'' . $testo . '\' where Id_DoTes = \'' . $id_dotes . '\' ');
    }

    public function segnalazione($id_dotes,$id_dorig,$testo){

        if(substr($testo,0,2 )=='01') {
            $decoder = new Decoder($delimiter = '');
            $barcode = $decoder->decode($testo);
            $where = 'Articolo ';
            foreach ($barcode->toArray()['identifiers'] as $field) {

                if ($field['code'] == '01') {
                    $contenuto = trim($field['content'], '*,');
                    $where .= $contenuto . ' con lotto ';

                }
                if ($field['code'] == '10') {
                    $where .= $field['content'] . ' non trovato.';

                }
                /*
                if ($field['code'] == '310') {
                    $decimali = floatval(substr($field['raw_content'],-2));
                    $qta = floatval(substr($field['raw_content'],0,4))+$decimali/100;
                    $where .= ' and Qta Like \'%' . $qta . '%\'';
                }*/

            }
        }else{
            $testo = trim($testo, '-');
            $where = $testo;
        }
        $esiste = DB::SELECT('SELECT * FROM DoTes WHERE Id_DoTes = \''.$id_dotes.'\' ')[0]->NotePiede;
        if($esiste != null){
            $esiste.='                                    ';
            $esiste .= $where;
            DB::update('Update DoTes set NotePiede = \''.$esiste.'\' where Id_DoTes = \''.$id_dotes.'\' ');
        }
        else
            DB::update('Update DOTes set NotePiede = \'' . $where . '\' where Id_DoTes = \'' . $id_dotes . '\' ');

    }
    public function cerca_articolo_new($q,$dest,$forn){

        $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto ON AR.Cd_AR = ARLotto.Cd_AR where (AR.Cd_AR Like \''.$q.'%\' or  AR.Descrizione Like \'%'.$q.'%\' or AR.CD_AR IN (SELECT CD_AR from ARAlias where Alias LIKE \'%'.$q.'%\'))  Order By AR.Id_AR DESC');
        if(sizeof($articoli)=='0') {
            $decoder = new Decoder($delimiter = '');
            $barcode = $decoder->decode($q);
            $where = ' where 1=1 ';

            foreach ($barcode->toArray()['identifiers'] as $field) {

                if ($field['code'] == '01') {
                    $testo = trim($field['content'], '*,');
                    $where .= ' and AR.Cd_AR Like \'' . $testo . '\'';
                }
                if ($field['code'] == '10') {
                    $where .= ' and ARLotto.Cd_ARLotto Like \'%' . $field['content'] . '%\'';
                }

            }
            $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto on AR.Cd_AR = ARLotto.Cd_AR ' . $where . '  Order By Id_AR DESC');
        }
        foreach($articoli as $a){ ?>

            <li class="list-group-item">
                <a href="/magazzino/trasporto2/<?php echo $a->Cd_AR ?>/BCV/<?php echo $forn?>/<?php echo $dest?>/<?php if($a->Cd_ARLotto!='')echo $a->Cd_ARLotto;else echo '0'; ?>" class="media">
                    <div class="media-body">
                        <h5><?php echo $a->Descrizione;if($a->Cd_ARLotto != '')echo '  Lotto: '.$a->Cd_ARLotto?></h5>
                        <p>Codice: <?php echo $a->Cd_AR;?></p>
                    </div>
                </a>
            </li>
        <?php }

    }



    public function cerca_fornitore($q = ''){

        if($q == '') {
            $fornitori = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Fornitore = 1 Order By Id_CF DESC');
        } else {
            $fornitori = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Fornitore = 1 and (Cd_CF Like \'%' . $q . '%\' or  Descrizione Like \'%' . $q . '%\')  Order By Id_CF DESC');
        }

        foreach($fornitori as $f){ ?>

            <li class="list-group-item">
                <a href="/magazzino/carico3/<?php echo $f->Id_CF ?>/ROF" class="media">
                    <div class="media-body">
                        <h5><?php echo $f->Descrizione ?></h5>
                        <p>Codice: <?php echo $f->Cd_CF ?></p>

                    </div>
                </a>
            </li>

        <?php }
    }
    public function cerca_fornitore_new($q = '',$dest){


        if($q == '') {
            $fornitori = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Fornitore = 1 Order By Id_CF DESC');
        } else {
            $fornitori = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Fornitore = 1 and (Cd_CF Like \'%' . $q . '%\' or  Descrizione Like \'%' . $q . '%\')  Order By Id_CF DESC');
        }
        if(sizeof($fornitori) != '0'){
            if($dest=='BCV'){
                foreach($fornitori as $f){ ?>

                    <li class="list-group-item">
                        <a href="/magazzino/trasporto_documento/BCV/<?php echo $f->Cd_CF ?>" class="media">
                            <div class="media-body">
                                <h5><?php echo $f->Descrizione ?></h5>
                                <p>Codice: <?php echo $f->Cd_CF ?></p>
                            </div>
                        </a>
                    </li>

                <?php }
            }else{
                foreach($fornitori as $f){ ?>

                    <li class="list-group-item">
                        <a href="/magazzino/carico03/<?php echo $f->Id_CF ?>/<?php echo $dest ?>" class="media">
                            <div class="media-body">
                                <h5><?php echo $f->Descrizione ?></h5>
                                <p>Codice: <?php echo $f->Cd_CF ?></p>

                            </div>
                        </a>
                    </li>

                <?php }
            }
        }
    }

    public function cerca_cliente_new($q,$dest){


        if($q == '') {
            $fornitori = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Cliente = 1 Order By Id_CF ASC');
        } else {
            $fornitori = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Cliente = 1 and (Cd_CF Like \'%' . $q . '%\' or  Descrizione Like \'%' . $q . '%\')  Order By Id_CF ASC');
        }
        if(sizeof($fornitori) != '0'){
            if($dest=='BCV'){
                foreach($fornitori as $f){ ?>

                    <li class="list-group-item">
                        <a href="/magazzino/trasporto_documento/BCV/<?php echo $f->Cd_CF ?>" class="media">
                            <div class="media-body">
                                <h5><?php echo $f->Descrizione ?></h5>
                                <p>Codice: <?php echo $f->Cd_CF ?></p>
                            </div>
                        </a>
                    </li>

                <?php }
            }else{
                foreach($fornitori as $f){ ?>

                    <li class="list-group-item">
                        <a href="/magazzino/<?php if(str_replace(' ','',$dest) !='OC') echo 'carico03';else echo 'scarico03'?>/<?php echo $f->Id_CF ?>/<?php echo $dest ?>" class="media">
                            <div class="media-body">
                                <h5><?php echo $f->Descrizione ?></h5>
                                <p>Codice: <?php echo $f->Cd_CF ?></p>

                            </div>
                        </a>
                    </li>

                <?php }
            }
        }
    }



    public function cerca_cliente($q = ''){


        if($q == '') {
            $clienti = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Cliente = 1 Order By Id_CF DESC');
        } else {
            $clienti = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Cliente = 1 and (Cd_CF Like \'%' . $q . '%\' or  Descrizione Like \'%' . $q . '%\')  Order By Id_CF DESC');
        }
        foreach($clienti as $c){ ?>

            <li class="list-group-item">
                <a href="/magazzino/scarico3/<?php echo $c->Id_CF ?>/PRV" class="media">
                    <div class="media-body">
                        <h5><?php echo $c->Descrizione ?></h5>
                        <p>Codice: <?php echo $c->Cd_CF ?></p>
                    </div>
                </a>
            </li>

        <?php }
    }
    /*public function cerca_cliente_new($q = '',$dest){


        if($q == '') {
            $clienti = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Cliente = 1 Order By Id_CF DESC');
        } else {
            $clienti = DB::select('SELECT [Id_CF],[Cd_CF],[Descrizione] FROM CF where Cliente = 1 and (Cd_CF Like \'%' . $q . '%\' or  Descrizione Like \'%' . $q . '%\')  Order By Id_CF DESC');
        }
        if($dest=='S2'){
            foreach($clienti as $f){ ?>

                <li class="list-group-item">
                    <a href="/magazzino/scarico3/<?php echo $f->Id_CF ?>/OVC" class="media">
                        <div class="media-body">
                            <h5><?php echo $f->Descrizione ?></h5>
                            <p>Codice: <?php echo $f->Cd_CF ?></p>

                        </div>
                    </a>
                </li>

            <?php }
        }
        if($dest=='S02'){
            foreach($clienti as $f){ ?>

                <li class="list-group-item">
                    <a href="/magazzino/scarico03/<?php echo $f->Id_CF ?>/DDT" class="media">
                        <div class="media-body">
                            <h5><?php echo $f->Descrizione ?></h5>
                            <p>Codice: <?php echo $f->Cd_CF ?></p>

                        </div>
                    </a>
                </li>

            <?php }
        }
    }*/

    public function cerca_articolo_barcode($cd_cf,$barcode){

        $articoli = DB::select('
            SELECT AR.Id_AR,AR.Cd_AR,AR.Descrizione,ARARMisura.UMFatt,DORig.PrezzoUnitarioV,LSArticolo.Prezzo from AR
            JOIN ARAlias ON AR.Cd_AR = ARAlias.Cd_AR and ARAlias.Alias = \''.$barcode.'\'
            LEFT JOIN ARARMisura ON ARARMisura.Cd_AR = AR.CD_AR
            LEFT JOIN LSArticolo ON LSArticolo.Cd_AR = AR.Cd_AR
            LEFT JOIN LSRevisione ON LSRevisione.Id_LSRevisione = LSArticolo.Id_LSRevisione and LSRevisione.Cd_LS = \'LSF\'
            LEFT JOIN DORig ON DOrig.Cd_CF = \''.$cd_cf.'\' and DORig.Cd_AR = AR.Cd_AR
            order by DORig.DataDoc ASC');

        if(sizeof($articoli) > 0){
            $articolo = $articoli[0];
            echo '<h3>Barcode: '.$barcode.'<br>
                      Pezzi x Collo: '.intval($articolo->UMFatt).'<br><br>
                      Descrizione:<br>'.$articolo->Descrizione.'</h3>';
            ?>


            $('#modal_Cd_AR').val('<?php echo $articolo->Cd_AR ?>');
            $('#modal_prezzo').val('<?php echo number_format($articolo->Prezzo,2,'.','') ?>');
            $('#modal_quantita').val(<?php echo intval($articolo->UMFatt) ?>);
            </script>
            <?php
        }
        if(sizeof($articoli)<1){
            $articoli = DB::select('
                SELECT AR.Id_AR,AR.Cd_AR,AR.Descrizione,ARARMisura.UMFatt,DORig.PrezzoUnitarioV,LSArticolo.Prezzo from AR
                LEFT JOIN ARARMisura ON ARARMisura.Cd_AR = AR.CD_AR
                LEFT JOIN LSArticolo ON LSArticolo.Cd_AR = AR.Cd_AR
                LEFT JOIN LSRevisione ON LSRevisione.Id_LSRevisione = LSArticolo.Id_LSRevisione and LSRevisione.Cd_LS = \'LSF\'
                LEFT JOIN DORig ON DOrig.Cd_CF LIKE \''.$cd_cf.'\' and DORig.Cd_AR = AR.Cd_AR
                where AR.CD_AR LIKE \''.$barcode.'\'
                order by DORig.DataDoc DESC');

            if(sizeof($articoli) > 0){
                $articolo = $articoli[0];
                echo '<h3>Barcode : Non inserito <br>
                          Codice: '.$articolo->Cd_AR.'<br>
                          Pezzi x Collo: '.intval($articolo->UMFatt).'<br><br>
                          Descrizione:<br>'.$articolo->Descrizione.'</h3>';
                ?>
                <script type="text/javascript">

                    $('#modal_Cd_AR').val('<?php echo $articolo->Cd_AR ?>');
                    <?php if($articolo->PrezzoUnitarioV){ ?>
                    $('#modal_prezzo').val('<?php echo number_format($articolo->PrezzoUnitarioV,2,'.','') ?>');
                    $('#modal_quantita').val(<?php echo intval($articolo->UMFatt) ?>);
                    <?php } else { ?>
                    $('#modal_prezzo').val('<?php echo number_format($articolo->Prezzo,2,'.','') ?>');
                    $('#modal_quantita').val(<?php echo intval($articolo->UMFatt) ?>);
                    <?php } ?>
                </script>
                <?php
            }
        }
    }

    public function cerca_articolo_codice($cd_cf,$codice,$Cd_ARLotto,$qta){

        $articoli = DB::select('SELECT AR.Id_AR,AR.Cd_AR,AR.Descrizione,ARAlias.Alias as barcode,ARARMisura.UMFatt,DORig.PrezzoUnitarioV,LSArticolo.Prezzo from AR
            LEFT JOIN ARAlias ON AR.Cd_AR = ARAlias.Cd_AR
            LEFT JOIN ARARMisura ON ARARMisura.Cd_AR = AR.CD_AR
            LEFT JOIN LSArticolo ON LSArticolo.Cd_AR = AR.Cd_AR
            LEFT JOIN DORig ON DOrig.Cd_CF LIKE \''.$cd_cf.'\' and DORig.Cd_AR = AR.Cd_AR
            where AR.CD_AR LIKE \''.$codice.'\'
            order by DORig.DataDoc DESC');

        $magazzino_selected = DB::select('SELECT MgMov.Cd_MG, Mg.Descrizione from MGMov LEFT JOIN MG ON MG.Cd_MG = MgMov.Cd_MG WHERE MgMov.Cd_ARLotto = \''.$Cd_ARLotto.'\'  and MgMov.Cd_AR = \''.$codice.'\' and MgMov.Cd_MGEsercizio = \'2021\' ');

        if($magazzino_selected != null) {
            $magazzino_selected = $magazzino_selected[0];
            $magazzino_selezionato = $magazzino_selected->Cd_MG;
        }
        else
            $magazzino_selezionato = '0';

        $magazzini = DB::select('SELECT * from MG WHERE Cd_MG !=\''.$magazzino_selezionato.'\' ');

        $date = date('d-m-Y',strtotime('today')) ;

        IF($Cd_ARLotto!='0')
            $lotto = DB::select('SELECT * FROM ARLotto WHERE Cd_AR = \'' . $codice . '\' and Cd_ARLotto !=\''.$Cd_ARLotto.'\' and Cd_ARLotto in (select Cd_ARLotto from MGMov group by Cd_ARLotto having SUM(QuantitaSign) >= 0) AND DataScadenza > \''.$date.'\' ORDER BY TimeIns DESC  ');
        else
            $lotto = DB::select('SELECT * FROM ARLotto WHERE Cd_AR = \'' . $codice . '\' and Cd_AR in (select Cd_AR from MGMov group by Cd_AR having SUM(QuantitaSign) >= 0) AND DataScadenza > \''.$date.'\' ORDER BY TimeIns DESC ');

        if(sizeof($articoli) > 0){
            $articolo = $articoli[0];
            echo '<h3>    Barcode: '.$articolo->barcode.'<br>
                          Codice: '.$articolo->Cd_AR.'<br>
                          Descrizione:<br>'.$articolo->Descrizione.'</h3>';
            ?>
            <script type="text/javascript">

                $('#modal_Cd_AR').val('<?php echo $articolo->Cd_AR ?>');
                <?php if($articolo->PrezzoUnitarioV){ ?>
                $('#modal_prezzo').val('<?php echo number_format($articolo->PrezzoUnitarioV,2,'.','') ?>');
                $('#modal_quantita').val(<?php echo intval($articolo->UMFatt) ?>);
                <?php } else { ?>
                $('#modal_prezzo').val('<?php echo number_format($articolo->Prezzo,2,'.','') ?>');
                $('#modal_quantita').val(<?php echo intval($articolo->UMFatt) ?>);
                <?php } ?>

                $('#modal_lotto').html
                <?php if($Cd_ARLotto!='0'){ ?>
                ('<option><?php echo $Cd_ARLotto ?></option>')
                <?php } ?>
                $('#modal_lotto').append( '<option>Nessun Lotto</option>')
                <?php foreach($lotto as $l){?>
                $('#modal_lotto').append('<option><?php echo $l->Cd_ARLotto ?></option>')
                <?php } ?>
                $('#modal_magazzino_P').html
                <?php  if($magazzino_selezionato !='0'){ ?>
                ('<option><?php echo $magazzino_selected->Cd_MG.' - '.$magazzino_selected->Descrizione?></option>')
                <?php } ?>
                <?php foreach($magazzini as $m){?>
                $('#modal_magazzino_P').append('<option><?php echo $m->Cd_MG.' - '.$m->Descrizione ?></option>')
                <?php } ?>
                $('#modal_quantita').val(<?php echo $qta ?>);

                cambioMagazzino();
            </script>
            <?php
        }

        if(sizeof($articoli)<1){
            $articoli = DB::select('
                SELECT AR.Id_AR,AR.Cd_AR,AR.Descrizione,ARARMisura.UMFatt,DORig.PrezzoUnitarioV,LSArticolo.Prezzo from AR
                LEFT JOIN ARARMisura ON ARARMisura.Cd_AR = AR.CD_AR
                LEFT JOIN LSArticolo ON LSArticolo.Cd_AR = AR.Cd_AR
                LEFT JOIN LSRevisione ON LSRevisione.Id_LSRevisione = LSArticolo.Id_LSRevisione and LSRevisione.Cd_LS = \'LSF\'
                LEFT JOIN DORig ON DOrig.Cd_CF LIKE \''.$cd_cf.'\' and DORig.Cd_AR = AR.Cd_AR
                where AR.CD_AR LIKE \''.$codice.'\'
                order by DORig.DataDoc DESC');
            IF($Cd_ARLotto!='')
                $lotto = DB::select('SELECT * FROM ARLotto WHERE Cd_AR = \'' . $codice . '\' and Cd_ARLotto !=\''.$Cd_ARLotto.'\' and  Cd_ARLotto in (select Cd_ARLotto from MGMov group by Cd_ARLotto having SUM(QuantitaSign) > 0)  ');
            else
                $lotto = DB::select('SELECT * FROM ARLotto WHERE Cd_AR = \'' . $codice . '\' and Cd_AR in (select Cd_AR from MGMov group by Cd_AR having SUM(QuantitaSign) > 0) ');
            if(sizeof($articoli) > 0){
                $articolo = $articoli[0];
                echo '<h3>Barcode : Non inserito <br>
                          Codice: '.$articolo->Cd_AR.'<br>
                          Pezzi x Collo: '.intval($articolo->UMFatt).'<br><br>
                          Descrizione:<br>'.$articolo->Descrizione.'</h3>';
                ?>
                <script type="text/javascript">

                    $('#modal_Cd_AR').val('<?php echo $articolo->Cd_AR ?>');
                    <?php if($articolo->PrezzoUnitarioV){ ?>
                    $('#modal_prezzo').val('<?php echo number_format($articolo->PrezzoUnitarioV,2,'.','') ?>');
                    $('#modal_quantita').val(<?php echo intval($articolo->UMFatt) ?>);
                    <?php } else { ?>
                    $('#modal_prezzo').val('<?php echo number_format($articolo->Prezzo,2,'.','') ?>');
                    $('#modal_quantita').val(<?php echo intval($articolo->UMFatt) ?>);
                    <?php }?>
                    $('#modal_lotto').html
                    <?php if($Cd_ARLotto!='0'){ ?>
                    ('<option><?php echo $Cd_ARLotto ?></option>');
                    <?php } ?>
                    $('#modal_lotto').append( '<option>Nessun Lotto</option>');
                    <?php foreach($lotto as $l){?>
                    $('#modal_lotto').append('<option><?php echo $l->Cd_ARLotto ?></option>')
                    <?php } ?>


                </script>
                <?php
            }
        }
    }

    public function evadi_documento1($Id_DoTes,$Cd_DO){
        $righe = DB::SELECT('SELECT * FROM DoRig WHERE Id_DoTes = \''.$Id_DoTes.'\' and QtaEvadibile > \'0\' ');
        foreach ($righe as $riga){?>
            <li class="list-group-item">
                <a href="#"  class="media">
                    <div class="media-body">
                        <h5><?php echo $riga->Cd_AR;if($riga->Cd_ARLotto != '')echo '  Lotto: '.$riga->Cd_ARLotto;  ?></h5>
                        <p>Quantita': <?php echo $riga->Qta ?></p>
                    </div>
                </a>
            </li>
        <?php }
    }
    public function salva_documento1($Id_DoTes,$Cd_DO){
        $righe = DB::SELECT('SELECT * FROM DoRig WHERE Id_DoTes = \''.$Id_DoTes.'\' and QtaEvadibile > \'0\' ');
        foreach ($righe as $riga){?>
            <li class="list-group-item">
                <a href="#"  class="media">
                    <div class="media-body">
                        <h5><?php echo $riga->Cd_AR;if($riga->Cd_ARLotto != '')echo '  Lotto: '.$riga->Cd_ARLotto;  ?></h5>
                        <p>Quantita': <?php echo $riga->Qta ?></p>
                    </div>
                </a>
            </li>
            <script type="text/javascript">
                $('#modal_Cd_AR_c_<?php echo $riga->Id_DORig ?>').val('<?php echo $riga->Cd_AR ?>');
                $('#modal_Cd_ARLotto_c_<?php echo $riga->Id_DORig ?>').val('<?php echo $riga->Cd_ARLotto ?>');
                $('#modal_Qta_c_<?php echo $riga->Id_DORig ?>').val('<?php echo $riga->Qta ?>');
            </script>
        <?php }
    }

    public function evadi_documento($Id_DoTes,$Cd_DO,$magazzino_A){

        $righe  = DB::SELECT('SELECT * FROM DoRig where Id_DoTes = \''.$Id_DoTes.'\'');
        $cf     = 'F000274';

        $Id_DoTes1 = DB::table('DOTes')->insertGetId(['Cd_CF' => $cf, 'Cd_Do' => $Cd_DO]);

        foreach($righe as $r) {

            if ($r->QtaEvadibile > 0) {


                $insert_evasione['Cd_MG_P'] = '00001';

                if ($r->Cd_MGUbicazione_P != NULL )
                    $insert_evasione['Cd_MGUbicazione_A'] = $r->Cd_MGUbicazione_A;
                if ($r->Cd_ARLotto != NULL )
                    $insert_evasione['Cd_ARLotto'] = $r->Cd_ARLotto;


                $insert_evasione['Cd_MG_A'] = str_replace('K','0',$Cd_DO);
                $insert_evasione['Qta'] = $r->QtaEvadibile;
                $insert_evasione['QtaEvadibile'] = $r->QtaEvadibile;
                $insert_evasione['Id_DoRig_Evade'] = $r->Id_DORig;
                $insert_evasione['Cd_AR'] = $r->Cd_AR;
                $insert_evasione['PrezzoUnitarioV'] = $r->PrezzoUnitarioV;
                $insert_evasione['Cd_Aliquota'] = $r->Cd_Aliquota;
                $insert_evasione['Cd_CGConto'] = $r->Cd_CGConto;

                $insert_evasione['Id_Dotes'] = $Id_DoTes1;
                DB::table('DoRig')->insertGetId($insert_evasione);


                DB::update('Update dorig set QtaEvadibile = \'0\'   where Id_DoRig = \'' . $r->Id_DORig . '\' ');
                DB::update('Update dorig set Evasa = \'1\'   where Id_DoRig = \'' . $r->Id_DORig . '\' ');

                DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = $Id_DoTes1");
                DB::statement("exec asp_DO_End $Id_DoTes1");

            }


        }
        DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = '$Id_DoTes'");
        DB::statement("exec asp_DO_End '$Id_DoTes'");
        echo 'Le riga sono state completamente evase';
    }


    public function evadi_articolo($Id_DoRig,$qtadaEvadere,$magazzino,$ubicazione,$lotto,$cd_cf,$documento,$cd_ar,$magazzino_A,$collo){

        $Id_DoTes = '';
        if(str_replace(' ','',$documento)=='CPI' ||str_replace(' ','',$documento)=='PRV'||str_replace(' ','',$documento)=='OC'||str_replace(' ','',$documento)=='B2'||str_replace(' ','',$documento)=='FA') {
            $controllo = DB::SELECT('SELECT * FROM ARLotto WHERE Cd_ARLotto = \'' . $lotto . '\' and Cd_AR = \'' . $cd_ar . '\' ');
            if (sizeof($controllo) == '0') {
                $dayS = date('d-m-Y', strtotime("2022-01-00 +" . substr($lotto, '0', '3') . "day"));
                $scadenza = date('d-m-Y', strtotime("+28 day" . $dayS));
                DB::table('ARLotto')->insertGetId(['Cd_AR' => $cd_ar, 'Cd_ARLotto' => $lotto, 'Descrizione' => 'Lotto ' . $lotto . '', 'DataScadenza' => $scadenza, 'Cd_CF' => 'F000123']);
            }
        }
        if ($collo == '0') {
            echo 'Impossibile evadere 0 colli';
            exit();
        }
        if ($qtadaEvadere == '0') {
            echo 'Impossibile evadere la Quantita a 0';
            exit();
        }

        else {
            $controllo = DB::SELECT('SELECT * FROM DORIG WHERE Id_DORig = \''.$Id_DoRig.'\'')[0]->Id_DOTes;
            $controlli = DB::SELECT('SELECT * FROM DORIG WHERE Id_DOTes = \''.$controllo.'\'');
            foreach($controlli as $c){
                $testata = DB::SELECT('SELECT * FROM DORIG WHERE Id_DORig_Evade = \''.$c->Id_DORig.'\' and Cd_Do = \''.$documento.'\'');
                if($testata!=null)
                    $Id_DoTes = $testata[0]->Id_DOTes;
            }

        }
        if($magazzino_A !='00001' && $magazzino_A != 'MAN -')
            $cd_cf ='F000274';
        $xqtaconf = DB::SELECT('SELECT * FROM AR WHERE CD_AR = \''.$cd_ar.'\'')[0]->xqtaconf;
        if($Id_DoTes == '') {
            $date = date('d-m-Y H:i:s',strtotime('now')) ;
            $Id_DoTes = DB::table('DOTes')->insertGetId(['Cd_CF' => $cd_cf, 'Cd_Do' => $documento, 'TrasportoDataOra'=> $date ,'Cd_DoAspBene' =>'CA','Cd_DoPorto' =>'01', 'Cd_DoSped'=>'02', 'Cd_DoTrasporto'=>'01']);
            if (str_replace(' ', '', $documento) == 'FA')
                $Id_DoTes = DB::SELECT('SELECT * FROM DOTES WHERE Cd_Do = \'FA\' ORDER BY Id_DoTes DESC')[0]->Id_DoTes;
        }
        if($magazzino_A !='00001' && $magazzino_A != 'MAN -')
            $magazzino_A = str_replace('K','0',$documento);

        if ($magazzino != '0')
            $insert_evasione['Cd_MG_P'] = $magazzino;
        if ($magazzino != '0')
            $insert_evasione['Cd_MG_A'] = $magazzino_A;
        if ($lotto != '0')
            $insert_evasione['Cd_ARLotto'] = $lotto;


        DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = '$Id_DoTes'");
        DB::statement("exec asp_DO_End '$Id_DoTes'");


        $Id_DoTes1 = $Id_DoTes;
        $riga = DB::SELECT('SELECT * FROM DORig WHERE Id_DOTes = \''.$Id_DoTes1.'\' ORDER BY Riga DESC');
        if($riga == null)
            $riga='0';
        else {
            $riga = $riga[0]->Riga;
            $riga++;
        }
        $qtadaEvadere = intval($collo)*intval($xqtaconf);
        if(str_replace(' ','',$documento)=='OC'|| str_replace(' ','',$documento)=='PRV'||str_replace(' ','',$documento)=='FA'||str_replace(' ','',$documento)=='B2')
            $qtadaEvadere = intval($collo);
        $insert_evasione['Cd_AR'] = $cd_ar;
        $insert_evasione['Id_DORig_Evade'] = $Id_DoRig;
        $insert_evasione['Qta'] = intval($collo)*intval($xqtaconf);
        if(str_replace(' ','',$documento)=='OC'|| str_replace(' ','',$documento)=='PRV' ||str_replace(' ','',$documento)=='FA'||str_replace(' ','',$documento)=='B2')
            $insert_evasione['Qta'] = intval($collo);
        $insert_evasione['xcolli'] = $collo;
        if(str_replace(' ','',$documento)=='OC'|| str_replace(' ','',$documento)=='PRV'|| str_replace(' ','',$documento)=='FA'||str_replace(' ','',$documento)=='B2')
            $insert_evasione['xcolli'] = intval($collo)/intval($xqtaconf);
        $insert_evasione['xqtaconf'] = $xqtaconf;
        $insert_evasione['Riga'] = $riga;


        $Riga = DB::SELECT('SELECT * FROM DoRig where Id_DoRig=\'' . $Id_DoRig . '\'');
        $insert_evasione['PrezzoUnitarioV'] = $Riga[0]->PrezzoUnitarioV;
        $insert_evasione['Cd_Aliquota'] = $Riga[0]->Cd_Aliquota;
        $insert_evasione['Cd_CGConto'] = $Riga[0]->Cd_CGConto;
        $insert_evasione['Id_DoTes'] = $Id_DoTes1;


        $qta_evasa      = DB::SELECT('SELECT * FROM DORig WHERE Id_DoRig= \''.$Id_DoRig.'\' ')[0]->QtaEvasa;
        $qta_evasa      = intval($qta_evasa)+intval($qtadaEvadere);
        $insert_evasione['QtaEvasa'] = $qta_evasa;
        $qta_evadibile  = DB::SELECT('SELECT * FROM DORig WHERE Id_DoRig= \''.$Id_DoRig.'\' ')[0]->QtaEvadibile;
        $qta_evadibile  = intval($qta_evadibile)-intval($qtadaEvadere);
        DB::table('DoRig')->insertGetId($insert_evasione);
        if ($qtadaEvadere < $Riga[0]->QtaEvadibile) {
            DB::UPDATE('Update DoRig set QtaEvadibile= \''.$qta_evadibile.'\'WHERE Id_DoRig = \''.$Id_DoRig.'\'');
            DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = '$Id_DoTes1'");
            DB::statement("exec asp_DO_End '$Id_DoTes1'");
        } else {
            DB::UPDATE('Update DoRig set QtaEvadibile= \'0\'WHERE Id_DoRig = \''.$Id_DoRig.'\'');
            DB::update('Update dorig set Evasa = \'1\'   where Id_DoRig = \'' . $Id_DoRig . '\' ');
            $Id_DoTes_old = DB::SELECT('select * from DoRig where id_dorig = \'' . $Id_DoRig . '\' ')[0]->Id_DOTes;
            DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = '$Id_DoTes_old'");
            DB::statement("exec asp_DO_End '$Id_DoTes_old'");
            DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = '$Id_DoTes1'");
            DB::statement("exec asp_DO_End '$Id_DoTes1'");
        }
    }


    public function crea_documento($cd_cf,$cd_do,$numero,$data,$listino){

        $insert_testata_ordine['Cd_CF'] = $cd_cf;
        $insert_testata_ordine['Cd_Do'] = $cd_do;/*
        if(str_replace(' ','',$cd_do) != 'CPI' && str_replace(' ','',$cd_do) != 'PRV' && str_replace(' ','',$cd_do) != 'OC' && str_replace(' ','',$cd_do) != 'FA'&& str_replace(' ','',$cd_do) != 'B2')
            $insert_testata_ordine['Cd_Agente_1'] = '0'.substr($cd_do, 1);
        if(substr($cd_do, 0,1) == 'O')
            $insert_testata_ordine['Cd_LS_1'] = '0000003';*/
        $insert_testata_ordine['NumeroDoc'] = $numero;
        $data = str_replace('-','',$data);
        $insert_testata_ordine['DataDoc'] = $data;
        $Id_DOTes = DB::table('DOTes')->insertGetId($insert_testata_ordine);
        echo $Id_DOTes;
    }


    public function crea_documento_rif($cd_cf,$cd_do,$numero,$data,$numero_rif,$data_rif){

        $insert_testata_ordine['Cd_CF'] = $cd_cf;
        $insert_testata_ordine['Cd_Do'] = $cd_do;/*
        if(str_replace(' ','',$cd_do)!= 'CPI' && str_replace(' ','',$cd_do) != 'PRV' && str_replace(' ','',$cd_do) != 'OC'&& str_replace(' ','',$cd_do) != 'FA'&& str_replace(' ','',$cd_do) != 'B2')
            $insert_testata_ordine['Cd_Agente_1'] = '0'.substr($cd_do, 1);
        if(substr($cd_do, 0,1) == 'O')
            $insert_testata_ordine['Cd_LS_1'] = '0000003';*/
        $insert_testata_ordine['NumeroDoc'] = $numero;
        $data = str_replace('-','',$data);
        $insert_testata_ordine['DataDoc'] = $data;
        if($numero_rif != '0') {
            $insert_testata_ordine['NumeroDocRif'] = $numero_rif;
            $data_rif = str_replace('-', '', $data_rif);
        }
        if($data_rif != '0')
            $insert_testata_ordine['DataDocRif'] = $data_rif;
        $Id_DoTes = DB::table('DOTes')->insertGetId($insert_testata_ordine);
        echo $Id_DoTes;
    }

    public function aggiungi_articolo_ordine($id_ordine,$codice,$quantita,$magazzino_A,$ubicazione_A,$lotto,$magazzino_P,$ubicazione_P){
        $i = 0;
        $magazzini = DB::SELECT('SELECT * FROM MGUbicazione WHERE Cd_MG=\''.$magazzino_A.'\'');
        foreach($magazzini as $m){
            if($m->Cd_MGUbicazione == $ubicazione_A)
                $i++;
        }
        if($ubicazione_A =='ND')
            $i++;
        if($i>0) {
            ArcaUtilsController::aggiungi_articolo($id_ordine, $codice, $quantita, $magazzino_A, 1, $ubicazione_A, $lotto, $magazzino_P, $ubicazione_P);

            $ordine = DB::select('SELECT * from DOTes where Id_DOtes = ' . $id_ordine)[0]->Id_DoTes;

            echo 'Articolo Caricato Correttamente ';

        }else {
            echo 'Ubicazione inserita inesistente in quel magazzino';
            exit();
        }
    }
    /* public function trasporto_articolo($documento,$codice,$quantita,$magazzino,$ubicazione_P,$magazzino_A,$ubicazione_A,$fornitore,$lotto){

         ArcaUtilsController::trasporto_articolo($codice,$documento,$quantita,$magazzino,$ubicazione_P,$magazzino_A,$ubicazione_A,$fornitore,$lotto);


         echo ArcaUtilsController::trasporto_articolo($codice,$documento,$quantita,$magazzino,$ubicazione_P,$magazzino_A,$ubicazione_A,$fornitore,$lotto);


     }*/
    public function trasporto_articolo($documento,$codice,$quantita,$magazzino,$ubicazione_P,$magazzino_A,$ubicazione_A,$fornitore,$lotto,$Id_DoTes){

        ArcaUtilsController::trasporto_articolo($codice,$documento,$quantita,$magazzino,$ubicazione_P,$magazzino_A,$ubicazione_A,$fornitore,$lotto,$Id_DoTes);

    }
    public function modifica_articolo_ordine($id_ordine,$codice,$quantita,$magazzino_A,$ubicazione_A,$lotto,$magazzino_P,$ubicazione_P){

        ArcaUtilsController::modifica_articolo($id_ordine,$codice,$quantita,$magazzino_A,1,$ubicazione_A,$lotto,$magazzino_P,$ubicazione_P);

        $ordine = DB::select('SELECT * from DOTes where Id_DOtes = '.$id_ordine)[0];

        echo 'Articolo Modificato Correttamente Ordine OAF: '.$ordine->NumeroDoc;

    }
    public function scarica_articolo_ordine($id_ordine,$codice,$quantita,$magazzino,$ubicazione,$lotto){

        ArcaUtilsController::scarica_articolo($id_ordine,$codice,$quantita,$magazzino,1,$ubicazione,$lotto);

        $ordine = DB::select('SELECT * from DOTes where Id_DOtes = '.$id_ordine)[0];

        echo 'Articolo Scaricato Correttamente : '.$ordine->NumeroDoc;

    }

    public function cerca_articolo_smart($q,$cd_cf)
    {
        $testo = substr($q,'0', '5');
        $pos = strpos($testo,"0");
        while($pos == '0'){
            $pos++;
            $testo = substr($testo,$pos);
            $pos = strpos($testo,"0");
            if($pos > 0 || !is_numeric($pos) ) {
                $pos = '1';
            }
        }
        $where = ' where 1=1 ';
        $where .= ' and AR.Cd_AR = \'' . $testo . '\'';
        $lotto = substr($q, '8', '6');
        if ($cd_cf[0] == 'C'){
            $articoli = DB::select('SELECT TOP 1 AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto on AR.Cd_AR = ARLotto.Cd_AR ' . $where . '  Order By Id_AR DESC');
            foreach ($articoli as $a) {
                $a->Cd_ARLotto = '0';
            }
        }
        else {
            $where .= ' and ARLotto.Cd_ARLotto like \'%' . $lotto . '%\'';
            if ($testo != '')
                $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto on AR.Cd_AR = ARLotto.Cd_AR ' . $where . '  Order By Id_AR DESC');
            else
                $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto on AR.Cd_AR = ARLotto.Cd_AR WHERE 1 = 0 Order By Id_AR DESC');
        }
        $qta = 'ND';
        /*
                if(sizeof($articoli) == '0') {

                    $decoder = new Decoder($delimiter = '');
                    $barcode = $decoder->decode($q);
                    $where = ' where 1=1 ';
                    foreach ($barcode->toArray()['identifiers'] as $field) {

                        if ($field['code'] == '01') {
                            $testo = trim($field['content'], '*,');
                            $where .= ' and AR.Cd_AR Like \'%' . $testo . '%\'';
                        }
                        if ($field['code'] == '310') {
                            $decimali = floatval(substr($field['raw_content'],-2));
                            $qta = floatval(substr($field['raw_content'],0,4))+$decimali/100;
                        }
                        if ($field['code'] == '10') {
                            $where .= ' and ARLotto.Cd_ARLotto Like \'%' . $field['content'] . '%\'';
                        }

                    }
                    $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto on AR.Cd_AR = ARLotto.Cd_AR ' . $where . '  Order By Id_AR DESC');
                }
        */
        if(sizeof($articoli) == '0') {
            $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto ON AR.Cd_AR = ARLotto.Cd_ARLotto LEFT JOIN ARAlias ON ARAlias.Cd_AR = AR.Cd_AR where AR.Cd_AR = \'' . $q . '\' or  AR.Descrizione Like \'%' . $q . '%\' or AR.CD_AR IN (SELECT CD_AR from ARAlias where Alias LIKE \'%' . $q . '%\') Order By AR.Id_AR ASC');
        }
        foreach($articoli as $articolo){ ?>

            <li class="list-group-item">
                <a href="#" onclick="" class="media">
                    <div class="media-body" onclick="cerca_articolo_codice('<?php echo $cd_cf ?>','<?php echo $articolo->Cd_AR ?>','<?php if($articolo->Cd_ARLotto != '')echo $articolo->Cd_ARLotto;else echo '0'; ?>','<?php if($qta != '')echo $qta;else echo '0'; ?>')">
                        <h5><?php echo $articolo->Descrizione;if($articolo->Cd_ARLotto != '0')echo '  Lotto: '.$articolo->Cd_ARLotto;  ?></h5>
                        <p>Codice: <?php echo $articolo->Cd_AR ?></p>
                    </div>
                </a>
            </li>

        <?php }

    }

    public function controllo_articolo_smart($q,$id_dotes){
        $testo = substr($q,'0', '5');
        $pos = strpos($testo,"0");
        while($pos == '0'){
            $pos++;
            $testo = substr($testo,$pos);
            $pos = strpos($testo,"0");
            if($pos > 0 || !is_numeric($pos) ) {
                $pos = '1';
            }
        }
        $where = ' where 1=1 ';
        $where.= ' and Cd_AR like \'%'.$testo.'%\'';
        $lotto = substr($q,'8', '6');
        $confezione = substr($q,'5', '3');
        $data = substr($q,'14', '6');
        $data = strtotime($data);
        $data = date('d-m-Y',$data);

        $articoli = DB::select('SELECT * FROM DoRig ' . $where . ' and Id_DoTes in (\''.$id_dotes.'\') Order By Cd_AR DESC');
        if(sizeof($articoli) > 0){
            foreach($articoli as $articolo){ ?>

                <script type="text/javascript">

                    $('#modal_controllo_articolo').val('<?php echo $articolo->Cd_AR ?>');
                    $('#modal_controllo_quantita').val(<?php echo floatval($articolo->QtaEvadibile) ?>);
                    $('#modal_controllo_lotto').val('<?php echo $lotto ?>');
                    $('#modal_controllo_confezione').val('<?php echo $confezione ?>');
                    $('#modal_controllo_dorig').val('<?php echo $articolo->Id_DORig ?>');
                    $('#modal_controllo_data').val('<?php echo $data ?>');
                    cambiocollo();


                </script>

            <?php } }

    }



    /**
     * Sezione Inventario di Magazzino
     * @return mixed
     */
    public function cerca_articolo_inventario($barcode){

        $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto ON AR.Cd_AR = ARLotto.Cd_AR where AR.Cd_AR = \''.$barcode.'\' or  AR.Descrizione = \''.$barcode.'\' or AR.CD_AR IN (SELECT CD_AR from ARAlias where Alias = \''.$barcode.'\')  Order By AR.Id_AR DESC');


        if(sizeof($articoli)=='0') {
            $decoder = new Decoder($delimiter = '');
            $barcode = $decoder->decode($barcode);
            $where = ' where 1=1  ';

            foreach ($barcode->toArray()['identifiers'] as $field) {

                if ($field['code'] == '01') {
                    $testo = trim($field['content'],'*,');
                    $where .= ' and AR.Cd_AR Like \'' . $testo . '\'';

                }
                if ($field['code'] == '10') {
                    $where .= ' and ARLotto.Cd_ARLotto Like \'%' . $field['content'] . '%\'';
                    $Cd_ARLotto = $field['content'];
                }

            }
            $articoli = DB::select('SELECT AR.[Id_AR],AR.[Cd_AR],AR.[Descrizione],ARLotto.[Cd_ARLotto] FROM AR LEFT JOIN ARLotto on AR.Cd_AR = ARLotto.Cd_AR ' . $where . '  Order By Id_AR DESC');

        }
        if(sizeof($articoli) > 0) {
            $articolo = $articoli[0];
            $quantita = 0;
            $disponibilita = DB::select('SELECT ISNULL(sum(QuantitaSign),0) as disponibilita from MGMOV where Cd_MGEsercizio = '.date('Y').' and Cd_AR = \'' . $articolo->Cd_AR . '\'');
            if (sizeof($disponibilita) > 0) {
                $quantita = floatval($disponibilita[0]->disponibilita);
                $prova = DB::SELECT('SELECT ISNULL(sum(QuantitaSign),0) as disponibilita,Cd_ARLotto,Cd_MG from MGMOV where Cd_MGEsercizio = '.date('Y').' and Cd_AR = \'' . $articolo->Cd_AR . '\' and Cd_ARLotto IS NOT NULL group by Cd_ARLotto, Cd_MG HAVING SUM(QuantitaSign)!= 0  ');
            }

            ?>
            <script type="text/javascript">
                $('#modal_Cd_AR').val('<?php echo $articolo->Cd_AR ?>');
                $('#modal_Cd_ARLotto').html('<option value="">Nessun Lotto</option>');
                <?php foreach($prova as $l){?>
                $('#modal_Cd_ARLotto').append('<option quantita="<?php echo floatval($l->disponibilita) ?>" magazzino="<?php echo $l->Cd_MG ?>" <?php echo ($Cd_ARLotto == $l->Cd_ARLotto)?'selected':'' ?>><?php echo $l->Cd_ARLotto.' - '.$l->Cd_MG ?></option>')
                <?php } ?>

                cambioLotto();

            </script>
        <?php }
    }



    public function rettifica_articolo($codice,$quantita,$lotto,$magazzino){

        try {
            DB::beginTransaction();

            $id_MGMovInt =  DB::table('MGMovInt')->insertGetId(array('Tipo' => 0,'DataMov' =>date('Ymd'),'Descrizione' => 'Movimenti Rettifica'));
            DB::insert('INSERT INTO MGMoV(DataMov,PartenzaArrivo,PadreComponente,Cd_MGEsercizio,Cd_AR,Cd_MG,Quantita,Ret,Id_MgMovInt,Cd_ARLotto) VALUES (\''.date('Ymd').'\',\'A\',\'P\','.date('Y').',\''.$codice.'\',\''.$magazzino.'\','.$quantita.',1,'.$id_MGMovInt.',\''.$lotto .'\' )');
            echo 'Quantità Rettificata con Successo';
            DB::commit();
        } catch (\PDOException $e) {
            // Woopsy
            print_r($e);
            DB::rollBack();
        }


    }

    public function cerca_articolo_smart_inventario($q,$tipo){
        if($tipo == 'GS1') {/*
            $testo = substr($q,'0', '5');
            $pos = strpos($testo,"0");
            $pos++;
            while($pos != null){
                $testo = substr($testo,$pos);
                $pos = strpos($testo,"0");
                if($pos >'0')
                    $pos=null;
                if($pos =='0')
                    $pos++;
*/
            $testo = substr($q,'0', '5');
            $pos = strpos($testo,"0");
            while($pos == '0'){
                $pos++;
                $testo = substr($testo,$pos);
                $pos = strpos($testo,"0");
                if($pos > 0 || !is_numeric($pos) ) {
                    $pos = '1';
                }

            }
            $where = ' where 1=1 ';
            $where.= ' and Cd_AR like \''.$testo.'\'';
            $Cd_ARLotto = substr($q,'8', '6');

            if($Cd_ARLotto == null)
                $Cd_ARLotto = 'NESSUN LOTTO';

            $articoli = DB::select('SELECT [Id_AR],[Cd_AR],[Descrizione] FROM AR '.$where.'  Order By Id_AR DESC');
            if(sizeof($articoli)>0){
                foreach($articoli as $articolo){ ?>

                    <li class="list-group-item">
                        <a href="#" onclick="" class="media">
                            <div class="media-body" onclick="cerca_articolo_inventario_codice('<?php echo $articolo->Cd_AR ?>','<?php echo $Cd_ARLotto;?>') ">
                                <h5><?php echo $articolo->Descrizione ?></h5>
                                <p>Codice: <?php echo $articolo->Cd_AR ?></p>
                            </div>
                        </a>
                    </li>

                <?php }  } else
                echo 'Nessun Articolo Trovato';
        }
        if($tipo == 'EAN'){
            $articoli = DB::select('SELECT [Id_AR],[Cd_AR],[Descrizione] FROM AR where (Cd_AR = \''.$q.'\' or  Descrizione = \''.$q.'\' or CD_AR IN (SELECT CD_AR from ARAlias where Alias = \''.$q.'\'))  Order By Id_AR DESC');
            if(sizeof($articoli)>0){
                foreach($articoli as $articolo){ ?>

                    <li class="list-group-item">
                        <a href="#" onclick="" class="media">
                            <div class="media-body" onclick="cerca_articolo_inventario_codice('<?php echo $articolo->Cd_AR ?>','NESSUNLOTTO')">
                                <h5><?php echo $articolo->Descrizione ?></h5>
                                <p>Codice: <?php echo $articolo->Cd_AR ?></p>
                            </div>
                        </a>
                    </li>

                <?php } } else
                echo 'Nessun Articolo Trovato';
        }
    }


    public function cerca_articolo_inventario_codice($codice,$Cd_ARLotto){

        $articoli = DB::select('SELECT AR.Cd_AR from AR where Cd_AR = \''.$codice.'\'');

        if(sizeof($articoli) > 0) {
            $articolo = $articoli[0];
            $quantita = 0;
            $disponibilita = DB::select('SELECT ISNULL(sum(QuantitaSign),0) as disponibilita from MGMOV where Cd_MGEsercizio = '.date('Y').' and Cd_AR = \'' . $articolo->Cd_AR . '\'');
            if (sizeof($disponibilita) > 0) {
                $data =  date('d-m-Y',strtotime('today')) ;
                $prova = DB::SELECT('SELECT ISNULL(sum(QuantitaSign),0) as disponibilita,Cd_ARLotto,Cd_MG from MGMOV where Cd_MGEsercizio = '.date('Y').' and Cd_AR = \'' . $articolo->Cd_AR . '\' and Cd_ARLotto IS NOT NULL group by Cd_ARLotto, Cd_MG HAVING SUM(QuantitaSign)!= 0  ');
            }

            ?>
            <script type="text/javascript">
                $('#modal_Cd_AR').val('<?php echo $articolo->Cd_AR ?>');
                $('#modal_Cd_ARLotto').html('<option value="">Nessun Lotto</option>');
                <?php foreach($prova as $l){?>
                $('#modal_Cd_ARLotto').append('<option quantita="<?php echo floatval($l->disponibilita) ?>" magazzino="<?php echo $l->Cd_MG ?>" <?php echo ($Cd_ARLotto == str_replace(' ', '', $l->Cd_ARLotto))?'selected':'' ?>><?php echo $l->Cd_ARLotto.' - '.$l->Cd_MG ?></option>')
                <?php } ?>
                cambioLotto();

            </script>
            <?php
        }

    }




}
