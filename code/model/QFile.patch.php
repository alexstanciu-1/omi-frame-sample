<?php

/**
 * QFile
 * 
 * @author Alex
 * @storage.table Files
 */
class QFile extends QModel
{
	use QFile_GenTrait;
	// hidden property: _fstorage
	
	/**
	 * @var file
	 */
	public $Path;
	
	/**
	 * Called when an upload was made and you need to do something with the file
	 * As an option the file could be handled on upload
	 * 
	 * @param string $property
	 * @param string[] $upload_info
	 */
	public function handleUpload($property, $upload_info)
	{
		
	}
}
