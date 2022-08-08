<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model{
    protected $table = 'categoria_prodotto';
    protected $primaryKey = 'nome';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';

    protected $allowedFields = [];

    
}

