<?php

namespace App\Controllers;

use Exception;

class Accesso extends BaseController
{
    public function index()
    {
        // localhost/accesso -> mostro schermata login
        $opt = array(
            'title'   =>   'Login',       
        );
        echo view('components/head', $opt);
        echo view('login/login');
        echo view('components/footer');
    }

    public function nuovo()
    {
        // localhost/accesso/nuovo -> mostro schermata login
        $opt = array(
            'title'   =>   'Signup',       
        );
        echo view('components/head', $opt);
        echo view('login/signup');
        echo view('components/footer');
    }

    public function verifica() 
    {
        // chiamato quando viene fatto il login

        // controllo form
        if(
            !isset($_POST['email']) || !isset($_POST['password']) ||
            empty($_POST['email']) || empty($_POST['password'])
        ){
            // campi non impostati... dovrebbe essere impossibile, but...
            return redirect()->to(base_url()."/accesso?error=1"); 
        }

        // prendo valori inseriti da utente
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        // model utente per CRUD
        $utente = model("UtenteModel");

        // controllo se username esiste
        if(empty($utente->where('email', $userEmail)->findAll())){
            // nessun utente con quella email
            return redirect()->to(base_url()."/accesso?error=2"); 
        }

        // username ok, controllo password
        if(password_verify($userPassword, $utente->where('email', $userEmail)->findColumn('passwd')[0])){

            // prendo tutte le colonne
            $dati_utente = $utente->where('email', $userEmail)->findAll()[0];

            // password corretta, setto variabili di sessione
            if (session_id() == "") session_start();
            $_SESSION['user_id'] = $dati_utente['utente_id'];
            $_SESSION['dati_utente'] = $dati_utente;

            // redirect ad area utente
            if(isset($_GET['source'])) return redirect()->to($_GET['source']); 
            else return redirect()->to(base_url()); 

        }else{

            // password errata
            return redirect()->to(base_url()."/accesso?error=3"); 
        }
    }

    public function registra() 
    {
        // chiamato quando viene fatto sign up

        // controllo form
        if(
            !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['nome']) || !isset($_POST['cognome']) || !isset($_POST['nascita']) || !isset($_POST['telefono']) ||
            empty($_POST['email']) || empty($_POST['password']) || empty($_POST['nome']) || empty($_POST['cognome']) || empty($_POST['nascita']) || empty($_POST['telefono'])
        ){
            // campi non impostati... dovrebbe essere impossibile, but...
            return redirect()->to(base_url()."/accesso/nuovo"); 
        }

        // model utente per CRUD
        $utente = model("UtenteModel");

        // calcolo hash password da salvare nel db
        $passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // dati in array associativo per passarli all'insert
        $data = [
            'nome'          => strtolower($_POST['nome']),
            'cognome'       => strtolower($_POST['cognome']),
            'data_nascita'  => $_POST['nascita'],
            'email'         => strtolower($_POST['email']),
            'telefono'      => $_POST['telefono'],
            'passwd'        => $passwd
        ];

        // provo ad inserire dati nel db
        try{

            // inserisco dati nel db
            $utente->insert($data);

            // prendo tutte le colonne
            $dati_utente = $utente->where('email', $data['email'])->findAll()[0];

            // setto variabili di sessione
            if (session_id() == "") session_start();
            $_SESSION['user_id'] = $dati_utente['utente_id'];
            $_SESSION['dati_utente'] = $dati_utente;

            // redirect ad area utente
            return redirect()->to(base_url()."/"); 

        }
        catch(Exception $e){

            // error on insert
            var_dump($e->getMessage());
        }
        

        
    }

    public function esci() 
    {
        if (session_id() == "") session_start();
        $_SESSION = array();
        session_destroy();
        return redirect()->to(base_url()); 
    }
    
}
