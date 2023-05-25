<section class="section section--hero">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="section--hero__content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="list-group" id="list_options_edit">
                                <button type="button" class="list-group-item list-group-item-action active" id="edit_company_button">Edit company</button>
                                <button type="button" class="list-group-item list-group-item-action" id="review_button">Reviews</button>
                                <button type="button" class="list-group-item list-group-item-action" id="offers_button">Offers</button>
                                <button type="button" class="list-group-item list-group-item-action" id="multiple_image_button">Pictures</button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="border">
                                <div id="reviews" class="menu_forms">
                                    <div class="m-3" id="review_form">
                                        <h3>Create a new Review</h3>
                                        <form id="form_review">
                                            <div class="form-group">
                                                <label for="comment-review" class="form-label">Comment review</label>
                                                <textarea class="form-control" id="comment-review" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name-review">Creator name</label>
                                                <input type="text" class="form-control" id="name-review" name="name-review" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="job-description-review">Job description</label>
                                                <input type="text" class="form-control" id="job-description-review" name="job-description-review" required>
                                            </div>
                                            <input type="hidden" name="company_id" id="company_id" value="<?=$company["id"]?>">
                                        </form> 
                                        <div class="text-center">
                                            <button type="submit" id="submit_form_review" class="btn btn-info mt-2">Insert review</button>
                                        </div>
                                    </div>
                                    <?php if (isset($reviews)):?>
                                        <table class="table" id="table_reviews">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Content</th>
                                                    <th scope="col">Creator</th>
                                                    <th scope="col">Job description</th>
                                                    <th scope="col">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($reviews as $review):?>
                                                    <tr>
                                                        <th scope="row"><?=$review->id?></th>
                                                        <td><?=$review->content?></td>
                                                        <td><?=$review->creator_name?></td>
                                                        <td><?=$review->job_description?></td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else:?>
                                        <p class="text-center py-2" id="no_reviews">There is no reviews yet</p>
                                    <?php endif;?>
                                </div>
                                <div id="offers" class="d-none menu_forms">
                                    <?php if (isset($offers)):?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Discount</th>
                                                    <th scope="col">Review</th>
                                                    <!-- <th scope="col">City/Province</th> -->
                                                    <th scope="col">Active</th>
                                                    <th scope="col">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($offers as $offer):?>
                                                    <tr>
                                                        <th scope="row"><?=$offer->id?></th>
                                                        <td><?=$offer->title?></td>
                                                        <td><?=$offer->description?></td>
                                                        <td><?=$offer->discount?></td>
                                                        <td><?=$offer->review?></td>
                                                        <!-- <td><//?=$offer->city_name?></td> -->
                                                        <td><?=$offer->block=="0"?"active":"inactive"?></td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else:?>
                                        <p class="text-center py-2">There is no offers yet</p>
                                    <?php endif;?>
                                </div>
                                <div id="multiple_image" class="d-none menu_forms">
                                    <h3>Add pictures</h3>
                                    <div class="loader_image">
                                        <form id="multipleimages_form">
                                            <div class="mb-3">
                                                <input type="hidden" name="company_id" id="company_id" value="<?=$company["id"]?>">
                                                <label for="multiple_images" class="form-label">Choose one or more files</label>
                                                <input type="file" class="form-control-file" id="multiple_images" multiple accept="image/*">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <?php if (isset($media)):?>
                                            <?php foreach ($media as $image):?>
                                                <div class="col-md-4 col-sm-6">
                                                    <figure>
                                                        <?php $name_file = "uploads/company/".$company["id"]."/media/".$image->name_file ?>
                                                        <a href="<?=base_url($name_file)?>" data-lightbox="images-interior">
                                                            <img src="<?=base_url($name_file)?>" alt="">
                                                        </a>
                                                    </figure>
                                                </div>
                                            <?php endforeach;?>
                                            <?php else:?>
                                                <div class="text">
                                                    <p>No image found</p>
                                                </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
