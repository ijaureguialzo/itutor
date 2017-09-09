<?php


abstract class BaseAsignaturaPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'asignatura';

	
	const CLASS_DEFAULT = 'lib.model.Asignatura';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'asignatura.ID';

	
	const PROFESOR_ID = 'asignatura.PROFESOR_ID';

	
	const NOMBRE = 'asignatura.NOMBRE';

	
	const DESCRIPCION = 'asignatura.DESCRIPCION';

	
	const AULA = 'asignatura.AULA';

	
	const PORCENTAJEPRUEBAS = 'asignatura.PORCENTAJEPRUEBAS';

	
	const PORCENTAJEFALTAS = 'asignatura.PORCENTAJEFALTAS';

	
	const PORCENTAJECOMPORTAMIENTO = 'asignatura.PORCENTAJECOMPORTAMIENTO';

	
	const MAXIMOFALTAS = 'asignatura.MAXIMOFALTAS';

	
	const ACTIVO = 'asignatura.ACTIVO';

	
	const UPDATED_AT = 'asignatura.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProfesorId', 'Nombre', 'Descripcion', 'Aula', 'Porcentajepruebas', 'Porcentajefaltas', 'Porcentajecomportamiento', 'Maximofaltas', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (AsignaturaPeer::ID, AsignaturaPeer::PROFESOR_ID, AsignaturaPeer::NOMBRE, AsignaturaPeer::DESCRIPCION, AsignaturaPeer::AULA, AsignaturaPeer::PORCENTAJEPRUEBAS, AsignaturaPeer::PORCENTAJEFALTAS, AsignaturaPeer::PORCENTAJECOMPORTAMIENTO, AsignaturaPeer::MAXIMOFALTAS, AsignaturaPeer::ACTIVO, AsignaturaPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'profesor_id', 'nombre', 'descripcion', 'aula', 'porcentajepruebas', 'porcentajefaltas', 'porcentajecomportamiento', 'maximofaltas', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProfesorId' => 1, 'Nombre' => 2, 'Descripcion' => 3, 'Aula' => 4, 'Porcentajepruebas' => 5, 'Porcentajefaltas' => 6, 'Porcentajecomportamiento' => 7, 'Maximofaltas' => 8, 'Activo' => 9, 'UpdatedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (AsignaturaPeer::ID => 0, AsignaturaPeer::PROFESOR_ID => 1, AsignaturaPeer::NOMBRE => 2, AsignaturaPeer::DESCRIPCION => 3, AsignaturaPeer::AULA => 4, AsignaturaPeer::PORCENTAJEPRUEBAS => 5, AsignaturaPeer::PORCENTAJEFALTAS => 6, AsignaturaPeer::PORCENTAJECOMPORTAMIENTO => 7, AsignaturaPeer::MAXIMOFALTAS => 8, AsignaturaPeer::ACTIVO => 9, AsignaturaPeer::UPDATED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'profesor_id' => 1, 'nombre' => 2, 'descripcion' => 3, 'aula' => 4, 'porcentajepruebas' => 5, 'porcentajefaltas' => 6, 'porcentajecomportamiento' => 7, 'maximofaltas' => 8, 'activo' => 9, 'updated_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AsignaturaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AsignaturaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AsignaturaPeer::getTableMap();
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
		return str_replace(AsignaturaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AsignaturaPeer::ID);

		$criteria->addSelectColumn(AsignaturaPeer::PROFESOR_ID);

		$criteria->addSelectColumn(AsignaturaPeer::NOMBRE);

		$criteria->addSelectColumn(AsignaturaPeer::DESCRIPCION);

		$criteria->addSelectColumn(AsignaturaPeer::AULA);

		$criteria->addSelectColumn(AsignaturaPeer::PORCENTAJEPRUEBAS);

		$criteria->addSelectColumn(AsignaturaPeer::PORCENTAJEFALTAS);

		$criteria->addSelectColumn(AsignaturaPeer::PORCENTAJECOMPORTAMIENTO);

		$criteria->addSelectColumn(AsignaturaPeer::MAXIMOFALTAS);

		$criteria->addSelectColumn(AsignaturaPeer::ACTIVO);

		$criteria->addSelectColumn(AsignaturaPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(asignatura.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT asignatura.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AsignaturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AsignaturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AsignaturaPeer::doSelectRS($criteria, $con);
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
		$objects = AsignaturaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AsignaturaPeer::populateObjects(AsignaturaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AsignaturaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AsignaturaPeer::getOMClass();
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
			$criteria->addSelectColumn(AsignaturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AsignaturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AsignaturaPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = AsignaturaPeer::doSelectRS($criteria, $con);
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

		AsignaturaPeer::addSelectColumns($c);
		$startcol = (AsignaturaPeer::NUM_COLUMNS - AsignaturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfesorPeer::addSelectColumns($c);

		$c->addJoin(AsignaturaPeer::PROFESOR_ID, ProfesorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AsignaturaPeer::getOMClass();

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
										$temp_obj2->addAsignatura($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAsignaturas();
				$obj2->addAsignatura($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AsignaturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AsignaturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AsignaturaPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = AsignaturaPeer::doSelectRS($criteria, $con);
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

		AsignaturaPeer::addSelectColumns($c);
		$startcol2 = (AsignaturaPeer::NUM_COLUMNS - AsignaturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfesorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfesorPeer::NUM_COLUMNS;

		$c->addJoin(AsignaturaPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AsignaturaPeer::getOMClass();


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
					$temp_obj2->addAsignatura($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAsignaturas();
				$obj2->addAsignatura($obj1);
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
		return AsignaturaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(AsignaturaPeer::ID); 

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
			$comparison = $criteria->getComparison(AsignaturaPeer::ID);
			$selectCriteria->add(AsignaturaPeer::ID, $criteria->remove(AsignaturaPeer::ID), $comparison);

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
			$affectedRows += AsignaturaPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(AsignaturaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AsignaturaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Asignatura) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AsignaturaPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += AsignaturaPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = AsignaturaPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Horario.php';

						$c = new Criteria();
			
			$c->add(HorarioPeer::ASIGNATURA_ID, $obj->getId());
			$affectedRows += HorarioPeer::doDelete($c, $con);

			include_once 'lib/model/Falta.php';

						$c = new Criteria();
			
			$c->add(FaltaPeer::ASIGNATURA_ID, $obj->getId());
			$affectedRows += FaltaPeer::doDelete($c, $con);

			include_once 'lib/model/Retraso.php';

						$c = new Criteria();
			
			$c->add(RetrasoPeer::ASIGNATURA_ID, $obj->getId());
			$affectedRows += RetrasoPeer::doDelete($c, $con);

			include_once 'lib/model/Prueba.php';

						$c = new Criteria();
			
			$c->add(PruebaPeer::ASIGNATURA_ID, $obj->getId());
			$affectedRows += PruebaPeer::doDelete($c, $con);

			include_once 'lib/model/Notaevaluacion.php';

						$c = new Criteria();
			
			$c->add(NotaevaluacionPeer::ASIGNATURA_ID, $obj->getId());
			$affectedRows += NotaevaluacionPeer::doDelete($c, $con);

			include_once 'lib/model/Comportamiento.php';

						$c = new Criteria();
			
			$c->add(ComportamientoPeer::ASIGNATURA_ID, $obj->getId());
			$affectedRows += ComportamientoPeer::doDelete($c, $con);

			include_once 'lib/model/Diario.php';

						$c = new Criteria();
			
			$c->add(DiarioPeer::ASIGNATURA_ID, $obj->getId());
			$affectedRows += DiarioPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Asignatura $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AsignaturaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AsignaturaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AsignaturaPeer::DATABASE_NAME, AsignaturaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AsignaturaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(AsignaturaPeer::DATABASE_NAME);

		$criteria->add(AsignaturaPeer::ID, $pk);


		$v = AsignaturaPeer::doSelect($criteria, $con);

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
			$criteria->add(AsignaturaPeer::ID, $pks, Criteria::IN);
			$objs = AsignaturaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAsignaturaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/AsignaturaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AsignaturaMapBuilder');
}
