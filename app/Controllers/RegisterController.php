<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BrancheModel;
use App\Models\CatTypeCompanyModel;
use App\Models\ProvincesModel;
use Config\Services;

class RegisterController extends BaseController
{
    protected $lang;
    public function __construct() {
        $this->lang = Services::request()->getLocale();
    }
    public function index()
    {
        $provinces = new ProvincesModel();
        $type_companies = new CatTypeCompanyModel();
        $branches = new BrancheModel();
        $data = array(
            "provinces" => $provinces->get_provinces_by_country(1),
            "type_companies" => $type_companies->get_all_type_companies(),
            "branches"  => $branches->get_all_branches()
        );
        echo $this->generate_view($data,"pages/general/register_view");
    }
    private function generate_view($data,$url_main)
    {
        $structure = array(
            'header' => view('templates/general/menu_view', $data),
            "js" => array(
                '<script src="'.base_url("assets/ownsite/js/general/login.js").'"></script>'
            ),
            "lang" => $this->lang,
            'main' => view($url_main, $data),
            'footer' => view('templates/general/footer_view', $data)
        );
        return view('layouts/layout_general_view', $structure);
    }
}
