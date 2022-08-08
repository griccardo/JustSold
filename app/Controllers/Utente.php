<?php

namespace App\Controllers;

class Utente extends BaseController
{
    public function index()
    {   
        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".base_url()."/utente");
        }

        $opt = array(
            'title'   =>   'JustSold',       
        );
        echo view('components/head', $opt);
        echo view('components/navbar/navbar_logged');

        echo view('user/body');
        
        echo view('components/footer');
    }

    public function modifica()
    {
        // chiamata backend per modifica profilo

        // redirect a login se non loggato
        if (session_id() == "") session_start();
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url()."/accesso?source=".base_url()."/utente");
        }

        if(
            !isset($_POST['nome']) || !isset($_POST['cognome']) || !isset($_POST['nascita']) || !isset($_POST['telefono']) || 
            empty($_POST['nome']) || empty($_POST['cognome']) || empty($_POST['nascita']) || empty($_POST['telefono'])
        ){
            // campi non impostati... dovrebbe essere impossibile, but...
            return redirect()->to(base_url()."/utente"); 
        }

        

        // model utente per CRUD
        $utente = model("UtenteModel");


        // dati in array associativo per passarli all'insert
        $data = [
            'nome'          => strtolower($_POST['nome']),
            'cognome'       => strtolower($_POST['cognome']),
            'data_nascita'  => $_POST['nascita'],
            'telefono'      => $_POST['telefono'],
        ];

        
        // inserisco dati nel db
        $utente->where('utente_id', $_SESSION['user_id'])->set($data)->update();

        // prendo tutte le colonne
        $dati_utente = $utente->where('utente_id', $_SESSION['user_id'])->findAll()[0];

        // setto nuove variabili di sessione
        if (session_id() == "") session_start();
        $_SESSION['dati_utente'] = $dati_utente;

        // redirect ad area utente
        return redirect()->to(base_url()."/"); 

    }


    
}
