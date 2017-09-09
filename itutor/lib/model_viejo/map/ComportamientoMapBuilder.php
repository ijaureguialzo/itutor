<?php



class ComportamientoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ComportamientoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('comportamiento');
		$tMap->setPhpName('Comportamiento');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ALUMNO_ID', 'AlumnoId', 'int', CreoleTypes::INTEGER, 'alumno', 'ID', false, null);

		$tMap->addForeignKey('EVALUACION_ID', 'EvaluacionId', 'int', CreoleTypes::INTEGER, 'evaluacion', 'ID', false, null);

		$tMap->addForeignKey('ASIGNATURA_ID', 'AsignaturaId', 'int', CreoleTypes::INTEGER, 'asignatura', 'ID', false, null);

		$tMap->addColumn('NOTA', 'Nota', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('OBSERVACIONES', 'Observaciones', 'string', CreoleTypes::VARCHAR, false, 3000);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 