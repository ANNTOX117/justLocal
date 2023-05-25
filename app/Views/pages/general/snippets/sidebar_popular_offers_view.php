<div class="section--interior__sidebar">
    <ul class="nav nav-tabs" id="navExtra" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" id="populairedeals-tab" data-bs-toggle="tab" data-bs-target="#populairedeals-tab-pane"
            type="button" role="tab" aria-controls="populairedeals-tab-pane" aria-selected="true"><?=lang("Company.popular_deals")?></button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="meer-tab" data-bs-toggle="tab" data-bs-target="#meer-tab-pane" type="button"
            role="tab" aria-controls="meer-tab-pane" aria-selected="false"><?=lang("Company.more")?></button>
        </li>
    </ul>
    <div class="downScroll"><i class="fa-solid fa-chevron-down"></i></div>
    <div class="tab-content" id="navExtraContent">
        <div class="tab-pane fade show active" id="populairedeals-tab-pane" role="tabpanel" aria-labelledby="populairedeals-tab" tabindex="0">
            <?php if (isset($popular_offers)):?>
                <?php foreach ($popular_offers as $offer):?>
                    <div class="element">
                        <h5 class="element__title"> <?=$offer->discount??false?>% <?=$offer->title??false?></h5>
                        <?php
                            $description = $offer->description??false;
                            if(strlen($description) > 50) $description = substr($description, 0, 50) . "...";
                        ?>
                        <p class="paragraph"><?=$description? sanitize_string($description,"capitalize"):false?></p>
                        <a href="<?=base_url(route_to("offer",$offer->slug??false))?>" class="link"><?=lang("Company.more_information")?></a>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        <div class="tab-pane fade" id="meer-tab-pane" role="tabpanel" aria-labelledby="meer-tab" tabindex="0">
            <?php if (isset($random_offers)):?>
                <?php foreach ($random_offers as $offer):?>
                    <div class="element">
                        <h5 class="element__title"><?=sanitize_string($offer->discount)??false?>% <?=sanitize_string($offer->title,"capitilize")??false?></h5>
                        <?php
                            $description = $offer->description??false;
                            if(strlen($description) > 50) $description = substr($description, 0, 50) . "...";
                        ?>
                        <p class="paragraph"><?=$description? sanitize_string($description,"capitalize"):false?></p>
                        <a href="<?=base_url(route_to("offer",$offer->slug??false))?>" class="link"><?=lang("Company.more_information")?></a>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</div>