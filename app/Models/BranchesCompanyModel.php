<?php

namespace App\Models;

use CodeIgniter\Model;

class BranchesCompanyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'branches_by_company';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["company_id","branche_id"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function get_categories_by_company($company_id)
    {
        $where = array(
            "branches.block" => 0,
            "companies.id" => $company_id
        );
        $query = $this->select('branches.name')
                ->join('branches', 'branches_by_company.branche_id = branches.id')
                ->join('companies', 'branches_by_company.company_id = companies.id')
                ->where($where);
        $query = $query->findAll();
        return count($query) > 0?$query:null;
    }
}
