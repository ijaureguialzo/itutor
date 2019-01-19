<?php



class PruebaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PruebaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('prueba');
		$tMap->setPhpName('Prueba');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('EVALUACION_ID', 'EvaluacionId', 'int', CreoleTypes::INTEGER, 'evaluacion', 'ID', false, null);

		$tMap->addForeignKey('ASIGNATURA_ID', 'AsignaturaId', 'int', CreoleTypes::INTEGER, 'asignatura', 'ID', false, null);

		$tMap->addColumn('DIA', 'Dia', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HORA', 'Hora', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FECHA', 'Fecha', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('DURACION', 'Duracion', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PORCENTAJE', 'Porcentaje', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OBSERVACIONES', 'Observaciones', 'string', CreoleTypes::VARCHAR, false, 3000);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 