<style>
    .preview-img{
        max-width: 100px;
    }
    .row{
        margin-bottom: 15px;
    }
</style>
    <div class="container mt-5 mb-5">
        <div id="liveAlertPlaceholder"></div>
        <div class="card">
            <div class="card-header">
                Home settings
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home settings header</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Carousel companies</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Populaire aanbiedingen</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Hoe het werkt</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">Reviews klanten</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="border p-2 mb-3">
                            <form action="" id="carousel_form_head" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title_home" class="form-label">Title home page</label>
                                            <input type="text" name="title_home" id="title_home" class="form-control" value="<?php echo $local_company->title_in_main ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description_home">Description:</label>
                                            <textarea class="form-control" name="description_home" id="description_home" rows="3"><?php echo $local_company->description_in_main ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image_principal" class="form-label">Principal image</label>
                                            <input type="file" class="form-control input-image" id="image_principal" accept="image/*" name="image_principal">
                                            <img class="preview-img" id="image_principal_prev" src="<?= isset($local_company->image_principal) ? base_url($local_company->image_principal) : '#' ?>" alt="Preview" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image_deco1" class="form-label">Decoration</label>
                                            <input type="file" class="form-control input-image" id="image_deco1" accept="image/*" name="image_deco1">
                                            <img class="preview-img" id="image_deco1_prev" src="<?= isset($local_company->images_deco1) ? base_url($local_company->images_deco1) : '#' ?>" alt="Preview" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image_deco2" class="form-label">Decoration</label>
                                            <input type="file" class="form-control input-image" id="image_deco2" accept="image/*" name="image_deco2">
                                            <img class="preview-img" id="image_deco2_prev" src="<?= isset($local_company->images_deco2) ? base_url($local_company->images_deco2) : '#' ?>" alt="Preview" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="border p-2 mb-3">
                            <h4>Order of Carousel</h4>
                            <form action="" id="carousel_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="url_image_carousel" class="form-label">Link to redirect</label>
                                            <input type="text" class="form-control" id="url_image_carousel" placeholder="https://www.example.com" name="link">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_in_carousel" class="form-label">Pages</label>
                                            <select id="" class="form-control" name="page">
                                                <option value="home">Home</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image_carousel" class="form-label">Choose your image</label>
                                            <input type="file" class="form-control input-image" id="image_carousel" accept="image/*" name="image">
                                            <img class="preview-img" id="image_carousel_prev" src="#" alt="Preview" />
                                        </div>
                                    </div>                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="my-2">
                                <ul id="sortable">
                                    <?php $item=0?><?php foreach($carousels as $carousel):?>
                                        <li class="ui-state-default d-flex justify-content-between" data-id="<?=$carousel->id?>" data-order="<?=$carousel->order_image?>"><?=++$item?>
                                            <a href="<?=$carousel->url_redirect?>"><?=$carousel->url_redirect?></a><img class="img-banner-admin" src="<?=base_url($carousel->url_image)?>" alt="aqui">
                                        </li>
                                    <?php endforeach?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <div class="border mb-3 p-2">
                            <form action="" id="offers_order_form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company_id" class="form-label">Company</label>
                                            <select id="company_id" class="form-control" name="company_id">
                                                <option value="">Select a company</option>
                                                <?php foreach($companies_select as $company):?>
                                                    <option value="<?=$company->id?>"><?=$company->name?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="offer_id" class="form-label">Offer</label>
                                            <select id="offer_id" class="form-control" name="offer_id">
                                                <option value="">Select an Offer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-3">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table <?=isset($popular_offers) && count($popular_offers)>0?false:'d-none'?>" id="table_popular_offers">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Offer</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($popular_offers) && count($popular_offers)>0):?>
                                        <?php foreach($popular_offers as $offer):?>
                                            <tr>
                                                <td><?=$offer->name?></td>
                                                <td><?=$offer->title?></td>
                                                <td>
                                                    <span data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?=$offer->id?>" class="text-danger delete-icon"><i class="fa-solid fa-trash" title="delete"></i></span>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿ Are you sure to delete it ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="delete_popular_offer" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
                        <div class="border p-2 mb-3">
                            <h4>All comments</h4>
                            <form id="how_it_works_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="comment_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="comment_title" placeholder="Title" name="icon_html">
                                        </div>
                                    </div>                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="icon_html" class="form-label">Font awesome icon in HTML</label>
                                            <input type="text" class="form-control" id="icon_html" placeholder="Title" name="icon_html">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="my-2">
                                <table class="table" id="table_how_it_works">
                                    <thead>
                                        <tr>
                                            <th>Comment</th>
                                            <th>Icon</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($how_it_works):?>
                                            <?php foreach ($how_it_works as $comment):?>
                                                <tr data-id="<?=$comment->id?>">
                                                    <td><?=$comment->comment?></td>
                                                    <td><?=$comment->icon_html?></td>
                                                    <td class="text-danger">
                                                        <span class="delete-icon" data-bs-toggle="modal" data-bs-target="#howWorkModal" data-id="<?=$comment->id?>"><i class="fa-solid fa-trash" title="delete"></i></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="howWorkModal" tabindex="-1" aria-labelledby="howWorkModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿ Are you sure to delete it ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="delete_how_it_work" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
                        <div class="border p-2 mb-3">
                            <form id="review_justlocal">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_user" class="form-label">Name user</label>
                                            <input type="text" class="form-control" id="name_user" placeholder="Title" name="name_user">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="job_description" class="form-label">Job description</label>
                                            <input type="text" class="form-control" id="job_description" placeholder="Job description" name="job_description">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment">Comment</label>
                                            <textarea class="form-control" id="comment_review" name="comment_review" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="review_image" class="form-label">Image review</label>
                                            <input type="file" class="form-control input-image" id="review_image" accept="image/*" name="image">
                                            <img class="preview-img" id="review_image_prev" src="#" alt="Preview" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                            <div class="my-2">
                                <ul id="sortable">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- <h2>Home settings header</h2>
                <div class="border p-2 mb-3">

                    <form action="" id="carousel_form_head" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title_home" class="form-label">Title home page</label>
                                    <input type="text" name="title_home" id="title_home" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description_home">Description:</label>
                                    <textarea class="form-control" id="description_home" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image_principal" class="form-label">Principal image</label>
                                    <input type="file" class="form-control input-image" id="image_principal" accept="image/*" name="image">
                                    <img class="preview-img" id="image_principal_prev" src="#" alt="Preview" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image_deco1" class="form-label">Decoration</label>
                                    <input type="file" class="form-control input-image" id="image_deco1" accept="image/*" name="image">
                                    <img class="preview-img" id="image_deco1_prev" src="#" alt="Preview" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image_deco2" class="form-label">Decoration</label>
                                    <input type="file" class="form-control input-image" id="image_deco2" accept="image/*" name="image">
                                    <img class="preview-img" id="image_deco2_prev" src="#" alt="Preview" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <h2>Carousel companies</h2>
                <div class="border p-2 mb-3">
                    <h4>Order of Carousel</h4>
                    <form action="" id="carousel_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="url_image_carousel" class="form-label">Link to redirect</label>
                                    <input type="text" class="form-control" id="url_image_carousel" placeholder="https://www.example.com" name="link">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order_in_carousel" class="form-label">Pages</label>
                                    <select id="" class="form-control" name="page">
                                        <option value="home">Home</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_carousel" class="form-label">Choose your image</label>
                                    <input type="file" class="form-control input-image" id="image_carousel" accept="image/*" name="image">
                                    <img class="preview-img" id="image_carousel_prev" src="#" alt="Preview" />
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="my-2">
                        <ul id="sortable">
                            <?php $item=0?><?php foreach($carousels as $carousel):?>
                                <li class="ui-state-default d-flex justify-content-between" data-id="<?=$carousel->id?>" data-order="<?=$carousel->order_image?>"><?=++$item?>
                                    <a href="<?=$carousel->url_redirect?>"><?=$carousel->url_redirect?></a><img class="img-banner-admin" src="<?=base_url($carousel->url_image)?>" alt="aqui">
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                </div>
                <h2>Populaire aanbiedingen</h2>
                <div class="border mb-3 p-2">
                    <form action="" id="offers_order_form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_id" class="form-label">Company</label>
                                    <select id="company_id" class="form-control" name="company_id">
                                        <option value="">Select a company</option>
                                        <?php foreach($companies_select as $company):?>
                                            <option value="<?=$company->id?>"><?=$company->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="offer_id" class="form-label">Offer</label>
                                    <select id="offer_id" class="form-control" name="offer_id">
                                        <option value="">Select an Offer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table <?=isset($popular_offers) && count($popular_offers)>0?false:'d-none'?>" id="table_popular_offers">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Offer</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($popular_offers) && count($popular_offers)>0):?>
                                <?php foreach($popular_offers as $offer):?>
                                    <tr>
                                        <td><?=$offer->name?></td>
                                        <td><?=$offer->title?></td>
                                        <td><span class="text-danger"><i class="fa-solid fa-trash" data-id="<?=$offer->id?>" title="delete"></i></span></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <h2>Hoe het werkt</h2>
                <div class="border p-2 mb-3">
                    <h4>All comments</h4>
                    <form id="how_it_works_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="comment_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="comment_title" placeholder="Title" name="icon_html">
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon_html" class="form-label">Font awesome icon in HTML</label>
                                    <input type="text" class="form-control" id="icon_html" placeholder="Title" name="icon_html">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="my-2">
                        <table class="table" id="table_how_it_works">
                            <thead>
                                <tr>
                                    <th>Comment</th>
                                    <th>Icon</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($how_it_works):?>
                                    <?php foreach ($how_it_works as $comment):?>
                                        <tr data-id="<?=$comment->id?>">
                                            <td><?=$comment->comment?></td>
                                            <td><?=$comment->icon_html?></td>
                                            <td class="text-danger"><span><i class="fa-solid fa-trash" title="delete"></i></span></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h2>Reviews klanten</h2>
                <div class="border p-2 mb-3">
                    <form id="review_justlocal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_user" class="form-label">Name user</label>
                                    <input type="text" class="form-control" id="name_user" placeholder="Title" name="name_user">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="job_description" class="form-label">Job description</label>
                                    <input type="text" class="form-control" id="job_description" placeholder="Job description" name="job_description">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control" id="comment_review" name="comment_review" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="review_image" class="form-label">Image review</label>
                                    <input type="file" class="form-control input-image" id="review_image" accept="image/*" name="image">
                                    <img class="preview-img" id="review_image_prev" src="#" alt="Preview" />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                    <div class="my-2">
                        <ul id="sortable">
                            
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>