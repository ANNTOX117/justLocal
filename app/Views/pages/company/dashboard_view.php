<section class="section section--businesses">
<img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="section--hero__content">
                    <h2>Your companies</h2>
                    <!-- <table class="table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>description</th>
                                <th>Active</th>
                                <th>Delete</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //if(isset($companies)):?>
                                <?php //foreach ($companies as $company):?>
                                    <tr>
                                        <td><?//=sanitize_string($company->name??false,"none")?></td>
                                        <td><?//=sanitize_string($company->description??false,"none")?></td>
                                        <td><?//=$company->block === "0"?"active":"inactive"?></td>
                                        <td><?//=$company->block === "1"?"deleted":"active"?></td>
                                        <td><span><i class="fa-solid fa-trash"></i></span><span><a href="<?//=base_url("company/edit/".$company->slug)?>"><i class="fa-solid fa-pen-to-square"></i></a></span></td>
                                    </tr>
                                <?php //endforeach;?>
                            <?php //endif?>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section--businesses continuation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ms-auto">
                <?php if(isset($companies)):?>
                    <div class="blocks">
                        <div class="row">
                            <?php foreach ($companies as $company):?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="block">
                                        <a href="<?=base_url("company/edit/").$company->slug?>">
                                            <figure class="block__figure">
                                                <img src="<?=base_url("uploads/company/25/profile/logo_1683231793_e33cf27fdb43684404e2.jpg")?>" class="block__figure__image">
                                            </figure>
                                        </a>
                                        <div class="block__content">
                                            <div class="block__content__header d-flex flex-direction-row">
                                                <a href="<?=base_url("company/edit/").$company->slug?>"><h4 class="discount"><?=sanitize_string($company->name)??false?></h4></a>
                                                <?php
                                                    $rating = $company->review;
                                                    $solid_stars = intval($rating / 2);
                                                ?>
                                                <div class="rating">
                                                    <?php for($i=0; $i<5; $i++){ ?>
                                                        <?php if($i < $solid_stars){ ?>
                                                            <i class="fa-solid fa-star"></i>
                                                        <?php } elseif($i == $solid_stars && $rating % 2 != 0){ ?>
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        <?php } else { ?>
                                                            <i class="fa-regular fa-star"></i>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <h3 class="title title--block"><a href="<?=base_url("company/edit/").$company->slug?>"><?=sanitize_string($company->title)??false?></a></h3>
                                            <h4 class="place">Hengelo, Overijssel</h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endif?>
            </div>
        </div>
    </div>
    <img src="<?= base_url('assets/ownsite/img/decoration-two.png')?>" class="decoration-two">
</section>