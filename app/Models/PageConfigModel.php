<?php

namespace App\Models;

use CodeIgniter\Model;

class PageConfigModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'page_config';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["company_id", "title_in_main","image_principal","description_in_main","images_deco1","images_deco2","block","page_id","block"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
}
