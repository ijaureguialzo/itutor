<?php


abstract class BaseEvaluacionPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'evaluacion';

	
	const CLASS_DEFAULT = 'lib.model.Evaluacion';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'evaluacion.ID';

	
	const TITULO = 'evaluacion.TITULO';

	
	const FECHAINI = 'evaluacion.FECHAINI';

	
	const FECHAFIN = 'evaluacion.FECHAFIN';

	
	const OBSERVACIONES = 'evaluacion.OBSERVACIONES';

	
	const ACTIVO = 'evaluacion.ACTIVO';

	
	const UPDATED_AT = 'evaluacion.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Titulo', 'Fechaini', 'Fechafin', 'Observaciones', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EvaluacionPeer::ID, EvaluacionPeer::TITULO, EvaluacionPeer::FECHAINI, EvaluacionPeer::FECHAFIN, EvaluacionPeer::OBSERVACIONES, EvaluacionPeer::ACTIVO, EvaluacionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'titulo', 'fechaini', 'fechafin', 'observaciones', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Titulo' => 1, 'Fechaini' => 2, 'Fechafin' => 3, 'Observaciones' => 4, 'Activo' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (EvaluacionPeer::ID => 0, EvaluacionPeer::TITULO => 1, EvaluacionPeer::FECHAINI => 2, EvaluacionPeer::FECHAFIN => 3, EvaluacionPeer::OBSERVACIONES => 4, EvaluacionPeer::ACTIVO => 5, EvaluacionPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'titulo' => 1, 'fechaini' => 2, 'fechafin' => 3, 'observaciones' => 4, 'activo' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EvaluacionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EvaluacionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EvaluacionPeer::getTableMap();
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
		return str_replace(EvaluacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EvaluacionPeer::ID);

		$criteria->addSelectColumn(EvaluacionPeer::TITULO);

		$criteria->addSelectColumn(EvaluacionPeer::FECHAINI);

		$criteria->addSelectColumn(EvaluacionPeer::FECHAFIN);

		$criteria->addSelectColumn(EvaluacionPeer::OBSERVACIONES);

		$criteria->addSelectColumn(EvaluacionPeer::ACTIVO);

		$criteria->addSelectColumn(EvaluacionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(evaluacion.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT evaluacion.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EvaluacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EvaluacionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EvaluacionPeer::doSelectRS($criteria, $con);
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
		$objects = EvaluacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EvaluacionPeer::populateObjects(EvaluacionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EvaluacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EvaluacionPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return EvaluacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EvaluacionPeer::ID); 

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
			$comparison = $criteria->getComparison(EvaluacionPeer::ID);
			$selectCriteria->add(EvaluacionPeer::ID, $criteria->remove(EvaluacionPeer::ID), $comparison);

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
			$affectedRows += EvaluacionPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(EvaluacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EvaluacionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Evaluacion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EvaluacionPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += EvaluacionPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = EvaluacionPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Grupoevaluacion.php';

						$c = new Criteria();
			
			$c->add(GrupoevaluacionPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += GrupoevaluacionPeer::doDelete($c, $con);

			include_once 'lib/model/Falta.php';

						$c = new Criteria();
			
			$c->add(FaltaPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += FaltaPeer::doDelete($c, $con);

			include_once 'lib/model/Retraso.php';

						$c = new Criteria();
			
			$c->add(RetrasoPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += RetrasoPeer::doDelete($c, $con);

			include_once 'lib/model/Prueba.php';

						$c = new Criteria();
			
			$c->add(PruebaPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += PruebaPeer::doDelete($c, $con);

			include_once 'lib/model/Notaevaluacion.php';

						$c = new Criteria();
			
			$c->add(NotaevaluacionPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += NotaevaluacionPeer::doDelete($c, $con);

			include_once 'lib/model/Comportamiento.php';

						$c = new Criteria();
			
			$c->add(ComportamientoPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += ComportamientoPeer::doDelete($c, $con);

			include_once 'lib/model/Festivo.php';

						$c = new Criteria();
			
			$c->add(FestivoPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += FestivoPeer::doDelete($c, $con);

			include_once 'lib/model/Diario.php';

						$c = new Criteria();
			
			$c->add(DiarioPeer::EVALUACION_ID, $obj->getId());
			$affectedRows += DiarioPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Evaluacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EvaluacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EvaluacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EvaluacionPeer::DATABASE_NAME, EvaluacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EvaluacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EvaluacionPeer::DATABASE_NAME);

		$criteria->add(EvaluacionPeer::ID, $pk);


		$v = EvaluacionPeer::doSelect($criteria, $con);

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
			$criteria->add(EvaluacionPeer::ID, $pks, Criteria::IN);
			$objs = EvaluacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEvaluacionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EvaluacionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EvaluacionMapBuilder');
}
