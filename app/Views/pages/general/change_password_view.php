<section class="section section--businesses">
    <img src="<?=base_url('assets/ownsite/img/background-2.png')?>" alt="" class="background drag-none">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Password Verification Form</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm-password" required>
                        <small id="password-match-message"></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>