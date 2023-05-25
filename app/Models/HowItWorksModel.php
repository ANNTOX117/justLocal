<?php

namespace App\Models;

use CodeIgniter\Model;

class HowItWorksModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'how_it_works';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["comment","icon_html", "title"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_all_comments()
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

    public function get_comments(){
        $query = $this->select(['title', 'comment', 'icon_html'])->findAll();
        if(count($query) > 0){
            return $query;
        } else {
            return null;
        }
    }

}
