<?php
//var_dump($_POST);
if(isset($_POST['user']) && isset($_POST['password'])) {
    //Valid-e?
    
    include_once("dbcon.php");
    $link = DBcon();
        
    $inuser = $_POST['user'];
    $inpass = md5($_POST['password']);
    
    $result = $link->query("SELECT level, id FROM users WHERE name = \"$inuser\" AND password = \"$inpass\";");

    
    $row_count = $result->num_rows;
    if($row_count == 1) {
        session_start();
        $_SESSION['user'] = $inuser;
        $row = mysqli_fetch_array($result);
        $_SESSION['level'] = $row['level'];
        $_SESSION['id'] = $row['id'];
        $link->close();
        header("Location: index.php");
    }
    
    $link->close();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="login.php">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputEmail" class="form-control <?php
             if(isset($_POST['user'])) {
                 echo "is-invalid";
             }
        ?>" placeholder="Username" name="user" required
      <?php
             if(isset($_POST['user'])) {
                 echo " value=\"" . $_POST['user'] . "\"";
             }
             else{
                 echo " autofocus";
             }
        ?>
      >
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control <?php
             if(isset($_POST['user'])) {
                 echo "is-invalid";
             }
        ?>" placeholder="Password" name="password" required
      <?php
             if(isset($_POST['user'])) {
                 echo " autofocus";
             }
        ?>
        >
        <?php
             if(isset($_POST['user'])) {
                 echo "<div class=\"invalid-feedback\">Worng username or password!</div>";
             }
        ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
    </form>
  </body>
</html>












