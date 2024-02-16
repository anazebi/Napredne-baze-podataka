<?php
session_start();
class IndexController
{
	public function index()
	{
		// Samo preusmjeri na login stranicu.
		header( 'Location: index.php?rt=login' );
	}
};

?>
