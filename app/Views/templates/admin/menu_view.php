<nav class="navbar navbar-expand-lg navbar-light bg-light header">
    <div class="container-fluid">
    <!-- Left Side -->
    <div class="navbar-brand">
        <img src="your-logo.png" alt="Your Logo">
    </div>
    <!-- Middle -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <?php if(session()->get('type_user') == 3): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/home')?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/categories')?>">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/users')?>">Users</a>
                </li>
            <?php endif; ?>
            <?php if(session()->get('type_user') == 3 || session()->get('type_user') == 2): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/companies')?>">Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/offers')?>">Offers</a>
                </li>
            <?php endif; ?>
            <!-- <li class="nav-item">
            <a class="nav-link" href="#">Oven ons</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
            </li> -->
        </ul>
    </div>
    <!-- Right Side -->
    <div class="d-flex">
        <a href="<?php echo base_url('logout')?>" class="btn btn-sm btn-danger">Uitloggen</a>
    </div>
    </div>
</nav>
