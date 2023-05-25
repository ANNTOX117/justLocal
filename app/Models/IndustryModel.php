<?php

namespace App\Models;

use CodeIgniter\Model;

class IndustryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'industries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["name"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_all_industries()
    {
        $where = array(
            "block" => 0
        );
        $query = $this->select("id,name")->where($where)->get();
        return $query->getResult();
    }

}
