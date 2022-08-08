<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $opt = array(
            'title'   =>   'JustSold',       
        );
        echo view('components/head', $opt);

        // se utente è loggato cambio navbar
        if (session_id() == "") session_start();
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            // logged
            echo view('components/navbar/navbar_logged');
        }else{
            // not logged
            echo view('components/navbar/navbar');
        }

        // model categoria per CRUD
        $categoria = model("CategoriaModel");

        // model categoria per CRUD
        $annuncio = model("AnnuncioModel");

        // mi salvo le condizioni e gli annunci per utilizzarli nella view
        $opt = array(
            'categoria'  =>     $categoria->orderBy('nome', 'asc')->findAll(), 
            'annunci'    =>     $annuncio->getAnnunciHome()
        );
        
        echo view('home_page', $opt);
        echo view('components/footer');
    }

    
}
