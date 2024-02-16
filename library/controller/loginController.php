<?php

require_once __DIR__."/../model/user.class.php";
session_start();
class LoginController
{
    public function index()
    {
        // proslijedi informacije na prikaz logina
        $naslov = "Login za VideoShare";
        $los_login = false;
        $losa_registracija = false;
        $registracijski_status = false;
        require_once __DIR__."/../view/login_index.php";
    }

    public function login()
    {
        $naslov = "Login za VideoShare";
        $los_login = false;
        $losa_registracija = false;
        $registracijski_status = false;

        // provjeri jesu li stigle login informacije
        if(!isset($_POST["username"]) || !isset($_POST["password"]))
        {
            $los_login = true;
            // vrati natrag na login stranicu
            require_once __DIR__."/../view/login_index.php";
        }
        // pokušaj obaviti login
        else
        {
            $username = htmlentities($_POST["username"]);
            $password = htmlentities($_POST["password"]);

            $user = new User($username, $password);
            if($user->check_login())
            {
                $_SESSION["user"] = $user;
                require_once __DIR__."/../view/navigacija_index.php";
            }
            else
            {
                $los_login = true;
                require_once __DIR__."/../view/login_index.php";
            }
        }
    }

    public function register()
    {
        $naslov = "Login za VideoShare";
        $los_login = false;
        $losa_registracija = false;
        $registracijski_status = false;

        // provjeri jesu li stigle registracijske informacije
        if(!isset($_POST["username"]) || !isset($_POST["password"]))
        {
            $losa_registracija = true;
            // vrati natrag na login stranicu
            require_once __DIR__ . "/../view/login_index.php";
        }
        // pokušaj obaviti registraciju
        else
        {
            $username = htmlentities($_POST["username"]);
            $password = htmlentities($_POST["password"]);
            if(isset($_POST["ime"]))
                $ime = htmlentities($_POST["ime"]);
            else
                $ime = "";
            if(isset($_POST["prezime"]))
                $prezime = htmlentities($_POST["prezime"]);
            else
                $prezime = "";
            if(isset($_FILES["slika"]) && $_FILES['slika']['size']>0)
            {
              $target_dir = __DIR__ . '/../slikeprofila';
              $target_file = $target_dir . basename($_FILES["slika"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
              $target_file = $target_dir . '/' . $username . '.' . $imageFileType;
              $slika = $username . '.' .$imageFileType;

              $check = getimagesize($_FILES['slika']['tmp_name']);
              if($check === false)
              {
                $uploadOk = 0;
                $losa_registracija = true;
                require_once __DIR__."/../view/login_index.php";
              }
              // Provjera veličine slike
              else if ($_FILES["slika"]["size"] > 500000)
              {
                $error = "Odabrana slika je prevelika.";
                $uploadOk = 0;
                $losa_registracija = true;
                require_once __DIR__."/../view/login_index.php";
              }
              // Provjeri je li slika dozvoljenog formata
              else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
              {
                $error = "Odaberite sliku u formatu JPG, JPEG, PNG ili GIF.";
                $uploadOk = 0;
                $losa_registracija = true;
                require_once __DIR__."/../view/login_index.php";
              }
              // provjeravamo je li upload prošao uspješno
              else if ($uploadOk === 0)
              {
                $error = "Nešto je pošlo po zlu pri učitavanju slike profila, pokušajte ponovno!";
                $losa_registracija = true;
                require_once __DIR__."/../view/login_index.php";
              }
              // ako je sve oke pokušamo uploadati datoteku
              else
              {
                if (!move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file))
                {
                  $error = "Nešto je pošlo po zlu pri učitavanju slike profila, pokušajte ponovno!";
                  $losa_registracija = true;
                  require_once __DIR__ . "/../view/login_index.php";
                }
                else {
                  $slikabinarna = file_get_contents(__DIR__ . '/../slikeprofila/' . $slika);
                  $user = new User($username, $password, $ime, $prezime, $slikabinarna);
                  unlink(__DIR__ . '/../slikeprofila/' . $slika);

                  if($user->register())
                  {
                    $registracijski_status = true;
                    require_once __DIR__."/../view/login_index.php";
                  }
                  else
                  {
                    $losa_registracija = true;
                    require_once __DIR__."/../view/login_index.php";
                  }
                }
              }
            }
            else
            {
              $uploadOk = 1;
              $slikabinarna = file_get_contents(__DIR__ . '/../slikeprofila/defaultimage.jpg');
              $user = new User($username, $password, $ime, $prezime, $slikabinarna);

              if($user->register())
              {
                $registracijski_status = true;
                require_once __DIR__."/../view/login_index.php";
              }
              else
              {
                $losa_registracija = true;
                require_once __DIR__."/../view/login_index.php";
              }
            }
        }
      }
    }
?>
