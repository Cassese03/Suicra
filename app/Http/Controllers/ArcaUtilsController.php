<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use function PHPUnit\Framework\lessThanOrEqual;


/**
 * Controller utilizzate per effettuare le chiamate Ajax
 * Class AjaxController
 * @package App\Http\Controllers
 */

class ArcaUtilsController extends Controller{


    /**
     * Aggiunge un prodotto con quantita 1 se è già presente aumenta la quantità di 1
     * @param $id_ordine
     * @return \Illuminate\Contracts\View\View
     */

    public static function calcola_totale_ordine($id_dotes){

        DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = $id_dotes exec asp_DO_End $id_dotes");

    }
    public static function aggiungi_articolo($id_ordine,$codice_articolo,$quantita,$magazzino_A,$fornitore = 0,$ubicazione_A,$lotto,$magazzino_P,$ubicazione_P){


        $cd_do = DB::SELECT('SELECT * FROM DOTES WHERE Id_DOTes = \''.$id_ordine.'\'')[0]->Cd_Do;

        $magazzino_P = str_replace(' ','',$magazzino_P);
        $magazzino_P = str_replace('-','',$magazzino_P);
        $magazzino_A = str_replace(' ','',$magazzino_A);
        $magazzino_A = str_replace('-','',$magazzino_A);

        $quantita = intval($quantita);
        if ($lotto == 'Nessun Lotto')
        {
            $lotto='0';
        }
        if ($ubicazione_A == 'ND')
        {
            $ubicazione_A='0';
        }
        if ($ubicazione_P == 'ND')
        {
            $ubicazione_P='0';
        }



        $cf = DB::select('SELECT * from CF Where Cd_CF IN (SELECT Cd_CF from DOTes WHere Id_DoTes = '.$id_ordine.')');
        if(sizeof($cf) > 0)
        {
            $cf = $cf[0];
            $articoli = DB::select
            ('
                SELECT *
                from AR
                where Cd_AR = \'' . $codice_articolo . '\';
             ');
            $RIGA = DB::SELECT('SELECT * FROM DORig where Id_DoTes = \'' . $id_ordine . '\' ORDER BY RIGA DESC');
            if ($RIGA == null)
                $RIGA = '0';
            else
                $RIGA = $RIGA[0]->Riga;
            $RIGA++;
            if (sizeof($articoli) > 0) {
                $articolo = $articoli[0];
                $insert_righe_ordine['Id_DoTes'] = $id_ordine;
                $insert_righe_ordine['Cd_AR'] = $articolo->Cd_AR;
                $insert_righe_ordine['Riga'] = $RIGA;
                $insert_righe_ordine['Descrizione'] = $articolo->Descrizione;
                $insert_righe_ordine['Cd_MGEsercizio'] = date('Y');
                $insert_righe_ordine['Cd_ARMisura'] = $articolo->Cd_ARMisura;
                $insert_righe_ordine['Cd_VL'] = 'EUR';
                $insert_righe_ordine['Qta'] = $quantita;
                $insert_righe_ordine['QtaEvadibile'] = $quantita;
                $insert_righe_ordine['Cambio'] = 1;
                $insert_righe_ordine['Mipaaf'] = 0;

                if ($magazzino_A != '0')
                    $insert_righe_ordine['Cd_MG_A'] = $magazzino_A;
                if ($magazzino_P != '0')
                    $insert_righe_ordine['Cd_MG_P'] = $magazzino_P;

                $condizione='';
                $condizione  .='and Cd_ARLotto = \''.$lotto.'\'';
                if($ubicazione_A != '0')
                    $condizione .='and Cd_MGUbicazione_A =\''.$ubicazione_A.'\'';
                if($ubicazione_P != '0')
                    $condizione .='and Cd_MGUbicazione_P =\''.$ubicazione_P.'\'';

                $insert_righe_ordine['Id_DoTes'] = $id_ordine;
                $insert_righe_ordine['Qta'] = $quantita;
                $insert_righe_ordine['QtaEvadibile'] = $quantita;
                $insert_righe_ordine['QtaEvasa'] = $quantita;
                $documento = DB::SELECT('SELECT * FROM DOTes WHERE Id_DOTes = \''.$id_ordine.'\' ')[0]->Cd_Do;
                $insert_righe_ordine['Cd_Aliquota'] = $articolo->Cd_Aliquota_A;
                if($insert_righe_ordine['Cd_Aliquota'] == '')
                    $insert_righe_ordine['Cd_Aliquota'] = '22';
                $insert_righe_ordine['Cd_CGConto'] = DB::SELECT('SELECT * FROM IMPOSTAZIONE WHERE Id_Impostazione = \'7\'')[0]->Cd_CGConto_1;
                $documento1 = DB::SELECT('SELECT * FROM DO WHERE Cd_DO = \''.$documento.'\'');
                if($documento1[0]->CliFor =='C')
                    $insert_righe_ordine['Cd_CGConto'] = DB::SELECT('SELECT * FROM IMPOSTAZIONE WHERE Id_Impostazione = \'7\'')[0]->Cd_CGConto_2;
                if($insert_righe_ordine['Cd_CGConto'] == '')
                    $insert_righe_ordine['Cd_CGConto'] = $cf->Cd_CGConto_Mastro;
                if(str_replace(' ','',$documento)!='CPI'){
                    $insert_righe_ordine['PrezzoUnitarioV'] = '';
                    $listino = DB::SELECT('SELECT * FROM DoTes WHERE Id_DOTes = \'' . $id_ordine . '\'');
                    $prezzo = DB::SELECT('SELECT * FROM LSRevisione WHERE Cd_LS = \''.$listino[0]->Cd_LS_1.'\'');
                    if(sizeof($prezzo) != '0')
                        $prezzo = DB::SELECT('SELECT * FROM LSArticolo WHERE Id_LSRevisione =\''.$prezzo[0]->Id_LSRevisione.'\' and Cd_AR = \''.$codice_articolo.'\' ');
                    if(sizeof($prezzo) != '0')
                        $insert_righe_ordine['PrezzoUnitarioV'] = $prezzo[0]->Prezzo;
                    if($insert_righe_ordine['PrezzoUnitarioV'] == '') {
                        $prezzo = DB::SELECT('SELECT Prezzo from LSScARCFGruppo where Cd_AR = \'' . $codice_articolo . '\' and Cd_CF = \''.$fornitore.'\' and DaData <= GETDATE() and AData >= GETDATE()');
                        if(sizeof($prezzo) != 0)
                            $insert_righe_ordine['PrezzoUnitarioV'] = $prezzo[0]->Prezzo;
                    }
                    if($insert_righe_ordine['PrezzoUnitarioV'] == ''){
                        $prezzo = DB::SELECT('SELECT * FROM DORIG WHERE Cd_AR = \''.$codice_articolo.'\' and Cd_DO in(\'OC\')  Order By Id_DORig DESC ');
                        if(sizeof($prezzo) == 0)
                            $insert_righe_ordine['PrezzoUnitarioV'] = '0';
                        else
                            $insert_righe_ordine['PrezzoUnitarioV'] = $prezzo[0]->PrezzoUnitarioV;
                    }
                }
                /*
                                $esiste = DB::select('SELECT * from DORig where Id_DoTes = ' . $id_ordine . ' and Cd_AR =  \'' . $codice_articolo . '\'  and Cd_MG_P = \''.$magazzino_P.'\' ');
                                if (sizeof($esiste) == 0)
                                {*/
                DB::table('DORig')->insertGetId($insert_righe_ordine);
                $Id_DORig = DB::SELECT('SELECT top 1 * FROM DORig order by Id_DORig desc ')[0]->Id_DORig;
                if ($lotto != '0')
                {
                    $controllo_lotto = DB::SELECT('SELECT * FROM ARLotto where Cd_AR = \''.$articolo->Cd_AR.'\' and Cd_ARLotto = \''.$lotto.'\'');
                    if(sizeof($controllo_lotto) != '0')
                        DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = '$Id_DORig'");
                    else {
                        DB::table('ARLotto')->insertGetId(['Cd_AR' => $articolo->Cd_AR, 'Cd_ARLotto' => $lotto, 'Descrizione' => 'Lotto '.$lotto]);
                        DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = '$Id_DORig'");
                    }

                }
                if ($ubicazione_A != '0') {
                    DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dorig = '$Id_DORig' ");
                }
                if ($ubicazione_P != '0') {
                    DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dorig = '$Id_DORig' ");
                }

                if(str_replace(' ','',$documento) == 'CPI') {
                    $listino = DB::SELECT('SELECT * FROM DoTes WHERE Id_DOTes = \'' . $id_ordine . '\'');
                    $listino = $listino[0]->Cd_LS_1;
                    if (str_replace(' ', '', $listino) == 'UACQ') {
                        $conto = DB::select('SELECT * FROM AR WHERE Cd_AR = \'' . $codice_articolo . '\'');
                        if ($conto[0]->Cd_CGConto_AI != null)
                            $conto = $conto[0]->Cd_CGConto_AI;
                        else
                            $conto = '06010211003';
                        DB::update("Update DoRig set Cd_CGConto = '$conto' where id_dorig = '$Id_DORig'");
                        DB::update("Update DoRig set Cd_Aliquota = '10' where id_dorig = '$Id_DORig'");
                        $listino = DB::SELECT('SELECT TOP 2 * FROM DORig WHERE Cd_AR = \'' . $codice_articolo . '\' AND PrezzoUnitarioV IS NOT NULL AND Cd_DO = \'CPI\' ORDER BY Id_DORig Desc')[1]->PrezzoUnitarioV;
                        DB::update("Update DoRig set PrezzoUnitarioV = '$listino' where id_dorig = '$Id_DORig'");
                    } else {
                        $conto = DB::select('SELECT * FROM AR WHERE Cd_AR=\'' . $codice_articolo . '\'');
                        if ($conto[0]->Cd_CGConto_AI != null)
                            $conto = $conto[0]->Cd_CGConto_AI;
                        else
                            $conto = '06010211004';
                        DB::update("Update DoRig set Cd_CGConto = '$conto' where id_dorig = '$Id_DORig'");
                        $listino = DB::SELECT('SELECT * FROM LS WHERE Cd_LS = \'' . $listino . '\'')[0]->Cd_LS;
                        $listino = DB::SELECT('SELECT * FROM LSRevisione WHERE Cd_LS = \'' . $listino . '\'')[0]->Id_LSRevisione;
                        $listino = DB::SELECT('SELECT * FROM LSArticolo WHERE Cd_AR = \'' . $codice_articolo . '\' AND Id_LSRevisione = \'' . $listino . '\'');
                        if ($listino != null)
                            $listino = $listino[0]->Prezzo;
                        if ($listino != null) {
                            DB::update("Update DoRig set Cd_Aliquota = '10' where id_dorig = '$Id_DORig'");
                            DB::update("Update DoRig set PrezzoUnitarioV = '$listino' where id_dorig = '$Id_DORig'");
                        }
                    }
                }
                if(substr($documento,0,1) == 'O') {
                    DB::update("Update DoRig set Cd_CGConto = '07010101004' where id_dorig = '$Id_DORig'");
                    $listino = DB::SELECT('SELECT * FROM DoTes WHERE Id_DOTes = \'' . $id_ordine . '\'')[0]->Cd_LS_1;
                    $listino = DB::SELECT('SELECT * FROM LS WHERE Cd_LS = \'' . $listino . '\'')[0]->Cd_LS;
                    $listino = DB::SELECT('SELECT * FROM LSRevisione WHERE Cd_LS = \'' . $listino . '\'')[0]->Id_LSRevisione;
                    $listino = DB::SELECT('SELECT * FROM LSArticolo WHERE Cd_AR = \'' . $codice_articolo . '\' AND Id_LSRevisione = \'' . $listino . '\'');
                    if ($listino != null)
                        $listino = $listino[0]->Prezzo;
                    if ($listino != null) {
                        DB::update("Update DoRig set Cd_Aliquota = '10' where id_dorig = '$Id_DORig'");
                        DB::update("Update DoRig set PrezzoUnitarioV = '$listino' where id_dorig = '$Id_DORig'");
                    }
                }
                if(str_replace(' ', '', $documento) != 'CPI') {
                    DB::update("Update dotes set dotes.reserved_1= 'RRRRRRRRRR' where dotes.id_dotes = '$id_ordine'");
                    DB::statement("exec asp_DO_End '$id_ordine'");
                }

                /*}
                else
                {
                    $insert_righe_ordine['Qta'] = floatval($quantita) + floatval($esiste[0]->Qta);
                    $insert_righe_ordine['QtaEvadibile'] = floatval($quantita) + floatval($esiste[0]->QtaEvadibile);
                    if($magazzino_A!='0')
                        $insert_righe_ordine['Cd_MG_A'] = $magazzino_A;
                    $insert_righe_ordine['Cd_MG_P'] = $magazzino_P;

                    DB::table('DORig')->where('Id_DORig', $esiste[0]->Id_DORig)->update($insert_righe_ordine);
                    $Id_DORig=$esiste[0]->Id_DORig;
                    if ($lotto != '0') {
                        DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = '$Id_DORig' ");
                    }
                    if ($ubicazione_A != '0') {
                        DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dorig = '$Id_DORig'");
                    }
                    if ($ubicazione_P != '0') {
                        DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dorig = '$Id_DORig'");
                    }


                }*/
            }
        }
    }
    /*
        public static function scarica_articolo($id_ordine,$codice_articolo,$quantita,$magazzino,$fornitore = 0,$ubicazione,$lotto){

            if ($lotto == 'Nessun Lotto')
            {
                $lotto='0';
            }
            if ($ubicazione_A == 'ND')
            {
                $ubicazione_A='0';
            }
            if ($ubicazione_P == 'ND')
            {
                $ubicazione_P='0';
            }

            $cf = DB::select('SELECT * from CF Where Cd_CF IN (SELECT Cd_CF from DOTes WHere Id_DoTes = '.$id_ordine.')');
            if(sizeof($cf) > 0)
            {
                $cf = $cf[0];
                $articoli = DB::select
                ('
                    SELECT Cd_AR,Descrizione,Cd_ARMisura
                    from AR
                    where Cd_AR = \'' . $codice_articolo . '\';
                 ');
                $RIGA = DB::SELECT('SELECT * FROM DORig where Id_DoTes = \'' . $id_ordine . '\' ORDER BY RIGA DESC');
                if ($RIGA == null)
                    $RIGA = '0';
                else
                    $RIGA = $RIGA[0]->Riga;
                $RIGA++;
                if (sizeof($articoli) > 0) {
                    $articolo = $articoli[0];
                    $insert_righe_ordine['Id_DoTes'] = $id_ordine;
                    $insert_righe_ordine['Cd_AR'] = $articolo->Cd_AR;
                    $insert_righe_ordine['Riga'] = $RIGA;
                    $insert_righe_ordine['Descrizione'] = $articolo->Descrizione;
                    $insert_righe_ordine['Cd_MGEsercizio'] = date('Y');
                    $insert_righe_ordine['Cd_ARMisura'] = $articolo->Cd_ARMisura;
                    $insert_righe_ordine['Cd_VL'] = 'EUR';
                    $insert_righe_ordine['Qta'] = $quantita;
                    $insert_righe_ordine['QtaEvadibile'] = $quantita;
                    $insert_righe_ordine['Cambio'] = 1;
                    $insert_righe_ordine['Cd_MG_A'] = $magazzino_A;
                    $insert_righe_ordine['Cd_MG_P'] = $magazzino_P;
                    $condizione='';
                    $condizione  .='and Cd_ARLotto = \''.$lotto.'\'';
                    if($ubicazione_A != '0')
                        $condizione .='and Cd_MGUbicazione_A =\''.$ubicazione_A.'\'';
                    if($ubicazione_P != '0')
                        $condizione .='and Cd_MGUbicazione_P =\''.$ubicazione_P.'\'';

                    $tipo1  = DB::SELECT('SELECT * FROM DOTes WHERE Id_DOTes = \''.$id_ordine.'\'');
                    $tipo   = $tipo1[0]->Cd_Do;
                    $fornitore= $tipo1[0]->Cd_CF;
                    $nuovo = DB::SELECT('SELECT * FROM DODOPREL WHERE Cd_DO = \''.$tipo.'\'')[0]->Cd_DO_Prelevabile;

                    $Id_DoTes = DB::table('DOTes')->insertGetId(['Cd_CF' => $fornitore, 'Cd_Do' => $nuovo]);
                    $insert_righe_ordine['Id_DoTes'] = $Id_DoTes;
                    $insert_righe_ordine['QtaEvasa'] = $insert_righe_ordine['QtaEvadibile'];



                    DB::table('DORig')->insertGetId($insert_righe_ordine);
                    $nuovaRiga = DB::SELECT('SELECT top 1 * FROM DORig order by Id_DORig desc ')[0]->Id_DORig;
                    if ($lotto != '0')
                    {
                        DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = '$nuovaRiga'");
                    }
                    $insert_righe_ordine['Id_DoTes'] = $id_ordine;
                    $insert_righe_ordine['Qta'] = $quantita;
                    $insert_righe_ordine['QtaEvadibile'] = $quantita;
                    $insert_righe_ordine['QtaEvasa'] = $quantita;
                    $insert_righe_ordine['Id_DORig_Evade'] = $nuovaRiga;
                    $condizione  .='and Id_DORig_Evade = \''.$nuovaRiga.'\'';
                    $esiste = DB::select('SELECT * from DORig where Id_DoTes = ' . $id_ordine . ' and Cd_AR =  \'' . $codice_articolo . '\' and Cd_MG_A = \''.$magazzino_A.'\' and Cd_MG_P = \''.$magazzino_P.'\'  '.$condizione.' ');
                    if (sizeof($esiste) == 0)
                    {
                        DB::table('DORig')->insertGetId($insert_righe_ordine);
                        $Id_DORig = DB::SELECT('SELECT top 1 * FROM DORig order by Id_DORig desc ')[0]->Id_DORig;;
                        if ($lotto != '0')
                        {
                            DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = '$Id_DORig'");
                        }
                        if ($ubicazione_A != '0') {
                            DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dorig = '$Id_DORig' ");
                        }
                        if ($ubicazione_P != '0') {
                            DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dorig = '$Id_DORig' ");
                        }
                        ArcaUtilsController::calcola_totale_ordine($id_ordine);

                    }
                    else
                    {
                        $insert_righe_ordine['Qta'] = floatval($quantita) + floatval($esiste[0]->Qta);
                        $insert_righe_ordine['QtaEvadibile'] = floatval($quantita) + floatval($esiste[0]->QtaEvadibile);
                        $insert_righe_ordine['Cd_MG_A'] = $magazzino_A;
                        $insert_righe_ordine['Cd_MG_P'] = $magazzino_P;

                        DB::table('DORig')->where('Id_DORig', $esiste[0]->Id_DORig)->update($insert_righe_ordine);
                        $Id_DORig=$esiste[0]->Id_DORig;
                        if ($lotto != '0') {
                            DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = '$Id_DORig' ");
                        }
                        if ($ubicazione_A != '0') {
                            DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dorig = '$Id_DORig'");
                        }
                        if ($ubicazione_P != '0') {
                            DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dorig = '$Id_DORig'");
                        }

                        ArcaUtilsController::calcola_totale_ordine($id_ordine);
                    }
                }
            }
        }
        */

    /*
        public static function trasporto_articolo($Cd_AR,$Cd_Do,$quantita,$Cd_MG,$ubicazione_P,$Cd_Mg_A,$ubicazione_A,$Cd_Cf,$lotto){


            $Id_DoTes = DB::table('DoTes')->InsertGetId(['cd_do' => $Cd_Do ,'cd_cf' => $Cd_Cf]);
            DB::update("Update dotes set dotes.reserved_1 = 'RRRRRRRRRR' where dotes.id_dotes = $Id_DoTes exec asp_DO_End $Id_DoTes");

            $Id_DoRig = DB::table('DoRig')->InsertGetId(['Id_DoTes'=>$Id_DoTes,'Cd_DO' => $Cd_Do , 'Cd_CF'=> $Cd_Cf, 'Cd_MG_P'=>$Cd_MG, 'Cd_MG_A'=>$Cd_Mg_A ,'Cd_AR'=>$Cd_AR,'Qta'=>$quantita]);
            DB::update("Update dotes set dotes.reserved_1 = 'RRRRRRRRRR' where dotes.id_dotes = $Id_DoRig exec asp_DO_End $Id_DoRig");

            if($lotto!='0')
            {
                DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dotes = $Id_DoTes ");
            }
            if($ubicazione_A!='0')
            {
                DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dotes = $Id_DoTes ");
            }
            if($ubicazione_P!='0')
            {
                DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dotes = $Id_DoTes ");
            }

            return $Id_DoTes;
        }*/
    public static function trasporto_articolo($Cd_AR,$Cd_Do,$quantita,$Cd_MG,$ubicazione_P,$Cd_Mg_A,$ubicazione_A,$Cd_Cf,$lotto,$Id_DoTes){
        if ($quantita == '0')
            echo 'Impossibile trasportare la Quantita a 0';
        else {
            $condizione = 'WHERE Cd_AR = \'' . $Cd_AR . '\' and Cd_Do =\'' . $Cd_Do . '\' and Cd_MG_P = \'' . $Cd_MG . '\' and Cd_MG_A = \'' . $Cd_Mg_A . '\' and Id_DoTes = \'' . $Id_DoTes . '\' ';
            if ($lotto != '0')
                $condizione .= 'and Cd_ARLotto = \'' . $lotto . '\'';

            if ($ubicazione_A != '0')
                $condizione .= 'and Cd_MGUbicazione_A =\'' . $ubicazione_A . '\'';

            if ($ubicazione_P != '0')
                $condizione .= 'and Cd_MGUbicazione_P =\'' . $ubicazione_P . '\'';


            $esiste = DB::Select('SELECT * FROM DoRig ' . $condizione);
            if (sizeof($esiste) == 0) {
                $Id_MgMov = DB::table('DORig')->insertGetId(['Id_DOTes' => $Id_DoTes, 'Cd_DO' => $Cd_Do, 'Cd_CF' => $Cd_Cf, 'Cd_MG_P' => $Cd_MG, 'Cd_MG_A' => $Cd_Mg_A, 'Cd_AR' => $Cd_AR, 'Qta' => $quantita]);
                $Id_DoRig = DB::SELECT('SELECT * FROM MgMov WHERE Id_MgMov = \''.$Id_MgMov.'\' ')[0]->Id_DoRig;

                DB::update("Update dotes set dotes.reserved_1 = 'RRRRRRRRRR' where dotes.id_dotes = $Id_DoRig exec asp_DO_End $Id_DoRig");

                if ($lotto != '0') {
                    DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = $Id_DoRig ");
                }
                if ($ubicazione_A != '0') {
                    DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dorig = $Id_DoRig ");
                }
                if ($ubicazione_P != '0') {
                    DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dorig = $Id_DoRig ");
                }
            } else {
                $quantita1 = $quantita + intval($esiste[0]->Qta);
                $Id_DoRig = $esiste[0]->Id_DORig;
                DB::update("Update DoRig set Qta = '$quantita1' where id_dorig = $Id_DoRig ");
            }
        }
    }

    public static function modifica_articolo($id_ordine,$codice_articolo,$quantita,$magazzino_A,$fornitore = 0,$ubicazione_A,$lotto,$magazzino_P,$ubicazione_P){


        $cf = DB::select('SELECT * from CF Where Cd_CF IN (SELECT Cd_CF from DOTes WHere Id_DoTes = '.$id_ordine.')');
        if(sizeof($cf) > 0) {
            $cf = $cf[0];


            $articoli = DB::select('
                SELECT Cd_AR,Descrizione,Cd_ARMisura
                from AR
                where Cd_AR = \'' . $codice_articolo . '\';
             ');

            if (sizeof($articoli) > 0) {
                $articolo = $articoli[0];

                $insert_righe_ordine['Id_DoTes'] = $id_ordine;
                $insert_righe_ordine['Cd_AR'] = $articolo->Cd_AR;
                $insert_righe_ordine['Riga'] = 1;
                $insert_righe_ordine['Descrizione'] = $articolo->Descrizione;
                $insert_righe_ordine['Cd_MGEsercizio'] = date('Y');
                $insert_righe_ordine['Cd_ARMisura'] = $articolo->Cd_ARMisura;
                $insert_righe_ordine['Cd_VL'] = 'EUR';
                $insert_righe_ordine['Cambio'] = 1;
                $insert_righe_ordine['Qta'] = $quantita;
                $insert_righe_ordine['QtaEvadibile'] = $quantita;
                $insert_righe_ordine['Cd_MG_P'] = $magazzino_P;
                $insert_righe_ordine['Cd_MG_A'] = $magazzino_A;

                $esiste = DB::select('SELECT * from DORig where Id_DoTes = ' . $id_ordine . ' and Cd_AR =  \'' . $codice_articolo . '\' and Cd_ARLotto = \''.$lotto.'\'');
                if (sizeof($esiste) == 0) {
                    $Id_MGMov = DB::table('DORig')->insertGetId($insert_righe_ordine);
                    $Id_DoRig1= DB::select('Select * from mgmov where Id_Mgmov = \''.$Id_MGMov.'\'');
                    $Id_DoRig = $Id_DoRig1[0]->Id_DoRig;
                } else {
                    $insert_righe_ordine['Qta'] = $quantita;
                    $insert_righe_ordine['QtaEvadibile'] = $quantita;
                    $insert_righe_ordine['Cd_MG_P'] = $magazzino_P;
                    $insert_righe_ordine['Cd_MG_A'] = $magazzino_A;
                    DB::table('DORig')->where('Id_DORig', $esiste[0]->Id_DORig)->update($insert_righe_ordine);
                    $Id_DoRig=$esiste[0]->Id_DORig;
                    if ($lotto != '0') {
                        DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = $Id_DoRig ");
                    }
                    if ($ubicazione_P != '0') {
                        DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dorig = $Id_DoRig ");
                    }
                    if ($ubicazione_A != '0') {
                        DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dorig = $Id_DoRig ");
                    }

                    ArcaUtilsController::calcola_totale_ordine($id_ordine);
                    exit();
                }

            }

            if ($lotto != '0') {
                DB::update("Update DoRig set Cd_ARLotto = '$lotto' where id_dorig = $Id_DoRig ");
            }
            if ($ubicazione_P != '0') {
                DB::update("Update DoRig set Cd_MGUbicazione_P = '$ubicazione_P' where id_dorig = $Id_DoRig ");
            }
            if ($ubicazione_A != '0') {
                DB::update("Update DoRig set Cd_MGUbicazione_A = '$ubicazione_A' where id_dorig = $Id_DoRig ");
            }

            ArcaUtilsController::calcola_totale_ordine($id_ordine);
        }
    }

    /**
     * Diminuisce di 1 la quantità di una riga, se la quantità è 1 elimina la riga
     * @param $id_ordine
     * @return \Illuminate\Contracts\View\View
     */
    public static function rimuovi_articolo($id_ordine,$codice_articolo){


        $articoli = DB::select('
                        SELECT
                             Cd_AR
		                    ,Descrizione
		                    ,Cd_ARMisura

                        from AR
                        ');

        if(sizeof($articoli) > 0) {
            $articolo = $articoli[0];

            $esiste = DB::select('SELECT * from DORig where Id_DoTes = '.$id_ordine.' and Cd_AR =  \''.$codice_articolo.'\'');
            if(sizeof($esiste) > 0){

                if($esiste[0]->Qta > 1) {

                    $quantita = $esiste[0]->Qta - 1;
                    $insert_righe_ordine['Qta'] = $quantita;
                    $insert_righe_ordine['QtaEvadibile'] = $quantita;
                    $insert_righe_ordine['PrezzoTotaleV'] = $articolo->Prezzo * $quantita;
                    DB::table('DORig')->where('Id_DORig', $esiste[0]->Id_DORig)->update($insert_righe_ordine);

                } else {

                    ArcaUtilsController::rimuovi_riga($id_ordine,$codice_articolo);
                }
            }
        }

        ArcaUtilsController::calcola_totale_ordine($id_ordine);

    }

    /**
     * Diminuisce di 1 la quantità di una riga, se la quantità è 1 elimina la riga
     * @param $id_ordine
     * @return \Illuminate\Contracts\View\View
     */
    public static function rimuovi_riga($id_ordine,$codice_articolo){


        $articoli = DB::select('
                        SELECT
                             Cd_AR
		                    ,Descrizione
		                    ,Cd_ARMisura
		                    ,Cd_Aliquota_V

                        from AR
                        ');

        if(sizeof($articoli) > 0) {
            $esiste = DB::select('SELECT * from DORig where Id_DoTes = '.$id_ordine.' and Cd_AR =  \''.$codice_articolo.'\'');
            if(sizeof($esiste) > 0){
                DB::table('DORig')->where('Id_DORig', $esiste[0]->Id_DORig)->delete();
            }
        }

        ArcaUtilsController::calcola_totale_ordine($id_ordine);

    }



    /**
     * Diminuisce di 1 la quantità di una riga, se la quantità è 1 elimina la riga
     * @param $id_ordine
     * @return \Illuminate\Contracts\View\View
     */
    public static function modifica_riga($id_ordine,$id_riga,$prezzo,$quantita){

        $esiste = DB::select('SELECT * from DORig where Id_DoTes = '.$id_ordine.' and Id_DORig =  '.$id_riga);
        if(sizeof($esiste) > 0){

            $insert_righe_ordine['Qta'] = $quantita;
            $insert_righe_ordine['PrezzoUnitarioV'] = $prezzo;
            $insert_righe_ordine['QtaEvadibile'] = $quantita;
            $insert_righe_ordine['PrezzoTotaleV'] = $prezzo * $quantita;
            DB::table('DORig')->where('Id_DORig', $esiste[0]->Id_DORig)->update($insert_righe_ordine);
        }

        ArcaUtilsController::calcola_totale_ordine($id_ordine);

    }

    public static function calcola_totali_ordine(){

        ini_set('max_execution_time',0);
        $ordini = DB::select('SELECT * from DOTes');
        foreach($ordini as $o) {

            ArcaUtilsController::calcola_totale_ordine($o->Id_DoTes);
        }
    }


}




