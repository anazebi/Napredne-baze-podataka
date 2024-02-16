<?php

require_once __DIR__."/../database/database.php";
require_once __DIR__."/user.class.php";

class Video
{
	protected $naziv, $link, $opis, $lajkovi, $dislajkovi, $tagovi, $vrijeme;

    function __construct($naziv = "", $link = "", $opis = "", $vrijeme = "",
                        $tagovi = [])
	{
		$this->naziv = $naziv;
        $this->link = $link;
        $this->opis = $opis;
        $this->tagovi = $tagovi;
        $this->lajkovi = 0;
        $this->dislajkovi = 0;
        $this->vrijeme = $vrijeme;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

    public function upload($korisnik)
    {
        // provjeri postoje li potrebni podaci
        if($this->naziv === "" || $this->opis === "" || $this->link === ""
            || $this->vrijeme === "")
            return 0;
        
        // odredi video id i ubaci ga u sorted set videa korisnika, zajedno s
        // vremenom učitavanja videa
        if(!($r->exists("korisnik:".$korisnik->id.":br_videa")))
        {
            $r->set("korisnik:".$korisnik->id.":br_videa", 1);
            $id = 0;
        }
        else
        {
            $id = $r->get("korisnik:".$korisnik->id.":br_videa");
            $r->incr("korisnik:".$korisnik->id.":br_videa");
        }

        $r->zAdd("korisnik:".$korisnik->id.":video", $this->vrijeme, $id);

        // spremi video u bazu kao hash
        $r->hMset("korisnik:".$korisnik->id.":video:".$id,
                    ["naziv" => $this->naziv, "link" => $this->link,
                    "opis" => $this->opis, "lajkovi" => $this->lajkovi,
                    "dislajkovi" => $this->dislajkovi]);
        return 1;
    }

    public function uredi($korisnik)
    {

    }
}

?>

