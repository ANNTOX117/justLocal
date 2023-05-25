<section class="section section--businesses">
    <img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background drag-none">
    <div class="container">
        <div class="navbar-categories d-flex justify-content-center align-items-center">
            <h4 class="result"><?= lang("Company.result")?> <?= count($companies??[])?></h4>
            <label class="ms-auto"><?=lang("Company.sort")?>:</label>
            <select class="form-control">
                <option value="aantal reviews"><?=lang("Company.companies_select")?></option>
            </select>
            <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="section--businesses__content d-block">
            <div></div>
            <div class="blocks">
                <?php $counter = 1;?>
                <?php foreach ($companies??[] as $company):?>
                    <div class="block">
                        <a href="#favorite" class="block__favorite"><i class="fa-solid fa-heart"></i></a>
                        <figure class="block__figure"><img src="<?=base_url("assets/img/brand1.jpg")?>" class="block__figure__image"></figure>
                        <div class="block__content">
                            <div class="block__content__header d-flex flex-direction-row">
                                <?php if(service('uri')->getSegment(1) === "aanbiedingen"||service('uri')->getSegment(1) === "offers"):?>
                                    <h4 class="discount"><a href="<?=base_url('offer',$company["slug"]??false);?>"><?=$company["discount"]??0?>% <?=lang("Company.discount")?></a></h4>
                                    <h3><?=$company["id"]?></h3>
                                <?php else:?>
                                    <h4 class="discount"><a href="<?=base_url(route_to("bussine",$company["slug"]));?>"><?=$company["total_offers"]??0?> <?=lang("Company.offers")?></a></h4>
                                <?php endif;?>
                                <?php 
                                    $rating = sanitize_string($company["review"]??false,"none")??10;
                                    $solid_stars = intval($rating / 2);// Divide by 2 to get number of solid stars
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
                                <h3 class="title title--block"><a href="<?= base_url('offer',sanitize_string($company["slug"]??false,"none"))?>"><?=sanitize_string($company["company_name"]??false,"capitalize")??false?></a></h3>
                            <?php else:?>
                                    <h3 class="title title--block"><a href="<?= base_url(route_to("bussine",$company["slug"]))?>"><?=sanitize_string($company["company_name"]??false,"capitalize")??false?></a></h3>
                            <?php endif;?>
                            <h4 class="place"><?=sanitize_string($company["city_name"]??false,"capitalize")??false?>, <?=sanitize_string($company["province_name"]??false,"capitalize")??false?></h4>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <img src="<?=base_url('assets/img/decoration-black.png')?>" class="decoration-one">
</section>
<div class="d-flex justify-content-center" id="pagination">
    <?php if ($pager) :?>
        <?= $pager->links() ?>
    <?php endif ?>
</div>