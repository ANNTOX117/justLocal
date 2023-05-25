<main class="container my-5 main">
    <div class="row">
        <div class="col-md-4">
            <h3>All categories</h3>
            <div class="list-group">
                <?php if(isset($all_categories) && !empty($all_categories)):?>
                    <?php foreach ($all_categories as $category):?>
                        <button type="button" class="list-group-item list-group-item-action" data-id="<?=$category['id']?>"><?=$category["name"]??false?></button>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Categories
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="categoryName">Categories</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" name="category">
                    </div>
                    <div class="my-3 form-check">
                        <input type="checkbox" class="form-check-input" id="blockCategory">
                        <label class="form-check-label" for="blockCategory" name="blockCategory">Active</label>
                    </div>
                    <button id="category_submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</main>
