<?php namespace App\Controllers;

    use App\Models\BrancheModel;
    use App\Models\BranchesCompanyModel;
    use App\Models\CarouselModel;
    use App\Models\CategoriesModel;
    use App\Models\CitiesModel;
    use App\Models\CompaniesModel;
    use App\Models\IndustryModel;
    use App\Models\NewsletterSubscribersModel;
    use App\Models\OffersModel;
    use App\Models\HowItWorksModel;
    use App\Models\LikedOffersUserModel;
    use App\Models\MediaCompanyModel;
    use App\Models\PopularOffersModel;
    use App\Models\ProvincesModel;
    use App\Models\ReviewsModel;
    use App\Models\UsersModel;
    use CodeIgniter\Controller;
    use Config\Services;

    class SiteController extends Controller
    {
        protected $lang;
        public function __construct() {
            $this->lang = Services::request()->getLocale();
        }
        
        // Homepage
        public function index()
        {
            helper('strings');
            $companies = new CompaniesModel();
            $offers = new OffersModel();
            $provincies = new ProvincesModel();
            $branches = new BrancheModel();
            $random_companies_img = $companies->get_random_companies(5,"bg_img_url");
            $random_offers = $offers->get_random_offers(4);
            $lastes_offers = $offers->get_latest_offers();
            $popular_offers = new PopularOffersModel();
            $carousel = new CarouselModel();
            $branches = new BrancheModel();
            $how_works = new HowItWorksModel();
            $how_works = $how_works->get_comments();
            $carousel_data = array(
                "companies" => $carousel->get_all_carousel_by_page("home")
            );
            $popular_offers_data = array(
                "popular_offers"        => $popular_offers->get_all_offers()
            );
            $reviews = new ReviewsModel();
            $review_by_justLocal = $reviews->get_reviews_for_justLocal(10);
            $data_justlocal["review_by_justLocal"] = $review_by_justLocal;
            $data = array(
                "random_companies"      => $random_companies_img,
                "random_offers"         => $random_offers,
                "lastes_offers"         => $lastes_offers,
                "how_works"             => $how_works,
                "provincies"            => $provincies->get_provinces_by_country(1),
                "branches"              => $branches->get_all_branches(),
                "carousel_view"         => view('pages/general/snippets/carousel_view', $carousel_data),
                "popular_offers_view"   => view('pages/general/snippets/popular_offers_view', $popular_offers_data),
                'reviews_justLocal'     => view('templates/general/reviews_justLocal_view', $data_justlocal),
                "js"                    => array(
                    '<script src="'.base_url("assets/ownsite/js/general/app.js").'"></script>'
                )
            );
            echo $this->generate_view($data,"pages/general/home_view");
        }

        private function generate_view($data,$url_main)
        {
            $structure = array(
                'header' => view('templates/general/menu_view', $data),
                'main' => view($url_main, $data),
                "lang" => $this->lang,
                'newsletter' => view('templates/general/newsletter_view', $data),
                'footer' => view('templates/general/footer_view', $data)
            );
            if(isset($data["js"])) $structure["js"] = $data["js"];
            return view('layouts/layout_general_view', $structure);
        }
        // Company page

        public function company($company)
        {
            $company = sanitize_string($company);
            $companies = new CompaniesModel();
            $reviews = new ReviewsModel();
            $offers = new OffersModel();
            $categories_by_company = new BranchesCompanyModel();
            $popular_offers = new PopularOffersModel();
            $company = $companies->get_page_by_slug($company);
            $media = new MediaCompanyModel();
            if (!isset($company)) return $this->response->setStatusCode(404)->setBody(view('errors/html/error_404'));
            $reviews_by_company = $reviews->get_reviews_by_company($company["id"]);
            $offers_by_company = $offers->get_offers_by_company($company["id"],true);
            $popular_offers_data = array(
                "popular_offers"        => $popular_offers->get_all_offers(),
                "random_offers"         => $offers->get_random_offers(5)
            );
            $data_title = array(
                "name" => $company["name"],
                "rating" => $company["review"],
                "reviews"   => $reviews_by_company,
                "website"   => $company["website"],
                "categories" => $categories_by_company->get_categories_by_company($company["id"])
            );
            $data_submenu = array(
                "company"   => $company,
                //"rating" => $company["review"],
                "offers"    => $offers_by_company,
                "media"     => $media->get_media_by_company($company["id"])
            );
            $data = array(
                "company"   => $company,
                "reviews"   => $reviews_by_company,
                "offers"    => $offers_by_company,
                "title_company_view" => view("pages/general/snippets/title_company_view",$data_title),
                "submenu_company_view" => view("pages/general/snippets/submenu_company_view",$data_submenu),
                "sidebar_popular_offers_view" => view("pages/general/snippets/sidebar_popular_offers_view",$popular_offers_data),
                "css"       => array(
                    '<link href="'.base_url('assets/css/lightbox.min.css').'" rel="stylesheet"/>'
                ),
                "js"        => array(
                    '<script type="text/javascript" src="'.base_url('assets/js/lightbox.min.js').'"></script>'
                )
            );
            echo $this->generate_view($data,"pages/general/company_view");
        }

        public function searching_companies()
        {
            $province = $this->request->getGet("provincie") ===""?null:$this->request->getGet("provincie");
            $city = $this->request->getGet("stad") ===""?null:$this->request->getGet("stad");
            $branche = $this->request->getGet("branche") ===""?null:$this->request->getGet("branche");
            $type_company = $this->request->getGet("type_company") ===""?null:$this->request->getGet("type_company");
            $name_company = $this->request->getGet("name_company") ===""?null:$this->request->getGet("name_company");
            $provincies = new ProvincesModel();
            $categories = new CategoriesModel();
            $industry = new IndustryModel();
            $companies = new CompaniesModel();
            $reviews = new ReviewsModel();
            $review_by_justLocal = $reviews->get_reviews_for_justLocal();
            $data_justlocal["review_by_justLocal"] = $review_by_justLocal;
            $data = array(
                "provincies"        => $provincies->get_provinces_by_country(1),
                "categories"        => $categories->get_categories(),
                "industries"        => $industry->get_all_industries(),
                "random_company"    => $companies->get_random_companies(1),
                "companies"         => $companies->searching_companies($type_company,$province,$city,$branche,$name_company),
                'pager'             => $companies->pager,
                "js"                => array(
                    '<script src="'.base_url("assets/ownsite/js/general/companies.js").'"></script>'
                ),
                'reviews_justLocal' => view('templates/general/reviews_justLocal_view', $data_justlocal),
            );
            echo $this->generate_view($data,"pages/general/searching_companies_view");
        }

        public function insert_user_newsletter() {
            if ($this->request->isAJAX()) {
                $email = $this->request->getPost('email');
                $email = filter_var(strip_tags(trim($email)),FILTER_SANITIZE_EMAIL);
                $newsletter = new NewsletterSubscribersModel();
                $data = array(
                    "email" => $email
                );
                try {
                    $newsletter->insert($data);
                    $response = [
                        'status' => 200,
                        'msg' => "insertado"
                    ];
                    return $this->response->setJSON($response);
                } catch (\Throwable $th) {
                $response = [
                    'status' => 500,
                    'msg' => $newsletter->error()
                    ];
                    return $this->response->setJSON($response);
                }
            } else {
                $response = [
                    'status' => 400,
                    'msg' => "it was no possible insert the email"
                ];
                return $this->response->setJSON($response);
            }
        }

        public function offers()
        {
            $provincies = new ProvincesModel();
            $categories = new CategoriesModel();
            $industry = new IndustryModel();
            $companies = new CompaniesModel();
            $reviews = new ReviewsModel();
            $offers = new OffersModel();
            $review_by_justLocal = $reviews->get_reviews_for_justLocal();
            $data_justlocal["review_by_justLocal"] = $review_by_justLocal;
            $data = array(
                "provincies"        => $provincies->get_provinces_by_country(1),
                "categories"        => $categories->get_categories(),
                "industries"        => $industry->get_all_industries(),
                "random_company"    => $companies->get_random_companies(1),
                "companies"         => $offers->get_all_offers_order(),
                'pager'             => $offers->pager,
                "js"                => array(
                    '<script src="'.base_url("assets/ownsite/js/general/companies.js").'"></script>'
                ),
                'reviews_justLocal' => view('templates/general/reviews_justLocal_view', $data_justlocal),
            );
            echo $this->generate_view($data,"pages/general/searching_companies_view");
        }

        public function offer($slug)
        {
            helper('strings');
            $companies = new CompaniesModel();
            $reviews = new ReviewsModel();
            $offers = new OffersModel();
            $slug = sanitize_string($slug);
            $offer = $offers->get_offer_by_slug($slug);
            $media = new MediaCompanyModel();
            $categories_by_company = new BranchesCompanyModel();
            if (!isset($offer)) return $this->response->setStatusCode(404)->setBody(view('errors/html/error_404'));
            $company = $companies->find($offer[0]->company_id);
            if (!isset($company)) return $this->response->setStatusCode(404)->setBody(view('errors/html/error_404'));
            $reviews_by_company = $reviews->get_reviews_by_company($company["id"]);
            $offers_by_company = $offers->get_offers_by_company($company["id"]);
            $popular_offers = new PopularOffersModel();
            $offers = new OffersModel();
            $popular_offers_data = array(
                "popular_offers"        => $popular_offers->get_all_offers(),
                "random_offers"         => $offers->get_random_offers(5)
            );
            $data_title = array(
                "name"      => $company["name"],
                "rating"    => $company["review"],
                "reviews"   => $reviews_by_company,
                "website"   => $company["website"],
                "offer"     => $offer,
                "categories" => $categories_by_company->get_categories_by_company($company["id"])
            );
            $data_submenu = array(
                "company"   => $company,
                //"rating" => $company["review"],
                "offers"    => $offers_by_company,
                "media"     => $media->get_media_by_company($company["id"])
            );
            $data = array(
                "company"   => $company,
                "reviews"   => $reviews_by_company,
                "offers"    => $offers_by_company,
                "title_company_view" => view("pages/general/snippets/title_company_view",$data_title),
                "submenu_company_view" => view("pages/general/snippets/submenu_company_view",$data_submenu),
                "sidebar_popular_offers_view" => view("pages/general/snippets/sidebar_popular_offers_view",$popular_offers_data),
                "css"       => array(
                    '<link href="'.base_url('assets/css/lightbox.min.css').'" rel="stylesheet"/>'
                ),
                "js"        => array(
                    '<script type="text/javascript" src="'.base_url('assets/js/lightbox.min.js').'"></script>'
                )
            );
            echo $this->generate_view($data,"pages/general/company_view");
        }

        public function contact()
        {
            $data = array();
            echo $this->generate_view($data,"pages/general/contact_view");
        }

        public function about_us()
        {
            $data = array();
            echo $this->generate_view($data,"pages/general/about_us_view");
        }

        public function companies_by_cities($province_slug,$city_slug)
        {
            
            helper('strings');
            $provinces = new ProvincesModel();
            $cities = new CitiesModel();
            $province_slug = sanitize_string($province_slug);
            $city_slug = sanitize_string($city_slug);
            $province = $provinces->get_province_by_slug($province_slug);
            $city = $cities->get_city_by_slug($city_slug);
            if (!isset($province) || !isset($city)) return $this->response->setStatusCode(404)->setBody(view('errors/html/error_404'));
            $companies = new CompaniesModel();
        
            $companies_by_province_and_city = $companies->get_companies_by_province_cities($province->id,$city->id);
            $data = array(
                "companies" => $companies_by_province_and_city,
                'pager'     => $companies->pager,
                "js"                => array(
                    '<script src="'.base_url("assets/ownsite/js/general/companies.js").'"></script>'
                ),
            );
            echo $this->generate_view($data,"pages/general/companies_by_cities_view");
        }

        public function provinces($province_slug = null)
        {
            helper('strings');
            $provinces = new ProvincesModel();
            if(isset($province_slug)){
                $province_slug = sanitize_string($province_slug);
                $province = $provinces->get_province_by_slug($province_slug);
                if (!isset($province)) return $this->response->setStatusCode(404)->setBody(view('errors/html/error_404'));
                $cities_by_company_count = $provinces->get_cities_company_counts_by_province($province->id);
            }
            $companies = new CompaniesModel();
            $reviews = new ReviewsModel();
            $review_by_justLocal = $reviews->get_reviews_for_justLocal();
            $data_justlocal["review_by_justLocal"] = $review_by_justLocal;
            $data = array(
                "random_company"    => $companies->get_random_companies(1),
                'reviews_justLocal' => view('templates/general/reviews_justLocal_view', $data_justlocal),
                'provinces'         => $cities_by_company_count??$provinces->get_province_company_counts(1),
                'js'                => array(
                    '<script src="'.base_url("assets/ownsite/js/general/companies.js").'"></script>',
                    '<script src="'.base_url("assets/ownsite/js/general/favourite.js").'"></script>'
                ),
            );
            echo $this->generate_view($data,"pages/general/provinces_view");
        }

        public function favorite()
        {
            $liked_offer_companies = new LikedOffersUserModel();
            $ip = $this->request->getIPAddress();
            $data = array(
                "liked_companies" => $liked_offer_companies->get_all_data_offer_companies_liked_user($ip,"company"),
                "liked_offers" => $liked_offer_companies->get_all_data_offer_companies_liked_user($ip,"offer"),
                'js'                => array(
                    '<script src="'.base_url("assets/ownsite/js/general/favourite.js").'"></script>'
                ),
            );
            echo $this->generate_view($data,"pages/general/favorites_view");
        }

        public function change_password($user_id)
        {
            $users = new UsersModel();
            $user = $users->find($user_id);
            if ($user["change_password"] === "0") return $this->response->setStatusCode(404)->setBody(view('errors/html/error_404'));
            echo $this->generate_view([],"pages/general/change_password_view");
        }

    }
