<?php

require_once 'server/model/CapitulosModel.php';
require_once 'server/drawing/DocumentationDrawing.php';

use Gear\Controller\ControllerAJAX;

class DocumentationController extends ControllerAJAX
{
	private $draw;

	public function __construct()
	{
		$this->draw = new DocumentationDrawing();		

		// Si la petición es para obtener un capitulo sin hacer la carga de la página 
		if( isset( $_POST['ajax'] ) )
		{
			$this->getSubChapter( $_POST[ 'url' ] );
		}
		else
		{
			$this->getFirstLoad();
		} // end if...else
	} // end __construct

	//*******************************************************************************************

	private function getFirstLoad()
	{
		if( isset( $_GET[ 'subchapter' ] ) )
		{
			$this->draw->drawPage( 'Bienvenido a Gear Framework', 
				array('Chapters()', 
					  'Content('. "'" . $_GET[ 'subchapter' ] . "'" . ')' 
					  
					  ));
		} 
		else 
		{
			$this->draw->drawPage( 'Bienvenido a Gear Framework', array('Chapters()', 'Content()' ) );
		}// end if...else
	} // end getFirstLoad

	//***********************************************************************************************

	private function getSubChapter( $url )
	{
		$this->callDraw( $this->draw, 'Content', array( $url ) );
	} // end getSubChapter

} // end DocumentationController

$page = new DocumentationController();