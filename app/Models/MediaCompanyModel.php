<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaCompanyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'media_company';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["name_file","company_id","type"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function get_media_by_company($company_id)
    {
        $where = array(
            "company_id" => $company_id,
        );
        $query = $this->getWhere($where);
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

}
