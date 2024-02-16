<?php

require_once __DIR__."/../model/user.class.php";
require_once __DIR__."/../model/video.class.php";
session_start();
class KorisnickiRacunController
{
    public function prikaz()
    {
        // brine se za prikaz mogućnosti upravljanja korisničkim računom
        $k = $_SESSION["user"];
        $naslov = "Korisnički račun";
        $promjena = false;
        require_once __DIR__."/../view/korisnickiRacun_prikaz.php";
    }
    public function uredi_korisnika()
    {
        // korisnik može promijeniti: username, password, ime, prezime, sliku
        $k = $_SESSION["user"];
        $staro = $k->username;
        $username = $k->username;
        $password = $k->password;
        $ime = $k->ime;
        $prezime = $k->prezime;
        $slika = $k->slika;
        $id = $k->id;

        if(isset($_POST["username"]) && $_POST["username"] !== "")
            $username = $_POST["username"];
        if(isset($_POST["password"]) && $_POST["password"] !== "")
            $password = $_POST["password"];
        if(isset($_POST["ime"]) && $_POST["ime"] !== "")
            $ime = $_POST["ime"];
        if(isset($_POST["prezime"]) && $_POST["prezime"] !== "")
            $prezime = $_POST["prezime"];
        if(isset($_POST["slika"]) && $_POST["slika"] !== "")
            $slika = $_POST["slika"];

        $novo = new User($username, $password, $ime, $prezime, $slika, $id);
        $k->update_user($novo, $staro);

        $_SESSION["user"] = $novo;
        $promjena = true;
        $k = $novo;
        $naslov = "Korisnički račun";
        require_once __DIR__."/../view/korisnickiRacun_prikaz.php";
    }

    public function video()
    {
        // brine se za prikaz mogućnosti upravljanja pojedinim videom
        $k = $_SESSION["user"];
        $naslov = "Uređivanje videa";
        $lista = $k->dohvati_videe();
        $promjena = false;
        require_once __DIR__."/../view/korisnickiRacun_video.php";
    }

    public function uredi_video()
    {
        // korisnik može promijeniti: naziv, opis
        $id = $_POST["gumb"];
        $k = $_SESSION["user"];

        $video = $k->dohvati_video($id);
        $naziv = $video["naziv"];
        $link = $video["link"];
        $opis = $video["opis"];

        if(isset($_POST["naziv"]) && $_POST["naziv"] !== "")
            $naziv = $_POST["naziv"];
        if(isset($_POST["opis"]) && $_POST["opis"] !== "")
            $opis = $_POST["opis"];

        $novo = new Video($naziv, $link, $opis);
        $k->update_video($novo, $id);

        $naslov = "Uređivanje videa";
        $lista = $k->dohvati_videe();
        $promjena = true;
        require_once __DIR__."/../view/korisnickiRacun_video.php";
    }
}

?>
