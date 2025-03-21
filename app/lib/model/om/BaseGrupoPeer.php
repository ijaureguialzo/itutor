<?php


abstract class BaseGrupoPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'grupo';

	
	const CLASS_DEFAULT = 'lib.model.Grupo';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'grupo.ID';

	
	const PROFESOR_ID = 'grupo.PROFESOR_ID';

	
	const NOMBRE = 'grupo.NOMBRE';

	
	const DESCRIPCION = 'grupo.DESCRIPCION';

	
	const OBSERVACIONES = 'grupo.OBSERVACIONES';

	
	const ACTIVO = 'grupo.ACTIVO';

	
	const UPDATED_AT = 'grupo.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProfesorId', 'Nombre', 'Descripcion', 'Observaciones', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (GrupoPeer::ID, GrupoPeer::PROFESOR_ID, GrupoPeer::NOMBRE, GrupoPeer::DESCRIPCION, GrupoPeer::OBSERVACIONES, GrupoPeer::ACTIVO, GrupoPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'profesor_id', 'nombre', 'descripcion', 'observaciones', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProfesorId' => 1, 'Nombre' => 2, 'Descripcion' => 3, 'Observaciones' => 4, 'Activo' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (GrupoPeer::ID => 0, GrupoPeer::PROFESOR_ID => 1, GrupoPeer::NOMBRE => 2, GrupoPeer::DESCRIPCION => 3, GrupoPeer::OBSERVACIONES => 4, GrupoPeer::ACTIVO => 5, GrupoPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'profesor_id' => 1, 'nombre' => 2, 'descripcion' => 3, 'observaciones' => 4, 'activo' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/GrupoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.GrupoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = GrupoPeer::getTableMap();
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
		return str_replace(GrupoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(GrupoPeer::ID);

		$criteria->addSelectColumn(GrupoPeer::PROFESOR_ID);

		$criteria->addSelectColumn(GrupoPeer::NOMBRE);

		$criteria->addSelectColumn(GrupoPeer::DESCRIPCION);

		$criteria->addSelectColumn(GrupoPeer::OBSERVACIONES);

		$criteria->addSelectColumn(GrupoPeer::ACTIVO);

		$criteria->addSelectColumn(GrupoPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(grupo.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT grupo.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = GrupoPeer::doSelectRS($criteria, $con);
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
		$objects = GrupoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return GrupoPeer::populateObjects(GrupoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			GrupoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = GrupoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinProfesor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GrupoPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = GrupoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinProfesor(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GrupoPeer::addSelectColumns($c);
		$startcol = (GrupoPeer::NUM_COLUMNS - GrupoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfesorPeer::addSelectColumns($c);

		$c->addJoin(GrupoPeer::PROFESOR_ID, ProfesorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GrupoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfesorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProfesor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addGrupo($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initGrupos();
				$obj2->addGrupo($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GrupoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GrupoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GrupoPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = GrupoPeer::doSelectRS($criteria, $con);
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

		GrupoPeer::addSelectColumns($c);
		$startcol2 = (GrupoPeer::NUM_COLUMNS - GrupoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfesorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfesorPeer::NUM_COLUMNS;

		$c->addJoin(GrupoPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProfesor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addGrupo($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initGrupos();
				$obj2->addGrupo($obj1);
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
		return GrupoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(GrupoPeer::ID); 

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
			$comparison = $criteria->getComparison(GrupoPeer::ID);
			$selectCriteria->add(GrupoPeer::ID, $criteria->remove(GrupoPeer::ID), $comparison);

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
			$affectedRows += GrupoPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(GrupoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Grupo) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(GrupoPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += GrupoPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = GrupoPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Horario.php';

						$c = new Criteria();
			
			$c->add(HorarioPeer::GRUPO_ID, $obj->getId());
			$affectedRows += HorarioPeer::doDelete($c, $con);

			include_once 'lib/model/Alumno.php';

						$c = new Criteria();
			
			$c->add(AlumnoPeer::GRUPO_ID, $obj->getId());
			$affectedRows += AlumnoPeer::doDelete($c, $con);

			include_once 'lib/model/Grupoevaluacion.php';

						$c = new Criteria();
			
			$c->add(GrupoevaluacionPeer::GRUPO_ID, $obj->getId());
			$affectedRows += GrupoevaluacionPeer::doDelete($c, $con);

			include_once 'lib/model/Prueba.php';

						$c = new Criteria();
			
			$c->add(PruebaPeer::GRUPO_ID, $obj->getId());
			$affectedRows += PruebaPeer::doDelete($c, $con);

			include_once 'lib/model/Diario.php';

						$c = new Criteria();
			
			$c->add(DiarioPeer::GRUPO_ID, $obj->getId());
			$affectedRows += DiarioPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Grupo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(GrupoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(GrupoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(GrupoPeer::DATABASE_NAME, GrupoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = GrupoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		$criteria->add(GrupoPeer::ID, $pk);


		$v = GrupoPeer::doSelect($criteria, $con);

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
			$criteria->add(GrupoPeer::ID, $pks, Criteria::IN);
			$objs = GrupoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseGrupoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/GrupoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.GrupoMapBuilder');
}
