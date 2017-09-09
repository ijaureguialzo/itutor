<?php


abstract class BaseComportamientoPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'comportamiento';

	
	const CLASS_DEFAULT = 'lib.model.Comportamiento';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'comportamiento.ID';

	
	const ALUMNO_ID = 'comportamiento.ALUMNO_ID';

	
	const EVALUACION_ID = 'comportamiento.EVALUACION_ID';

	
	const ASIGNATURA_ID = 'comportamiento.ASIGNATURA_ID';

	
	const NOTA = 'comportamiento.NOTA';

	
	const OBSERVACIONES = 'comportamiento.OBSERVACIONES';

	
	const ACTIVO = 'comportamiento.ACTIVO';

	
	const UPDATED_AT = 'comportamiento.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AlumnoId', 'EvaluacionId', 'AsignaturaId', 'Nota', 'Observaciones', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ComportamientoPeer::ID, ComportamientoPeer::ALUMNO_ID, ComportamientoPeer::EVALUACION_ID, ComportamientoPeer::ASIGNATURA_ID, ComportamientoPeer::NOTA, ComportamientoPeer::OBSERVACIONES, ComportamientoPeer::ACTIVO, ComportamientoPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'alumno_id', 'evaluacion_id', 'asignatura_id', 'nota', 'observaciones', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AlumnoId' => 1, 'EvaluacionId' => 2, 'AsignaturaId' => 3, 'Nota' => 4, 'Observaciones' => 5, 'Activo' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (ComportamientoPeer::ID => 0, ComportamientoPeer::ALUMNO_ID => 1, ComportamientoPeer::EVALUACION_ID => 2, ComportamientoPeer::ASIGNATURA_ID => 3, ComportamientoPeer::NOTA => 4, ComportamientoPeer::OBSERVACIONES => 5, ComportamientoPeer::ACTIVO => 6, ComportamientoPeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'alumno_id' => 1, 'evaluacion_id' => 2, 'asignatura_id' => 3, 'nota' => 4, 'observaciones' => 5, 'activo' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ComportamientoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ComportamientoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ComportamientoPeer::getTableMap();
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
		return str_replace(ComportamientoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ComportamientoPeer::ID);

		$criteria->addSelectColumn(ComportamientoPeer::ALUMNO_ID);

		$criteria->addSelectColumn(ComportamientoPeer::EVALUACION_ID);

		$criteria->addSelectColumn(ComportamientoPeer::ASIGNATURA_ID);

		$criteria->addSelectColumn(ComportamientoPeer::NOTA);

		$criteria->addSelectColumn(ComportamientoPeer::OBSERVACIONES);

		$criteria->addSelectColumn(ComportamientoPeer::ACTIVO);

		$criteria->addSelectColumn(ComportamientoPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(comportamiento.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT comportamiento.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
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
		$objects = ComportamientoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ComportamientoPeer::populateObjects(ComportamientoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ComportamientoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ComportamientoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAlumno(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAsignatura(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAlumno(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ComportamientoPeer::addSelectColumns($c);
		$startcol = (ComportamientoPeer::NUM_COLUMNS - ComportamientoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AlumnoPeer::addSelectColumns($c);

		$c->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ComportamientoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AlumnoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAlumno(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addComportamiento($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initComportamientos();
				$obj2->addComportamiento($obj1); 			}
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

		ComportamientoPeer::addSelectColumns($c);
		$startcol = (ComportamientoPeer::NUM_COLUMNS - ComportamientoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EvaluacionPeer::addSelectColumns($c);

		$c->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ComportamientoPeer::getOMClass();

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
										$temp_obj2->addComportamiento($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initComportamientos();
				$obj2->addComportamiento($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAsignatura(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ComportamientoPeer::addSelectColumns($c);
		$startcol = (ComportamientoPeer::NUM_COLUMNS - ComportamientoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AsignaturaPeer::addSelectColumns($c);

		$c->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ComportamientoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AsignaturaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAsignatura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addComportamiento($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initComportamientos();
				$obj2->addComportamiento($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);

		$criteria->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
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

		ComportamientoPeer::addSelectColumns($c);
		$startcol2 = (ComportamientoPeer::NUM_COLUMNS - ComportamientoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AlumnoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AlumnoPeer::NUM_COLUMNS;

		EvaluacionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EvaluacionPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + AsignaturaPeer::NUM_COLUMNS;

		$c->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);

		$c->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ComportamientoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = AlumnoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAlumno(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addComportamiento($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initComportamientos();
				$obj2->addComportamiento($obj1);
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
					$temp_obj3->addComportamiento($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initComportamientos();
				$obj3->addComportamiento($obj1);
			}


					
			$omClass = AsignaturaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getAsignatura(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addComportamiento($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initComportamientos();
				$obj4->addComportamiento($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptAlumno(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);

		$criteria->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptAsignatura(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ComportamientoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);

		$criteria->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = ComportamientoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptAlumno(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ComportamientoPeer::addSelectColumns($c);
		$startcol2 = (ComportamientoPeer::NUM_COLUMNS - ComportamientoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		$c->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ComportamientoPeer::getOMClass();

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
					$temp_obj2->addComportamiento($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initComportamientos();
				$obj2->addComportamiento($obj1);
			}

			$omClass = AsignaturaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAsignatura(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addComportamiento($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initComportamientos();
				$obj3->addComportamiento($obj1);
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

		ComportamientoPeer::addSelectColumns($c);
		$startcol2 = (ComportamientoPeer::NUM_COLUMNS - ComportamientoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AlumnoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AlumnoPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		$c->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);

		$c->addJoin(ComportamientoPeer::ASIGNATURA_ID, AsignaturaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ComportamientoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AlumnoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAlumno(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addComportamiento($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initComportamientos();
				$obj2->addComportamiento($obj1);
			}

			$omClass = AsignaturaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAsignatura(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addComportamiento($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initComportamientos();
				$obj3->addComportamiento($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptAsignatura(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ComportamientoPeer::addSelectColumns($c);
		$startcol2 = (ComportamientoPeer::NUM_COLUMNS - ComportamientoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AlumnoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AlumnoPeer::NUM_COLUMNS;

		EvaluacionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EvaluacionPeer::NUM_COLUMNS;

		$c->addJoin(ComportamientoPeer::ALUMNO_ID, AlumnoPeer::ID);

		$c->addJoin(ComportamientoPeer::EVALUACION_ID, EvaluacionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ComportamientoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AlumnoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAlumno(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addComportamiento($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initComportamientos();
				$obj2->addComportamiento($obj1);
			}

			$omClass = EvaluacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEvaluacion(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addComportamiento($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initComportamientos();
				$obj3->addComportamiento($obj1);
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
		return ComportamientoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ComportamientoPeer::ID); 

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
			$comparison = $criteria->getComparison(ComportamientoPeer::ID);
			$selectCriteria->add(ComportamientoPeer::ID, $criteria->remove(ComportamientoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ComportamientoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ComportamientoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Comportamiento) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ComportamientoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Comportamiento $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ComportamientoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ComportamientoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ComportamientoPeer::DATABASE_NAME, ComportamientoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ComportamientoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ComportamientoPeer::DATABASE_NAME);

		$criteria->add(ComportamientoPeer::ID, $pk);


		$v = ComportamientoPeer::doSelect($criteria, $con);

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
			$criteria->add(ComportamientoPeer::ID, $pks, Criteria::IN);
			$objs = ComportamientoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseComportamientoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ComportamientoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ComportamientoMapBuilder');
}
