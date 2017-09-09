<?php


abstract class BaseAlumno extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $grupo_id;


	
	protected $codigo;


	
	protected $nombre;


	
	protected $email;


	
	protected $observaciones;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aGrupo;

	
	protected $collFaltas;

	
	protected $lastFaltaCriteria = null;

	
	protected $collRetrasos;

	
	protected $lastRetrasoCriteria = null;

	
	protected $collNotapruebas;

	
	protected $lastNotapruebaCriteria = null;

	
	protected $collNotaevaluacions;

	
	protected $lastNotaevaluacionCriteria = null;

	
	protected $collComportamientos;

	
	protected $lastComportamientoCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getGrupoId()
	{

		return $this->grupo_id;
	}

	
	public function getCodigo()
	{

		return $this->codigo;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getEmail()
	{

		return $this->email;
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
			$this->modifiedColumns[] = AlumnoPeer::ID;
		}

	} 
	
	public function setGrupoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->grupo_id !== $v) {
			$this->grupo_id = $v;
			$this->modifiedColumns[] = AlumnoPeer::GRUPO_ID;
		}

		if ($this->aGrupo !== null && $this->aGrupo->getId() !== $v) {
			$this->aGrupo = null;
		}

	} 
	
	public function setCodigo($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->codigo !== $v) {
			$this->codigo = $v;
			$this->modifiedColumns[] = AlumnoPeer::CODIGO;
		}

	} 
	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = AlumnoPeer::NOMBRE;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = AlumnoPeer::EMAIL;
		}

	} 
	
	public function setObservaciones($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->observaciones !== $v) {
			$this->observaciones = $v;
			$this->modifiedColumns[] = AlumnoPeer::OBSERVACIONES;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = AlumnoPeer::ACTIVO;
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
			$this->modifiedColumns[] = AlumnoPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->grupo_id = $rs->getInt($startcol + 1);

			$this->codigo = $rs->getInt($startcol + 2);

			$this->nombre = $rs->getString($startcol + 3);

			$this->email = $rs->getString($startcol + 4);

			$this->observaciones = $rs->getString($startcol + 5);

			$this->activo = $rs->getBoolean($startcol + 6);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Alumno object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AlumnoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AlumnoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(AlumnoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AlumnoPeer::DATABASE_NAME);
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


												
			if ($this->aGrupo !== null) {
				if ($this->aGrupo->isModified()) {
					$affectedRows += $this->aGrupo->save($con);
				}
				$this->setGrupo($this->aGrupo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AlumnoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AlumnoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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

			if ($this->collNotapruebas !== null) {
				foreach($this->collNotapruebas as $referrerFK) {
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


												
			if ($this->aGrupo !== null) {
				if (!$this->aGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGrupo->getValidationFailures());
				}
			}


			if (($retval = AlumnoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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

				if ($this->collNotapruebas !== null) {
					foreach($this->collNotapruebas as $referrerFK) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AlumnoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getGrupoId();
				break;
			case 2:
				return $this->getCodigo();
				break;
			case 3:
				return $this->getNombre();
				break;
			case 4:
				return $this->getEmail();
				break;
			case 5:
				return $this->getObservaciones();
				break;
			case 6:
				return $this->getActivo();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AlumnoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getGrupoId(),
			$keys[2] => $this->getCodigo(),
			$keys[3] => $this->getNombre(),
			$keys[4] => $this->getEmail(),
			$keys[5] => $this->getObservaciones(),
			$keys[6] => $this->getActivo(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AlumnoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setGrupoId($value);
				break;
			case 2:
				$this->setCodigo($value);
				break;
			case 3:
				$this->setNombre($value);
				break;
			case 4:
				$this->setEmail($value);
				break;
			case 5:
				$this->setObservaciones($value);
				break;
			case 6:
				$this->setActivo($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AlumnoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGrupoId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCodigo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNombre($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObservaciones($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setActivo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AlumnoPeer::DATABASE_NAME);

		if ($this->isColumnModified(AlumnoPeer::ID)) $criteria->add(AlumnoPeer::ID, $this->id);
		if ($this->isColumnModified(AlumnoPeer::GRUPO_ID)) $criteria->add(AlumnoPeer::GRUPO_ID, $this->grupo_id);
		if ($this->isColumnModified(AlumnoPeer::CODIGO)) $criteria->add(AlumnoPeer::CODIGO, $this->codigo);
		if ($this->isColumnModified(AlumnoPeer::NOMBRE)) $criteria->add(AlumnoPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(AlumnoPeer::EMAIL)) $criteria->add(AlumnoPeer::EMAIL, $this->email);
		if ($this->isColumnModified(AlumnoPeer::OBSERVACIONES)) $criteria->add(AlumnoPeer::OBSERVACIONES, $this->observaciones);
		if ($this->isColumnModified(AlumnoPeer::ACTIVO)) $criteria->add(AlumnoPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(AlumnoPeer::UPDATED_AT)) $criteria->add(AlumnoPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AlumnoPeer::DATABASE_NAME);

		$criteria->add(AlumnoPeer::ID, $this->id);

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

		$copyObj->setGrupoId($this->grupo_id);

		$copyObj->setCodigo($this->codigo);

		$copyObj->setNombre($this->nombre);

		$copyObj->setEmail($this->email);

		$copyObj->setObservaciones($this->observaciones);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getFaltas() as $relObj) {
				$copyObj->addFalta($relObj->copy($deepCopy));
			}

			foreach($this->getRetrasos() as $relObj) {
				$copyObj->addRetraso($relObj->copy($deepCopy));
			}

			foreach($this->getNotapruebas() as $relObj) {
				$copyObj->addNotaprueba($relObj->copy($deepCopy));
			}

			foreach($this->getNotaevaluacions() as $relObj) {
				$copyObj->addNotaevaluacion($relObj->copy($deepCopy));
			}

			foreach($this->getComportamientos() as $relObj) {
				$copyObj->addComportamiento($relObj->copy($deepCopy));
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
			self::$peer = new AlumnoPeer();
		}
		return self::$peer;
	}

	
	public function setGrupo($v)
	{


		if ($v === null) {
			$this->setGrupoId(NULL);
		} else {
			$this->setGrupoId($v->getId());
		}


		$this->aGrupo = $v;
	}


	
	public function getGrupo($con = null)
	{
		if ($this->aGrupo === null && ($this->grupo_id !== null)) {
						include_once 'lib/model/om/BaseGrupoPeer.php';

			$this->aGrupo = GrupoPeer::retrieveByPK($this->grupo_id, $con);

			
		}
		return $this->aGrupo;
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

				$criteria->add(FaltaPeer::ALUMNO_ID, $this->getId());

				FaltaPeer::addSelectColumns($criteria);
				$this->collFaltas = FaltaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FaltaPeer::ALUMNO_ID, $this->getId());

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

		$criteria->add(FaltaPeer::ALUMNO_ID, $this->getId());

		return FaltaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFalta(Falta $l)
	{
		$this->collFaltas[] = $l;
		$l->setAlumno($this);
	}


	
	public function getFaltasJoinEvaluacion($criteria = null, $con = null)
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

				$criteria->add(FaltaPeer::ALUMNO_ID, $this->getId());

				$this->collFaltas = FaltaPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(FaltaPeer::ALUMNO_ID, $this->getId());

			if (!isset($this->lastFaltaCriteria) || !$this->lastFaltaCriteria->equals($criteria)) {
				$this->collFaltas = FaltaPeer::doSelectJoinEvaluacion($criteria, $con);
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

				$criteria->add(FaltaPeer::ALUMNO_ID, $this->getId());

				$this->collFaltas = FaltaPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(FaltaPeer::ALUMNO_ID, $this->getId());

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

				$criteria->add(RetrasoPeer::ALUMNO_ID, $this->getId());

				RetrasoPeer::addSelectColumns($criteria);
				$this->collRetrasos = RetrasoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RetrasoPeer::ALUMNO_ID, $this->getId());

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

		$criteria->add(RetrasoPeer::ALUMNO_ID, $this->getId());

		return RetrasoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRetraso(Retraso $l)
	{
		$this->collRetrasos[] = $l;
		$l->setAlumno($this);
	}


	
	public function getRetrasosJoinEvaluacion($criteria = null, $con = null)
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

				$criteria->add(RetrasoPeer::ALUMNO_ID, $this->getId());

				$this->collRetrasos = RetrasoPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RetrasoPeer::ALUMNO_ID, $this->getId());

			if (!isset($this->lastRetrasoCriteria) || !$this->lastRetrasoCriteria->equals($criteria)) {
				$this->collRetrasos = RetrasoPeer::doSelectJoinEvaluacion($criteria, $con);
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

				$criteria->add(RetrasoPeer::ALUMNO_ID, $this->getId());

				$this->collRetrasos = RetrasoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(RetrasoPeer::ALUMNO_ID, $this->getId());

			if (!isset($this->lastRetrasoCriteria) || !$this->lastRetrasoCriteria->equals($criteria)) {
				$this->collRetrasos = RetrasoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastRetrasoCriteria = $criteria;

		return $this->collRetrasos;
	}

	
	public function initNotapruebas()
	{
		if ($this->collNotapruebas === null) {
			$this->collNotapruebas = array();
		}
	}

	
	public function getNotapruebas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotapruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotapruebas === null) {
			if ($this->isNew()) {
			   $this->collNotapruebas = array();
			} else {

				$criteria->add(NotapruebaPeer::ALUMNO_ID, $this->getId());

				NotapruebaPeer::addSelectColumns($criteria);
				$this->collNotapruebas = NotapruebaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotapruebaPeer::ALUMNO_ID, $this->getId());

				NotapruebaPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotapruebaCriteria) || !$this->lastNotapruebaCriteria->equals($criteria)) {
					$this->collNotapruebas = NotapruebaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotapruebaCriteria = $criteria;
		return $this->collNotapruebas;
	}

	
	public function countNotapruebas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotapruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotapruebaPeer::ALUMNO_ID, $this->getId());

		return NotapruebaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotaprueba(Notaprueba $l)
	{
		$this->collNotapruebas[] = $l;
		$l->setAlumno($this);
	}


	
	public function getNotapruebasJoinPrueba($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotapruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotapruebas === null) {
			if ($this->isNew()) {
				$this->collNotapruebas = array();
			} else {

				$criteria->add(NotapruebaPeer::ALUMNO_ID, $this->getId());

				$this->collNotapruebas = NotapruebaPeer::doSelectJoinPrueba($criteria, $con);
			}
		} else {
									
			$criteria->add(NotapruebaPeer::ALUMNO_ID, $this->getId());

			if (!isset($this->lastNotapruebaCriteria) || !$this->lastNotapruebaCriteria->equals($criteria)) {
				$this->collNotapruebas = NotapruebaPeer::doSelectJoinPrueba($criteria, $con);
			}
		}
		$this->lastNotapruebaCriteria = $criteria;

		return $this->collNotapruebas;
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

				$criteria->add(NotaevaluacionPeer::ALUMNO_ID, $this->getId());

				NotaevaluacionPeer::addSelectColumns($criteria);
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotaevaluacionPeer::ALUMNO_ID, $this->getId());

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

		$criteria->add(NotaevaluacionPeer::ALUMNO_ID, $this->getId());

		return NotaevaluacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotaevaluacion(Notaevaluacion $l)
	{
		$this->collNotaevaluacions[] = $l;
		$l->setAlumno($this);
	}


	
	public function getNotaevaluacionsJoinEvaluacion($criteria = null, $con = null)
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

				$criteria->add(NotaevaluacionPeer::ALUMNO_ID, $this->getId());

				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(NotaevaluacionPeer::ALUMNO_ID, $this->getId());

			if (!isset($this->lastNotaevaluacionCriteria) || !$this->lastNotaevaluacionCriteria->equals($criteria)) {
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinEvaluacion($criteria, $con);
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

				$criteria->add(NotaevaluacionPeer::ALUMNO_ID, $this->getId());

				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(NotaevaluacionPeer::ALUMNO_ID, $this->getId());

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

				$criteria->add(ComportamientoPeer::ALUMNO_ID, $this->getId());

				ComportamientoPeer::addSelectColumns($criteria);
				$this->collComportamientos = ComportamientoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ComportamientoPeer::ALUMNO_ID, $this->getId());

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

		$criteria->add(ComportamientoPeer::ALUMNO_ID, $this->getId());

		return ComportamientoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComportamiento(Comportamiento $l)
	{
		$this->collComportamientos[] = $l;
		$l->setAlumno($this);
	}


	
	public function getComportamientosJoinEvaluacion($criteria = null, $con = null)
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

				$criteria->add(ComportamientoPeer::ALUMNO_ID, $this->getId());

				$this->collComportamientos = ComportamientoPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(ComportamientoPeer::ALUMNO_ID, $this->getId());

			if (!isset($this->lastComportamientoCriteria) || !$this->lastComportamientoCriteria->equals($criteria)) {
				$this->collComportamientos = ComportamientoPeer::doSelectJoinEvaluacion($criteria, $con);
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

				$criteria->add(ComportamientoPeer::ALUMNO_ID, $this->getId());

				$this->collComportamientos = ComportamientoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(ComportamientoPeer::ALUMNO_ID, $this->getId());

			if (!isset($this->lastComportamientoCriteria) || !$this->lastComportamientoCriteria->equals($criteria)) {
				$this->collComportamientos = ComportamientoPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastComportamientoCriteria = $criteria;

		return $this->collComportamientos;
	}

} 