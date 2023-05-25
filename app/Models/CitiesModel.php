<?php

namespace App\Models;

use CodeIgniter\Model;

class CitiesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'cities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    public function get_info($id){
        $query = $this->select(['cities.id as city_id','provinces.id as province_id', 'provinces.name as province_name', 'countries.id as country_id', 'cities.name as city_name'])
            ->join('provinces', 'provinces.id = cities.province_id')
            ->join('countries', 'countries.id = cities.country_id')
            ->where('cities.id', $id)->get();
            return $query->getResult();
        // if(count($query) > 0){
        //     return $query;
        // } else {
        //     return null;
        // }
    }

    public function get_all_cities_by_province($id_city, $type = 3)
    {
        // $query = $this->getWhere(['province_id' => $id_city]);
        $query = $this->distinct()->select(['cities.id', 'cities.name'])->join('companies', 'companies.city_id = cities.id')->where('province_id', $id_city);
        if($type != 3){
            $query->where('companies.type_company_id', $type);
        }
        $query = $query->findAll();
        if(count($query) > 0){
            return $query;
        } else {
            return null;
        }
        // if ($query->resultID->num_rows > 0) {
        //     return $query->getResult();
        // } else {
        //     return null;
        // }
    }

    public function get_all_cities_by_provinceId($id_province)
    {
        $query = $this->getWhere(['province_id' => $id_province]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_city_by_slug($slug)
    {
        $where = array(
            "path" => $slug
        );
        $query = $this->select("id,name,path")->where($where)->get();
        return $query->getRow();
    }
}
