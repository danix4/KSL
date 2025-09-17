
<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location:../admin/admin.php");
}
elseif (isset($_SESSION["principal"])) {
  header("Location:../principal/principal.php");
}
elseif (isset($_SESSION["employee"])) {
  header("Location:../employee/employee.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/login.css">
<link href="https://fonts.googleapis.com/css2?family=Jura&display=swap" rel="stylesheet">
<title> Login Pagina </title>
</head>
  <body>
    <div class="login-page">
      <div class="form">
        <div class="login">
          <h1>LOGIN</h1>
          <p>Voer uw gegevens in om in te loggen.</p>
        </div>

        <form action="loginFunction.php"  method="post" class="login-form">
          <input type="email"  required name="Email" placeholder="Email"/>
          <input type="password" required name="Password" placeholder="Wachtwoord"/>
          <div class="error_message">Fout email of wachtwoord</div>
          <button class="margin-bottom">login</button>
          <a class="forgot_pass" href="">Wachtwoord vergeten</a>
        </form>
      </div>
    </div>
    <script>
      const url = new URL(window.location.href);
      const error = url.searchParams.get("error");
      if (error && error === "credentials") {
        document.getElementsByClassName('error_message')[0].style.display='block'; 
      } 
    </script>
</body>
</html>