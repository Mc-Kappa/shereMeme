<!doctype html>
<html>
<head>
<title>IoT Project</title>
<meta name="description" content="Hash page">
<link rel="stylesheet" href="login_style.css">
</head>
<body>
  <form method="post">
    <div class="container">
      <h2>Password Hasher</h2>
      Password to hash:<br/>
      <input type = "password" name="password1" placeholder="Enter Password to hash" class = "box" />
      </br>
      <button type="submit">Hash</button>
      </br>
      <?php
          $password1 = $_POST['password1'];
          if(strlen($password1) > 0) {
            $passhash = password_hash($password1, PASSWORD_DEFAULT);
            echo $passhash;
            unset($_POST['password1']);
          } else {
            unset($_POST['password1']);
          };
  ?>
    </div>
  </form>
</body>
</html>



