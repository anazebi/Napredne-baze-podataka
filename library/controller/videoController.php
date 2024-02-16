<?php

require_once __DIR__ . "/../model/user.class.php";
require_once __DIR__ . "/../model/video.class.php";
require_once __DIR__ . "/../model/videoService.class.php";
session_start();
class VideoController
{

    public function index()
    {
      $videi = VideoService::sviVidei();
      require_once __DIR__ . '/../view/video_index.php';
    }

    public function myvideos()
    {
        $k = $_SESSION["user"];
        $array = $k->dohvati_videe();
        $videi = [];

        foreach($array as $id => $video)
        {
            $videi[] = $video["link"];
        }

        require_once __DIR__ . '/../view/video_index.php';
    }

    public function ucitaj_prikaz()
    {
        // prikaz stranice za učitavanje videozapisa
        $naslov = "Učitavanje videozapisa";
        $uspjeh = false;
        $k = $_SESSION["user"];
        require_once __DIR__."/../view/video_ucitaj.php";
    }

    public function ucitaj()
    {
        // funkcija koja obavlja učitavanje videozapisa u bazu

        $naslov = "Učitavanje videozapisa";
        $korisnik = $_SESSION["user"];
        if(!isset($_POST['video_ime']) || $_POST['video_ime'] === '')
        {
          if (isset($_POST['ucitajvideo']))
          {
            require_once __DIR__."/../view/video_ucitaj.php";
            echo "<h3 style = 'color: red'>Obavezno je učitati ime i poveznicu na novi videozapis!</h3>";
          }
          else
            require_once __DIR__."/../view/video_ucitaj.php";
        }
        else {
          $video_ime = $_POST['video_ime'];
          $video_link = $_POST['video_link'];
          $video_opis = $_POST['opis'];
          $video_tags = explode(',', $_POST['tagovi']);
          $video = New Video($video_ime, $video_link, $video_opis, $vrijeme = time(), $video_tags);
          videoService::dodajVideo($video, $_SESSION['user']);

          require_once __DIR__."/../view/navigacija_index.php";
        }
    }

    public function prikazi()
    {
        // funkcija koja prikazuje video na stranici
        require_once __DIR__."/../view/video_prikazi.php";
    }

     public function pretrazivanje()
    {
        if(isset($_SESSION["user"])){
            require_once __DIR__."/../view/pretrazivanje_tag.php";
        }
        else
            require_once __DIR__."/../view/pretrazivanje_guest.php";
    }

    public function pretrazi()
    {
        $prazno = false;
        if( (!isset($_POST['tag']) || $_POST['tag']=== '')  &&
        (!isset($_POST['videoName']) || $_POST['videoName']=== ''))
        {
            $prazno = true;
            require_once __DIR__."/../view/pretrazivanje_tag.php";
        }
        if( isset($_POST['tag']) && $_POST['tag']!== '')
        {
            $tagovi = $_POST['tag'];
            //echo $tagovi;

            $videoS = new VideoService();
            $listaVidea = $videoS->dohvati_tag_videe($tagovi);
            $videi = [];
            foreach($listaVidea as $video)
               $videi[] = $video[1];

            if(isset($_SESSION["user"])){
                require_once __DIR__."/../view/video_index.php";
            }
            else
                require_once __DIR__."/../view/video_guest.php";

            /*echo 'ovo je lista videa s tagom ' . $tagovi . ': ';
            foreach($listaVidea as $video)
                foreach($video as $v)
                    echo $v . '<br>';*/
            
            
            
            
            //treba dodati pretraživanje po tagovima
        }
        if( isset($_POST['videoName']) && $_POST['videoName']!== '')
        {
            $videoName = $_POST['videoName'];
            $videoS = new VideoService();
            $listaVidea = $videoS->dohvati_name_videe($videoName);
            $videi = [];
            foreach($listaVidea as $video)
               $videi[] = $video[1];

            if(isset($_SESSION["user"])){
                require_once __DIR__."/../view/video_index.php";
            }
            else
                require_once __DIR__."/../view/video_guest.php";

        }
    }
}

?>
