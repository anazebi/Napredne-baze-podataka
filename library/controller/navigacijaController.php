<?php
require_once __DIR__."/../model/user.class.php"; 
require_once __DIR__ . "/../model/videoService.class.php";
session_start();

class NavigacijaController
{
	public function index()
	{
		$user = $_SESSION["user"];
    	$title = "Navigacija";

		require_once __DIR__ . '/../view/navigacija_index.php';
	}
	public function guest()
	{
		if(isset($_SESSION["user"])){
			session_unset();
		};
		$title = "Prikaz svih videa";
		$videi = VideoService::sviVidei();
      	require_once __DIR__ . '/../view/video_guest.php';
	}
};

?>
