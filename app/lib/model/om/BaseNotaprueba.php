<?php


abstract class BaseNotaprueba extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $alumno_id;


	
	protected $prueba_id;


	
	protected $nota;


	
	protected $observaciones;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aAlumno;

	
	protected $aPrueba;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAlumnoId()
	{

		return $this->alumno_id;
	}

	
	public function getPruebaId()
	{

		return $this->prueba_id;
	}

	
	public function getNota()
	{

		return $this->nota;
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
			$this->modifiedColumns[] = NotapruebaPeer::ID;
		}

	} 
	
	public function setAlumnoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->alumno_id !== $v) {
			$this->alumno_id = $v;
			$this->modifiedColumns[] = NotapruebaPeer::ALUMNO_ID;
		}

		if ($this->aAlumno !== null && $this->aAlumno->getId() !== $v) {
			$this->aAlumno = null;
		}

	} 
	
	public function setPruebaId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->prueba_id !== $v) {
			$this->prueba_id = $v;
			$this->modifiedColumns[] = NotapruebaPeer::PRUEBA_ID;
		}

		if ($this->aPrueba !== null && $this->aPrueba->getId() !== $v) {
			$this->aPrueba = null;
		}

	} 
	
	public function setNota($v)
	{

		if ($this->nota !== $v) {
			$this->nota = $v;
			$this->modifiedColumns[] = NotapruebaPeer::NOTA;
		}

	} 
	
	public function setObservaciones($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->observaciones !== $v) {
			$this->observaciones = $v;
			$this->modifiedColumns[] = NotapruebaPeer::OBSERVACIONES;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = NotapruebaPeer::ACTIVO;
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
			$this->modifiedColumns[] = NotapruebaPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->alumno_id = $rs->getInt($startcol + 1);

			$this->prueba_id = $rs->getInt($startcol + 2);

			$this->nota = $rs->getFloat($startcol + 3);

			$this->observaciones = $rs->getString($startcol + 4);

			$this->activo = $rs->getBoolean($startcol + 5);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Notaprueba object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotapruebaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NotapruebaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(NotapruebaPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotapruebaPeer::DATABASE_NAME);
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


												
			if ($this->aAlumno !== null) {
				if ($this->aAlumno->isModified()) {
					$affectedRows += $this->aAlumno->save($con);
				}
				$this->setAlumno($this->aAlumno);
			}

			if ($this->aPrueba !== null) {
				if ($this->aPrueba->isModified()) {
					$affectedRows += $this->aPrueba->save($con);
				}
				$this->setPrueba($this->aPrueba);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NotapruebaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NotapruebaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aAlumno !== null) {
				if (!$this->aAlumno->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAlumno->getValidationFailures());
				}
			}

			if ($this->aPrueba !== null) {
				if (!$this->aPrueba->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPrueba->getValidationFailures());
				}
			}


			if (($retval = NotapruebaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotapruebaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAlumnoId();
				break;
			case 2:
				return $this->getPruebaId();
				break;
			case 3:
				return $this->getNota();
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
		$keys = NotapruebaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAlumnoId(),
			$keys[2] => $this->getPruebaId(),
			$keys[3] => $this->getNota(),
			$keys[4] => $this->getObservaciones(),
			$keys[5] => $this->getActivo(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotapruebaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAlumnoId($value);
				break;
			case 2:
				$this->setPruebaId($value);
				break;
			case 3:
				$this->setNota($value);
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
		$keys = NotapruebaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAlumnoId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPruebaId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNota($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObservaciones($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActivo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NotapruebaPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotapruebaPeer::ID)) $criteria->add(NotapruebaPeer::ID, $this->id);
		if ($this->isColumnModified(NotapruebaPeer::ALUMNO_ID)) $criteria->add(NotapruebaPeer::ALUMNO_ID, $this->alumno_id);
		if ($this->isColumnModified(NotapruebaPeer::PRUEBA_ID)) $criteria->add(NotapruebaPeer::PRUEBA_ID, $this->prueba_id);
		if ($this->isColumnModified(NotapruebaPeer::NOTA)) $criteria->add(NotapruebaPeer::NOTA, $this->nota);
		if ($this->isColumnModified(NotapruebaPeer::OBSERVACIONES)) $criteria->add(NotapruebaPeer::OBSERVACIONES, $this->observaciones);
		if ($this->isColumnModified(NotapruebaPeer::ACTIVO)) $criteria->add(NotapruebaPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(NotapruebaPeer::UPDATED_AT)) $criteria->add(NotapruebaPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NotapruebaPeer::DATABASE_NAME);

		$criteria->add(NotapruebaPeer::ID, $this->id);

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

		$copyObj->setAlumnoId($this->alumno_id);

		$copyObj->setPruebaId($this->prueba_id);

		$copyObj->setNota($this->nota);

		$copyObj->setObservaciones($this->observaciones);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new NotapruebaPeer();
		}
		return self::$peer;
	}

	
	public function setAlumno($v)
	{


		if ($v === null) {
			$this->setAlumnoId(NULL);
		} else {
			$this->setAlumnoId($v->getId());
		}


		$this->aAlumno = $v;
	}


	
	public function getAlumno($con = null)
	{
		if ($this->aAlumno === null && ($this->alumno_id !== null)) {
						include_once 'lib/model/om/BaseAlumnoPeer.php';

			$this->aAlumno = AlumnoPeer::retrieveByPK($this->alumno_id, $con);

			
		}
		return $this->aAlumno;
	}

	
	public function setPrueba($v)
	{


		if ($v === null) {
			$this->setPruebaId(NULL);
		} else {
			$this->setPruebaId($v->getId());
		}


		$this->aPrueba = $v;
	}


	
	public function getPrueba($con = null)
	{
		if ($this->aPrueba === null && ($this->prueba_id !== null)) {
						include_once 'lib/model/om/BasePruebaPeer.php';

			$this->aPrueba = PruebaPeer::retrieveByPK($this->prueba_id, $con);

			
		}
		return $this->aPrueba;
	}

} 