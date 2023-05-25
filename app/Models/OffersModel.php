<?php

namespace App\Models;

use CodeIgniter\Model;

class OffersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'offers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["title","slug","description","discount","city_id","review","company_id","block"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_random_offers($limit = 4)
    {
        return $this->select('*')
            ->orderBy('RAND()')
            ->limit($limit)
            ->get()
            ->getResult();
    }

    public function get_with_info($id)
    {
        return $this->select(['offers.*', 'cities.name as city_name', 'provinces.id as province_id', 'provinces.name as province_name', 'cities.country_id as country_id'])
            ->join("cities","offers.city_id = cities.id")
            ->join("provinces","cities.province_id = provinces.id")
            ->where('offers.id', $id)
            ->get()
            ->getResult();
    }

    public function get_latest_offers($limit = 18)
    {
        $where = array(
            "block" => 0,
            "active" => 1,
            "deleted" => 0,
        );
        return $this->select('*')
            ->where($where)
            ->orderBy('created_at','DESC')
            ->limit($limit)
            ->get()
            ->getResult();
    }

    public function get_offers_by_company($company_id,$active = null)
    {
        $where = array(
            'companies.id'    => $company_id,
            'offers.block'         => 0
        );
        if ($active === null) unset($where['block']);
        $this->select("offers.id,offers.slug,offers.title,companies.description,offers.discount,companies.review,companies.name as company_name,cities.name as city_name,provinces.name as province_name");
        $this->join("companies","offers.company_id = companies.id","inner");
        $this->join("cities","companies.city_id = cities.id","inner");
        $this->join("provinces","cities.province_id = provinces.id","inner");
        $this->orderBy("offers.discount DESC");
        $this->where($where);
        $query = $this->get();
        
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_offer_by_slug($slug)
    {
        $query = $this->getWhere(['slug' => $slug]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_all_offers()
    {
        $this->select("offers.*,companies.description,companies.name as company_name,cities.name as city_name");
        $this->join("companies","offers.company_id = companies.id","inner");
        $this->join("cities","offers.city_id = cities.id","inner");
        $query = $this->get();
        return $query->getResult();
    }

    public function get_all_offers_by_company($id)
    {
        $this->select("offers.*,");
        $this->where('offers.company_id', $id);
        $query = $this->get();
        return $query->getResult();
    }

    public function get_all_offers_order()
    {
        $this->select("offers.id,offers.slug,offers.title,companies.description,offers.discount,companies.review,companies.name as company_name,cities.name as city_name,provinces.name as province_name");
        $this->join("companies","offers.company_id = companies.id","inner");
        $this->join("cities","offers.city_id = cities.id","inner");
        $this->join("provinces","cities.province_id = provinces.id","inner");
        $this->orderBy("offers.discount DESC");
        // $query = $this->get();
        // return $query->getResult();
        return $this->paginate(12);
    }

    public function get_all_offers_order_condition($type = null,$province = null,$city = null,$branche = null)
    {
        $where = array(
            "companies.block" => 0,
            "companies.active" => 1,
            "companies.deleted" => 0,
        );
        if ($type !== null) $where["companies.type_company_id"] = $type;
        if ($province !== null) $where["cities.province_id"] = $province;
        if ($city !== null) $where["companies.city_id"] = $city;
        $this->select("offers.id,offers.slug,offers.title,companies.description,offers.discount,companies.review,companies.name as company_name,cities.name as city_name,provinces.name as province_name");
        $this->join("companies","offers.company_id = companies.id","inner");
        $this->join("cities","offers.city_id = cities.id","inner");
        $this->join("provinces","cities.province_id = provinces.id","inner");
        if ($branche !== null) {
            $where["branches_by_company.branche_id"] = $branche;
            $this->join("branches_by_company","companies.id = branches_by_company.company_id");
        }
        $this->where($where);
        $this->orderBy("offers.discount DESC");
        return $this->paginate(12);
    }
}
