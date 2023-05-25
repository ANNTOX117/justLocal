<section class="section section--services section--services--carousel">
    <div class="container">
        <h3 class="title title--section"><?= lang("Home.title_popular_offers")?></h3>
        <p class="paragraph"><?= lang("Home.paragraph_popular_offers")?></p>
        <div class="owl-carousel owl-carousel-three">
            <?php foreach($popular_offers as $offer):?>
                <div class="block">
                    <figure class="block__figure"><img src="<?= base_url('assets/img/block1.jpeg')?>" class="block__figure__image"></figure>
                    <div class="block__content">
                        <div class="block__content__header d-flex flex-direction-row" id="popular_offers">
                            <h4 class="discount"><?=capitalize_text($offer->discount)?>% <?= lang("Snippets.txt_discount")?></h4>
                            <button class="like ms-auto" data-id="<?=$offer->offer_id?>" data-type="offer"><i class="fa-solid fa-heart"></i></button>
                            <button class="share ms-2"><i class="fa-solid fa-share-nodes"></i></button>
                        </div>
                        <h3 class="title title--block"><a href="<?= base_url(route_to("offer",$offer->slug))?>"><?=$offer->title?></a></h3>
                        <h4 class="place"><?=capitalize_text($offer->city_name)?>,<?=capitalize_text($offer->province_name)?></h4>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</section>