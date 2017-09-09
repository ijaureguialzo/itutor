<?php


abstract class BaseDiarioPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'diario';

	
	const CLASS_DEFAULT = 'lib.model.Diario';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'diario.ID';

	
	const EVALUACION_ID = 'diario.EVALUACION_ID';

	
	const ASIGNATURA_ID = 'diario.ASIGNATURA_ID';

	
	const GRUPO_ID = 'diario.GRUPO_ID';

	
	const PROFESOR_ID = 'diario.PROFESOR_ID';

	
	const FECHA = 'diario.FECHA';

	
	const ACTIVIDAD = 'diario.ACTIVIDAD';

	
	const UDIDACTICA = 'diario.UDIDACTICA';

	
	const ACTIVO = 'diario.ACTIVO';

	
	const UPDATED_AT = 'diario.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'EvaluacionId', 'AsignaturaId', 'GrupoId', 'ProfesorId', 'Fecha', 'Actividad', 'Udidactica', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DiarioPeer::ID, DiarioPeer::EVALUACION_ID, DiarioPeer::ASIGNATURA_ID, DiarioPeer::GRUPO_ID, DiarioPeer::PROFESOR_ID, DiarioPeer::FECHA, DiarioPeer::ACTIVIDAD, DiarioPeer::UDIDACTICA, DiarioPeer::ACTIVO, DiarioPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'evaluacion_id', 'asignatura_id', 'grupo_id', 'profesor_id', 'fecha', 'actividad', 'udidactica', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'EvaluacionId' => 1, 'AsignaturaId' => 2, 'GrupoId' => 3, 'ProfesorId' => 4, 'Fecha' => 5, 'Actividad' => 6, 'Udidactica' => 7, 'Activo' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (DiarioPeer::ID => 0, DiarioPeer::EVALUACION_ID => 1, DiarioPeer::ASIGNATURA_ID => 2, DiarioPeer::GRUPO_ID => 3, DiarioPeer::PROFESOR_ID => 4, DiarioPeer::FECHA => 5, DiarioPeer::ACTIVIDAD => 6, DiarioPeer::UDIDACTICA => 7, DiarioPeer::ACTIVO => 8, DiarioPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'evaluacion_id' => 1, 'asignatura_id' => 2, 'grupo_id' => 3, 'profesor_id' => 4, 'fecha' => 5, 'actividad' => 6, 'udidactica' => 7, 'activo' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DiarioMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DiarioMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DiarioPeer::getTableMap();
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
		return str_replace(DiarioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DiarioPeer::ID);

		$criteria->addSelectColumn(DiarioPeer::EVALUACION_ID);

		$criteria->addSelectColumn(DiarioPeer::ASIGNATURA_ID);

		$criteria->addSelectColumn(DiarioPeer::GRUPO_ID);

		$criteria->addSelectColumn(DiarioPeer::PROFESOR_ID);

		$criteria->addSelectColumn(DiarioPeer::FECHA);

		$criteria->addSelectColumn(DiarioPeer::ACTIVIDAD);

		$criteria->addSelectColumn(DiarioPeer::UDIDACTICA);

		$criteria->addSelectColumn(DiarioPeer::ACTIVO);

		$criteria->addSelectColumn(DiarioPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(diario.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT diario.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DiarioPeer::doSelectRS($criteria, $con);
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
		$objects = DiarioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DiarioPeer::populateObjects(DiarioPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DiarioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DiarioPeer::getOMClass();
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
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProfesor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
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

		DiarioPeer::addSelectColumns($c);
		$startcol = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EvaluacionPeer::addSelectColumns($c);

		$c->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

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
										$temp_obj2->addDiario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1); 			}
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

		DiarioPeer::addSelectColumns($c);
		$startcol = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AsignaturaPeer::addSelectColumns($c);

		$c->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

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
										$temp_obj2->addDiario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiarioPeer::addSelectColumns($c);
		$startcol = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GrupoPeer::addSelectColumns($c);

		$c->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

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
										$temp_obj2->addDiario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProfesor(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiarioPeer::addSelectColumns($c);
		$startcol = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfesorPeer::addSelectColumns($c);

		$c->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

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
										$temp_obj2->addDiario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$criteria->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$criteria->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
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

		DiarioPeer::addSelectColumns($c);
		$startcol2 = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GrupoPeer::NUM_COLUMNS;

		ProfesorPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfesorPeer::NUM_COLUMNS;

		$c->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$c->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$c->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();


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
					$temp_obj2->addDiario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1);
			}


					
			$omClass = AsignaturaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAsignatura(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDiarios();
				$obj3->addDiario($obj1);
			}


					
			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getGrupo(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initDiarios();
				$obj4->addDiario($obj1);
			}


					
			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfesor(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initDiarios();
				$obj5->addDiario($obj1);
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
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$criteria->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$criteria->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$criteria->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$criteria->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProfesor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$criteria->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$criteria->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = DiarioPeer::doSelectRS($criteria, $con);
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

		DiarioPeer::addSelectColumns($c);
		$startcol2 = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AsignaturaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AsignaturaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GrupoPeer::NUM_COLUMNS;

		ProfesorPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfesorPeer::NUM_COLUMNS;

		$c->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$c->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$c->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AsignaturaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAsignatura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1);
			}

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGrupo(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiarios();
				$obj3->addDiario($obj1);
			}

			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfesor(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiarios();
				$obj4->addDiario($obj1);
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

		DiarioPeer::addSelectColumns($c);
		$startcol2 = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GrupoPeer::NUM_COLUMNS;

		ProfesorPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfesorPeer::NUM_COLUMNS;

		$c->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);

		$c->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

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
					$temp_obj2->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1);
			}

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGrupo(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiarios();
				$obj3->addDiario($obj1);
			}

			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfesor(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiarios();
				$obj4->addDiario($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiarioPeer::addSelectColumns($c);
		$startcol2 = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		ProfesorPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfesorPeer::NUM_COLUMNS;

		$c->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$c->addJoin(DiarioPeer::PROFESOR_ID, ProfesorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

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
					$temp_obj2->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1);
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
					$temp_obj3->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiarios();
				$obj3->addDiario($obj1);
			}

			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfesor(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiarios();
				$obj4->addDiario($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProfesor(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiarioPeer::addSelectColumns($c);
		$startcol2 = (DiarioPeer::NUM_COLUMNS - DiarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EvaluacionPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(DiarioPeer::EVALUACION_ID, EvaluacionPeer::ID);

		$c->addJoin(DiarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$c->addJoin(DiarioPeer::GRUPO_ID, GrupoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiarioPeer::getOMClass();

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
					$temp_obj2->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiarios();
				$obj2->addDiario($obj1);
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
					$temp_obj3->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiarios();
				$obj3->addDiario($obj1);
			}

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getGrupo(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiarios();
				$obj4->addDiario($obj1);
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
		return DiarioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DiarioPeer::ID); 

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
			$comparison = $criteria->getComparison(DiarioPeer::ID);
			$selectCriteria->add(DiarioPeer::ID, $criteria->remove(DiarioPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DiarioPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DiarioPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Diario) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DiarioPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Diario $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DiarioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DiarioPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DiarioPeer::DATABASE_NAME, DiarioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DiarioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DiarioPeer::DATABASE_NAME);

		$criteria->add(DiarioPeer::ID, $pk);


		$v = DiarioPeer::doSelect($criteria, $con);

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
			$criteria->add(DiarioPeer::ID, $pks, Criteria::IN);
			$objs = DiarioPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDiarioPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DiarioMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DiarioMapBuilder');
}
