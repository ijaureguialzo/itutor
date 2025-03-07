<?php


abstract class BaseAlumnoPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'alumno';

	
	const CLASS_DEFAULT = 'lib.model.Alumno';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'alumno.ID';

	
	const GRUPO_ID = 'alumno.GRUPO_ID';

	
	const CODIGO = 'alumno.CODIGO';

	
	const NOMBRE = 'alumno.NOMBRE';

	
	const EMAIL = 'alumno.EMAIL';

	
	const OBSERVACIONES = 'alumno.OBSERVACIONES';

	
	const ACTIVO = 'alumno.ACTIVO';

	
	const UPDATED_AT = 'alumno.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'GrupoId', 'Codigo', 'Nombre', 'Email', 'Observaciones', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (AlumnoPeer::ID, AlumnoPeer::GRUPO_ID, AlumnoPeer::CODIGO, AlumnoPeer::NOMBRE, AlumnoPeer::EMAIL, AlumnoPeer::OBSERVACIONES, AlumnoPeer::ACTIVO, AlumnoPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'grupo_id', 'codigo', 'nombre', 'email', 'observaciones', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'GrupoId' => 1, 'Codigo' => 2, 'Nombre' => 3, 'Email' => 4, 'Observaciones' => 5, 'Activo' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (AlumnoPeer::ID => 0, AlumnoPeer::GRUPO_ID => 1, AlumnoPeer::CODIGO => 2, AlumnoPeer::NOMBRE => 3, AlumnoPeer::EMAIL => 4, AlumnoPeer::OBSERVACIONES => 5, AlumnoPeer::ACTIVO => 6, AlumnoPeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'grupo_id' => 1, 'codigo' => 2, 'nombre' => 3, 'email' => 4, 'observaciones' => 5, 'activo' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AlumnoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AlumnoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AlumnoPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(AlumnoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AlumnoPeer::ID);

		$criteria->addSelectColumn(AlumnoPeer::GRUPO_ID);

		$criteria->addSelectColumn(AlumnoPeer::CODIGO);

		$criteria->addSelectColumn(AlumnoPeer::NOMBRE);

		$criteria->addSelectColumn(AlumnoPeer::EMAIL);

		$criteria->addSelectColumn(AlumnoPeer::OBSERVACIONES);

		$criteria->addSelectColumn(AlumnoPeer::ACTIVO);

		$criteria->addSelectColumn(AlumnoPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(alumno.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT alumno.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AlumnoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AlumnoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AlumnoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AlumnoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AlumnoPeer::populateObjects(AlumnoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AlumnoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AlumnoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AlumnoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AlumnoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AlumnoPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = AlumnoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AlumnoPeer::addSelectColumns($c);
		$startcol = (AlumnoPeer::NUM_COLUMNS - AlumnoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GrupoPeer::addSelectColumns($c);

		$c->addJoin(AlumnoPeer::GRUPO_ID, GrupoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AlumnoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GrupoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getGrupo(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAlumno($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAlumnos();
				$obj2->addAlumno($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AlumnoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AlumnoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AlumnoPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = AlumnoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AlumnoPeer::addSelectColumns($c);
		$startcol2 = (AlumnoPeer::NUM_COLUMNS - AlumnoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GrupoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(AlumnoPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AlumnoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getGrupo(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAlumno($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAlumnos();
				$obj2->addAlumno($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return AlumnoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(AlumnoPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AlumnoPeer::ID);
			$selectCriteria->add(AlumnoPeer::ID, $criteria->remove(AlumnoPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += AlumnoPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(AlumnoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(AlumnoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Alumno) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AlumnoPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += AlumnoPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = AlumnoPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Falta.php';

						$c = new Criteria();
			
			$c->add(FaltaPeer::ALUMNO_ID, $obj->getId());
			$affectedRows += FaltaPeer::doDelete($c, $con);

			include_once 'lib/model/Retraso.php';

						$c = new Criteria();
			
			$c->add(RetrasoPeer::ALUMNO_ID, $obj->getId());
			$affectedRows += RetrasoPeer::doDelete($c, $con);

			include_once 'lib/model/Notaprueba.php';

						$c = new Criteria();
			
			$c->add(NotapruebaPeer::ALUMNO_ID, $obj->getId());
			$affectedRows += NotapruebaPeer::doDelete($c, $con);

			include_once 'lib/model/Notaevaluacion.php';

						$c = new Criteria();
			
			$c->add(NotaevaluacionPeer::ALUMNO_ID, $obj->getId());
			$affectedRows += NotaevaluacionPeer::doDelete($c, $con);

			include_once 'lib/model/Comportamiento.php';

						$c = new Criteria();
			
			$c->add(ComportamientoPeer::ALUMNO_ID, $obj->getId());
			$affectedRows += ComportamientoPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Alumno $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AlumnoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AlumnoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(AlumnoPeer::DATABASE_NAME, AlumnoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AlumnoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(AlumnoPeer::DATABASE_NAME);

		$criteria->add(AlumnoPeer::ID, $pk);


		$v = AlumnoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(AlumnoPeer::ID, $pks, Criteria::IN);
			$objs = AlumnoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAlumnoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/AlumnoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AlumnoMapBuilder');
}
