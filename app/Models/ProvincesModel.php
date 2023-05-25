<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvincesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'provinces';
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
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_all_provinces(){
        $this->select('id,name');
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_provinces_by_country($country_id)
    {
        $where = array(
            "country_id" => $country_id
        );
        $query = $this->select("id,name,path")->where($where)->get();
        return $query->getResult();
    }

    public function get_province_company_counts($country_id)
    {
        $db = db_connect();
        $query = $db->query("
            SELECT p.name, p.path, COUNT(co.name) total_companies
            FROM provinces p
            INNER JOIN cities c on p.id = c.province_id
            LEFT JOIN companies co on co.city_id = c.id AND co.active = 1 AND co.block = 0 AND co.deleted = 0
            WHERE p.country_id = $country_id
            GROUP BY p.id
            ORDER by total_companies DESC;
        ");
        return $query->getResult();
    }

    public function get_cities_company_counts_by_province($province_id)
    {
        $db = db_connect();
        $query = $db->query("
            SELECT p.path as path_province,c.name,c.path, COUNT(co.name) total_companies 
            FROM provinces p 
            INNER JOIN cities c on p.id = c.province_id 
            LEFT JOIN companies co on co.city_id = c.id
            WHERE p.id = $province_id AND co.active = 1 AND co.block = 0 AND co.deleted = 0 
            GROUP BY c.id 
            ORDER by total_companies DESC;
        ");
        return $query->getResult();
    }

    public function get_province_by_slug($slug)
    {
        $where = array(
            "path" => $slug
        );
        $query = $this->select("id,name,path")->where($where)->get();
        return $query->getRow();
    }
}
