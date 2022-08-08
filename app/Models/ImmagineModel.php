<?php

namespace App\Models;

use CodeIgniter\Model;

class ImmagineModel extends Model{
    protected $table = 'immagini_annuncio';
    protected $primaryKey = 'immagine_id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $allowedFields = ['annuncio_id', 'path'];

    
}