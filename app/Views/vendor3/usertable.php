<?= $this->extend('vendor3/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Users Table</h6>
              <a href="<?=base_url(VD.'adduser')?>" class="btn btn-primary" style="float: right;">+ Add User</a>
            </div>
            
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th> 
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Brand</th> <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key=>$emp): ?>
                <tr>
                    <td><?= $key+1?></td>
                    <td><?= $emp['name'] ?></td>
                
                    <td><?= $emp['email'] ?></td>
                    <td><?= $emp['phone_no'] ?></td>
                    <td><?= $emp['role'] ?></td>
                    <td><button class="btn btn-primary"><a href="<?= base_url(VD); ?>brtable?user_id=<?=$emp['user_id'] ?>" class="text-light">Brand</a></button></td>
                    <td>
                    <button class="btn btn-primary"><a href="<?=base_url(VD);?>edituser/<?=$emp['user_id']?>"class="text-light">Edit</a></button>
                           <button class="btn btn-danger"><a href="<?=base_url(VD);?>deleteuser/<?=$emp['user_id']?>"class="text-light">Delete</a></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection() ?>