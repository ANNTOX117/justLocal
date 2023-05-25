<?php 
    $session = session();
    $uri = service('uri')->getSegment(1);
    $redirect = "/";
    switch ($uri) {
        case 'company':
            $redirect.= "company/";
        break;
        case 'admin':
            $redirect.= "admin/home";
        break;
    }
?>
<header id="mainHeader" class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">        
            <a class="navbar-brand" href="<?= base_url($redirect)?>">
                <img src="<?= base_url('assets/ownsite/img/logo.png')?>">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if($session->has("logged") && ($uri === "company" || $uri === "admin")):?>
                    <!-- company menu -->
                    <?php if ($session->get("type_user") === "2"):?>
                        <?php $uri_part_2 = service('uri')->getSegment(2)??false;?>
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text-dark <?php echo $uri_part_2===''?"active":false?>" aria-current="page" href="<?= base_url($redirect)?>">Dashboard</a>
                            </li>
                            <li class="nav-item ms-auto">
                                <a class="btn btn-danger" href="#" id="close_session">Sessie sluiten</a>
                            </li>
                        </ul>
                    <?php endif;?>
                    <!-- admin menu -->
                    <?php if ($session->get("type_user") === "3"):?>
                    <?php endif;?>
                <?php else:?>
                    <!-- normal user view -->
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php echo service('uri')->getSegment(1)===''?"active":false?>" aria-current="page" href="<?= base_url()?>"><?= lang("Menu.home")?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ((service('uri')->getSegment(1)==='bedrijven' ||service('uri')->getSegment(1)==='businesses' )|| (service('uri')->getSegment(1) !== ''&& service('uri')->getSegment(1) !== 'provinces' && service('uri')->getSegment(1) !== 'login'&& service('uri')->getSegment(1) !== 'favorite'&& service('uri')->getSegment(1) !== 'favoriete'&& service('uri')->getSegment(1) !== 'provincies'&& service('uri')->getSegment(1) !== 'register'&& service('uri')->getSegment(1) !== 'over_ons'&& service('uri')->getSegment(1)!=='aanbiedingen'&& service('uri')->getSegment(1)!=='offers'&& service('uri')->getSegment(1)!=='provinces' &&service('uri')->getSegment(1)!=='about_us' && service('uri')->getSegment(1)!=='contact')) ? 'active' : false ?>" href="<?=base_url(route_to("bussiness"))?>"><?=lang("Menu.companies")?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo service('uri')->getSegment(1)==='aanbiedingen'||service('uri')->getSegment(1)==='offers'?"active":false?>" href="<?=base_url(route_to('offers'))?>"><?=lang("Menu.offers")?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo service('uri')->getSegment(1)==='provinces'||service('uri')->getSegment(1)==='provincies'?"active":false?>" href="<?=base_url(route_to("provinces"))?>"><?=lang("Menu.provinces")?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo service('uri')->getSegment(1)==='about_us'||service('uri')->getSegment(1)==='over_ons'?"active":false?>" href="<?= base_url(route_to('about_us'))?>"><?=lang("Menu.about_us")?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo service('uri')->getSegment(1)==='contact'?"active":false?>" href="<?= base_url('contact')?>"><?=lang("Menu.contact")?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo service('uri')->getSegment(1)==='favorite'||service('uri')->getSegment(1)==='favoriete'?"active":false?>" href="<?= base_url(route_to('favorite'))?>"><i class="fa-solid fa-heart"></i> <?=lang("Menu.favorites")?></a>
                        </li>
                        <li class="nav-item d-flex">
                            <form action="<?=base_url(route_to('bussiness'))?>" class="d-flex header__search">
                                <input class="form-control" type="search" placeholder="<?=lang("Menu.search_company")?>" aria-label="Search" name="name_company">
                                <button class="d-flex align-items" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </li>
                        <li class="nav-item ms-auto">
                            <a class="nav-link" href="<?=base_url("login")?>"><?=lang("Menu.login")?></a>
                        </li>
                    </ul>
                <?php endif?>
            </div>
        </div>
    </nav>
</header>