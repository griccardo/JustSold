<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnuncioModel extends Model{
    protected $table = 'annuncio';
    protected $primaryKey = 'annuncio_id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $allowedFields = ['titolo', 'prezzo', 'utente_venditore', 'condizioni', 'categoria', 'descrizione', 'data_pubblicazione', 'comune', 'provincia', 'regione', 'is_spedibile', 'is_disponibile'];


    /**
     * insertAndGetID
     * Inserisce un annuncio e restituisce l'id assegnato ad esso
     *
     * @param [array] $data : i dati del nuovo annuncio
     * @return int
     */
    function insertAndGetID($data){
        $db = db_connect('default'); 
        $builder = $db->table('annuncio');
        $builder->insert($data);
        return $db->insertID();
    }

    /**
     * getAnnunciHome
     * Restituisce i 20 annunci più recenti e la prima immagine per ognuno
     * 
     * @return array
     */
    function getAnnunciHome(){
        $db = db_connect('default'); 
        $qry = $db->query('SELECT a.*, path FROM annuncio a LEFT JOIN immagini_annuncio USING (annuncio_id) WHERE is_disponibile = "DISPONIBILE" GROUP BY annuncio_id ORDER BY data_pubblicazione DESC LIMIT 20');
        return $qry->getResultArray();
    }

    /**
     * getAnnunciPubblicati
     * Restituisce gli annunci pubblicati e la prima immagine per ognuno
     * 
     * @return array
     */
    function getAnnunciPubblicati(){
        if (session_id() == "") session_start();
        $db = db_connect('default'); 
        $qry = $db->query('SELECT a.*, path FROM annuncio a LEFT JOIN immagini_annuncio USING (annuncio_id) WHERE utente_venditore = ? GROUP BY annuncio_id ORDER BY data_pubblicazione DESC', $_SESSION['user_id']);
        return $qry->getResultArray();
    }

    /**
     * getAnnunciPreferiti
     * Restituisce gli annunci preferiti e la prima immagine per ognuno
     * 
     * @return array
     */
    function getAnnunciPreferiti(){
        if (session_id() == "") session_start();
        $db = db_connect('default'); 
        $qry = $db->query('SELECT a.*, path FROM annuncio a LEFT JOIN immagini_annuncio USING (annuncio_id) WHERE annuncio_id IN (SELECT annuncio_id FROM preferiti p WHERE utente_id = ? ) GROUP BY annuncio_id ORDER BY data_pubblicazione DESC', $_SESSION['user_id']);
        return $qry->getResultArray();
    }

    /**
     * getAnnuncioDetails
     * Restituisce tutte le informazioni e le immagini di un annuncio
     *
     * @param [int] $id : id dell'annuncio da cercare
     * @return array
     */
    function getAnnuncioDetails($id){
        $db = db_connect('default'); 

        if (session_id() == "") session_start();
        if(isset($_SESSION['user_id'])){
            // loggato, cerco anche i preferiti
            $qry = $db->query(
                'SELECT a.*, CONCAT(v.nome, " ", v.cognome) AS nome_venditore, v.email AS email_venditore, path, p.annuncio_id AS preferito 
                FROM annuncio a JOIN utente v ON v.utente_id = a.utente_venditore
                LEFT JOIN preferiti p ON p.annuncio_id = a.annuncio_id AND p.utente_id = ?
                LEFT JOIN immagini_annuncio i ON a.annuncio_id = i.annuncio_id
                WHERE a.annuncio_id = ?;'
            , [$_SESSION['user_id'], $id]);
            return $qry->getResultArray();
        }else{
            $qry = $db->query(
                'SELECT a.*, CONCAT(v.nome, " ", v.cognome) AS nome_venditore, v.email AS email_venditore, path
                FROM annuncio a JOIN utente v ON v.utente_id = a.utente_venditore
                LEFT JOIN immagini_annuncio i ON a.annuncio_id = i.annuncio_id
                WHERE a.annuncio_id = ?;'
            , $id);
            return $qry->getResultArray();
        }
        
    }

    /**
     * getRicerca
     * Restituisce gli annunci che corrispondono alla ricerca, se non interessa un parametro passare stringa vuota
     *
     * @param [string] $cosa
     * @param [string] $dove
     * @param [boolean] $sped
     * @param [string] $cat
     * @return array
     */
    function getRicerca($cosa, $dove, $sped, $cat){
        $db = db_connect('default'); 
        $sql = 'SELECT a.*, path FROM annuncio a LEFT JOIN immagini_annuncio USING (annuncio_id) WHERE is_disponibile = "DISPONIBILE" AND '.($sped?'is_spedibile = "SPEDIBILE" AND':'').' titolo LIKE ? AND ( comune LIKE ? OR provincia LIKE ? OR regione LIKE ? ) AND categoria LIKE ? GROUP BY annuncio_id ORDER BY data_pubblicazione DESC';
        $qry = $db->query($sql, array('%'.$db->escapeLikeString($cosa).'%', '%'.$db->escapeLikeString($dove).'%', '%'.$db->escapeLikeString($dove).'%', '%'.$db->escapeLikeString($dove).'%', '%'.$db->escapeLikeString($cat).'%'));
        
        return $qry->getResultArray();
    }
    
}

