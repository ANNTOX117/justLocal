<section class="section section--hero-page" data-background="<?=base_url('assets/ownsite/img/hero-interior.jpeg')?>" data-background-size="cover" data-background-position="center center"></section>
<section class="section section--interior">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 bg-md-light">
                <figure class="logo">
                    <img src="<?=base_url('assets/ownsite/img/logo-interior.png')?>" alt="">
                </figure>
                <div class="specifications">
                    <?php $uri = service('uri')->getSegment(1);?>
                    <?php if ($uri === "aanbiedingen"||$uri === "offers"):?>
                        <div class="mb-3">
                            <a href="<?= base_url(route_to("bussine",$company['slug']))?>" class="btn btn-outline-primary"><?=lang("Company.go_profile")?></a>
                        </div>
                    <?php endif;?>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="name"><?=lang("Company.offers")?></h4>
                            <p class="content"><?=isset($offers)?count($offers):false?></p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="name"><?=lang("Company.score")?></h4>
                            <p class="content"><?=sanitize_string($company['review'])??false?></p>
                        </div>
                    </div>
                    <h4 class="name"><?=lang("Company.website")?></h4>
                    <p class="content"><a href="<?=sanitize_string($company['website'])?>"><?=sanitize_string($company['website'])??false?></a></p>
                    <h4 class="name"><?=lang("Company.phone")?></h4>
                    <p class="content"><?=sanitize_string($company['phone'])??false?></p>
                    <h4 class="name"><?=lang("Company.email")?></h4>
                    <p class="content"><?=sanitize_string($company['email'])??false?></p>
                    <div class="social">
                        <?php if(isset($company['facebook'])):?>
                            <a href="<?=$company['facebook']??'#'?>" target="_blank" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                        <?php endif;?>
                        <?php if(isset($company['instagram'])):?>
                            <a href="<?=$company['instagram']??'#'?>" target="_blank" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                        <?php endif;?>
                        <?php if(isset($company['linkedin'])):?>
                            <a href="<?=$company['linkedin']??'#'?>" target="_blank" class="social-link"><i class="fa-brands fa-linkedin"></i></a>
                        <?php endif;?>
                    </div>
                    <h4 class="name"><?=lang("Company.address")?></h4>
                    <p class="content"><?=sanitize_string($company['address'],"capitalize")??false?>
                </div>
            </div>
            <div class="col-lg-9 ms-auto me-auto section--interior__inner">
                <?=$title_company_view??false?>
                <div class="section--interior__content content">
                    <?=$submenu_company_view??false?>
                </div>
                <?=$sidebar_popular_offers_view?>
            </div>
        </div>
    </div>
</section>