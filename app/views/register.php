<?php session_start();?>
<h1>Add new user</h1>

<form action="/register" method="POST">
  <div class="mb-3">
    <label class="form-label">First name</label>
    <input type="text" value="" name="first_name" class="form-control <?php echo $user->hasError('first_name') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
      <?php echo $user->getError('first_name') ?>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Last name</label>
    <input type="text" value="" name="last_name" class="form-control <?php echo $user->hasError('last_name') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
      <?php echo $user->getError('last_name') ?>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" value="" name="email" class="form-control <?php echo $user->hasError('email') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
      <?php echo $user->getError('email') ?>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" value="" name="password" class="form-control <?php echo $user->hasError('password') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
      <?php echo $user->getError('password') ?>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Gender</label>
    <input type="text" value="" name="gender" class="form-control <?php echo $user->hasError('gender') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
      <?php echo $user->getError('gender') ?>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Birthday</label>
    <input type="text" value="" name="birthday" class="form-control <?php echo $user->hasError('birthday') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
      <?php echo $user->getError('birthday') ?>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Register</button>
</form>