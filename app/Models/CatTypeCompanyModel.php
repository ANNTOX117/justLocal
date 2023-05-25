<?php

namespace App\Models;

use CodeIgniter\Model;

class CatTypeCompanyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'cat_type_company';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function get_all_type_companies()
    {
        $where = array(
            "block" => 0
        );
        $query = $this->getWhere($where);
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }
}
