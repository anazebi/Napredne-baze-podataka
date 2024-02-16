<?php require_once __DIR__ . '/_header_logged_user.php'; ?>

<h2>Dodavanje novog videozapisa:</h2>
<br>

<form action="index.php?rt=video/ucitaj" method="post">
  <table>
    <tr>
      <td>Unesite ime novoga videozapisa: </td>
      <td><input type="text" name="video_ime" value=""></td>
    </tr>
    <tr>
      <td>Unesite link novoga videozapisa: </td>
      <td><input type="text" name="video_link" value=""></td>
    </tr>
    <tr>
      <td>Unesite opis željenog videa: </td>
      <td><textarea name="opis" rows="4" cols="40"></textarea></td>
    </tr>
    <tr>
      <td>Unesite oznake videozapisa odvojene zarezom: </td>
      <td><textarea name="tagovi" rows="3" cols="40"></textarea></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
        <td> <input type="submit" name="ucitajvideo" value="Dodaj novi video">  </td>
    </tr>
  </table>
  <br><br>
</form>

<?php require_once __DIR__ . '/povratak_navigacija.php' ?>
<?php echo "<br>"; ?>
<?php require_once __DIR__ . '/_footer.php' ?>
