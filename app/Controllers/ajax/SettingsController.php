<?php

namespace App\Controllers\Ajax;

use App\Controllers\BaseController;
use App\Models\BrancheModel;
use App\Models\CarouselModel;
use App\Models\CategoriesModel;
use App\Models\CitiesModel;
use App\Models\CompaniesModel;
use App\Models\ContactModel;
use App\Models\HowItWorksModel;
use App\Models\IndustryModel;
use App\Models\LikedOffersUserModel;
use App\Models\MediaCompanyModel;
use App\Models\OffersModel;
use App\Models\PopularOffersModel;
use App\Models\ProvincesModel;
use App\Models\PageConfigModel;
use App\Models\ReviewsModel;
use App\Models\UsersModel;

class SettingsController extends BaseController
{     
    public function index()
    {
        //
    }

    public function insertCarouselDos()
    { 
        helper(['form', 'url']);

        if ($_SERVER['CONTENT_LENGTH'] > 2024) {
            $response = [
                'success' => false,
                'data' => '',
                'msg' => "Image could not upload"
            ];
            return $this->response->setJSON($response);
        }
        $database = \Config\Database::connect();
        $builder = $database->table('users');
        $validateImage = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file, image/png, image/jpg,image/jpeg, image/gif]',
                'max_size[file, 4096]',
            ],
        ]);
    
        $response = [
            'success' => false,
            'data' => '',
            'msg' => "Image could not upload"
        ];
        if ($validateImage) {
            $imageFile = $this->request->getFile('file');
            $imageFile->move(WRITEPATH . 'uploads');
            $data = [
                'img_name' => $imageFile->getClientName(),
                'file'  => $imageFile->getClientMimeType()
            ];
            $save = $builder->insert($data);
            $response = [
                'success' => true,
                'data' => $save,
                'msg' => "Image successfully uploaded"
            ];
        }
        return $this->response->setJSON($response);
    }

    public function insertCarousel()
    {
        try{
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $_FILES['image'];
                $directory  = "uploads/carousel/home/";
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                move_uploaded_file($image['tmp_name'],$directory.$image['name']);
                try {
                    $carousel = new CarouselModel();
                    $data = array(
                        "url_image" => "uploads/carousel/home/".$image['name'],
                        "url_redirect" => $_POST['link'],
                        "page" => $_POST['page'],
                    );
                    $id_carousel = $carousel->insert_carousel_by_page("home",$data);
                    $response = array('status' => 'success', 'message' => 'done',"id"=>$id_carousel);
                    echo json_encode($response);
                    return;
        
                } catch (\Exception $e) {
                    $response = array('status' => 'error', 'message' => $e->getMessage());
                    echo json_encode($response);
                    return;
                }
            }
            else {
                // Return an error response
                $response = array('status' => 'error', 'message' => 'Failed to upload image');
                echo json_encode($response);
                return;
            }
        } catch(\Exception $e){
            $response = array('status' => 'error', 'message' => $e->getMessage(), 'line' => $e->getLine());
            echo json_encode($response);
        }
    }

    public function delete_offer($id){
        $offer = new PopularOffersModel();
        $offer->delete($id);
        $response = [
            'success' => true,
            'msg' => "Offer successfully deleted"
        ];
        return $this->response->setJSON($response);
    }

    public function offer_delete($id){
        $pop_offer = new PopularOffersModel();
        $pop_offer->deleteWhere($id);
        $offer = new OffersModel();
        $offer->delete($id);
        $response = [
            'success' => true,
            'msg' => "Offer successfully deleted"
        ];
        return $this->response->setJSON($response);
    }
    
    public function delete_howWork($id){
        $how_delete = new HowItWorksModel();
        $how_delete->delete($id);
        $response = [
            'success' => true,
            'msg' => "Element successfully deleted"
        ];
        return $this->response->setJSON($response);
    }

    public function getDataCarouselById($id_carousel)
    {
        $carousel = new CarouselModel();
        $data_carousel = $carousel->find($id_carousel);
        $response = array("info" => $data_carousel);
        echo json_encode($response);
        return;
    }

    public function get_offers_by_company($company_id)
    {
        $offers = new OffersModel();
        echo json_encode($offers->get_offers_by_company($company_id));
    }

    public function insert_popular_offer()
    {
        $offer_id = $_POST["offer_id"];
        $popular_offers = new PopularOffersModel();
        $data = array(
            "offer_id" => $offer_id
        );
        echo $popular_offers->insert($data);
    }

    public function popular_offer($id_popular_offer)
    {
        $popular_offer = new PopularOffersModel();
        echo json_encode($popular_offer->get_popular_offer_data($id_popular_offer));
    }

    public function delete_user($id_user)
    {
        $user = new UsersModel();
        echo $user->delete_user($id_user);
    }

    public function insert_how_it_works()
    {
        $how_it_works = new HowItWorksModel();
        $validateRequest = $this->validate([
            'comment' => 'required|string',
            'icon_html' => 'required|string',
            'title' => 'required|string',
        ]);
        
        $response = [
            'success' => false,
            'data' => '',
            'msg' => "Upload error"
        ];

        if($validateRequest){
            $data = array(
                "comment" => $_POST["comment"],
                "icon_html" => $_POST["icon_html"],
                "title" => $_POST["comment_title"],
            );
            $id_comment = $how_it_works->insert($data);
            $data = array(
                "status" => 200,
                "id"    => $id_comment,
                "msg"   => "inserted"
            );
            echo json_encode($data);
        }
        return $this->response->setJSON($response);
    }

    public function provinces_by_country($id_country)
    {
        $provinces = new ProvincesModel();
        echo json_encode($provinces->get_provinces_by_country($id_country));
    }

    public function cities_by_provinces($id_city, $type)
    {
        $cities = new CitiesModel();
        echo json_encode($cities->get_all_cities_by_province($id_city, null));
    }

    public function cities_by_provinceId($id_province)
    {
        $cities = new CitiesModel();
        echo json_encode($cities->get_all_cities_by_provinceId($id_province));
    }

    public function branches_by_city($id_city, $type)
    {
        $branches = new BrancheModel();
        echo json_encode($branches->get_branches_city($id_city, $type));
    }

    public function get_offer($id){
        $offer = new OffersModel();
        return json_encode($offer->get_with_info($id));
    }

    public function insert_offer()
    {
        //$how_it_works = new HowItWorksModel();
        helper("strings");
        $offers = new OffersModel();
        $edit_offer = $_POST["id_offer"];
        $data = array(
            "title" => $_POST["offerName"],
            "slug" => create_slug($_POST["offerName"]),
            "description" => $_POST["offerDescription"],
            "review" => number_format((float)$_POST["review"], 1, '.', ''),
            "discount" => $_POST["discount"],
            "city_id" => $_POST["city"],
            "company_id" => $_POST["company"],
            "block" => $_POST["blockOffer"]===NULL?0:1,
        );
        if(isset($edit_offer)){
            $id_offer = $offers->update($edit_offer, $data);
        } else {
            $id_offer = $offers->insert($data);
        }
        $data = array(
            "status" => 200,
            "id"    => $id_offer,
            "msg"   => "inserted"
        );
        echo json_encode($data);
    }

    public function insert_carousel_head()
    {
        $home_page = new PageConfigModel();
        helper("strings");
        $data = array(
            "title_in_main" => $_POST["title_home"],
            "description_in_main" => $_POST["description_home"],
            "company_id"    => 1, //Company Id check
            "block" => 1,
            "page_id" => 1
        );
        $image_principal = isset($_FILES['image_principal']) ? $_FILES['image_principal'] : null;
        $image_deco1 = isset($_FILES['image_deco1']) ? $_FILES['image_deco1'] : null;
        $image_deco2 = isset($_FILES['image_deco2']) ? $_FILES['image_deco2'] : null;
        // var_dump($image_principal, $image_deco1, $image_deco2); die();
        try {
            // if (isset($_FILES['image_pricipal']) && $_FILES['image_pricipal']['error'] == 0) {
            if (isset($image_principal) && $image_principal['error'] == 0) {
                $image = $image_principal;
                $directory  = "assets/ownsite/img/";
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                move_uploaded_file($image['tmp_name'],$directory.$image['name']);
                $data["image_principal"] = "assets/ownsite/img/".$image['name'];
            }
            // if (isset($_FILES['image_deco1']) && $_FILES['image_deco1']['error'] == 0) {
            if (isset($image_deco1) && $image_deco1['error'] == 0) {
                $image = $image_deco1;
                $directory  = "assets/ownsite/img/";
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                move_uploaded_file($image['tmp_name'],$directory.$image['name']);
                // array_push($data, ["images_deco1" => "assets/ownsite/img/".$image['name']]);
                $data["images_deco1"] = "assets/ownsite/img/".$image['name'];
            }

            // if (isset($_FILES['image_deco2']) && $_FILES['image_deco2']['error'] == 0) {
            if (isset($image_deco2) && $image_deco2['error'] == 0) {
                $image = $image_deco2;
                $directory  = "assets/ownsite/img/";
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                move_uploaded_file($image['tmp_name'],$directory.$image['name']);
                // array_push($data, ["images_deco2" => "assets/ownsite/img/".$image['name']]);
                $data["images_deco2"] = "assets/ownsite/img/".$image['name'];
            }
            
            $id_page = $home_page->update(1, $data);
            $data = array(
                "status" => 200,
                "id"    => $id_page,
                "msg"   => "inserted"
            );
            echo json_encode($data);
            // echo $review->insert($data);

        } catch (\Exception $e) {
            $response = array('status' => 'error', 'message' => $e->getMessage(), 'line' => $e->getLine());
            echo json_encode($response);
        }
    }

    public function insert_review()
    {
        $review = new ReviewsModel();
        helper("strings");
        $data = array(
            "content" => sanitize_string($_POST["comment_review"],"none"),
            "creator_name" => sanitize_string($_POST["name_user"],"none"),
            "job_description" => sanitize_string($_POST["job_description"],"none"),
            "company_id"    => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1
        );
        try {
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $_FILES['image'];
                $directory  = "uploads/reviews/";
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                move_uploaded_file($image['tmp_name'],$directory.$image['name']);
                // $data['img_reviewer'] = "uploads/reviews/".$image['name'];
                array_push($data, ["job_description" => "uploads/reviews/".$image['name']]);
            }
            // var_dump($data);
            
            $id_comment = $review->insert($data);
            $data = array(
                "status" => 200,
                "id"    => $id_comment,
                "msg"   => "inserted"
            );
            echo json_encode($data);
            // echo $review->insert($data);

        } catch (\Exception $e) {
            $response = array('status' => 'error', 'message' => $e->getMessage(), 'line' => $e->getLine());
            echo json_encode($response);
        }
    }

    public function insert_multiple_image()
    {
        $files = $this->request->getFiles();
        $media = new MediaCompanyModel();
        $id = $_POST["id"];
        $uploadPath = 'uploads/company/'.$id."/media";
        foreach ($files['images'] as $image) {
            if ($image->isValid() && ! $image->hasMoved()) {
                $newName = $image->getRandomName();
                $image->move($uploadPath, $newName);
                $media->insert([
                    "name_file"  =>  $newName,
                    "company_id"  =>  $id,
                    "type"  =>  "images",
                ]);
            }
        }
    }

    public function insert_contact_message()
    {
        helper("strings");
        $data_error = [];
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => [
                'label' => 'name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'The {field} field is required.',
                    'is_unique' => 'The {field} is already taken.',
                ],
            ],
            'email' => [
                'label' => 'email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'The {field} field is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'is_unique' => 'The {field} is already taken.',
                ],
            ],
            'message' => 'required',
        ]);
        if (!$validation->run($this->request->getPost())) array_push($data_error,$validation->getErrors());
        $errors = $data_error[0]??[];
        if (count($errors)>0) return $this->response->setStatusCode(404)->setJSON($errors);
        $contact = new ContactModel();
        try {
            $contact->insert([
                "name" => $this->request->getPost("name"),
                "email" => $this->request->getPost("email"),
                "message" => $this->request->getPost("message"),
            ]);
            return $this->response->setStatusCode(202)->setJSON(["success"=>"Thanks"]);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404)->setJSON(["no_insert"=>"it was no possible insert the information"]);
        }
        
    }

    public function like_offer_or_company()
    {
        helper("strings");
        $ip_user = $this->request->getIPAddress();
        $id = $this->request->getPost("id");
        $type = sanitize_string($this->request->getPost("type"),"lower");
        $type = $type === "offer"?"offer":"company";
        $liked_user_offer = new LikedOffersUserModel();
        $data = [
            "offer_id" => $id,
            "ip_user" => $ip_user,
            "type"  => $type
        ];
        try {
            $liked_user_offer->check_if_ip_and_offer_exist_and_add_or_delete($data);
            return $this->response->setStatusCode(202)->setJSON(["success"=>"done"]);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404)->setJSON(["error"=>"it was no possible add the company in your favorites"]);
        }
    }

    public function get_liked_offers_by_ip($type="offer")
    {
        helper("strings");
        $ip = $this->request->getIPAddress();
        $type = sanitize_string($type,"lower")==="offer"?"offer":"company";
        $liked_user_offer = new LikedOffersUserModel();
        return $this->response->setStatusCode(202)->setJSON(["offers_liked"=>$liked_user_offer->get_all_offers_user($ip,$type)]);
    }

    public function return_pagination_company()
    {
        $province = $this->request->getGet("provincie") ===""?null:$this->request->getGet("provincie");
        $city = $this->request->getGet("stad") ===""?null:$this->request->getGet("stad");
        $branche = $this->request->getGet("branche") ===""?null:$this->request->getGet("branche");
        $type_company = $this->request->getGet("type_company") ===""?null:$this->request->getGet("type_company");
        $name_company = $this->request->getGet("name_company") ===""?null:$this->request->getGet("name_company");
        if ($type_company === "3") $type_company = NULL;
        $companies = new CompaniesModel();
        // $reviews = new ReviewsModel();
        //$review_by_justLocal = $reviews->get_reviews_for_justLocal();
        //$data_justlocal["review_by_justLocal"] = $review_by_justLocal;
        $all_companies = $companies->searching_companies($type_company,$province,$city,$branche,$name_company);
        //$paper = $companies->pager;
        $splitArrays = array_chunk($all_companies, 6);
        $data = array(
            "companies"         => $splitArrays[0]??[],
        );
        $data2 = array(
            "companies"         => $splitArrays[1]??[],
            
        );
        $views = array(
            "first_part"    => view("pages/general/snippets/grid_cards_company_view",$data),
            "second_part"   =>  view("pages/general/snippets/grid_cards_company_view",$data2),
            'pager'         => $companies->pager
        );
        return $this->response->setStatusCode(202)->setJSON(["views"=>$views]);
    }

    public function return_pagination_offer()
    {
        $province = $this->request->getGet("provincie") ===""?null:$this->request->getGet("provincie");
        $city = $this->request->getGet("stad") ===""?null:$this->request->getGet("stad");
        $branche = $this->request->getGet("branche") ===""?null:$this->request->getGet("branche");
        $type_company = $this->request->getGet("type_company") ===""?null:$this->request->getGet("type_company");
        if ($type_company === "3") $type_company = NULL;
        $offers = new OffersModel();
    
        $all_companies = $offers->get_all_offers_order_condition($type_company,$province,$city,$branche);
        
        $splitArrays = array_chunk($all_companies, 6);
        $data = array(
            "companies"         => $splitArrays[0]??[],
        );
        $data2 = array(
            "companies"         => $splitArrays[1]??[],
            
        );
        $views = array(
            "first_part"    => view("pages/general/snippets/grid_cards_company_view",$data),
            "second_part"   =>  view("pages/general/snippets/grid_cards_company_view",$data2),
            'pager'         => $offers->pager
        );
        return $this->response->setStatusCode(202)->setJSON(["views"=>$views]);
    }

    public function get_info_user($user_id)
    {
        $users = new UsersModel();
        $user = $users->get_user_by_id($user_id);
        return $this->response->setStatusCode(202)->setJSON(["user"=>$user]);
    }
    public function update_user_info($user_id)
{
    $users = new UsersModel();
    $user = $users->find($user_id);

    if (!$user) {
        return $this->response->setStatusCode(404)->setJSON(["error" => "User not found"]);
    }

    $name = $this->request->getPost("name");
    $email = $this->request->getPost("email");
    $blockUser = $this->request->getPost("blockUser") == 'true' ? 1 : 0;
    $deleteUser = $this->request->getPost("deleteUser") == 'true' ? 1 : 0;
    $approveUser = $this->request->getPost("approveUser") == 'true' ? 1 : 0;
    $activeUser = $this->request->getPost("activeUser") == 'true' ? 1 : 0;
    $verifiedUser = $this->request->getPost("verifiedUser") == 'true' ? 1 : 0;

    try {
        $users->update($user_id, [
            'name' => $name,
            'email' => $email,
            'blocked' => $blockUser,
            'active' => $activeUser,
            'verified' => $verifiedUser,
            'deleted' => $deleteUser,
            'approved' => $approveUser,
        ]);
        return $this->response->setStatusCode(202)->setJSON(["success" => "success"]);
    } catch (\Throwable $th) {
        return $this->response->setStatusCode(500)->setJSON(["error" => $th->getMessage()]);
    }
}



    
}
