<?php foreach ($companies??[] as $company):?>
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