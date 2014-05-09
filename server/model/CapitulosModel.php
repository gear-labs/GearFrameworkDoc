<?php

use Gear\Db\GMySqli;

class CapitulosModel
{
	public function getChapters()
	{
		return GMySqli::getRegisters( 'Capitulos' );		
	} // end getChapters

	//*******************************************************************************

	public function getSubChapters( $idChapter )
	{
		return GMySqli::getRegisters( 'SubCapitulos', 'idSubCapitulo, titulo, url', 'Capitulos_idCapitulo = ' . $idChapter );

	} // end getSubChapters

	//*********************************************************************************

	public function getChapterTitle( $idChapter )
	{
		return GMySqli::getRegister( 'Capitulos', 'capitulo',
			'idCapitulo = ' . $idChapter )[ 'capitulo' ];
	} // end getChapterTitle

	//*********************************************************************************

	public function getContent( $url, $isAJAX = false )
	{
		if( $isAJAX )
		{
			return GMySqli::getRegister( 'SubCapitulos', 'titulo, contenido', 
			'url = ' . "'" . $url . "'" ); 
		} // end if

		return GMySqli::getRegister( 'SubCapitulos', 'titulo, contenido, Capitulos_idCapitulo', 
			'url = ' . "'" . $url . "'" );
	} // end getContent

} // end Capitulos Model