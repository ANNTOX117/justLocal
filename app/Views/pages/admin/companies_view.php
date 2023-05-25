<link rel="stylesheet" href="<?=base_url('assets/css/general.css')?>">
<main id="return_pagination" class="container my-5 main">
    <div id="liveAlertPlaceholder"></div>
    <div class="row">

        <div class="col-md-4">
            <h3>All companies</h3>
            <div class="list-group">
                <?php if(isset($companies) && !empty($companies)):?>
                    <?php foreach ($companies as $company):?>
                        <button id="button_company_<?=$company['id']??false?>" type="button" class="list-group-item list-group-item-action company-button" data-id="<?=$company['id']??false?>"><?=$company['name']??false?></button>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="d-flex justify-content-center mt-4" id="pagination">
                <?php if ($pager) :?>
                    <?= $pager->links() ?>
                <?php endif ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Company Information
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="companyName">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter company name">
                    </div>
                    <div class="form-group">
                        <label for="companyDescription">Description</label>
                        <textarea name="companyDescription" class="form-control" id="companyDescription" cols="30" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="companyImage">Image brand <span class="text-danger">*</span></label>
                        <input type="file" name="companyImage" id="companyImage" class="form-control input-image" accept="image/png, image/gif, image/jpeg">
                    </div>
                    <div class="mt-3" id="image-preview">
                        <img id="companyImage_prev" src="" alt="Preview Image">
                    </div>
                    <div class="form-group">
                        <label for="companyImageBg">Image background <span class="text-danger">*</span></label>
                        <input type="file" name="companyImageBg" id="companyImageBg" class="form-control input-image" accept="image/png, image/gif, image/jpeg">
                    </div>
                    <div class="mt-3" id="image-preview-bg">
                        <img id="companyImageBg_prev" src="" alt="Preview Image">
                    </div>
                    <div class="form-group">
                        <label for="companyEmail">Email address</label>
                        <input type="email" class="form-control" id="companyEmail" name="companyEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="companyPhone">Phone Number</label>
                        <input type="tel" class="form-control" id="companyPhone" name="companyPhone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label for="companyWebsite">Web site</label>
                        <input type="tel" class="form-control" id="companyWebsite" name="companyWebsite" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label for="companyAddress">Address</label>
                        <textarea name="companyAddress" class="form-control" id="companyAddress" cols="30" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="companyCategory">Category <span class="text-danger">*</span></label>
                        <select name="category" class="form-control" id="companyCategory">
                            <?php if(isset($categories) && !empty($categories)):?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                            <?php else:?>
                                <option value="">There is no categories</option>
                            <?php endif?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="companyIndustry">Industry<span class="text-danger">*</span></label>
                        <select name="industry" class="form-control" id="companyIndustry">
                            <?php if(isset($industries) && !empty($industries)):?>
                            <?php foreach ($industries as $industry): ?>
                                <option value="<?= $industry->id ?>"><?= $industry->name ?></option>
                            <?php endforeach; ?>
                            <?php else:?>
                                <option value="">There is no industries</option>
                            <?php endif?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="companyType">Type company<span class="text-danger">*</span></label>
                        <select name="type_company" class="form-control" id="companyType">
                            <?php if(isset($type_companies) && !empty($type_companies)):?>
                            <?php foreach ($type_companies as $type_company): ?>
                                <option value="<?= $type_company->id ?>"><?= $type_company->name ?></option>
                            <?php endforeach; ?>
                            <?php else:?>
                                <option value="">There is no industries</option>
                            <?php endif?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="companyFacebook">Facebook url</label>
                        <input type="tel" class="form-control" id="companyFacebook" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label for="companyInstagram">Instagram</label>
                        <input type="tel" class="form-control" id="companyInstagram" placeholder="Enter phone number">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="companyCountry">Country <span class="text-danger">*</span></label>
                                <select name="country" class="form-control" id="companyCountry">
                                <option value="">Select a country</option>
                                    <?php if(isset($countries) && !empty($countries)):?>
                                        <?php foreach ($countries as $country): ?>
                                            <option value="<?=$country->id?>"><?=$country->name?></option>
                                        <?php endforeach; ?>
                                    <?php endif?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group d-none" id="provinces">
                                <label for="companyProvince">Province <span class="text-danger">*</span></label>
                                <select name="province" class="form-control" id="companyProvince">
                                    <option value="">Select Provinces</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group d-none" id="cities">
                                <label for="companyCities">Cities <span class="text-danger">*</span></label>
                                <select name="city" class="form-control" id="companyCities">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 form-check">
                        <input type="checkbox" class="form-check-input" id="blockCompany">
                        <label class="form-check-label" for="blockCompany" name="blockCompany">Active</label>
                    </div>
                    <button class="btn btn-primary mt-3" id="companyForm">Submit</button>


                    <div>
                        <br>
                        <h4>Reviews</h4>
                    </div>
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
                    <!-- <div>
                        <br>
                        <h4>Offers</h4>
                    </div>
                    <div class="border p-2 mb-3">
                            <form id="offers_justlocal">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="offer_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="offer_title" placeholder="Title" name="offer_title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_offer" class="form-label">Discount</label>
                                            <input type="text" class="form-control" id="discount_offer" placeholder="Discount" name="discount_offer">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="review_offer" class="form-label">Review</label>
                                            <input type="text" class="form-control" id="review_offer" placeholder="Review" name="review_offer">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="companyCountryOffer">Country <span class="text-danger">*</span></label>
                                            <select name="companyCountryOffer" class="form-control" id="companyCountryOffer">
                                            <option value="">Select a country</option>
                                                <?php if(isset($countries) && !empty($countries)):?>
                                                    <?php foreach ($countries as $country): ?>
                                                        <option value="<?=$country->id?>"><?=$country->name?></option>
                                                    <?php endforeach; ?>
                                                <?php endif?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group d-none" id="provincesOffer">
                                            <label for="companyProvinceOffer">Province <span class="text-danger">*</span></label>
                                            <select name="companyProvinceOffer" class="form-control" id="companyProvinceOffer">
                                                <option value="">Select Provinces</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group d-none" id="citiesOffer">
                                            <label for="companyCitiesOffer">Cities <span class="text-danger">*</span></label>
                                            <select name="companyCitiesOffer" class="form-control" id="companyCitiesOffer">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description_offer">Description</label>
                                            <textarea class="form-control" id="description_offer" name="description_offer" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div> -->

                        
                </div>
            </div>
        </div>
    </div>
</main>