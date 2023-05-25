<section class="section section--hero">
    <section class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="section--hero__content">
                    <div class="col-md-6 m-auto" id="login">
                        <?php if(session()->getFlashdata('err_message')){ ?>
                            <div class="form-group text-center">
                                <label class="text-danger" for="">
                                <?php echo session()->getFlashdata('err_message'); ?>
                                </label>
                            </div>
                        <?php } ?>
                        <div class="card">
                            <div class="card-body">
                                <form action="logUser" id="login_no_more" method="post">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="password" class="form-label">Password:</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                    <div id="loggin_error_msg" class="alert alert-danger mt-2 d-none">
                                    </div>
                                    <div class="text-center mt-4">
                                        <a href="<?=base_url("register")?>">Register</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>