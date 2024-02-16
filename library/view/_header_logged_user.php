<?php require_once __DIR__."/../model/user.class.php";?>
<!DOCTYPE html>
<html lang="hr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>VideoShare</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <table id = "navigacija">
    <tr>
      <td> <?php  echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['user']->slika).'" id = "profilna"/>' ;echo "<br>"; echo $_SESSION['user']->username; ?></td>
      <td> <a href="index.php?rt=korisnickiRacun/prikaz">Korisnički račun</a> </td>
      <td> <a href="index.php?rt=video/index"> Pregled svih videa</a> </td>
      <td> <a href="index.php?rt=video/myvideos"> Pregled mojih videa </a></td>
      <td> <a href="index.php?rt=video/ucitaj"> Učitaj novi video </a></td>
    </tr>
  </table>
