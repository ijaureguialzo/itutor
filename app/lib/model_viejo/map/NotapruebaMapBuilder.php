<?php



class NotapruebaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NotapruebaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('notaprueba');
		$tMap->setPhpName('Notaprueba');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ALUMNO_ID', 'AlumnoId', 'int', CreoleTypes::INTEGER, 'alumno', 'ID', false, null);

		$tMap->addForeignKey('PRUEBA_ID', 'PruebaId', 'int', CreoleTypes::INTEGER, 'prueba', 'ID', false, null);

		$tMap->addColumn('NOTA', 'Nota', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('OBSERVACIONES', 'Observaciones', 'string', CreoleTypes::VARCHAR, false, 3000);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 