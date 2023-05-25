<section class="section section--reviews">
    <div class="container">
        <h3 class="title title--section text-center"><?= lang("Home.title_reviews")?></h3>
        <p class="paragraph text-center"><?= lang("Home.paragraph_reviews")?></p>
        <div class="owl-carousel owl-carousel-two">
            <?php if(isset($review_by_justLocal)):?>
                <?php foreach($review_by_justLocal as $review):?>
                    <div class="block d-lg-flex">
                        <figure class="block__figure">
                            <img src="./public/img/review1.jpeg" class="block__figure__image">
                        </figure>
                        <div class="block__content">
                            <img src="./public/img/review-decoration.png" alt="" class="decoration">
                            <p class="paragraph"><?=$review->content??false?></p>
                            <h3 class="title title--block"><?=$review->creator_name??false?></h3>
                            <h4 class="block__content__position">Job description</h4>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</section>