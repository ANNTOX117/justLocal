<?php if (count($companies)>0):?>
    <section class="section section--brands">
        <div class="container">
            <div class="owl-carousel owl-carousel-five">
                <?php foreach($companies as $company):?>        
                    <figure class="section--brands__figure">
                        <img class="section--brands__figure__image" src="<?= $company->url_image?>">
                    </figure>
                <?php endforeach;?>
            </div>
        </div>
    </section>
<?php endif;?>