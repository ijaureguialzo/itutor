<?php



class EvaluacionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EvaluacionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('evaluacion');
		$tMap->setPhpName('Evaluacion');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITULO', 'Titulo', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('FECHAINI', 'Fechaini', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('FECHAFIN', 'Fechafin', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('OBSERVACIONES', 'Observaciones', 'string', CreoleTypes::VARCHAR, false, 3000);

		$tMap->addColumn('ACTIVO', 'Activo', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 