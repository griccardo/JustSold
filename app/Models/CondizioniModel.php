<?php

namespace App\Models;

use CodeIgniter\Model;

class CondizioniModel extends Model{
    protected $table = 'condizioni_prodotto';
    protected $primaryKey = 'condizioni';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';

    protected $allowedFields = [];

    
}

