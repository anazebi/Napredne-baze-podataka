<?php require_once __DIR__."/_header.php";?>
<h1>Pretraživanje videa</h1>

<div id = "kor_podaci">
<h2>Pretraživanje videa </h2>
<table>
<form action = "index.php?rt=video/pretrazi" method = "POST">
    <table>
    <tr><td>Pretraži po tagu: </td><td><input type = "text" name = "tag"></td><td></td></tr>
    <tr><td>Pretraži po imenu: </td><td><input type = "text" name = "videoName"></td><td></td></tr>
    <td><input type = "submit" value = "Pretrazi videe"></td></tr>
    </table>
</form>
</table>
<?php if(isset($prazno)&&$prazno) echo  "Niste unjeli tag ili naziv za pretragu."; ?>
</div>

<br><br>
<?php require_once __DIR__."/povratak_navigacija.php";?>
<?php require_once __DIR__."/_footer.php";?>