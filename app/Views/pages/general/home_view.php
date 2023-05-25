<section class="section section--hero">
    <img class="section--hero__image" src="<?= base_url('assets/ownsite/img/hero1.jpg')?>">
    <img src="<?= base_url('assets/ownsite/img/decoration-white.png')?>" class="decoration decoration--one">
    <img src="<?= base_url('assets/ownsite/img/decoration-black.png')?>" class="decoration decoration--two">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-9">
                <div class="section--hero__content">
                    <h1 class="title title--main"><?= lang("Home.title")??false?> JustLocal</h1>
                    <p class="paragraph"><?= lang("Home.subtitle")??false?></p>
                    <a href="<?=base_url(route_to("about_us"))?>" class="btn btn-primary mb-5"><?= lang("Snippets.btn_read_more")?></a>
                </div>
                <div class="search-form">
                    <ul class="nav nav-tabs" id="navTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="alles-tab" data-bs-toggle="tab" data-bs-target="#alles-tab-pane" type="button"
                            role="tab" aria-controls="alles-tab-pane" aria-selected="true"><?= lang("Snippets.form_all")?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bedrijven-tab" data-bs-toggle="tab" data-bs-target="#bedrijven-tab-pane" type="button"
                            role="tab" aria-controls="bedrijven-tab-pane" aria-selected="false"><?= lang("Menu.companies")?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="webshops-tab" data-bs-toggle="tab" data-bs-target="#webshops-tab-pane" type="button"
                            role="tab" aria-controls="webshops-tab-pane" aria-selected="false"><?=lang("Menu.webshops")?></button>
                        </li>
                    </ul>
                    <div class="tab-content" id="navTabContent">
                        <div class="tab-pane fade show active" id="alles-tab-pane" role="tabpanel" aria-labelledby="alles-tab" tabindex="0">
                            <form action="<?=base_url(route_to('bussiness'))?>" class="search-form__form d-flex flex-direction-row align-items-center">
                                <div class="element">
                                    <label for="provincie"><?= lang("Snippets.select_province")?></label>
                                    <select class="form-control" name="provincie" id="provincie_all">
                                        <option value=""><?= lang("Snippets.option_province")?></option>
                                        <?php foreach($provincies as $province):?>
                                            <option value="<?=sanitize_string($province->id)?>"><?=sanitize_string($province->name)?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="element">
                                    <label for="stad"><?= lang("Snippets.select_city")?></label>
                                    <select class="form-control" name="stad" id="stad_all">
                                        <option value=""><?= lang("Snippets.option_city")?></option>
                                    </select>
                                </div>
                                <div class="element">
                                    <label for="branche"><?= lang("Snippets.select_industry")?></label>
                                    <select class="form-control" name="branche" id="branche_all">
                                        <option value=""><?= lang("Snippets.option_industry")?></option>
                                        <?php if (isset($branches)):?>
                                            <?php foreach($branches as $branche):?>
                                                <option value="<?=sanitize_string($branche->id)?>"><?=sanitize_string($branche->name)?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="element">
                                    <button type="submit" class="btn btn-primary"><?= lang("Snippets.btn_search_offer")?></button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="bedrijven-tab-pane" role="tabpanel" aria-labelledby="bedrijven-tab" tabindex="0">
                            <form action="<?=base_url(route_to('bussiness'))?>" class="search-form__form d-flex flex-direction-row">
                                <div class="element">
                                    <label for="provincie"><?= lang("Snippets.select_province")?></label>
                                    <select class="form-control" name="provincie" id="province_bed">
                                        <option value=""><?= lang("Snippets.option_province")?></option>
                                        <?php if(isset($provincies)):?>
                                            <?php foreach($provincies as $province):?>
                                                <option value="<?=sanitize_string($province->id)?>"><?=sanitize_string($province->name)?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="element">
                                    <label for="stad"><?= lang("Snippets.select_city")?></label>
                                    <select class="form-control" name="stad" id="stad_bed">
                                    <option value=""><?= lang("Snippets.option_city")?></option>
                                    </select>
                                </div>
                                <div class="element">
                                    <label for="branche"><?= lang("Snippets.select_industry")?></label>
                                    <select class="form-control" name="branche" id="branche_bed">
                                        <option value=""><?= lang("Snippets.option_industry")?></option>
                                        <?php if(isset($branches)):?>
                                            <?php foreach($branches as $branche):?>
                                                    <option value="<?=sanitize_string($branche->id)?>"><?=sanitize_string($branche->name)?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <input type="hidden" name="type_company" value=1>
                                <div class="element">
                                    <button type="submit" class="btn btn-primary"><?= lang("Snippets.btn_search_offer")?></button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="webshops-tab-pane" role="tabpanel" aria-labelledby="webshops-tab" tabindex="0">
                            <form action="<?=base_url(route_to('bussiness'))?>" class="search-form__form d-flex flex-direction-row">
                                <div class="element">
                                    <label for="provincie"><?= lang("Snippets.select_province")?></label>
                                    <select class="form-control" name="provincie" id="province_web">
                                        <option value=""><?= lang("Snippets.option_province")?></option>
                                        <?php if(isset($branches)):?>
                                            <?php foreach($provincies as $province):?>
                                                <option value="<?=sanitize_string($province->id)?>"><?=sanitize_string($province->name)?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="element">
                                    <label for="stad"><?= lang("Snippets.select_city")?></label>
                                    <select class="form-control" name="stad" id="stad_web">
                                        <option value=""><?= lang("Snippets.option_city")?></option>
                                    </select>
                                </div>
                                <div class="element">
                                    <label for="branche"><?= lang("Snippets.select_industry")?></label>
                                    <select class="form-control" name="branche" id="branche_web">
                                        <option value=""><?= lang("Snippets.option_industry")?></option>
                                        <?php if(isset($branches)):?>
                                            <?php foreach($branches as $branche):?>
                                                <option value="<?=sanitize_string($branche->id)?>"><?=sanitize_string($branche->name)?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <input type="hidden" name="type_company" value=2>
                                <div class="element">
                                    <button type="submit" class="btn btn-primary"><?= lang("Snippets.btn_search_offer")?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?=$carousel_view??false?>
<section class="section section--image-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
            <figure class="section--image-content__figure">
                <img src="<?=base_url('assets/img/decoration-two.png')?>" class="decoration">
                <img class="section--image-content__figure__image" src="<?=base_url('assets/img/image1.jpeg')?>">
            </figure>
            </div>
            <div class="col-lg-6 ms-auto">
                <div class="section--image-content__content">
                    <h4 class="subtitle"><?= lang("Home.subtitle_we_do")?></h4>
                    <h3 class="title title--section"><?= lang("Home.title_we_do")?></h3>
                    <p class="paragraph"><?=lang("Home.paragraph_1_we_do")?></p>
                    <p class="paragraph"><?=lang("Home.paragraph_2_we_do")?></p>
                    <p class="paragraph"><?=lang("Home.paragraph_3_we_do")?></p>
                    <div class="section--image-content__content__buttons d-flex">
                        <a href="<?=base_url(route_to("about_us"))?>" class="btn btn-primary"><?= lang("Snippets.btn_read_more")?></a>
                        <a href="<?=base_url("contact")?>" class="btn btn-outline-primary"><?= lang("Menu.contact")?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?=$popular_offers_view??false?>
<section class="section section--blocks bg-light-blue">
    <div class="container">
        <h3 class="title title--section text-center"><?= lang("Home.title_how_it_work")?></h3>
        <p class="paragraph text-center"><?= lang("Home.paragraph_how_it_work")?></p>
        <div class="owl-carousel owl-carousel-four">
            <?php $colors = ['bg-black', 'bg-blue', 'bg-green', 'bg-orange', 'bg-black', 'bg-blue', 'bg-green', 'bg-orange']; ?>
            <?php if(isset($how_works)): ?>
                <?php foreach($how_works as $block):
                    $color = $colors[rand(0,7)];
                    ?>
                    <div class="block" style="min-height: 300px;">
                        <div class="d-flex flex-direction-row">
                            <figure class="block__figure <?php echo $color ?>">
                                <?php
                                    echo $block['icon_html'];
                                ?>
                            </figure>
                            <h3 class="title title--block">
                                <?php
                                    echo $block['title'];
                                ?>
                            </h3>
                        </div>
                        <div class="block__content">
                            <p class="paragraph">
                                <?php
                                    echo $block['comment'];
                                ?>
                            </p>
                            <a href="#" class="link">Lees meer...</a>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</section>
    
<section class="section section--services">
    <div class="container">
        <h3 class="title title--section text-center"><?= lang("Home.title_recent_offers")?></h3>
        <p class="paragraph text-center"><?= lang("Home.paragraph_recent_offers")?></p>
        <div class="owl-carousel owl-carousel-three">
            <?php foreach($lastes_offers as $index => $offer): ?>
                <?php if($index % 2 === 0): ?>
                    <div class="two-blocks">
                <?php endif; ?>
                        <div class="block">
                            <figure class="block__figure">
                                <a href="<?= base_url(route_to("offer",$offer->slug))?>"><img src="<?php echo base_url('assets/ownsite/img/block1.jpeg')?>" class="block__figure__image"></a>
                            </figure>
                            <div class="block__content">
                                <div class="block__content__header d-flex flex-direction-row" id="recent_offers">
                                    <h4 class="discount"><?php echo $offer->discount; ?>% <?= lang("Snippets.txt_discount")?></h4>
                                    <button class="like ms-auto" data-id="<?=$offer->id?>" data-type="offer"><i class="fa-solid fa-heart"></i></button>
                                    <button class="share ms-2 shareModal"><i class="fa-solid fa-share-nodes"></i></button>
                                </div>
                                <h3 class="title title--block"><a href="<?= base_url(route_to("offer",$offer->slug))?>"><?php echo $offer->title; ?></a></h3>
                                <h4 class="place"><?php echo "bshbjhsb" ?></h4>
                            </div>
                        </div>
                <?php if(($index + 1) % 2 === 0 || $index === count($lastes_offers) - 1): ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <a href="<?=base_url(route_to("offers"))?>" class="btn btn-primary mx-auto d-block" style="width:fit-content;"><?=lang("Snippets.btn_more")?></a>
    </div>
</section>
<div id="shareModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
            </div>
            <div class="modal-body text-center">
                <h3><a href="#"><i class="fa-solid fa-link"></i></a><a href="#"><i class="fa-brands fa-facebook"></i></a></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php echo $reviews_justLocal??false?>