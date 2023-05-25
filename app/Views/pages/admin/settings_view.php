<main class="container my-5 main">
    <div class="row">
        <div class="col-md-4">
            <h3>Settings</h3>
            <div class="list-group">
                <?php if(isset($categories) && !empty($categories)):?>
                    <?php foreach ($categories as $category):?>
                        <button type="button" class="list-group-item list-group-item-action"><?=$category["name"]??false?></button>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Company Information
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="companyName">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter company name">
                    </div>
                    <div class="form-group">
                        <label for="companyDescription">Description</label>
                        <textarea name="companyDescription" class="form-control" id="companyDescription" cols="30" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="companyImage">Image brand <span class="text-danger">*</span></label>
                        <input type="file" name="companyImage" id="companyImage" class="form-control" accept="image/png, image/gif, image/jpeg">
                    </div>
                    <div class="d-none mt-3" id="image-preview">
                        <img id="preview" src="" alt="Preview Image">
                    </div>
                    <div class="form-group">
                        <label for="companyEmail">Email address</label>
                        <input type="email" class="form-control" id="companyEmail" name="companyEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="companyPhone">Phone Number</label>
                        <input type="tel" class="form-control" id="companyPhone" name="companyPhone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label for="companyWebsite">Web site</label>
                        <input type="tel" class="form-control" id="companyWebsite" name="companyWebsite" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label for="companyAddress">Address</label>
                        <textarea name="companyAddress" class="form-control" id="companyAddress" cols="30" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="companyCategory">Category <span class="text-danger">*</span></label>
                        <select name="category" class="form-control" id="companyCategory">
                            <?php if(isset($categories) && !empty($categories)):?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                            <?php else:?>
                                <option value="">There is no categories</option>
                            <?php endif?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="companyFacebook">Facebook url</label>
                        <input type="tel" class="form-control" id="companyFacebook" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label for="companyInstagram">Instagram</label>
                        <input type="tel" class="form-control" id="companyInstagram" placeholder="Enter phone number">
                    </div>
                    <div class="my-3 form-check">
                        <input type="checkbox" class="form-check-input" id="blockCompany">
                        <label class="form-check-label" for="blockCompany" name="blockCompany">Active</label>
                    </div>
                    <button class="btn btn-primary mt-3" id="companyForm">Submit</button>
                </div>
            </div>
        </div>
    </div>
</main>