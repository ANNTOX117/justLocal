<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CompaniesModel;
use App\Models\CountriesModel;
use App\Models\OffersModel;
use App\Models\UsersModel;

class OffersController extends BaseController
{
    public function index()
    {
        $companies = new CompaniesModel();
        $company = new CompaniesModel();
        $countries = new CountriesModel();
        $offers = new OffersModel();
        // $config = [
        //     //'baseURL' => base_url('/admin/offers/index'),
        //     'totalRows' => $offers->countAll(),
        //     'perpage' => 10
        // ];
    
        // $pager = $this->pager;
        // $pager->initialize($config);
    
        // $data['offers'] = $offers->paginate(10);
        // $data['pager'] = $offers->pager;
        // var_dump($offers->get_all_offers()[0]); die();
        $user = new UsersModel();
        $user = $user->get_info(session()->get("user_id"));
        $user = $user[0];
        // var_dump($company->get_by_user($user->id)[0]->id, $offers->get_all_offers_by_company($company->get_by_user($user->id)[0]->id)); die();
        $data = array(
            "companies" => $companies->get_all_companies(),
            "countries" => $countries->get_countries_available(),
            "offers"    => $user->type_user_id == 3 ? $offers->get_all_offers() : $offers->get_all_offers_by_company($company->get_by_user($user->id)[0]->id)
        );
        return $this->generate_view($data,"pages/admin/offers_view");   
    }

    private function generate_view($data,$url_main)
    {
        $structure = array(
            "js"       => array(
                '<script src="'.base_url('assets/ownsite/js/admin/offers.js').'"></script>'
            ),
            'header'    => view('templates/admin/menu_view', $data),
            'main'      => view($url_main, $data),
            'footer'    => view('templates/admin/footer_view', $data)
        );
        return view('layouts/layout_general_view', $structure);
    }
}
