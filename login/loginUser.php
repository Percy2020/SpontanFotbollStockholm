<!DOCTYPE html>
<html>
<body>
    <?php include '../template/header.php'; ?>
<div class="container">
  <h2>Spontan Fotboll Stockholm</h2>
  <p>Logga in och se vart du kan spela fotboll i Stockholm nu</p>
  <form method="post" action="login.php">
    <div class="form-group">
      <label for="usr">Användarnamn:</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
      <label for="pwd">Lösenord:</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
      <label>
        <input type="checkbox" name="remember"> Kom ihåg mig
    </label>
    </div>
    <div class="form-group">
      <input class="btn btn-secondary btn-sm" type="submit" value="Logga in">
    </div>
    <div class="form-group">
    <a class="nav-link" href="/phpDev/user/registerUser.php""><u>Registera</u></a>
    <a class="nav-link" href="/phpDev/login/loginUser.php""><u>Glömt ditt lösenord</u></a>
   </div>
  </form>
</div>

    <?php include '../template/footer.php'; ?>
</body>
</html>