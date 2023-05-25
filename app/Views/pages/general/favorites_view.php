<section class="section section--businesses">
    <img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background drag-none">
    <div class="container">
        <div class="navbar-categories d-flex justify-content-center align-items-center">
            <h4 class="result" id="total_companies"><?=lang("Menu.companies")?>: <span><?= count($liked_companies??[])?></span></h4>
        </div>
        <div class="section--businesses__content">
            <div class="blocks">
                <?php foreach ($liked_companies??[] as $company):?>
                    <div class="block">
                        <a href="#" class="block__favorite" data-type="company" data-id="<?=$company->id?>"><i class="fa-solid fa-heart"></i></a>
                        <figure class="block__figure"><img src="<?=base_url("assets/img/brand1.jpg")?>" class="block__figure__image"></figure>
                        <div class="block__content">
                            <div class="block__content__header d-flex flex-direction-row">
                                <!-- <h4 class="discount"><a href="<?//=base_url(route_to('offer',$company->slug??false));?>"><?//=$company->discount??0?></a></h4> -->
                                <?php 
                                    $rating = sanitize_string($company->review??false,"none")??10;
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
                            <h3 class="title title--block"><a href="<?=base_url(route_to('offer',$company->slug??false));?>"><?=sanitize_string($company->name,"capitalize")??false?></a></h3>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="navbar-categories d-flex justify-content-center align-items-center">
            <h4 class="result" id="total_offers"><?=lang("Company.offers")?>: <span><?= count($liked_offers??[])?></span></h4>
        </div>
        <div class="section--businesses__content">
            <div class="blocks">
                <?php foreach ($liked_offers??[] as $company):?>
                    <div class="block">
                        <a href="#" class="block__favorite" data-type="offer" data-id="<?=$company->id?>"><i class="fa-solid fa-heart"></i></a>
                        <figure class="block__figure"><img src="<?=base_url("assets/img/brand1.jpg")?>" class="block__figure__image"></figure>
                        <div class="block__content">
                            <div class="block__content__header d-flex flex-direction-row">
                                <h4 class="discount"><a href="<?=base_url(route_to('offer',$company->slug??false));?>"><?=$company->discount??0?>% <?=lang("Company.discount")?></a></h4>
                                <?php 
                                    $rating = sanitize_string($company->review??false,"none")??10;
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
                            <h3 class="title title--block"><a href="<?=base_url(route_to('offer',$company->slug??false));?>"><?=sanitize_string($company->title,"capitalize")??false?></a></h3>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <img src="<?=base_url('assets/img/decoration-black.png')?>" class="decoration-one">
</section>
<?php echo $reviews_justLocal??false?>