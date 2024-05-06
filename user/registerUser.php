<!DOCTYPE html>
<html>
<body>
    <?php include '../template/header.php'; ?>
      <div class="container">
        <h2>Spontan Fotboll Stockholm</h2>
        <p>Registrera dig för att se alla platser de spelar spontan fotboll i stockholm</p>
        <form method="post" action="register.php">
          <div class="form-group">
            <label for="usr">Användarnamn:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="pwd">Lösenord:</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="pwd">E-post:</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>
          </br>
          <div class="form-group">
            <input class="btn btn-secondary btn-sm" type="submit" value="Registrera">
          </div>
          <div class="form-group">
              <a class="nav-link" href="/phpDev/login/loginUser.php""><u>Glömt ditt lösenord</u></a>
          </div>
        </form>
      </div>
    <?php include '../template/footer.php'; ?>
</body>
</html>