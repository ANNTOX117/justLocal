<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name user</th>
                <th>Email</th>
                <th>Company name</th>
                <th>Blocked</th>
                <th>Actived</th>
                <th>Verified</th>
                <th>Deleted</th>
                <th>Approved</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_members as $user):?>
                <tr data-id="<?=$user->id?>">
                    <td><?=$user->id?></td>
                    <td><?=$user->name?></td>
                    <td><?=$user->email?></td>
                    <td><?=$user->company_name??false?></td>
                    <td><?=($user->blocked)?"Blocked":"Active"?></td>
                    <td><?=($user->active)?"Actived":"No actived"?></td>
                    <td><?=($user->verified)?"Verified":"No verified"?></td>
                    <td><?=($user->deleted)?"Deleted":"Not deleted"?></td>
                    <td><?=($user->approved)?"Approved":"Not approved"?></td>
                    <td><span class="m-2 text-primary edit_user" data-id="<?=$user->id?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></span></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Update user</h4>
            </div>
            <div class="modal-body">
                <div class="form_update">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="companyName">Company Name:</label>
                        <input type="text" class="form-control" id="companyName" placeholder="Enter company name">
                    </div>
                    <div class="form-group">
                        <label>Actions by user:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="blockUser">
                            <label class="form-check-label" for="blockUser">Block User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="deleteUser">
                            <label class="form-check-label" for="deleteUser">Delete User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="approveUser">
                            <label class="form-check-label" for="approveUser">Approve User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="activeUser">
                            <label class="form-check-label" for="activeUser">Active User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="verifiedUser">
                            <label class="form-check-label" for="verifiedUser">Verified User</label>
                        </div>
                        <label class="d-block">Actions by company:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="activeCompany">
                            <label class="form-check-label" for="activeCompany">Active Company</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="deleteCompany">
                            <label class="form-check-label" for="deleteCompany">Delete Company</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="blockCompany">
                            <label class="form-check-label" for="blockCompany">Block Company</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="hide_modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_info">Update info</button>
            </div>
        </div>
    </div>
</div>