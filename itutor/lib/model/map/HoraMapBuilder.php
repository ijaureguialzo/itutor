<?php



class HoraMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HoraMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('hora');
		$tMap->setPhpName('Hora');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TRAMO', 'Tramo', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('DESCANSO', 'Descanso', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::VARCHAR, false, 3000);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 