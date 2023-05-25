<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CarouselModel;
use App\Models\CompaniesModel;
use App\Models\HowItWorksModel;
use App\Models\PopularOffersModel;
use App\Models\UsersModel;

class SettingsController extends BaseController
{
    public function index()
    {
        echo $this->generate_view([],"pages/admin/settings_view");
    }

    public function home()
    {
        $carousel = new CarouselModel();
        $companies = new CompaniesModel();
        $popular_offers = new PopularOffersModel();
        $how_it_works = new HowItWorksModel();
        $local_company = new CompaniesModel();

        $data = array(
            "carousels" => $carousel->get_all_carousel_by_page("home"),
            "companies_select" => $companies->get_company_to_select(),
            "popular_offers" => $popular_offers->get_all_offers(),
            "how_it_works" => $how_it_works->get_all_comments(),
            "local_company" => $local_company->get_info()[0],
        );
        echo $this->generate_view($data,"pages/admin/settings/home_view");
    }

    public function users()
    {
        $users = new UsersModel();
        $data = array(
            "user_members" => $users->get_all_member_users()
        );
       echo $this->generate_view($data,"pages/admin/users_view");
    }

    public function sendEmail()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'sandbox.smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => '50eb140a0a3ba0',
            'smtp_pass' => 'f1371932d4d195',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );
        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom('your@example.com', 'Password change');
        $email->setTo('antoniorazo@aragon.unam.mx');
        $email->setSubject('Email Test');
        $email->setMessage('Testing the email class.');
        $email->send();
    }

    private function generate_view($data,$url_main)
    {
        $structure = array(
            "css" => array(
                '<link rel="stylesheet" href="'.base_url("assets/ownsite/css/admin.css").'"/>'
            ),
            "js" => array(
                '<script src="'.base_url('assets/ownsite/js/admin/companies.js').'"></script>',
                '<script src="'.base_url('assets/ownsite/js/admin/app.js').'"></script>'
            ),
            'header'    => view('templates/admin/menu_view', $data),
            'main'      => view($url_main, $data),
            'footer'    => view('templates/admin/footer_view', $data)
        );
        return view('layouts/layout_general_view', $structure);
    }
}
