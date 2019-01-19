<?php



class DiarioMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DiarioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('diario');
		$tMap->setPhpName('Diario');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('EVALUACION_ID', 'EvaluacionId', 'int', CreoleTypes::INTEGER, 'evaluacion', 'ID', false, null);

		$tMap->addForeignKey('ASIGNATURA_ID', 'AsignaturaId', 'int', CreoleTypes::INTEGER, 'asignatura', 'ID', false, null);

		$tMap->addForeignKey('GRUPO_ID', 'GrupoId', 'int', CreoleTypes::INTEGER, 'grupo', 'ID', false, null);

		$tMap->addForeignKey('PROFESOR_ID', 'ProfesorId', 'int', CreoleTypes::INTEGER, 'profesor', 'ID', false, null);

		$tMap->addColumn('FECHA', 'Fecha', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ACTIVIDAD', 'Actividad', 'string', CreoleTypes::VARCHAR, false, 3000);

		$tMap->addColumn('UDIDACTICA', 'Udidactica', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 