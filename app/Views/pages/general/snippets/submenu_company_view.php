<ul class="nav nav-tabs" id="navInterior" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="informatie-tab" data-bs-toggle="tab" data-bs-target="#informatie-tab-pane" type="button"
        role="tab" aria-controls="informatie-tab-pane" aria-selected="true"><?=lang("Company.information")?></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="fotos-tab" data-bs-toggle="tab" data-bs-target="#fotos-tab-pane" type="button"
        role="tab" aria-controls="fotos-tab-pane" aria-selected="false"><?=lang("Company.photos")?></button>
    </li>
    <?php if (service('uri')->getSegment(1) !== "aanbiedingen"):?>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="aanbiedingen-tab" data-bs-toggle="tab" data-bs-target="#aanbiedingen-tab-pane" type="button"
            role="tab" aria-controls="aanbiedingen-tab-pane" aria-selected="false"><?=lang("Menu.offers")?></button>
        </li>
    <?php endif;?>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button"
        role="tab" aria-controls="reviews-tab-pane" aria-selected="false"><?=lang("Company.reviews")?> <?=service('uri')->getSegment(1) === "aanbiedingen"||service('uri')->getSegment(1) ==="offers"?" ".lang("Company.by")." ".sanitize_string($company['name'],"capitalize"):false?> </button>
    </li>
</ul>
<div class="tab-content" id="navInteriorContent">
    <div class="tab-pane fade show active" id="informatie-tab-pane" role="tabpanel" aria-labelledby="informatie-tab" tabindex="0">
        <p class="paragraph"><?=sanitize_string($company['description'],"capitalize")??false?></p>
    </div>
    <div class="tab-pane fade" id="fotos-tab-pane" role="tabpanel" aria-labelledby="fotos-tab" tabindex="0">
        <div class="row">
            <?php if (isset($media)):?>
                <?php foreach ($media as $image):?>
                    <div class="col-md-4 col-sm-6">
                        <figure>
                            <?php $name_file = "uploads/company/".$company["id"]."/media/".$image->name_file ?>
                            <a href="<?=base_url($name_file)?>" data-lightbox="images-interior">
                                <img src="<?=base_url($name_file)?>" alt="">
                            </a>
                        </figure>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="text">
                    <p><?=lang("Company.no_image_found")?></p>
                </div>
            <?php endif;?>
        </div>
    </div>
    <?php if (service('uri')->getSegment(1) !== "aanbiedingen"):?>
        <div class="tab-pane fade" id="aanbiedingen-tab-pane" role="tabpanel" aria-labelledby="aanbiedingen-tab" tabindex="0">
            <div class="row">
                <?php if(isset($offers)):?>
                    <?php foreach ($offers as $offer):?>
                        <div class="col-md-6">
                            <div class="block">
                                <figure class="block__figure">
                                    <a href="<?=base_url(route_to("offer",$offer->slug??false))?>"><img src="<?=base_url('assets/ownsite/img/block1.jpeg')?>" class="block__figure__image"></a>
                                </figure>
                                <div class="block__content">
                                    <div class="block__content__header d-flex flex-direction-row">
                                        <h4 class="discount"><?=sanitize_string($offer->discount)??false?>% <?=lang("Company.discount")?></h4>
                                        <button class="like ms-auto"><i class="fa-solid fa-heart"></i></button>
                                        <button class="share ms-2"><i class="fa-solid fa-share-nodes"></i></button>
                                    </div>
                                    <h3 class="title title--block"><a href="<?=base_url(route_to("offer/",$offer->slug??false))?>"><?= sanitize_string($offer->title,"capitalize")??false?></a></h3>
                                    <h4 class="place"><?= sanitize_string($offer->city_name,"capitalize")?>, <?= sanitize_string($offer->province_name,"capitalize")?></h4>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    <?php endif;?>
    <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
        <div class="row">
            <?php if(isset($reviews)):?>
                <?php foreach($reviews as $review):?>
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block__content">
                                <img src="<?=base_url('assets/ownsite/img/review-decoration.png')?>" alt="" class="decoration">
                                <p class="paragraph"><?=sanitize_string($review->content,"capitalize")??false;?></p>
                                <h3 class="title title--block"><?=sanitize_string($review->creator_name,"capitalize")??false;?></h3>
                                <h4 class="block__content__position"><?= sanitize_string($review->job_description,"capitalize")??false; ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <p><?=lang("Company.no_reviews_found")?></p>
            <?php endif;?>
        </div>
    </div>
</div>