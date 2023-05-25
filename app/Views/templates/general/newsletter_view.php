<section class="section section--subscribe bg-blue">
    <img src="<?=base_url('assets/img/banner-decoration.png')?>" alt="" class="decoration decoration-one drag-none">
    <img src="<?=base_url('assets/img/decoration-two-white.png')?>" alt="" class="decoration decoration-three drag-none">
    <img src="<?=base_url('assets/img/decoration-white.png')?>" alt="" class="decoration decoration-four drag-none">
    <img src="<?=base_url('assets/img/banner-decoration.png')?>" alt="" class="decoration decoration-two drag-none">
    <div class="container">
        <div class="content">
            <h3 class="title title--section c-white text-center"><?= lang("Snippets.title_newsletter")?></h3>
            <p class="section--subscribe__text c-white text-center"><?= lang("Snippets.paragraph_newsletter")?></p>
            <form action="#" class="section--subscribe__form" id="newsletter_form">
                <div class="input-group">
                    <input type="email" placeholder="<?= lang("Snippets.email_newsletter")?>" class="form-control" id="email_newsletter" required>
                    <button type="submit" class="btn btn-primary"><?= lang("Snippets.btn_newsletter")?></button>
                </div>
            </form>
        </div>
    </div>
</section>