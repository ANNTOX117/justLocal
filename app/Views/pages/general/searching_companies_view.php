<?php $splitArrays = array_chunk($companies, 6);?>
<div id="return_pagination">
    <section class="section section--businesses">
        <img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background drag-none">
        <div class="container">
            <div class="navbar-categories d-flex justify-content-center align-items-center">
                <nav class="navbar navbar-expand">
                    <ul class="navbar-nav" id="filter-searching">
                        <li class="nav-item"><a href="#" class="nav-link <?php echo isset($_GET["type_company"]) ?false:"active";?>" data-id="3"><?=lang("Snippets.form_all")?></a></li>
                        <li class="nav-item"><a href="#" class="nav-link <?php echo  isset($_GET["type_company"]) && $_GET["type_company"]==="1"?"active":false;?>" data-id="1"><?=lang("Menu.companies")?></a></li>
                        <li class="nav-item"><a href="#" class="nav-link <?php echo isset($_GET["type_company"]) && $_GET["type_company"]==="2"?"active":false;?>" data-id="2"><?=lang("Menu.webshops")?></a></li>
                    </ul>
                </nav>
                <h4 class="result"><?=lang("Company.result")?>: <?= count($companies??[])?></h4>
                <label class="ms-auto"><?=lang("Company.sort")?>:</label>
                <select class="form-control">
                    <?php if(service('uri')->getSegment(1) === "aanbiedingen"||service('uri')->getSegment(1) === "offers"):?>
                        <option value="aantal reviews"><?= lang("Company.offers_select")?></option>
                    <?php else:?>
                        <option value="aantal reviews"><?= lang("Company.companies_select")?></option>
                    <?php endif;?>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="section--businesses__content">
                <div class="search-form">
                    <form action="#" class="search-form__form">
                        <div class="element">
                            <label for="province_all"><?=lang("Snippets.select_province")?></label>
                            <select class="form-control" name="provincie" id="province_all">
                            <option value=""><?=lang("Snippets.option_province")?></option>
                                <?php foreach ($provincies as $province):?>
                                    <option value="<?=$province->id?>"><?=$province->name?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="element">
                            <label for="stad_all"><?=lang("Snippets.select_city")?></label>
                            <select class="form-control" name="city" id="stad_all">
                                <option value=""><?=lang("Snippets.option_city")?></option>
                            </select>
                        </div>
                        <div class="element">
                            <label for="branche_all"><?=lang("Snippets.select_industry")?></label>
                            <select class="form-control" id="branche_all">
                                <option value=""><?=lang("Snippets.option_industry")?></option>
                            </select>
                        </div>
                        <!-- <div class="element">
                            <label for="branche">Productcategorie</label>
                            <select class="form-control" name="branche">
                                <option value="">Alles</option>
                                <?php //foreach ($categories as $category):?>
                                    <option value="<?//=$category->id?>"><?//=$category->name?></option>
                                <?php //endforeach;?>
                            </select>
                        </div> -->
                    </form>
                </div>
                <div class="blocks" id="blocks_first_part">
                    <?php foreach ($splitArrays[0]??[] as $company):?>
                        <div class="block card-block" data-type="<?=$company["type_company"]??false?>">
                            <?php if(service('uri')->getSegment(1) === "aanbiedingen" ||service('uri')->getSegment(1) === "offers"):?>
                                <a href="#" class="block__favorite" data-type="offer" data-id="<?=$company["id"]?>"><i class="fa-solid fa-heart"></i></a>
                            <?php else:?>
                                <a href="#" class="block__favorite" data-type="company" data-id="<?=$company["id"]?>"><i class="fa-solid fa-heart"></i></a>
                            <?php endif;?>
                            <figure class="block__figure"><img src="<?=base_url("assets/img/brand1.jpg")?>" class="block__figure__image"></figure>
                            <div class="block__content">
                                <div class="block__content__header d-flex flex-direction-row">
                                    <?php if(service('uri')->getSegment(1) === "aanbiedingen" ||service('uri')->getSegment(1) === "offers"):?>
                                        <h4 class="discount"><a href="<?=base_url(route_to('offer',$company["slug"]??false));?>"><?=$company["discount"]??0?>% <?= lang("Company.discount")?></a></h4>
                                    <?php else:?>
                                        <h4 class="discount"><a href="<?=base_url(route_to('bussine',$company["slug"]??false));?>"><?=$company["total_offers"]??0?> <?= lang("Company.offers")?></a></h4>
                                    <?php endif;?>
                                    <?php 
                                        $rating = sanitize_string($company["review"]??false,"none")??10;
                                        $solid_stars = intval($rating / 2); // Divide by 2 to get number of solid stars
                                    ?>
                                    <div class="rating">
                                        <?php for($i=0; $i<5; $i++){ ?>
                                            <?php if($i < $solid_stars){ ?>
                                                <i class="fa-solid fa-star"></i> <!-- Solid star -->
                                            <?php } elseif($i == $solid_stars && $rating % 2 != 0){ ?>
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                            <?php } else { ?>
                                                <i class="fa-regular fa-star"></i> <!-- Empty star -->
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if(service('uri')->getSegment(1) === "aanbiedingen"||service('uri')->getSegment(1) === "offers"):?>
                                    <h3 class="title title--block"><a href="<?=base_url(route_to('offer',$company["slug"]??false));?>"><?=sanitize_string($company["company_name"],"capitalize")??false?></a></h3>
                                <?php else:?>
                                    <h3 class="title title--block"><a href="<?=base_url(route_to('bussine',$company["slug"]??false));?>"><?=sanitize_string($company["company_name"],"capitalize")??false?></a></h3>
                                <?php endif;?>
                                <h4 class="place"><?=sanitize_string($company["city_name"],"capitalize")??false?>, <?=sanitize_string($company["province_name"]??false,"capitalize")??false?></h4>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <img src="<?=base_url('assets/img/decoration-black.png')?>" class="decoration-one">
    </section>
    <section class="section section--content-image bg-light-blue">
        <img src="<?php //echo base_url('uploads/company/').$random_company[0]->bg_img_url?>" alt="" class="image">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="content">
                        <h4 class="subtitle"><?= sanitize_string($random_company[0]->name)?></h4>
                        <h3 class="title title--section"><?= sanitize_string($random_company[0]->title)?></h3>
                        <p class="paragraph"><?= sanitize_string($random_company[0]->description)?></p>
                        <a href="<?=base_url(route_to("bussine",$random_company[0]->slug))?>" class="btn btn-primary"><?=lang("Snippets.btn_offers")?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section--businesses continuation section--businesses--background-right">
        <div class="container">
            <div class="section--businesses__content">
            <div></div>
                <div class="blocks" id="blocks_second_part">
                <?php foreach ($splitArrays[1]??[] as $company):?>
                        <div class="block card-block" data-type="<?=$company["type_company"]??false?>">
                            <?php if(service('uri')->getSegment(1) === "aanbiedingen" ||service('uri')->getSegment(1) === "offers"):?>
                                <a href="#" class="block__favorite" data-type="offer" data-id="<?=$company["id"]?>"><i class="fa-solid fa-heart"></i></a>
                            <?php else:?>
                                <a href="#" class="block__favorite" data-type="company" data-id="<?=$company["id"]?>"><i class="fa-solid fa-heart"></i></a>
                            <?php endif;?>
                            <figure class="block__figure"><img src="<?=base_url("assets/img/brand1.jpg")?>" class="block__figure__image"></figure>
                            <div class="block__content">
                                <div class="block__content__header d-flex flex-direction-row">
                                    <?php if(service('uri')->getSegment(1) === "aanbiedingen" ||service('uri')->getSegment(1) === "offers"):?>
                                        <h4 class="discount"><a href="<?=base_url(route_to('offer',$company["slug"]??false));?>"><?=$company["discount"]??0?>% <?= lang("Company.discount")?></a></h4>
                                    <?php else:?>
                                        <h4 class="discount"><a href="<?=base_url(route_to('bussine',$company["slug"]??false));?>"><?=$company["total_offers"]??0?> <?= lang("Company.offers")?></a></h4>
                                    <?php endif;?>
                                    <?php 
                                        $rating = sanitize_string($company["review"]??false,"none")??10;
                                        $solid_stars = intval($rating / 2); // Divide by 2 to get number of solid stars
                                    ?>
                                    <div class="rating">
                                        <?php for($i=0; $i<5; $i++){ ?>
                                            <?php if($i < $solid_stars){ ?>
                                                <i class="fa-solid fa-star"></i> <!-- Solid star -->
                                            <?php } elseif($i == $solid_stars && $rating % 2 != 0){ ?>
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                            <?php } else { ?>
                                                <i class="fa-regular fa-star"></i> <!-- Empty star -->
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if(service('uri')->getSegment(1) === "aanbiedingen"||service('uri')->getSegment(1) === "offers"):?>
                                    <h3 class="title title--block"><a href="<?=base_url(route_to('offer',$company["slug"]??false));?>"><?=sanitize_string($company["company_name"],"capitalize")??false?></a></h3>
                                <?php else:?>
                                    <h3 class="title title--block"><a href="<?=base_url(route_to('bussine',$company["slug"]??false));?>"><?=sanitize_string($company["company_name"],"capitalize")??false?></a></h3>
                                <?php endif;?>
                                <h4 class="place"><?=sanitize_string($company["city_name"],"capitalize")??false?>, <?=sanitize_string($company["province_name"]??false,"capitalize")??false?></h4>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" id="pagination">
            <?php if ($pager) :?>
                <?= $pager->links() ?>
            <?php endif ?>
        </div>
    </section>
</div>
<?php echo $reviews_justLocal??false?>