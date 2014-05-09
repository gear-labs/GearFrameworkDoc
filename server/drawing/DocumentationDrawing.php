<?php

use Gear\Draw\Drawing;

class DocumentationDrawing extends Drawing
{
	private $myCapitulo;

	public function __construct()
	{
		parent::__construct();
		$this->myCapitulo = new CapitulosModel();
	} // end __construct

	//**************************************************************

	public function drawChapters()
	{		
		// Obtiene los capitulos
		$chapters = $this->myCapitulo->getChapters();

		// Itera a traves de los capítulos
		foreach ( $chapters as $chapter ) 
		{
			$this->list[] = array(
				'idChapter' => $chapter[ 'idCapitulo' ],
				'Chapter Name' => $chapter[ 'capitulo' ],
				'SubChapters' => $this->drawSubChapters( $chapter[ 'idCapitulo' ] ), // para el nav izquierdo
			);

		} // end foreach

		$this->setList( 'chapters' );
		$this->draw( 'Chapters' );
		
	} // end drawChapters

	//*************************************************************************

	public function drawContent( $url = 'resumen', $isAJAX = false )
	{
		// Optimiza al maximo la consulta y paso de datos
		if( !$isAJAX )
		{
			$content = $this->myCapitulo->getContent( $url );
			$this->principalList[ 'Chapter' ] = $this->myCapitulo->getChapterTitle( $content[ 'Capitulos_idCapitulo' ] ); // titulo del capitulo
		} // end if
		
		$content = $this->myCapitulo->getContent( $url, true );
		$this->principalList[ 'SubChapter' ] = $content[ 'titulo' ]; // titulo del Sub-Capitulo
		$this->principalList[ 'Content' ] = $content[ 'contenido' ]; // Contenido del Sub-Capitulo
		
		if( $isAJAX )
		{
			return $this->principalList;
		} // end if
			
	} // end drawContent




	//**************************************************************************

	private function drawSubChapters( $idChapter )
	{
		// Obtiene los subcapitulos
		$subChapters = $this->myCapitulo->getSubChapters( $idChapter );

		$list = array();

		// Itera a traves de los subcapitulos
		foreach ( $subChapters as $subChapter ) 
		{
			$list[] = array
			(
				'idSubChapter' => $subChapter[ 'idSubCapitulo' ],
				'SubChapter' => $subChapter[ 'titulo' ],
				'SubChapter Link' => $subChapter[ 'url' ],
			);
		} // end foreach

		// Establece el template de los subcapitulos
		$this->setList( 'subchapters' );

		return ( ( $this->draw( 'SubChapters', $list ) ) );
	} // end drawSubChapters
} // end IndexDrawing
