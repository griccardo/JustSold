<?php

namespace App\Models;

use CodeIgniter\Model;

class PreferitiModel extends Model{
    protected $table = 'preferiti';
    protected $primaryKey = 'annuncio_id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';

    protected $allowedFields = ['annuncio_id', 'utente_id'];

    
}

