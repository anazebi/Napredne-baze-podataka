<?php require_once __DIR__ . '/video.class.php'; ?>
<?php require_once __DIR__ . '/user.class.php'; ?>
<?php require_once __DIR__."/../database/database.php"; ?>

<?php

  class videoService
  {
    static function dodajVideo($video, $user)
    {

      $r = DB::getConnection();
      $id = $user->id;

      if(!($r->exists("korisnik:".$user->id.":br_videa")))
      {
          $r->set("korisnik:".$user->id.":br_videa", 1);
          $brojvidea = 0;
      }
      else
      {
          $brojvidea = $r->get("korisnik:".$user->id.":br_videa");
          $r->incr("korisnik:".$user->id.":br_videa");
      }

      $r->zAdd("korisnik:" . $id . ":video", $video->vrijeme, $brojvidea);

      $r->sAdd("indeks:naziv:" . $video->naziv, "korisnik:" . $user->id .":video:" . $brojvidea);

      $r->hMSet("korisnik:" . $id . ":video:" . $brojvidea, ['naziv' => $video->naziv, 'link' => $video->link, 'opis' => $video->opis, 'lajkovi' => $video->lajkovi, 'dislajkovi' => $video->dislajkovi]);

      $r->sAdd("indeks:video:" . $video->naziv, "korisnik:" . $user->id
              .":video:" . $brojvidea);
      foreach ($video->tagovi as $tag) {
            $r->sAdd("korisnik:" . $id . ":video:" . $brojvidea . ":tags", $tag);
            $r->sAdd("indeks:tag:" . $tag, "korisnik:" . $id . ":video:" . $brojvidea);
      }
    }

    static function sviVidei()
    {
      $lista = [];
      $r = DB::getConnection();

      $brojkorisnika = $r->get("br_korisnika");

      for($i = 0; $i < $brojkorisnika; $i++)
      {
        if($r->exists("korisnik:" . $i) && $r->exists("korisnik:" . $i . ":br_videa"))
        {
          $brojvidea = $r->get("korisnik:" . $i . ":br_videa");
          for ($j = 0; $j < $brojvidea; $j++) {
            if($r->exists("korisnik:" . $i . ":video:" . $j))
            {
              $video = $r->hMGet("korisnik:" . $i . ":video:" .$j, ['link']);
              array_push($lista, $video['link']);
            }
          }
         }
       }
      return $lista;
    }

    public function dohvati_name_videe($videoName)
    {
        $r = DB::getConnection();
        $listaIndeksa = [];
        $listaVidea = [];

        $smece = array_pop($listaIndeksa);
        $smece = array_pop($listaVidea);

        $indeks = $r->smembers("indeks:video:" . $videoName);
        foreach($indeks as $in)
        {
            $video = $r->hvals($in);
            $listaVidea[] = $video;
        }
        return $listaVidea;
    }

    public function dohvati_tag_videe($tagovi)
    {
        $r = DB::getConnection();
        $listaIndeksa = [];
        $listaVidea = [];
        $smece = array_pop($listaIndeksa);
        $smece = array_pop($listaVidea);

        $indeks = $r->smembers("indeks:tag:" . $tagovi);
        $listaIndeksa[] = $indeks; 
	
        foreach($indeks as $in)
        {
            $video = $r->hvals($in);
            $listaVidea[] = $video;
        }
        return $listaVidea;
    }

  };

 ?>
