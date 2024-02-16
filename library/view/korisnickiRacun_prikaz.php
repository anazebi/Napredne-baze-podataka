<?php require_once __DIR__."/_header.php";?>
<h1>Račun korisnika: <?php echo $k->username; ?></h1>

<div id = "kor_podaci">
<h2>Uređivanje korisničkih podataka</h2>
<table>
<form action = "index.php?rt=korisnickiRacun/uredi_korisnika" method = "POST">
    <table>
    <tr><td style="font-weight:bold">Username: </td><td> <?php echo $k->username; ?></td><td><input type = "text" name = "username"></td><td></td></tr>
    <tr><td style="font-weight:bold">Password: </td><td><?php echo $k->password; ?></td><td><input type = "password" name = "password"></td><td></td></tr>
    <tr><td style="font-weight:bold">Ime: </td><td><?php echo $k->ime; ?></td><td><input type = "text" name = "ime"></td><td></td></tr>
    <tr><td style="font-weight:bold">Prezime: </td><td><?php echo $k->prezime; ?></td><td><input type = "text" name = "prezime"></td><td></td></tr>
    <tr><td style="font-weight:bold">Slika: </td><td><?php  echo '<img src="data:image/jpeg;base64,'.base64_encode($k->slika).'" id = "profilna"/>';?></td>
    <td><input type = "submit" value = "Promijeni podatke"></td></tr>
    </table>
</form>
</table>
<?php if($promjena) echo "Podaci uspješno promijenjeni!"; ?>
</div>
<h2>Uređivanje videa</h2>
<table>
<tr>
  <td>
<a href="index.php?rt=korisnickiRacun/video">Uredi videe</a>
</td>
</tr>
</table>
<br><br>
<?php require_once __DIR__."/povratak_navigacija.php";?>
<?php echo "<br>"; ?>
<?php require_once __DIR__."/_footer.php";?>
