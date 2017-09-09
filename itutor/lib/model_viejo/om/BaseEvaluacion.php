<?php


abstract class BaseEvaluacion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $titulo;


	
	protected $fechaini;


	
	protected $fechafin;


	
	protected $observaciones;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $collGrupoevaluacions;

	
	protected $lastGrupoevaluacionCriteria = null;

	
	protected $collFaltas;

	
	protected $lastFaltaCriteria = null;

	
	protected $collRetrasos;

	
	protected $lastRetrasoCriteria = null;

	
	protected $collPruebas;

	
	protected $lastPruebaCriteria = null;

	
	protected $collNotaevaluacions;

	
	protected $lastNotaevaluacionCriteria = null;

	
	protected $collComportamientos;

	
	protected $lastComportamientoCriteria = null;

	
	protected $collFestivos;

	
	protected $lastFestivoCriteria = null;

	
	protected $collDiarios;

	
	protected $lastDiarioCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitulo()
	{

		return $this->titulo;
	}

	
	public function getFechaini($format = 'Y-m-d')
	{

		if ($this->fechaini === null || $this->fechaini === '') {
			return null;
		} elseif (!is_int($this->fechaini)) {
						$ts = strtotime($this->fechaini);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fechaini] as date/time value: " . var_export($this->fechaini, true));
			}
		} else {
			$ts = $this->fechaini;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFechafin($format = 'Y-m-d')
	{

		if ($this->fechafin === null || $this->fechafin === '') {
			return null;
		} elseif (!is_int($this->fechafin)) {
						$ts = strtotime($this->fechafin);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fechafin] as date/time value: " . var_export($this->fechafin, true));
			}
		} else {
			$ts = $this->fechafin;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getObservaciones()
	{

		return $this->observaciones;
	}

	
	public function getActivo()
	{

		return $this->activo;
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EvaluacionPeer::ID;
		}

	} 
	
	public function setTitulo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->titulo !== $v) {
			$this->titulo = $v;
			$this->modifiedColumns[] = EvaluacionPeer::TITULO;
		}

	} 
	
	public function setFechaini($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fechaini] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fechaini !== $ts) {
			$this->fechaini = $ts;
			$this->modifiedColumns[] = EvaluacionPeer::FECHAINI;
		}

	} 
	
	public function setFechafin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fechafin] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fechafin !== $ts) {
			$this->fechafin = $ts;
			$this->modifiedColumns[] = EvaluacionPeer::FECHAFIN;
		}

	} 
	
	public function setObservaciones($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->observaciones !== $v) {
			$this->observaciones = $v;
			$this->modifiedColumns[] = EvaluacionPeer::OBSERVACIONES;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = EvaluacionPeer::ACTIVO;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = EvaluacionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->titulo = $rs->getString($startcol + 1);

			$this->fechaini = $rs->getDate($startcol + 2, null);

			$this->fechafin = $rs->getDate($startcol + 3, null);

			$this->observaciones = $rs->getString($startcol + 4);

			$this->activo = $rs->getBoolean($startcol + 5);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Evaluacion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EvaluacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EvaluacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(EvaluacionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EvaluacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EvaluacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EvaluacionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collGrupoevaluacions !== null) {
				foreach($this->collGrupoevaluacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFaltas !== null) {
				foreach($this->collFaltas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRetrasos !== null) {
				foreach($this->collRetrasos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPruebas !== null) {
				foreach($this->collPruebas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotaevaluacions !== null) {
				foreach($this->collNotaevaluacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collComportamientos !== null) {
				foreach($this->collComportamientos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFestivos !== null) {
				foreach($this->collFestivos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiarios !== null) {
				foreach($this->collDiarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = EvaluacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGrupoevaluacions !== null) {
					foreach($this->collGrupoevaluacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFaltas !== null) {
					foreach($this->collFaltas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRetrasos !== null) {
					foreach($this->collRetrasos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPruebas !== null) {
					foreach($this->collPruebas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotaevaluacions !== null) {
					foreach($this->collNotaevaluacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collComportamientos !== null) {
					foreach($this->collComportamientos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFestivos !== null) {
					foreach($this->collFestivos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDiarios !== null) {
					foreach($this->collDiarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EvaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitulo();
				break;
			case 2:
				return $this->getFechaini();
				break;
			case 3:
				return $this->getFechafin();
				break;
			case 4:
				return $this->getObservaciones();
				break;
			case 5:
				return $this->getActivo();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EvaluacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitulo(),
			$keys[2] => $this->getFechaini(),
			$keys[3] => $this->getFechafin(),
			$keys[4] => $this->getObservaciones(),
			$keys[5] => $this->getActivo(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EvaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitulo($value);
				break;
			case 2:
				$this->setFechaini($value);
				break;
			case 3:
				$this->setFechafin($value);
				break;
			case 4:
				$this->setObservaciones($value);
				break;
			case 5:
				$this->setActivo($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EvaluacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitulo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFechaini($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFechafin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObservaciones($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActivo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EvaluacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(EvaluacionPeer::ID)) $criteria->add(EvaluacionPeer::ID, $this->id);
		if ($this->isColumnModified(EvaluacionPeer::TITULO)) $criteria->add(EvaluacionPeer::TITULO, $this->titulo);
		if ($this->isColumnModified(EvaluacionPeer::FECHAINI)) $criteria->add(EvaluacionPeer::FECHAINI, $this->fechaini);
		if ($this->isColumnModified(EvaluacionPeer::FECHAFIN)) $criteria->add(EvaluacionPeer::FECHAFIN, $this->fechafin);
		if ($this->isColumnModified(EvaluacionPeer::OBSERVACIONES)) $criteria->add(EvaluacionPeer::OBSERVACIONES, $this->observaciones);
		if ($this->isColumnModified(EvaluacionPeer::ACTIVO)) $criteria->add(EvaluacionPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(EvaluacionPeer::UPDATED_AT)) $criteria->add(EvaluacionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EvaluacionPeer::DATABASE_NAME);

		$criteria->add(EvaluacionPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitulo($this->titulo);

		$copyObj->setFechaini($this->fechaini);

		$copyObj->setFechafin($this->fechafin);

		$copyObj->setObservaciones($this->observaciones);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getGrupoevaluacions() as $relObj) {
				$copyObj->addGrupoevaluacion($relObj->copy($deepCopy));
			}

			foreach($this->getFaltas() as $relObj) {
				$copyObj->addFalta($relObj->copy($deepCopy));
			}

			foreach($this->getRetrasos() as $relObj) {
				$copyObj->addRetraso($relObj->copy($deepCopy));
			}

			foreach($this->getPruebas() as $relObj) {
				$copyObj->addPrueba($relObj->copy($deepCopy));
			}

			foreach($this->getNotaevaluacions() as $relObj) {
				$copyObj->addNotaevaluacion($relObj->copy($deepCopy));
			}

			foreach($this->getComportamientos() as $relObj) {
				$copyObj->addComportamiento($relObj->copy($deepCopy));
			}

			foreach($this->getFestivos() as $relObj) {
				$copyObj->addFestivo($relObj->copy($deepCopy));
			}

			foreach($this->getDiarios() as $relObj) {
				$copyObj->addDiario($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EvaluacionPeer();
		}
		return self::$peer;
	}

	
	public function initGrupoevaluacions()
	{
		if ($this->collGrupoevaluacions === null) {
			$this->collGrupoevaluacions = array();
		}
	}

	
	public function getGrupoevaluacions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGrupoevaluacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupoevaluacions === null) {
			if ($this->isNew()) {
			   $this->collGrupoevaluacions = array();
			} else {

				$criteria->add(GrupoevaluacionPeer::EVALUACION_ID, $this->getId());

				GrupoevaluacionPeer::addSelectColumns($criteria);
				$this->collGrupoevaluacions = GrupoevaluacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GrupoevaluacionPeer::EVALUACION_ID, $this->getId());

				GrupoevaluacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastGrupoevaluacionCriteria) || !$this->lastGrupoevaluacionCriteria->equals($criteria)) {
					$this->collGrupoevaluacions = GrupoevaluacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGrupoevaluacionCriteria = $criteria;
		return $this->collGrupoevaluacions;
	}

	
	public function countGrupoevaluacions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseGrupoevaluacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GrupoevaluacionPeer::EVALUACION_ID, $this->getId());

		return GrupoevaluacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGrupoevaluacion(Grupoevaluacion $l)
	{
		$this->collGrupoevaluacions[] = $l;
		$l->setEvaluacion($this);
	}


	
	public function getGrupoevaluacionsJoinGrupo($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGrupoevaluacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupoevaluacions === null) {
			if ($this->isNew()) {
				$this->collGrupoevaluacions = array();
			} else {

				$criteria->add(GrupoevaluacionPeer::EVALUACION_ID, $this->getId());

				$this->collGrupoevaluacions = GrupoevaluacionPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(GrupoevaluacionPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastGrupoevaluacionCriteria) || !$this->lastGrupoevaluacionCriteria->equals($criteria)) {
				$this->collGrupoevaluacions = GrupoevaluacionPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastGrupoevaluacionCriteria = $criteria;

		return $this->collGrupoevaluacions;
	}

	
	public function initFaltas()
	{
		if ($this->collFaltas === null) {
			$this->collFaltas = array();
		}
	}

	
	public function getFaltas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFaltaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFaltas === null) {
			if ($this->isNew()) {
			   $this->collFaltas = array();
			} else {

				$criteria->add(FaltaPeer::EVALUACION_ID, $this->getId());

				FaltaPeer::addSelectColumns($criteria);
				$this->collFaltas = FaltaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FaltaPeer::EVALUACION_ID, $this->getId());

				FaltaPeer::addSelectColumns($criteria);
				if (!isset($this->lastFaltaCriteria) || !$this->lastFaltaCriteria->equals($criteria)) {
					$this->collFaltas = FaltaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFaltaCriteria = $criteria;
		return $this->collFaltas;
	}

	
	public function countFaltas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFaltaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FaltaPeer::EVALUACION_ID, $this->getId());

		return FaltaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFalta(Falta $l)
	{
		$this->collFaltas[] = $l;
		$l->setEvaluacion($this);
	}


	
	public function getFaltasJoinAlumno($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFaltaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFaltas === null) {
			if ($this->isNew()) {
				$this->collFaltas = array();
			} else {

				$criteria->add(FaltaPeer::EVALUACION_ID, $this->getId());

				$this->collFaltas = FaltaPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(FaltaPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastFaltaCriteria) || !$this->lastFaltaCriteria->equals($criteria)) {
				$this->collFaltas = FaltaPeer::doSelectJoinAlumno($criteria, $con);
			}
		}
		$this->lastFaltaCriteria = $criteria;

		return $this->collFaltas;
	}


	
	public function getFaltasJoinAsignatura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFaltaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFaltas === null) {
			if ($this->isNew()) {
				$this->collFaltas = array();
			} else {

				$criteria->add(FaltaPeer::EVALUACION_ID, $this->getId());

				$this->collFaltas = FaltaPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(FaltaPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastFaltaCriteria) || !$this->lastFaltaCriteria->equals($criteria)) {
				$this->collFaltas = FaltaPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastFaltaCriteria = $criteria;

		return $this->collFaltas;
	}

	
	public function initRetrasos()
	{
		if ($this->collRetrasos === null) {
			$this->collRetrasos = array();
		}
	}

	
	public function getRetrasos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRetrasoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRetrasos === null) {
			if ($this->isNew()) {
			   $this->collRetrasos = array();
			} else {

				$criteria->add(RetrasoPeer::EVALUACION_ID, $this->getId());

				RetrasoPeer::addSelectColumns($criteria);
				$this->collRetrasos = RetrasoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RetrasoPeer::EVALUACION_ID, $this->getId());

				RetrasoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRetrasoCriteria) || !$this->lastRetrasoCriteria->equals($criteria)) {
					$this->collRetrasos = RetrasoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRetrasoCriteria = $criteria;
		return $this->collRetrasos;
	}

	
	public function countRetrasos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRetrasoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RetrasoPeer::EVALUACION_ID, $this->getId());

		return RetrasoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRetraso(Retraso $l)
	{
		$this->collRetrasos[] = $l;
		$l->setEvaluacion($this);
	}


	
	public function getRetrasosJoinAlumno($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRetrasoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRetrasos === null) {
			if ($this->isNew()) {
				$this->collRetrasos = array();
			} else {

				$criteria->add(RetrasoPeer::EVALUACION_ID, $this->getId());

				$this->collRetrasos = RetrasoPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(RetrasoPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastRetrasoCriteria) || !$this->lastRetrasoCriteria->equals($criteria)) {
				$this->collRetrasos = RetrasoPeer::doSelectJoinAlumno($criteria, $con);
			}
		}
		$this->lastRetrasoCriteria = $criteria;

		return $this->collRetrasos;
	}


	
	public function getRetrasosJoinAsignatura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRetrasoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRetrasos === null) {
			if ($this->isNew()) {
				$this->collRetrasos = array();
			} else {

				$criteria->add(RetrasoPeer::EVALUACION_ID, $this->getId());

				$this->collRetrasos = RetrasoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(RetrasoPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastRetrasoCriteria) || !$this->lastRetrasoCriteria->equals($criteria)) {
				$this->collRetrasos = RetrasoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastRetrasoCriteria = $criteria;

		return $this->collRetrasos;
	}

	
	public function initPruebas()
	{
		if ($this->collPruebas === null) {
			$this->collPruebas = array();
		}
	}

	
	public function getPruebas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPruebas === null) {
			if ($this->isNew()) {
			   $this->collPruebas = array();
			} else {

				$criteria->add(PruebaPeer::EVALUACION_ID, $this->getId());

				PruebaPeer::addSelectColumns($criteria);
				$this->collPruebas = PruebaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PruebaPeer::EVALUACION_ID, $this->getId());

				PruebaPeer::addSelectColumns($criteria);
				if (!isset($this->lastPruebaCriteria) || !$this->lastPruebaCriteria->equals($criteria)) {
					$this->collPruebas = PruebaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPruebaCriteria = $criteria;
		return $this->collPruebas;
	}

	
	public function countPruebas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PruebaPeer::EVALUACION_ID, $this->getId());

		return PruebaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrueba(Prueba $l)
	{
		$this->collPruebas[] = $l;
		$l->setEvaluacion($this);
	}


	
	public function getPruebasJoinAsignatura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPruebas === null) {
			if ($this->isNew()) {
				$this->collPruebas = array();
			} else {

				$criteria->add(PruebaPeer::EVALUACION_ID, $this->getId());

				$this->collPruebas = PruebaPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(PruebaPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastPruebaCriteria) || !$this->lastPruebaCriteria->equals($criteria)) {
				$this->collPruebas = PruebaPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastPruebaCriteria = $criteria;

		return $this->collPruebas;
	}

	
	public function initNotaevaluacions()
	{
		if ($this->collNotaevaluacions === null) {
			$this->collNotaevaluacions = array();
		}
	}

	
	public function getNotaevaluacions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotaevaluacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotaevaluacions === null) {
			if ($this->isNew()) {
			   $this->collNotaevaluacions = array();
			} else {

				$criteria->add(NotaevaluacionPeer::EVALUACION_ID, $this->getId());

				NotaevaluacionPeer::addSelectColumns($criteria);
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotaevaluacionPeer::EVALUACION_ID, $this->getId());

				NotaevaluacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotaevaluacionCriteria) || !$this->lastNotaevaluacionCriteria->equals($criteria)) {
					$this->collNotaevaluacions = NotaevaluacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotaevaluacionCriteria = $criteria;
		return $this->collNotaevaluacions;
	}

	
	public function countNotaevaluacions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotaevaluacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotaevaluacionPeer::EVALUACION_ID, $this->getId());

		return NotaevaluacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotaevaluacion(Notaevaluacion $l)
	{
		$this->collNotaevaluacions[] = $l;
		$l->setEvaluacion($this);
	}


	
	public function getNotaevaluacionsJoinAlumno($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotaevaluacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotaevaluacions === null) {
			if ($this->isNew()) {
				$this->collNotaevaluacions = array();
			} else {

				$criteria->add(NotaevaluacionPeer::EVALUACION_ID, $this->getId());

				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(NotaevaluacionPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastNotaevaluacionCriteria) || !$this->lastNotaevaluacionCriteria->equals($criteria)) {
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinAlumno($criteria, $con);
			}
		}
		$this->lastNotaevaluacionCriteria = $criteria;

		return $this->collNotaevaluacions;
	}


	
	public function getNotaevaluacionsJoinAsignatura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotaevaluacionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotaevaluacions === null) {
			if ($this->isNew()) {
				$this->collNotaevaluacions = array();
			} else {

				$criteria->add(NotaevaluacionPeer::EVALUACION_ID, $this->getId());

				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(NotaevaluacionPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastNotaevaluacionCriteria) || !$this->lastNotaevaluacionCriteria->equals($criteria)) {
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastNotaevaluacionCriteria = $criteria;

		return $this->collNotaevaluacions;
	}

	
	public function initComportamientos()
	{
		if ($this->collComportamientos === null) {
			$this->collComportamientos = array();
		}
	}

	
	public function getComportamientos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseComportamientoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComportamientos === null) {
			if ($this->isNew()) {
			   $this->collComportamientos = array();
			} else {

				$criteria->add(ComportamientoPeer::EVALUACION_ID, $this->getId());

				ComportamientoPeer::addSelectColumns($criteria);
				$this->collComportamientos = ComportamientoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ComportamientoPeer::EVALUACION_ID, $this->getId());

				ComportamientoPeer::addSelectColumns($criteria);
				if (!isset($this->lastComportamientoCriteria) || !$this->lastComportamientoCriteria->equals($criteria)) {
					$this->collComportamientos = ComportamientoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastComportamientoCriteria = $criteria;
		return $this->collComportamientos;
	}

	
	public function countComportamientos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseComportamientoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ComportamientoPeer::EVALUACION_ID, $this->getId());

		return ComportamientoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComportamiento(Comportamiento $l)
	{
		$this->collComportamientos[] = $l;
		$l->setEvaluacion($this);
	}


	
	public function getComportamientosJoinAlumno($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseComportamientoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComportamientos === null) {
			if ($this->isNew()) {
				$this->collComportamientos = array();
			} else {

				$criteria->add(ComportamientoPeer::EVALUACION_ID, $this->getId());

				$this->collComportamientos = ComportamientoPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(ComportamientoPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastComportamientoCriteria) || !$this->lastComportamientoCriteria->equals($criteria)) {
				$this->collComportamientos = ComportamientoPeer::doSelectJoinAlumno($criteria, $con);
			}
		}
		$this->lastComportamientoCriteria = $criteria;

		return $this->collComportamientos;
	}


	
	public function getComportamientosJoinAsignatura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseComportamientoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComportamientos === null) {
			if ($this->isNew()) {
				$this->collComportamientos = array();
			} else {

				$criteria->add(ComportamientoPeer::EVALUACION_ID, $this->getId());

				$this->collComportamientos = ComportamientoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(ComportamientoPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastComportamientoCriteria) || !$this->lastComportamientoCriteria->equals($criteria)) {
				$this->collComportamientos = ComportamientoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastComportamientoCriteria = $criteria;

		return $this->collComportamientos;
	}

	
	public function initFestivos()
	{
		if ($this->collFestivos === null) {
			$this->collFestivos = array();
		}
	}

	
	public function getFestivos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFestivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFestivos === null) {
			if ($this->isNew()) {
			   $this->collFestivos = array();
			} else {

				$criteria->add(FestivoPeer::EVALUACION_ID, $this->getId());

				FestivoPeer::addSelectColumns($criteria);
				$this->collFestivos = FestivoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FestivoPeer::EVALUACION_ID, $this->getId());

				FestivoPeer::addSelectColumns($criteria);
				if (!isset($this->lastFestivoCriteria) || !$this->lastFestivoCriteria->equals($criteria)) {
					$this->collFestivos = FestivoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFestivoCriteria = $criteria;
		return $this->collFestivos;
	}

	
	public function countFestivos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFestivoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FestivoPeer::EVALUACION_ID, $this->getId());

		return FestivoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFestivo(Festivo $l)
	{
		$this->collFestivos[] = $l;
		$l->setEvaluacion($this);
	}

	
	public function initDiarios()
	{
		if ($this->collDiarios === null) {
			$this->collDiarios = array();
		}
	}

	
	public function getDiarios($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDiarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiarios === null) {
			if ($this->isNew()) {
			   $this->collDiarios = array();
			} else {

				$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

				DiarioPeer::addSelectColumns($criteria);
				$this->collDiarios = DiarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

				DiarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
					$this->collDiarios = DiarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiarioCriteria = $criteria;
		return $this->collDiarios;
	}

	
	public function countDiarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDiarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

		return DiarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDiario(Diario $l)
	{
		$this->collDiarios[] = $l;
		$l->setEvaluacion($this);
	}


	
	public function getDiariosJoinAsignatura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDiarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiarios === null) {
			if ($this->isNew()) {
				$this->collDiarios = array();
			} else {

				$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastDiarioCriteria = $criteria;

		return $this->collDiarios;
	}


	
	public function getDiariosJoinGrupo($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDiarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiarios === null) {
			if ($this->isNew()) {
				$this->collDiarios = array();
			} else {

				$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastDiarioCriteria = $criteria;

		return $this->collDiarios;
	}


	
	public function getDiariosJoinProfesor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDiarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiarios === null) {
			if ($this->isNew()) {
				$this->collDiarios = array();
			} else {

				$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::EVALUACION_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		}
		$this->lastDiarioCriteria = $criteria;

		return $this->collDiarios;
	}

} 