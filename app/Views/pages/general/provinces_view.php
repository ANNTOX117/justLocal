
<section class="section section--businesses">
    <img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background drag-none">
    <div class="container">
        <div class="navbar-categories d-flex justify-content-center align-items-center">
            <h4 class="result"><?=lang("Company.result")?>: <?= count($provinces??[])?></h4>
            <label class="ms-auto"><?=lang("Company.sort")?>:</label>
            <select class="form-control">
                <option value="aantal reviews"><?=lang("Snippets.option_province")?></option>
            </select>
            <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="section--businesses__content">
            <div class="blocks">
                <?php $counter = 1;?>
                <?php foreach ($provinces??[] as $province):?>
                    <div class="block">
                        <?php if (isset($province->path_province)):?>
                            <figure class="block__figure"><a href="<?=base_url(route_to("province_city",$province->path_province,$province->path));?>"><img src="<?=base_url("uploads/provinces/pexels-george-becker-135161.jpg")?>" class="block__figure__image"></a></figure>
                            <div class="block__content">
                                <div class="block__content__header d-flex flex-direction-row">
                                    <h4 class="discount"><a href="<?=base_url(route_to("province_city",$province->path_province,$province->path));?>"><?=sanitize_string($province->name,"capitalize")??false?></a></h4>
                                </div>
                                <h3 class="title title--block"><a href="<?= base_url(route_to("province_city",$province->path_province,$province->path))?>"><?=lang("Snippets.total_companies")?>: <?=sanitize_string($province->total_companies,"none")??0?></a></h3>
                            </div>
                        <?php else:?>
                            <figure class="block__figure"><a href="<?=base_url(route_to("province",$province->path));?>"><img src="<?=base_url("uploads/provinces/pexels-george-becker-135161.jpg")?>" class="block__figure__image"></a></figure>
                            <div class="block__content">
                                <div class="block__content__header d-flex flex-direction-row">
                                    <h4 class="discount"><a href="<?=base_url(route_to("province",$province->path));?>"><?=sanitize_string($province->name,"capitalize")??false?></a></h4>
                                </div>
                                <h3 class="title title--block"><a href="<?= base_url(route_to("province",$province->path))?>"><?=lang("Snippets.total_companies")?>: <?=sanitize_string($province->total_companies,"none")??0?></a></h3>
                            </div>
                        <?php endif;?>
                    </div>
                <?php if ($counter % 6 === 0 && $counter % 12 !== 0):?>
            </div>
        </div>
    </div>
    <img src="<?=base_url('assets/img/decoration-black.png')?>" class="decoration-one">
</section>
<section class="section section--content-image bg-light-blue">
    <img src="<?=base_url("uploads/company/".$random_company[0]->id."/".$random_company[0]->bg_img_url)?>" alt="" class="image">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="content">
                    <h4 class="subtitle"><?= sanitize_string($random_company[0]->name,"capitalize")?></h4>
                    <h3 class="title title--section"><?= sanitize_string($random_company[0]->title,"capitalize")?></h3>
                    <p class="paragraph"><?= sanitize_string($random_company[0]->description,"capitalize")?></p>
                    <a href="<?=base_url(route_to("bussine",$random_company[0]->slug))?>" class="btn btn-primary"><?=lang("Snippets.btn_offers")?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section--businesses continuation section--businesses--background-right">
    <div class="container">
        <div class="section--businesses__content">
            <div class="blocks">
                <?php endif;?>
            <?php $counter++;?>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<?php echo $reviews_justLocal??false?>