<section class="section section--businesses my-4">
    <img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background drag-none">
    <div class="container">
        <div class="section--hero__content mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-3">
                        <form action="" id="form_contact">
                            <div class="form-group">
                                <label for="name"><?=lang("Contact.label_name")?>:</label>
                                <input type="text" class="form-control" id="name" placeholder="<?=lang("Contact.placeholder_name")?>" name="name">
                                <span class="text-danger d-none msg-error" id="name_error"></span>
                            </div>
                            <div class="form-group my-4">
                                <label for="email"><?=lang("Contact.email")?>:</label>
                                <input type="email" class="form-control" id="email" placeholder="<?=lang("Contact.placeholder_email")?>" name="email">
                                <span class="text-danger d-none msg-error" id="email_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="message"><?=lang("Contact.label_email")?>:</label>
                                <textarea class="form-control" id="message" rows="3" placeholder="<?=lang("Contact.placeholder_email")?>" name="message"></textarea>
                                <span class="text-danger d-none msg-error" id="message_error"></span>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary"><?=lang("Contact.btn_submit")?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="title title--section" style="margin-bottom: 0;">Contact</h2>
                    <div class="paragraph">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates atque explicabo est fuga voluptatem suscipit qui nesciunt, velit hic tempora, aliquam deleniti accusamus harum tempore dignissimos corrupti vero adipisci molestias.</p>
                    </div>
                    <div class="address">
                        <h2>JustLocal</h2>
                        <ul>
                            <li>Address</li>
                            <li>Email</li>
                            <li>Tel</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="alert alert-success d-none" id="success-msg"></div>
        </div>
    </div>
</section>