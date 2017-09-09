<?php


abstract class BaseFaltaPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'falta';

	
	const CLASS_DEFAULT = 'lib.model.Falta';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'falta.ID';

	
	const EVALUACION_ID = 'falta.EVALUACION_ID';

	
	const ALUMNO_ID = 'falta.ALUMNO_ID';

	
	const ASIGNATURA_ID = 'falta.ASIGNATURA_ID';

	
	const DIA = 'falta.DIA';

	
	const HORA = 'falta.HORA';

	
	const FECHA = 'falta.FECHA';

	
	const JUSTIFICADO = 'falta.JUSTIFICADO';

	
	const OBSERVACIONES = 'falta.OBSERVACIONES';

	
	const ACTIVO = 'falta.ACTIVO';

	
	const UPDATED_AT = 'falta.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'EvaluacionId', 'AlumnoId', 'AsignaturaId', 'Dia', 'Hora', 'Fecha', 'Justificado', 'Observaciones', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (FaltaPeer::ID, FaltaPeer::EVALUACION_ID, FaltaPeer::ALUMNO_ID, FaltaPeer::ASIGNATURA_ID, FaltaPeer::DIA, FaltaPeer::HORA, FaltaPeer::FECHA, FaltaPeer::JUSTIFICADO, FaltaPeer::OBSERVACIONES, FaltaPeer::ACTIVO, FaltaPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'evaluacion_id', 'alumno_id', 'asignatura_id', 'dia', 'hora', 'fecha', 'justificado', 'observaciones', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'EvaluacionId' => 1, 'AlumnoId' => 2, 'AsignaturaId' => 3, 'Dia' => 4, 'Hora' => 5, 'Fecha' => 6, 'Justificado' => 7, 'Observaciones' => 8, 'Activo' => 9, 'UpdatedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (FaltaPeer::ID => 0, FaltaPeer::EVALUACION_ID => 1, FaltaPeer::ALUMNO_ID => 2, FaltaPeer::ASIGNATURA_ID => 3, FaltaPeer::DIA => 4, FaltaPeer::HORA => 5, FaltaPeer::FECHA => 6, FaltaPeer::JUSTIFICADO => 7, FaltaPeer::OBSERVACIONES => 8, FaltaPeer::ACTIVO => 9, FaltaPeer::UPDATED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'evaluacion_id' => 1, 'alumno_id' => 2, 'asignatura_id' => 3, 'dia' => 4, 'hora' => 5, 'fecha' => 6, 'justificado' => 7, 'observaciones' => 8, 'activo' => 9, 'updated_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/FaltaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.FaltaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FaltaPeer::getTableMap();
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
		return str_replace(FaltaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FaltaPeer::ID);

		$criteria->addSelectColumn(FaltaPeer::EVALUACION_ID);

		$criteria->addSelectColumn(FaltaPeer::ALUMNO_ID);

		$criteria->addSelectColumn(FaltaPeer::ASIGNATURA_ID);

		$criteria->addSelectColumn(FaltaPeer::DIA);

		$criteria->addSelectColumn(FaltaPeer::HORA);

		$criteria->addSelectColumn(FaltaPeer::FECHA);

		$criteria->addSelectColumn(FaltaPeer::JUSTIFICADO);

		$criteria->addSelectColumn(FaltaPeer::OBSERVACIONES);

		$criteria->addSelectColumn(FaltaPeer::ACTIVO);

		$criteria->addSelectColumn(FaltaPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(falta.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT falta.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FaltaPeer::doSelectRS($criteria, $con);
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
		$objects = FaltaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FaltaPeer::populateObjects(FaltaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FaltaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = FaltaPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEvaluacion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = FaltaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAlumno(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);

		$rs = FaltaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = FaltaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEvaluacion(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FaltaPeer::addSelectColumns($c);
		$startcol = (FaltaPeer::NUM_COLUMNS - FaltaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EvaluacionPeer::addSelectColumns($c);

		$c->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FaltaPeer::getOMClass();

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
										$temp_obj2->addFalta($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFaltas();
				$obj2->addFalta($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAlumno(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FaltaPeer::addSelectColumns($c);
		$startcol = (FaltaPeer::NUM_COLUMNS - FaltaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AlumnoPeer::addSelectColumns($c);

		$c->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FaltaPeer::getOMClass();

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
										$temp_obj2->addFalta($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFaltas();
				$obj2->addFalta($obj1); 			}
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

		FaltaPeer::addSelectColumns($c);
		$startcol = (FaltaPeer::NUM_COLUMNS - FaltaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AsignaturaPeer::addSelectColumns($c);

		$c->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FaltaPeer::getOMClass();

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
										$temp_obj2->addFalta($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFaltas();
				$obj2->addFalta($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);

		$criteria->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = FaltaPeer::doSelectRS($criteria, $con);
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

		FaltaPeer::addSelectColumns($c);
		$startcol2 = (FaltaPeer::NUM_COLUMNS - FaltaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		AlumnoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AlumnoPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + AsignaturaPeer::NUM_COLUMNS;

		$c->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);

		$c->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FaltaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EvaluacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEvaluacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFalta($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initFaltas();
				$obj2->addFalta($obj1);
			}


					
			$omClass = AlumnoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAlumno(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFalta($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initFaltas();
				$obj3->addFalta($obj1);
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
					$temp_obj4->addFalta($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initFaltas();
				$obj4->addFalta($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEvaluacion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);

		$criteria->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = FaltaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptAlumno(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = FaltaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FaltaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FaltaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);

		$rs = FaltaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEvaluacion(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FaltaPeer::addSelectColumns($c);
		$startcol2 = (FaltaPeer::NUM_COLUMNS - FaltaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AlumnoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AlumnoPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		$c->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);

		$c->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FaltaPeer::getOMClass();

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
					$temp_obj2->addFalta($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFaltas();
				$obj2->addFalta($obj1);
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
					$temp_obj3->addFalta($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFaltas();
				$obj3->addFalta($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptAlumno(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FaltaPeer::addSelectColumns($c);
		$startcol2 = (FaltaPeer::NUM_COLUMNS - FaltaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		$c->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(FaltaPeer::ASIGNATURA_ID, AsignaturaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FaltaPeer::getOMClass();

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
					$temp_obj2->addFalta($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFaltas();
				$obj2->addFalta($obj1);
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
					$temp_obj3->addFalta($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFaltas();
				$obj3->addFalta($obj1);
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

		FaltaPeer::addSelectColumns($c);
		$startcol2 = (FaltaPeer::NUM_COLUMNS - FaltaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		AlumnoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AlumnoPeer::NUM_COLUMNS;

		$c->addJoin(FaltaPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(FaltaPeer::ALUMNO_ID, AlumnoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FaltaPeer::getOMClass();

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
					$temp_obj2->addFalta($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFaltas();
				$obj2->addFalta($obj1);
			}

			$omClass = AlumnoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAlumno(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFalta($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFaltas();
				$obj3->addFalta($obj1);
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
		return FaltaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(FaltaPeer::ID); 

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
			$comparison = $criteria->getComparison(FaltaPeer::ID);
			$selectCriteria->add(FaltaPeer::ID, $criteria->remove(FaltaPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(FaltaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FaltaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Falta) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FaltaPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Falta $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FaltaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FaltaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FaltaPeer::DATABASE_NAME, FaltaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FaltaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(FaltaPeer::DATABASE_NAME);

		$criteria->add(FaltaPeer::ID, $pk);


		$v = FaltaPeer::doSelect($criteria, $con);

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
			$criteria->add(FaltaPeer::ID, $pks, Criteria::IN);
			$objs = FaltaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFaltaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/FaltaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.FaltaMapBuilder');
}
