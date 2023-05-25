<section class="section section--businesses">
    <img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background drag-none">
    <section class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="section--hero__content">
                    <div class="alert alert-success d-none" id="success_insert_company"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="section--hero__content">
                                <h1 class="title title--main"><?=lang("Register.title")?></h1>
                                <p class="paragraph"><?=lang("Register.paragraph")?></p>
                            </div>
                            <hr>
                            <div class="col-md-10">
                                <ul class="porto-info-list">
                                    <li class="porto-info-list-item"><i class="p-2 fas fa-map-marker-alt"></i><span><?=lang("Register.list_1")?></span></li>
                                    <li class="porto-info-list-item"><i class="p-2 fas fa-map-marker-alt"></i><span><?=lang("Register.list_2")?></span></li>
                                    <li class="porto-info-list-item"><i class="p-2 fas fa-map-marker-alt"></i><span><?=lang("Register.list_3")?></span></li>
                                    <li class="porto-info-list-item"><i class="p-2 fas fa-map-marker-alt"></i><span><?=lang("Register.list_4")?></span></li>
                                    <li class="porto-info-list-item"><i class="p-2 fas fa-map-marker-alt"></i><span><?=lang("Register.list_5")?></span></li>
                                    <li class="porto-info-list-item"><i class="p-2 fas fa-map-marker-alt"></i><span><?=lang("Register.list_6")?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" id="register_company_form" method="post">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name_company" class="form-label"><?=lang("Register.label_name_company")?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name_company" placeholder="<?=lang("Register.label_name_company")?>" name="name_company">
                                                    <div class="text-danger d-block error_input" id="name_company_error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name_contac_person" class="form-label"><?=lang("Register.label_name_contact")?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name_contac_person" placeholder="<?=lang("Register.label_name_contact")?>" name="name_contac_person">
                                                    <div class="text-danger d-block error_input" id="name_contac_person_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number" class="form-label"><?=lang("Register.label_title_company")?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title_company" placeholder="<?=lang("Register.label_title_company")?>" name="title_company">
                                            <div class="text-danger d-block error_input" id="title_company_error"></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="website" class="form-label"><?=lang("Register.label_website")?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="website" placeholder="www.example.com" name="website">
                                                    <div class="text-danger d-block error_input" id="website_error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-label"><?=lang("Register.label_email")?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="email" placeholder="<?=lang("Register.label_email")?>" name="email">
                                                    <div class="text-danger d-block error_input" id="email_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number" class="form-label"><?=lang("Register.label_phone")?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="phone_number" placeholder="<?=lang("Register.label_phone")?>" name="phone_number">
                                            <div class="text-danger d-block error_input" id="phone_number_error"></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label for="address" class="form-label"><?=lang("Register.label_address")?></label>
                                                    <input type="text" class="form-control" id="address" placeholder="<?=lang("Register.placeholder_street")?>" name="address">
                                                    <div class="text-danger d-block error_input" id="address_error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="address" class="form-label"><?=lang("Register.label_num_house")?></label>
                                                    <input type="text" class="form-control" id="interior_number" placeholder="<?=lang("Register.label_num_house")?>" name="interior_number">
                                                    <div class="text-danger d-block error_input" id="interior_number_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="province"><?=lang("Register.label_province")?> <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="province" name="province">
                                                        <option value=""><?=lang("Register.option_select_province")?></option>
                                                        <?php foreach ($provinces as $province):?>
                                                            <option value="<?=$province->id?>"><?=$province->name?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <div class="text-danger d-block error_input" id="city_error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group d-none" id="city_select">
                                                    <label for="city"><?= lang("Register.label_city")?> <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="city" name="city">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="type_company"><?=lang("Register.label_type_company")?></label>
                                            <select class="form-control" id="type_company" name="type_company">
                                                <?php foreach ($type_companies as $type):?>
                                                    <option value="<?= $type->id?>"><?= $type->name?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <div class="text-danger d-block error_input" id="type_company_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="branche"><?=lang("Register.label_select_categories")?> <span class="text-danger">*</span></label>
                                            <div class="border p-2">
                                                <?php foreach ($branches as $branch):?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?=$branch->id?>" id="<?=$branch->id?>" name="branches">
                                                        <label class="form-check-label" for="<?=$branch->id?>">
                                                            <?=$branch->name?>
                                                        </label>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                            <div class="text-danger d-block error_input" id="all_branches_error"></div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="imageCompany"><?=lang("Register.label_photo_company")?> <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imageCompany"  name="imageCompany">
                                            </div>
                                            <div class="text-danger d-block error_input" id="imageCompany_error"></div>
                                            <img id="image-preview" src="#" alt="Preview">
                                        </div>
                                        <div class="form-group">
                                            <label for="imageBg"><?=lang("Register.label_photo_company_bg")?> <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imageBg"  name="imageBg">
                                            </div>
                                            <div class="text-danger d-block error_input" id="imageBg_error"></div>
                                            <img id="image-previewBg" src="#" alt="Preview Bg">
                                        </div>
                                        <div class="form-group">
                                            <label for="descriptionShortCompany" class="form-label"><?=lang("Register.label_short_description")?> <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="descriptionShortCompany" id="descriptionShortCompany" rows="3" placeholder="<?=lang("Register.placeholder_short_description")?>"></textarea>
                                            <div class="text-danger d-block error_input" id="descriptionShortCompany_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="form-label"><?=lang("Register.label_long_description")?></label>
                                            <textarea class="form-control" name="descriptionLargeCompany" id="descriptionLargeCompany" rows="3" placeholder="<?=lang("Register.placeholder_long_description")?>"></textarea>
                                            <div class="text-danger d-block error_input" id="descriptionLargeCompany_error"></div>
                                        </div>
                                        <div class="text-center mt-2">
                                            <button type="submit" class="btn btn-primary"><?=lang("Register.btn_submit")?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3 "><a href="<?=base_url("login")?>">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
        