<?php

require_once 'server/drawing/ErrorDrawing.php';

class ErrorController 
{
	public function __construct()
	{
		$draw = new ErrorDrawing();
		$draw->drawPage( 'Error - La página solicitada no existe' );
	}
}

$page = new ErrorController();