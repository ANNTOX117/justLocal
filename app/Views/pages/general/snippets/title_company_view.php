<div class="content-header match-height">
    <?php if (service('uri')->getSegment(1) === "aanbiedingen"||service('uri')->getSegment(1) === "offers"):?>
        <h3 class="title title--section"><?=sanitize_string($offer[0]->discount,"none")??false?>% <?=sanitize_string($offer[0]->title,"capitalize")??false?></h3>
    <?php else:?>
        <h3 class="title title--section"><?=sanitize_string($name,"capitalize")??false?></h3>
    <?php endif;?>
    <div class="rating d-flex flex-direction-row">
        <?php
            if (isset($categories)) {
                $names = array_map(function($item) {
                    return $item["name"];
                }, $categories);
                
                $str = implode(", ", $names);
                if(strlen($str) > 40) $str = substr($str, 0, 40) . "...";
            }
        ?>
        <h4 class="company"><?=isset($str)?sanitize_string($str,"capitalize"):false?></h4>
        <?php
            $solid_stars = intval($rating / 2); // Divide by 2 to get number of solid stars
        ?>
        <div class="starts">
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
        <span class="quantify">(<?=isset($reviews)?count($reviews):0?>)</span>
    </div>
</div>
<div class="section--interior__link-header match-height">
    <a href="<?=$website??"#"?>" target="_blank" class="btn btn-primary"><?=lang("Company.visit_website")?></a>
</div>