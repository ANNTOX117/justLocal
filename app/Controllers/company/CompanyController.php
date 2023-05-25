<?php

namespace App\Controllers\Company;
use App\Controllers\BaseController;
use App\Models\CompaniesModel;
use App\Models\MediaCompanyModel;
use App\Models\OffersModel;
use App\Models\ReviewsModel;

class CompanyController extends BaseController
{   
    public function index()
    {
        helper("strings");
        $this->checkSession();
        $companies = new CompaniesModel();
        $user_id = session()->get("user_id");
        $data = array(
            "companies" => $companies->get_all_companies_by_user($user_id)
        );
        echo $this->generate_view($data,"pages/company/dashboard_view");
    }
    public function edit($company_slug)
    {
        $this->checkSession();
        $user_id = session()->get("user_id");
        helper("strings");
        $company_slug = sanitize_string($company_slug);
        $company = new CompaniesModel();
        $data_company = $company->get_page_by_slug($company_slug);
        $company_owns_user = $company->company_owns_user($data_company["id"],$user_id);
        $offers = new OffersModel();
        $media = new MediaCompanyModel();
        $reviews = new ReviewsModel();
        if (!isset($data_company) || !$company_owns_user) return $this->response->setStatusCode(404)->setBody(view('errors/html/error_404'));
        $data = array(
            "company" => $data_company,
            "reviews" => $reviews->get_reviews_by_company($data_company["id"]),
            "offers" => $offers->get_offers_by_company($data_company["id"]),
            "media" => $media->get_media_by_company($data_company["id"])
        );
        echo $this->generate_view($data,"pages/company/edit_company_view");
    }

    private function generate_view($data,$url_main)
    {
        $structure = array(
            'header'    => view('templates/general/menu_view', $data),
            'main'      => view($url_main, $data),
            'footer'    => view('templates/general/footer_view', $data),
            "js"        => array(
                "<script src='".base_url("assets/ownsite/js/company/company.js")."'></script>"
            )
        );
        if(isset($data["js"])) $structure["js"] = $data["js"];
        return view('layouts/layout_general_view', $structure);
    }

    private function checkSession()
    {
        if (!session()->has('user_id') || !session()->has('logged') || session()->get('type_user') != "2") {
            return $this->response->redirect(site_url('/login'));
        }
    }
}
