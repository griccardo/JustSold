<?php

namespace App\Models;

use CodeIgniter\Model;

class UtenteModel extends Model{
    protected $table = 'utente';
    protected $primaryKey = 'utente_id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $allowedFields = ['nome', 'cognome', 'data_nascita', 'email', 'telefono', 'passwd'];

    
}

