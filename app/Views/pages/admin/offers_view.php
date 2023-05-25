<main class="container my-5 main">
    <div id="liveAlertPlaceholder"></div>
    <div class="card">
        <div class="card-header">
            Offer Information
        </div>
        <div class="card-body">
            <form action="" id="form_offer">
                <div class="form-group">
                    <label for="offerName">Offer Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="offerName" name="offerName" placeholder="Enter company name">
                </div>
                <div class="form-group">
                    <label for="offerDescription">Description</label>
                    <textarea name="offerDescription" class="form-control" id="offerDescription" cols="30" rows="8"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company">Company <span class="text-danger">*</span></label>
                            <select name="company" class="form-control" id="company">
                                <?php if(isset($companies) && !empty($companies)):?>
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?= $company->id ?>"><?= $company->name?></option>
                                <?php endforeach; ?>
                                <?php else:?>
                                    <option value="">There is no companies</option>
                                <?php endif?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="review">Review <span class="text-danger">*</span></label>
                            <input type="number" step="0.1" min="0" max="10" class="form-control" id="review" name="review">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount">Discount <span class="text-danger">*</span></label>
                            <input type="number" step="1" min="1" max="99" class="form-control" id="discount" name="discount">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="companyCountry">Country <span class="text-danger">*</span></label>
                            <select name="country" class="form-control" id="companyCountry">
                            <option value="">Select a country</option>
                                <?php if(isset($countries) && !empty($countries)):?>
                                    <?php foreach ($countries as $country): ?>
                                        <option value="<?=$country->id?>"><?=$country->name?></option>
                                    <?php endforeach; ?>
                                <?php endif?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group d-none" id="provinces">
                            <label for="companyProvince">Province <span class="text-danger">*</span></label>
                            <select name="province" class="form-control" id="companyProvince">
                                <option value="">Select Provinces</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group d-none" id="cities">
                            <label for="companyCities">Cities <span class="text-danger">*</span></label>
                            <select name="city" class="form-control" id="companyCities">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="my-3 form-check">
                    <input type="checkbox" class="form-check-input" id="blockOffer" name="blockOffer">
                    <label class="form-check-label" for="blockOffer">Active</label>
                </div>
                <button class="btn btn-primary mt-3" id="companyForm" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <table class="table" id="table_offers">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Company</th>
                <th>City</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offers as $offer):?>
                <tr>
                    <td><?=$offer->id?></td>
                    <td><?=$offer->title?></td>
                    <td><?=$offer->description?></td>
                    <td><?=$offer->company_name?></td>
                    <td><?=$offer->city_name?></td>
                    <td>
                        <span class="text-info mx-2 btn-update-offer" data-id="<?= $offer->id ?>"><i class="fa-solid fa-pen-to-square" title="edit"></i></span>
                        <span class="text-danger delete-icon" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $offer->id ?>"><i class="fa-solid fa-trash" title="delete"></i></span>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿ Are you sure to delete it ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="delete_offer" class="btn btn-sm btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>
</main>