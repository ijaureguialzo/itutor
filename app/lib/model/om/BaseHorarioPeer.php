<?php


abstract class BaseHorarioPeer {

	
	const DATABASE_NAME = 'itutor';

	
	const TABLE_NAME = 'horario';

	
	const CLASS_DEFAULT = 'lib.model.Horario';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'horario.ID';

	
	const PROFESOR_ID = 'horario.PROFESOR_ID';

	
	const ASIGNATURA_ID = 'horario.ASIGNATURA_ID';

	
	const GRUPO_ID = 'horario.GRUPO_ID';

	
	const DIA = 'horario.DIA';

	
	const HORA = 'horario.HORA';

	
	const OBSERVACIONES = 'horario.OBSERVACIONES';

	
	const ACTIVO = 'horario.ACTIVO';

	
	const UPDATED_AT = 'horario.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProfesorId', 'AsignaturaId', 'GrupoId', 'Dia', 'Hora', 'Observaciones', 'Activo', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (HorarioPeer::ID, HorarioPeer::PROFESOR_ID, HorarioPeer::ASIGNATURA_ID, HorarioPeer::GRUPO_ID, HorarioPeer::DIA, HorarioPeer::HORA, HorarioPeer::OBSERVACIONES, HorarioPeer::ACTIVO, HorarioPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'profesor_id', 'asignatura_id', 'grupo_id', 'dia', 'hora', 'observaciones', 'activo', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProfesorId' => 1, 'AsignaturaId' => 2, 'GrupoId' => 3, 'Dia' => 4, 'Hora' => 5, 'Observaciones' => 6, 'Activo' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (HorarioPeer::ID => 0, HorarioPeer::PROFESOR_ID => 1, HorarioPeer::ASIGNATURA_ID => 2, HorarioPeer::GRUPO_ID => 3, HorarioPeer::DIA => 4, HorarioPeer::HORA => 5, HorarioPeer::OBSERVACIONES => 6, HorarioPeer::ACTIVO => 7, HorarioPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'profesor_id' => 1, 'asignatura_id' => 2, 'grupo_id' => 3, 'dia' => 4, 'hora' => 5, 'observaciones' => 6, 'activo' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/HorarioMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.HorarioMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = HorarioPeer::getTableMap();
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
		return str_replace(HorarioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HorarioPeer::ID);

		$criteria->addSelectColumn(HorarioPeer::PROFESOR_ID);

		$criteria->addSelectColumn(HorarioPeer::ASIGNATURA_ID);

		$criteria->addSelectColumn(HorarioPeer::GRUPO_ID);

		$criteria->addSelectColumn(HorarioPeer::DIA);

		$criteria->addSelectColumn(HorarioPeer::HORA);

		$criteria->addSelectColumn(HorarioPeer::OBSERVACIONES);

		$criteria->addSelectColumn(HorarioPeer::ACTIVO);

		$criteria->addSelectColumn(HorarioPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(horario.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT horario.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = HorarioPeer::doSelectRS($criteria, $con);
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
		$objects = HorarioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return HorarioPeer::populateObjects(HorarioPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			HorarioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = HorarioPeer::getOMClass();
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
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$rs = HorarioPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = HorarioPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = HorarioPeer::doSelectRS($criteria, $con);
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

		HorarioPeer::addSelectColumns($c);
		$startcol = (HorarioPeer::NUM_COLUMNS - HorarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfesorPeer::addSelectColumns($c);

		$c->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HorarioPeer::getOMClass();

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
										$temp_obj2->addHorario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHorarios();
				$obj2->addHorario($obj1); 			}
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

		HorarioPeer::addSelectColumns($c);
		$startcol = (HorarioPeer::NUM_COLUMNS - HorarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AsignaturaPeer::addSelectColumns($c);

		$c->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HorarioPeer::getOMClass();

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
										$temp_obj2->addHorario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHorarios();
				$obj2->addHorario($obj1); 			}
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

		HorarioPeer::addSelectColumns($c);
		$startcol = (HorarioPeer::NUM_COLUMNS - HorarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GrupoPeer::addSelectColumns($c);

		$c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HorarioPeer::getOMClass();

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
										$temp_obj2->addHorario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHorarios();
				$obj2->addHorario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$criteria->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$criteria->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = HorarioPeer::doSelectRS($criteria, $con);
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

		HorarioPeer::addSelectColumns($c);
		$startcol2 = (HorarioPeer::NUM_COLUMNS - HorarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfesorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfesorPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$c->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HorarioPeer::getOMClass();


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
					$temp_obj2->addHorario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initHorarios();
				$obj2->addHorario($obj1);
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
					$temp_obj3->addHorario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initHorarios();
				$obj3->addHorario($obj1);
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
					$temp_obj4->addHorario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initHorarios();
				$obj4->addHorario($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptProfesor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$criteria->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = HorarioPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$criteria->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);

		$rs = HorarioPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(HorarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HorarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$criteria->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$rs = HorarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptProfesor(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HorarioPeer::addSelectColumns($c);
		$startcol2 = (HorarioPeer::NUM_COLUMNS - HorarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AsignaturaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AsignaturaPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);

		$c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HorarioPeer::getOMClass();

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
					$temp_obj2->addHorario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHorarios();
				$obj2->addHorario($obj1);
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
					$temp_obj3->addHorario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initHorarios();
				$obj3->addHorario($obj1);
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

		HorarioPeer::addSelectColumns($c);
		$startcol2 = (HorarioPeer::NUM_COLUMNS - HorarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfesorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfesorPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HorarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProfesor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHorario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHorarios();
				$obj2->addHorario($obj1);
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
					$temp_obj3->addHorario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initHorarios();
				$obj3->addHorario($obj1);
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

		HorarioPeer::addSelectColumns($c);
		$startcol2 = (HorarioPeer::NUM_COLUMNS - HorarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfesorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfesorPeer::NUM_COLUMNS;

		AsignaturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AsignaturaPeer::NUM_COLUMNS;

		$c->addJoin(HorarioPeer::PROFESOR_ID, ProfesorPeer::ID);

		$c->addJoin(HorarioPeer::ASIGNATURA_ID, AsignaturaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HorarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfesorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProfesor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHorario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHorarios();
				$obj2->addHorario($obj1);
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
					$temp_obj3->addHorario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initHorarios();
				$obj3->addHorario($obj1);
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
		return HorarioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(HorarioPeer::ID); 

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
			$comparison = $criteria->getComparison(HorarioPeer::ID);
			$selectCriteria->add(HorarioPeer::ID, $criteria->remove(HorarioPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(HorarioPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HorarioPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Horario) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HorarioPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Horario $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HorarioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HorarioPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HorarioPeer::DATABASE_NAME, HorarioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HorarioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(HorarioPeer::DATABASE_NAME);

		$criteria->add(HorarioPeer::ID, $pk);


		$v = HorarioPeer::doSelect($criteria, $con);

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
			$criteria->add(HorarioPeer::ID, $pks, Criteria::IN);
			$objs = HorarioPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseHorarioPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/HorarioMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.HorarioMapBuilder');
}
