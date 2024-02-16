<?php

require_once __DIR__."/../database/database.php";

class User
{
	protected $username, $password, $ime, $prezime, $id, $slika;

	function __construct($username, $password, $ime = "", $prezime = "",
						$slika = "", $id = "")
	{
		$this->username = $username;
		$this->password = $password;
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->id = $id;
		$this->slika = $slika;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

	// pokušaj logirati korisnika, poziva se kad već imamo username i password
	public function check_login()
	{
		// nađi korisnika u bazi
		$r = DB::getConnection();

		// odredi id korisnika iz indeksa
		$this->id = $r->Get("indeks:korisnik:".$this->username);
		if($r->exists("korisnik:".$this->id)){
			$podaci = $r->hMGet("korisnik:".$this->id,
								["password", "ime", "prezime", "slika"]);

			if($this->password === $podaci["password"]){
				$this->ime = $podaci["ime"];
				$this->prezime = $podaci["prezime"];
				$this->slika = $podaci["slika"];
				return true;
			}
		}

		return false;
	}

	// pokušaj registrirati korisnika
	public function register()
	{
		// ako korisnik ne postoji, registriraj ga
		$r = DB::getConnection();

		if(!($r->exists("korisnik:".$this->username))){
			// odredi id korisnika
			$this->id = $r->get("br_korisnika");
			$r->incr("br_korisnika");

			// spremi ga u indeks
			$r->Set("indeks:korisnik:" . $this->username, $this->id);

			// spremi podatke o korisniku
			$r->hMSet("korisnik:".$this->id, ["username" => $this->username,
                    "password" => $this->password,
                    "ime" => $this->ime, "prezime" => $this->prezime,
                    "slika" => $this->slika]);
			return true;
		}

		return false;
	}

	public function update_user($novo, $staro)
	{
		$r = DB::getConnection();
		$r->rename('indeks:korisnik:' . $staro, 'indeks:korisnik:' . $novo->username);
		$r->hMSet("korisnik:".$novo->id, ["username" => $novo->username,
                    "password" => $novo->password,
                    "ime" => $novo->ime, "prezime" => $novo->prezime,
                    "slika" => $novo->slika]);
	}

	public function dohvati_videe()
	{
		$lista = [];

		$r = DB::getConnection();
		// prođi po listi od početka (0) do kraja (-1)
		$indeksi = $r->zRange("korisnik:".$this->id.":video", 0, -1);

		foreach($indeksi as $id => $time)
			$lista[$id] = $r->hMGet("korisnik:".$this->id.":video:".$id,
								["naziv", "link", "opis", "lajkovi",
								"dislajkovi"]);

		return $lista;
	}

	public function dohvati_video($id)
	{
		$r = DB::getConnection();
		return $r->hMGet("korisnik:".$this->id.":video:".$id,
						["naziv", "link", "opis", "lajkovi",
						"dislajkovi"]);
	}

	public function update_video($novo, $id)
	{
		$r = DB::getConnection();
		$r->hMSet("korisnik:".$this->id.":video:".$id,
								["naziv" => $novo->naziv, "link" => $novo->link,
								"opis" => $novo->opis, "lajkovi" => $novo->lajkovi,
								"dislajkovi" => $novo->dislajkovi]);
	}
}

?>
