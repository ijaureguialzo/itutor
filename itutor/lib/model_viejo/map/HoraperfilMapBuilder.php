<?php



class HoraperfilMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HoraperfilMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('itutor');

		$tMap = $this->dbMap->addTable('horaperfil');
		$tMap->setPhpName('Horaperfil');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('HORA_ID', 'HoraId', 'int', CreoleTypes::INTEGER, 'hora', 'ID', false, null);

		$tMap->addForeignKey('PERFIL_ID', 'PerfilId', 'int', CreoleTypes::INTEGER, 'perfil', 'ID', false, null);

		$tMap->addColumn('ORDEN', 'Orden', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 