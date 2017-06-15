<?php

namespace OCFram;

class Cach
{
	protected $directoryPath,
    		  $fileExtension;

	const DONNEES = 'datas';
	const VUES = 'views';
	
	public function __construct($directoryPath) 
	{
		$this->setDirectoryPath = $directoryPath;
		$this->fileExtension = '.txt';
	}

	public function generateFile($fileName, $resource, \DateInterval $expirationDate) 
	{
		$resourceType = (is_string($resource)) ? self::VUES : self::DONNEES;
		$filePath = $this->getFilePath($fileName, $resourceType);

		$date = new \DateTime();
		$date->add($expirationDate);
		$expirationDate = $date->format('Y-m-d H:i');
		
		$data = $expirationDate.PHP_EOL;
		$data .= ($resourceType == self::DONNEES) ? serialize($resource) : $resource;
		file_put_contents($filePath, $data);

		return $this;
	}

	public function loadFileData($fileName) 
    {
    	$filePath = $this->getFilePath($fileName, self::DONNEES);
    	
    	if(file_exists($filePath)) 
		{
			$lines = file($filePath);
			$expirationDate = new \DateTime($lines[0]);
			$currentDate = new \DateTime();
			$content = unserialize($lines[1]);

			if($expirationDate < $currentDate) 
			{
				$this->deleteFile($fileName);
			}
			else 
			{
				return $content;
			}
		}
    }

    public function loadFileView($fileName) 
    {
    	$filePath = $this->getFilePath($fileName, self::VUES);

    	if(file_exists($filePath)) 
		{
			$lines =  file($filePath);
			$content = '';
			
			foreach($lines as $n => $line){
				if($n == 0) 
				{
					$expirationDate = new \DateTime($lines[$n]);
					$currentDate = new \DateTime();

					if($expirationDate < $currentDate) 
					{
						$this->deleteFile($fileName);
						return;
					}
				}
				else 
				{
					$content .= $line; 
				}
			}

			return $content;
		}
    }

	public function deleteFile($fileName) 
	{
		$resourceType = (preg_match('#_#', $fileName)) ? self::VUES : self::DONNEES;
		$filePath = $this->getFilePath($fileName, $resourceType);
		unlink($filePath);

		return $this;
	}

	protected function getFilePath($fileName, $resourceType) 
	{
		return $this->directoryPath.DIRECTORY_SEPARATOR.$resourceType.DIRECTORY_SEPARATOR.$fileName.$this->fileExtension;
	}

	public function setDirectoryPath($directoryPath) 
	{
		if(!is_dir($directoryPath)) 
		{
			throw new \InvalidArgumentException('Chemin d\'accès au répertoire des ressources invalide !');
		}

		$this->directoryPath = $directoryPath;
	}

	public function setFileExtesion($fileExtension) 
	{
		if(!is_string($fileExtension)) 
		{
			throw new \InvalidArgumentException('L\'extension des fichiers du cach specifiée est invalide !');
		}

		$this->fileExtension = $fileExtension;
	}

	public function fileExtension() 
	{
		return $this->fileExtension;
	}

	public function directoryPath() 
	{ 
		return $this->directoryPath; 
	}
}