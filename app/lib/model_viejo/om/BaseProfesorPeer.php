<?php


abstract class BaseProfesorPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'profesor';

	
	const CLASS_DEFAULT = 'lib.model.Profesor';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'profesor.ID';

	
	const PERFIL_ID = 'profesor.PERFIL_ID';

	
	const NOMBRE = 'profesor.NOMBRE';

	
	const CODIGO = 'profesor.CODIGO';

	
	const EMAIL = 'profesor.EMAIL';

	
	const ACTIVO = 'profesor.ACTIVO';

	
	const UPDATED_AT = 'profesor.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PerfilId', 'Nombre', 'Codigo', 'Email', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ProfesorPeer::ID, ProfesorPeer::PERFIL_ID, ProfesorPeer::NOMBRE, ProfesorPeer::CODIGO, ProfesorPeer::EMAIL, ProfesorPeer::ACTIVO, ProfesorPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'perfil_id', 'nombre', 'codigo', 'email', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PerfilId' => 1, 'Nombre' => 2, 'Codigo' => 3, 'Email' => 4, 'Activo' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (ProfesorPeer::ID => 0, ProfesorPeer::PERFIL_ID => 1, ProfesorPeer::NOMBRE => 2, ProfesorPeer::CODIGO => 3, ProfesorPeer::EMAIL => 4, ProfesorPeer::ACTIVO => 5, ProfesorPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'perfil_id' => 1, 'nombre' => 2, 'codigo' => 3, 'email' => 4, 'activo' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProfesorMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProfesorMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProfesorPeer::getTableMap();
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
		return str_replace(ProfesorPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProfesorPeer::ID);

		$criteria->addSelectColumn(ProfesorPeer::PERFIL_ID);

		$criteria->addSelectColumn(ProfesorPeer::NOMBRE);

		$criteria->addSelectColumn(ProfesorPeer::CODIGO);

		$criteria->addSelectColumn(ProfesorPeer::EMAIL);

		$criteria->addSelectColumn(ProfesorPeer::ACTIVO);

		$criteria->addSelectColumn(ProfesorPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(profesor.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT profesor.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfesorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfesorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProfesorPeer::doSelectRS($criteria, $con);
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
		$objects = ProfesorPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProfesorPeer::populateObjects(ProfesorPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProfesorPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProfesorPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPerfil(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfesorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfesorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfesorPeer::PERFIL_ID, PerfilPeer::ID);

		$rs = ProfesorPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPerfil(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfesorPeer::addSelectColumns($c);
		$startcol = (ProfesorPeer::NUM_COLUMNS - ProfesorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(ProfesorPeer::PERFIL_ID, PerfilPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfesorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPerfil(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addProfesor($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProfesors();
				$obj2->addProfesor($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfesorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfesorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfesorPeer::PERFIL_ID, PerfilPeer::ID);

		$rs = ProfesorPeer::doSelectRS($criteria, $con);
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

		ProfesorPeer::addSelectColumns($c);
		$startcol2 = (ProfesorPeer::NUM_COLUMNS - ProfesorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PerfilPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PerfilPeer::NUM_COLUMNS;

		$c->addJoin(ProfesorPeer::PERFIL_ID, PerfilPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPerfil(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfesor($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initProfesors();
				$obj2->addProfesor($obj1);
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
		return ProfesorPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProfesorPeer::ID); 

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
			$comparison = $criteria->getComparison(ProfesorPeer::ID);
			$selectCriteria->add(ProfesorPeer::ID, $criteria->remove(ProfesorPeer::ID), $comparison);

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
			$affectedRows += ProfesorPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ProfesorPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProfesorPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Profesor) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProfesorPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += ProfesorPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = ProfesorPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Asignatura.php';

						$c = new Criteria();
			
			$c->add(AsignaturaPeer::PROFESOR_ID, $obj->getId());
			$affectedRows += AsignaturaPeer::doDelete($c, $con);

			include_once 'lib/model/Grupo.php';

						$c = new Criteria();
			
			$c->add(GrupoPeer::PROFESOR_ID, $obj->getId());
			$affectedRows += GrupoPeer::doDelete($c, $con);

			include_once 'lib/model/Horario.php';

						$c = new Criteria();
			
			$c->add(HorarioPeer::PROFESOR_ID, $obj->getId());
			$affectedRows += HorarioPeer::doDelete($c, $con);

			include_once 'lib/model/Diario.php';

						$c = new Criteria();
			
			$c->add(DiarioPeer::PROFESOR_ID, $obj->getId());
			$affectedRows += DiarioPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Profesor $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProfesorPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProfesorPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProfesorPeer::DATABASE_NAME, ProfesorPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProfesorPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProfesorPeer::DATABASE_NAME);

		$criteria->add(ProfesorPeer::ID, $pk);


		$v = ProfesorPeer::doSelect($criteria, $con);

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
			$criteria->add(ProfesorPeer::ID, $pks, Criteria::IN);
			$objs = ProfesorPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProfesorPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProfesorMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProfesorMapBuilder');
}
