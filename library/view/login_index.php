<?php require_once __DIR__."/_header.php";?>
<h1>Dobrodošli u VideoShare</h1>
<div id="log">
<h2>LOGIN</h2>
<h3>Ukoliko već imate izrađen korisnički račun, unesite podatke za prijavu</h3>
<table>
<form action = "index.php?rt=login/login" method = "post">
    <tr><td>Username:</td><td><input type = "text" name = "username"></td><td></td></tr>
    <tr><td>Password:</td><td><input type = "password" name = "password"></td>
        <td><input type = "submit" value = "Login"></td></tr>

</form>
</table>
</div>
<?php
if($los_login)
    echo "<br><p>Login nije uspio, pokušajte ponovno!</p>";
?>
<div id = "reg">
<h2>REGISTRACIJA</h2>
<h3>Ako želite postati korisnik VideoSharea ispunite sljedeći obrazac:</h3>

<form action = "index.php?rt=login/register" method = "post" enctype="multipart/form-data">
    <table>
    <tr><td>Username:</td><td><input type = "text" name = "username"></td><td></td></tr>
    <tr><td>Password:</td><td><input type = "password" name = "password"></td><td></td></tr>
    <tr><td>Ime:</td><td><input type = "text" name = "ime"></td><td></td></tr>
    <tr><td>Prezime:</td><td><input type = "text" name = "prezime"></td></tr>
    <tr><td>Slika profila:</td><td><input type="file" name="slika" id="slika"></td>
    <td><input type = "submit" value = "Register"></td></tr>
    </table>
</form>
</div>
<br>
<form action="index.php?rt=navigacija/guest" method="post">
  <table>
    <tr>
      <td><button type="submit" name="guest">Nastavi kao gost</button></td></tr>
  </table>
</form>

<?php
if($losa_registracija)
    echo "<br><p>Registracija nije uspjela, pokušajte ponovno!</p>";

if($registracijski_status)
    echo "<br><p>Uspješna registracija! Za ulazak u aplikaciju obavite login.";

?>
<?php require_once __DIR__."/login_footer.php";?>
