<?php

namespace App\Models;

use CodeIgniter\Model;

class BrancheModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'branches';
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
    protected $updatedField  = 'updated_at';
    

    public function get_all_branches()
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

    public function get_branches_city($id_city, $type = 3){

        $query = $this->select(['branches.id', 'branches.name'])
                ->join('branches_by_company', 'branches_by_company.branche_id = branches.id')
                ->join('companies', 'branches_by_company.company_id = companies.id')
                ->where('companies.city_id', $id_city);
                // ->findAll();
        if($type != 3){
            $query->where('companies.type_company_id', $type);
        }
        $query = $query->findAll();
        if(count($query) > 0){
            return $query;
        } else {
            return null;
        }
    }
}
