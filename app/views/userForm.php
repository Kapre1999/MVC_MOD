<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body><br>
    <h1 class="text-center p-1">User Registration</h1>
    <?php if (isset($data['error'])): ?>
      <?php foreach ($data['error'] as $error ): ?>
        <div class="container border-danger p-2 text-danger text-center">
          <ul class="list-group list-unstyled">
            <li><?php echo $error;?></li>
          </ul>
        </div>
      <?php endforeach ?>
    <?php endif ?>
    <?php if (isset($data['success'])): ?>
      <div class="border-success p-2 text-success text-center">
        <?php echo $data['success']; ?>
      </div>
    <?php endif ?>
    <form action="<?php echo URLROOT.'/test/userregister' ?>" class="container" method="POST">
      <div class="hidden">
        <?php echo CSRF_TOKEN(); ?>
      </div>
      <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" id="text" name="name"
          value="<?php  if(isset($data['name'])){ echo $data['name'];}?>"
          class="form-control"
        >
      </div>
       <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" id="email" name="email"
        value="
          <?php  if(isset($data['email'])){ echo $data['email'];}?>"
          class="form-control"
        >
      </div>
       <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"
          class="form-control"
        >
      </div>
      <div class="form-group">
        <label for="confirm_password">Comfirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary text-center">Submit</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>