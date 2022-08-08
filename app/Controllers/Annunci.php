<?php

namespace App\Controllers;

use Exception;

class Annunci extends BaseController
{
    public function index()
    {
        // localhost/annunci -> mostro schermata con annunci
        $opt = array(
            'title'   =>   'Cerca annunci',       
        );
        echo view('components/head', $opt);

        // mostro navbar corretta
        if (session_id() == "") session_start();
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            // logged
            echo view('components/navbar/navbar_logged');
        }else{
            // not logged
            echo view('components/navbar/navbar');
        }

        // model annuncio per CRUD
        $annuncio = model("AnnuncioModel");

        // ottiengo annunci che matchano la ricerca
        $cosa = (empty($_GET['cosa'])? "" : $_GET['cosa']);
        $dove = (empty($_GET['dove'])? "" : $_GET['dove']);
        $categoria = (empty($_GET['categoria'])? "" : $_GET['categoria']);
        $sped = isset($_GET['spedizione']) && $_GET['spedizione'];
        $risultato = $annuncio->getRicerca($cosa, $dove, $sped, $categoria);

        /* print "<pre>";
        print_r($risultato);
        print "</pre>"; */

        // model preferiti per CRUD
        $preferiti = model("PreferitiModel");

        // model categoria per CRUD
        $categoria = model("CategoriaModel");
        
        // se utente è loggato prendo i suoi preferiti
        $prefe = null;
        if(isset($_SESSION['user_id'])) $prefe = $preferiti->where('utente_id', $_SESSION['user_id'])->findAll();
       

        $opt = array(
            'annunci'    =>     $risultato,
            'categorie'  =>     $categoria->orderBy('nome', 'asc')->findAll(), 
            'preferiti'  =>     $prefe
        );
        echo view('advertisement/searchindex', $opt);
        
        echo view('components/footer');
    }

    public function nuovo()
    {
        // localhost/annunci/nuovo -> mostro schermata creazione annuncio

        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".current_url());
        }

        $opt = array(
            'title'   =>   'Nuovo annuncio',       
        );
        echo view('components/head', $opt);
        echo view('components/navbar/navbar_logged');

        // model condizioni per CRUD
        $condizioni = model("CondizioniModel");

        // model categoria per CRUD
        $categoria = model("CategoriaModel");

        // mi salvo le condizioni per utilizzarle nella view
        $opt = array(
            'condizioni'   =>   $condizioni->orderBy('peso', 'desc')->limit(10)->findAll(),       
            'categoria'   =>   $categoria->orderBy('nome', 'asc')->findAll(),       
        );
        echo view('advertisement/new', $opt);
        echo view('components/footer');
    }

    public function carica()
    {
        // chiamato in fase di pubblicazione di un nuovo annuncio

        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".current_url());
        }

        // model annuncio per CRUD
        $annuncio = model("AnnuncioModel");

        // creo array associativo recuperando utti i dati
        // faccio sanificazione per evitare code injection: senza "htmlspecialchars" sarebbe possibile far eseguire js aribitariamente
        // immagina un titolo con <script>while(true) alert("miao")</script> evitiamo ...
        $data = [
            'titolo'                => htmlspecialchars($_POST['titolo']),
            'prezzo'                => htmlspecialchars($_POST['prezzo']),
            'utente_venditore'      => $_SESSION['user_id'],
            'condizioni'            => $_POST['condizioni'],
            'categoria'             => $_POST['categoria'],
            'descrizione'           => htmlspecialchars($_POST['descrizione']),
        //  'data_pubblicazione'    => default, currenttimestamp(),
            'comune'                => htmlspecialchars(strtolower($_POST['comune'])),
            'provincia'             => htmlspecialchars(strtolower($_POST['provincia'])),
            'regione'               => htmlspecialchars(strtolower($_POST['regione'])),
            'is_spedibile'          => (isset($_POST['spedizione'])?"SPEDIBILE":"NON SPEDIBILE"),
            'is_disponibile'        => "DISPONIBILE"
        ];

        //var_dump($_POST);

        // inserisco dati nel db e getto l'id
        $annID = $annuncio->insertAndGetID($data);

        // definisco base dir dove salavre immagini
        $uploadDir = "./uploads/adv_images/user".$_SESSION['user_id']."/adv".$annID;

        //controllo se directory esiste, se no la creo
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // model immagine per CRUD
        $immagine = model("ImmagineModel");
        
        //inserisco tutte le immagini
        $finish = false;
        $index = 1;
        while(!$finish){

            if(isset($_FILES['img_inp'.$index]) && $_FILES['img_inp'.$index]['name'] != ""){

                // definisco nome file con percorso completo
                $uploadFile = $uploadDir . "/" . basename($_FILES['img_inp'.$index]['name']);

                // sposto il file da temp alla directory corretta
                move_uploaded_file($_FILES['img_inp'.$index]['tmp_name'], $uploadFile);

                // inserisco il percorso nel db
                $immagine->insert(['annuncio_id' => $annID, 'path' => $uploadFile]);

            }else{
                // non ci sono più file, finito
                $finish = true;
            }
            $index++;
        }

        // redirect ad annunci caricati
        return redirect()->to(base_url()."/annunci/pubblicati"); 

    }

    public function pubblicati()
    {
        // localhost/annunci/pubblicati -> mostro annunci pubblicati dall'utente loggato

        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".current_url());
        }

        // model annuncio per CRUD
        $annuncio = model("AnnuncioModel");

        // mostro head e nav
        $opt = array(
            'title'   =>   'JustSold',       
        );
        echo view('components/head', $opt);
        echo view('components/navbar/navbar_logged');

        $opt = array(
            'annunci'    =>     $annuncio->getAnnunciPubblicati()
        );
        echo view('advertisement/pubblicati', $opt);
        
        /* print "<pre>";
        print_r($pubblicati);
        print "</pre>"; */

        echo view('components/footer');

    }

    public function scheda($id = null)
    {
        // localhost/annunci/scheda/12 -> mostro scheda annuncio indicato
        
        if($id == null || !is_numeric($id)){
            return redirect()->to(base_url());
        }

        // model annuncio per CRUD
        $annuncio = model("AnnuncioModel");

        // prendo dati annuncio
        $a = $annuncio->getAnnuncioDetails($id);

        // se annuncio non esite
        if(empty($a)){

            // mostro errore
            $opt = array(
                'title'   =>   "Non trovato"       
            );
            echo view('components/head', $opt);
            echo view('advertisement/details/notfound');
            echo view('components/footer');

        }else{

            // annuncio trovato, mostro scheda

            $opt = array(
                'title'   =>   $a[0]['titolo'] . " - JustSold",       
            );
            echo view('components/head', $opt);

            // mostro navbar corretta
            if (session_id() == "") session_start();
            if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
                // logged
                echo view('components/navbar/navbar_logged');
            }else{
                // not logged
                echo view('components/navbar/navbar');
            }

            echo view('advertisement/details/body', ['annuncio' => $a]);
            echo view('components/footer');
        }


    }

    public function aggiungipreferito($id = null)
    {
        // localhost/annunci/aggiungipreferito/22 -> backend per aggiungerte prefe

        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso");
        }

        // model preferiti per CRUD
        $preferiti = model("PreferitiModel");

        // aggiungo preferito x utente loggato
        $preferiti->insert(['annuncio_id' => $id, 'utente_id' => $_SESSION['user_id']]);

        // torno a scheda annuncio
        return redirect()->to(base_url().'/annunci/scheda/'.$id);
    }

    public function rimuovipreferito($id = null)
    {
        // localhost/annunci/rimuovipreferito/22 -> backend per rimuovere prefe

        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso");
        }

        // model preferiti per CRUD
        $preferiti = model("PreferitiModel");

        // rimuovo preferito x utente loggato
        $preferiti->where('annuncio_id', $id)->where('utente_id', $_SESSION['user_id'])->delete();

        // torno a scheda annuncio
        return redirect()->to(base_url().'/annunci/scheda/'.$id);
    }

    public function preferiti()
    {
        // localhost/annunci/pubblicati -> mostro annunci pubblicati dall'utente loggato

        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".current_url());
        }

        // model annuncio per CRUD
        $annuncio = model("AnnuncioModel");

        // mostro head e nav
        $opt = array(
            'title'   =>   'JustSold',       
        );
        echo view('components/head', $opt);
        echo view('components/navbar/navbar_logged');

        // ottengo prefe e mostro view
        $opt = array(
            'annunci'    =>     $annuncio->getAnnunciPreferiti()
        );
        echo view('advertisement/preferiti', $opt);
        
        /* print "<pre>";
        print_r($pubblicati);
        print "</pre>"; */

        echo view('components/footer');

    }

    function disponibilita($id = null)
    {
        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if ($id == null || !isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".current_url());
        }

        // model annuncio per CRUD
        $annuncio = model("AnnuncioModel");

        // ottengo dati annuncio
        $annuncioSelected = $annuncio->where('annuncio_id', $id)->findAll()[0];

        // controllo se annuncio appartiene a utente loggato
        if ($annuncioSelected['utente_venditore'] != $_SESSION['user_id']) {
            // furbetto...
            return redirect()->to(base_url()."/");
        }

        // dati in array associativo per passarli all'insert
        $data = [
            'is_disponibile'    =>    $annuncioSelected['is_disponibile']?"NON DISPONIBILE":"DISPONIBILE",
        ];

        // inserisco dati nel db
        $annuncio->where('annuncio_id', $id)->set($data)->update();

        // torno a scheda annuncio
        return redirect()->to(base_url().'/annunci/scheda/'.$id);
    }

    function elimina($id = null)
    {
        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if ($id == null || !isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".current_url());
        }

        // model annuncio per CRUD
        $annuncio = model("AnnuncioModel");

        // model preferiti per CRUD
        $preferiti = model("PreferitiModel");

        // ottengo dati annuncio
        $annuncioSelected = $annuncio->where('annuncio_id', $id)->findAll()[0];

        // controllo se annuncio appartiene a utente loggato
        if ($annuncioSelected['utente_venditore'] != $_SESSION['user_id']) {
            // furbetto...
            return redirect()->to(base_url()."/");
        }

        // elimino dati dal db
        $preferiti->where('annuncio_id', $id)->delete();
        $annuncio->where('annuncio_id', $id)->delete();

        // torno a scheda annuncio
        return redirect()->to(base_url().'/annunci/pubblicati');
    }


}