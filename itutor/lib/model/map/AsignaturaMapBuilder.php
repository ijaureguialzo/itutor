<?php



class AsignaturaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AsignaturaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('asignatura');
		$tMap->setPhpName('Asignatura');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PROFESOR_ID', 'ProfesorId', 'int', CreoleTypes::INTEGER, 'profesor', 'ID', false, null);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::VARCHAR, false, 3000);

		$tMap->addColumn('AULA', 'Aula', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('PORCENTAJEPRUEBAS', 'Porcentajepruebas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PORCENTAJEFALTAS', 'Porcentajefaltas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PORCENTAJECOMPORTAMIENTO', 'Porcentajecomportamiento', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MAXIMOFALTAS', 'Maximofaltas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 