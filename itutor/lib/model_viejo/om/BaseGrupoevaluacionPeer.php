<?php


abstract class BaseGrupoevaluacionPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'grupoevaluacion';

	
	const CLASS_DEFAULT = 'lib.model.Grupoevaluacion';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'grupoevaluacion.ID';

	
	const GRUPO_ID = 'grupoevaluacion.GRUPO_ID';

	
	const EVALUACION_ID = 'grupoevaluacion.EVALUACION_ID';

	
	const ACTIVO = 'grupoevaluacion.ACTIVO';

	
	const UPDATED_AT = 'grupoevaluacion.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'GrupoId', 'EvaluacionId', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (GrupoevaluacionPeer::ID, GrupoevaluacionPeer::GRUPO_ID, GrupoevaluacionPeer::EVALUACION_ID, GrupoevaluacionPeer::ACTIVO, GrupoevaluacionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'grupo_id', 'evaluacion_id', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'GrupoId' => 1, 'EvaluacionId' => 2, 'Activo' => 3, 'UpdatedAt' => 4, ),
		BasePeer::TYPE_COLNAME => array (GrupoevaluacionPeer::ID => 0, GrupoevaluacionPeer::GRUPO_ID => 1, GrupoevaluacionPeer::EVALUACION_ID => 2, GrupoevaluacionPeer::ACTIVO => 3, GrupoevaluacionPeer::UPDATED_AT => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'grupo_id' => 1, 'evaluacion_id' => 2, 'activo' => 3, 'updated_at' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/GrupoevaluacionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.GrupoevaluacionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = GrupoevaluacionPeer::getTableMap();
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
		return str_replace(GrupoevaluacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(GrupoevaluacionPeer::ID);

		$criteria->addSelectColumn(GrupoevaluacionPeer::GRUPO_ID);

		$criteria->addSelectColumn(GrupoevaluacionPeer::EVALUACION_ID);

		$criteria->addSelectColumn(GrupoevaluacionPeer::ACTIVO);

		$criteria->addSelectColumn(GrupoevaluacionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(grupoevaluacion.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT grupoevaluacion.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = GrupoevaluacionPeer::doSelectRS($criteria, $con);
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
		$objects = GrupoevaluacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return GrupoevaluacionPeer::populateObjects(GrupoevaluacionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			GrupoevaluacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = GrupoevaluacionPeer::getOMClass();
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
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GrupoevaluacionPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = GrupoevaluacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEvaluacion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GrupoevaluacionPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = GrupoevaluacionPeer::doSelectRS($criteria, $con);
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

		GrupoevaluacionPeer::addSelectColumns($c);
		$startcol = (GrupoevaluacionPeer::NUM_COLUMNS - GrupoevaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GrupoPeer::addSelectColumns($c);

		$c->addJoin(GrupoevaluacionPeer::GRUPO_ID, GrupoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GrupoevaluacionPeer::getOMClass();

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
										$temp_obj2->addGrupoevaluacion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initGrupoevaluacions();
				$obj2->addGrupoevaluacion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEvaluacion(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GrupoevaluacionPeer::addSelectColumns($c);
		$startcol = (GrupoevaluacionPeer::NUM_COLUMNS - GrupoevaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EvaluacionPeer::addSelectColumns($c);

		$c->addJoin(GrupoevaluacionPeer::EVALUACION_ID, EvaluacionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GrupoevaluacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EvaluacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEvaluacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addGrupoevaluacion($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initGrupoevaluacions();
				$obj2->addGrupoevaluacion($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GrupoevaluacionPeer::GRUPO_ID, GrupoPeer::ID);

		$criteria->addJoin(GrupoevaluacionPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = GrupoevaluacionPeer::doSelectRS($criteria, $con);
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

		GrupoevaluacionPeer::addSelectColumns($c);
		$startcol2 = (GrupoevaluacionPeer::NUM_COLUMNS - GrupoevaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GrupoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GrupoPeer::NUM_COLUMNS;

		EvaluacionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EvaluacionPeer::NUM_COLUMNS;

		$c->addJoin(GrupoevaluacionPeer::GRUPO_ID, GrupoPeer::ID);

		$c->addJoin(GrupoevaluacionPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GrupoevaluacionPeer::getOMClass();


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
					$temp_obj2->addGrupoevaluacion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initGrupoevaluacions();
				$obj2->addGrupoevaluacion($obj1);
			}


					
			$omClass = EvaluacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEvaluacion(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addGrupoevaluacion($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initGrupoevaluacions();
				$obj3->addGrupoevaluacion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GrupoevaluacionPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = GrupoevaluacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEvaluacion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoevaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GrupoevaluacionPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = GrupoevaluacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GrupoevaluacionPeer::addSelectColumns($c);
		$startcol2 = (GrupoevaluacionPeer::NUM_COLUMNS - GrupoevaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		$c->addJoin(GrupoevaluacionPeer::EVALUACION_ID, EvaluacionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GrupoevaluacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EvaluacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEvaluacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addGrupoevaluacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initGrupoevaluacions();
				$obj2->addGrupoevaluacion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEvaluacion(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GrupoevaluacionPeer::addSelectColumns($c);
		$startcol2 = (GrupoevaluacionPeer::NUM_COLUMNS - GrupoevaluacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GrupoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(GrupoevaluacionPeer::GRUPO_ID, GrupoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GrupoevaluacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getGrupo(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addGrupoevaluacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initGrupoevaluacions();
				$obj2->addGrupoevaluacion($obj1);
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
		return GrupoevaluacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(GrupoevaluacionPeer::ID); 

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
			$comparison = $criteria->getComparison(GrupoevaluacionPeer::ID);
			$selectCriteria->add(GrupoevaluacionPeer::ID, $criteria->remove(GrupoevaluacionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(GrupoevaluacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(GrupoevaluacionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Grupoevaluacion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(GrupoevaluacionPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Grupoevaluacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(GrupoevaluacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(GrupoevaluacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(GrupoevaluacionPeer::DATABASE_NAME, GrupoevaluacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = GrupoevaluacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(GrupoevaluacionPeer::DATABASE_NAME);

		$criteria->add(GrupoevaluacionPeer::ID, $pk);


		$v = GrupoevaluacionPeer::doSelect($criteria, $con);

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
			$criteria->add(GrupoevaluacionPeer::ID, $pks, Criteria::IN);
			$objs = GrupoevaluacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseGrupoevaluacionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/GrupoevaluacionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.GrupoevaluacionMapBuilder');
}
