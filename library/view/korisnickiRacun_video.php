<?php require_once __DIR__."/_header.php";?>
<h1>Račun korisnika: <?php echo $k->username; ?></h1>
<h2>Uređivanje videa</h2>

<div id = "video_podaci">

<?php if($promjena) echo "Video uspješno uređen!"; ?>

<table>
<form action = "index.php?rt=korisnickiRacun/uredi_video" method = "POST">
    <table>
        <?php 
            foreach($lista as $id => $video)
            {
                echo "<tr><td>Naziv: ".$video["naziv"].
                    "</td><td><input type = 'text' name = 'naziv'></td>";
                echo "<tr><td>Link: </td><td>".$video["link"]."</td>";
                echo "<tr><td>Opis: ".$video["opis"].
                    "</td><td><input type = 'text' name = 'opis'></td>";
                echo "<tr><td>Lajkovi: </td><td>".$video["lajkovi"]."</td>";
                echo "<tr><td>Dislajkovi: </td><td>".$video["dislajkovi"]."</td>";
                echo "<td><button type = 'submit' name = 'gumb'
                            value = $id>Uredi video!</td></tr>";
            }
        ?>
    
    </table>
</form>
</table>
<?php if($promjena) echo "Podaci uspješno promijenjeni!"; ?>
</div>

<?php require_once __DIR__."/povratak_navigacija.php";?>
<?php require_once __DIR__."/_footer.php";?>
