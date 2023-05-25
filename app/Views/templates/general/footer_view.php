<footer id="mainFooter">
	<div class="container">
		<div class="widgets-area">
			<div class="row">
				<div class="col-lg-4">
					<div class="widget ms-0 ">
						<figure class="logo"><a href="#"><img src="<?=base_url('assets/img/logo.png')?>"></a></figure>
						<p class="paragraph"><?= lang("Footer.paragraph")?></p>
						<div class="social">
							<a href="#" target="_blank" class="social-link"><i class="fa-brands fa-linkedin-in"></i></a>
							<a href="#" target="_blank" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
							<a href="#" target="_blank" class="social-link"><i class="fa-brands fa-instagram"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="row">
						<div class="col-lg-4">
							<div class="widget ">
								<h4 class="widget__title"><?= lang("Footer.links")?></h4>
								<ul class="widget__nav">
									<li class="widget__nav__item"><a href="<?=base_url()?>" class="widget__nav__item__link"><?= lang("Menu.home")?></a></li>
									<li class="widget__nav__item"><a href="<?=base_url(route_to("about_us"))?>" class="widget__nav__item__link"><?= lang("Menu.about_us")?></a></li>
									<li class="widget__nav__item"><a href="<?=base_url(route_to("offers"))?>" class="widget__nav__item__link"><?= lang("Menu.offers")?></a></li>
									<li class="widget__nav__item"><a href="<?=base_url(route_to("bussiness"))?>" class="widget__nav__item__link"><?= lang("Menu.companies")?></a></li>
									<li class="widget__nav__item"><a href="<?=base_url(route_to("favorite"))?>" class="widget__nav__item__link"><?= lang("Menu.favorites")?></a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="widget">
								<h4 class="widget__title"><?= lang("Footer.services")?></h4>
								<ul class="widget__nav">
									<li class="widget__nav__item"><a href="#" class="widget__nav__item__link"><?=lang("Footer.help")?></a></li>
									<li class="widget__nav__item"><a href="<?= base_url("contact")?>" class="widget__nav__item__link"><?=lang("Menu.contact")?></a></li>
									<li class="widget__nav__item"><a href="<?= base_url("login")?>" class="widget__nav__item__link"><?=lang("Menu.login")?></a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="widget widget--small">
								<h4 class="widget__title"><?=lang("Footer.contact_us")?></h4>
								<ul class="widget__nav">
									<li class="widget__nav__item">
										<a href="mailto:info@justlocal.nl" class="email widget__nav__item__link"><i class="fa-solid fa-envelope "></i>info@justlocal.nl</a>
									</li>
									<li class="widget__nav__item">
										<address><i class="fa-sharp fa-solid fa-location-dot"></i> Londenstraat 33,<br> 7559 KS HENGELO</address>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>