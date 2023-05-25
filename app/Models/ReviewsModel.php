<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["content","creator_name","job_description","company_id","active", "img_reviewer"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function get_reviews_by_company($company_id)
    {
        $query = $this->getWhere(['company_id' => $company_id]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_reviews_for_justLocal($limit = 3)
    {
        $where = array(
            "companies.slug" => "justlocal" 
        );
        return $this->select('reviews.*')
            ->join("companies","reviews.company_id = companies.id")
            ->where($where)
            ->orderBy('created_at','desc')
            ->limit($limit)
            ->get()
            ->getResult();
    }
}
