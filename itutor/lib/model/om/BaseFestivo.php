<?php


abstract class BaseFestivo extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $evaluacion_id;


	
	protected $fecha;


	
	protected $motivo;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aEvaluacion;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEvaluacionId()
	{

		return $this->evaluacion_id;
	}

	
	public function getFecha($format = 'Y-m-d')
	{

		if ($this->fecha === null || $this->fecha === '') {
			return null;
		} elseif (!is_int($this->fecha)) {
						$ts = strtotime($this->fecha);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha] as date/time value: " . var_export($this->fecha, true));
			}
		} else {
			$ts = $this->fecha;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getMotivo()
	{

		return $this->motivo;
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
			$this->modifiedColumns[] = FestivoPeer::ID;
		}

	} 
	
	public function setEvaluacionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->evaluacion_id !== $v) {
			$this->evaluacion_id = $v;
			$this->modifiedColumns[] = FestivoPeer::EVALUACION_ID;
		}

		if ($this->aEvaluacion !== null && $this->aEvaluacion->getId() !== $v) {
			$this->aEvaluacion = null;
		}

	} 
	
	public function setFecha($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha !== $ts) {
			$this->fecha = $ts;
			$this->modifiedColumns[] = FestivoPeer::FECHA;
		}

	} 
	
	public function setMotivo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->motivo !== $v) {
			$this->motivo = $v;
			$this->modifiedColumns[] = FestivoPeer::MOTIVO;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = FestivoPeer::ACTIVO;
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
			$this->modifiedColumns[] = FestivoPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->evaluacion_id = $rs->getInt($startcol + 1);

			$this->fecha = $rs->getDate($startcol + 2, null);

			$this->motivo = $rs->getString($startcol + 3);

			$this->activo = $rs->getBoolean($startcol + 4);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Festivo object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FestivoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FestivoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(FestivoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FestivoPeer::DATABASE_NAME);
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


												
			if ($this->aEvaluacion !== null) {
				if ($this->aEvaluacion->isModified()) {
					$affectedRows += $this->aEvaluacion->save($con);
				}
				$this->setEvaluacion($this->aEvaluacion);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FestivoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FestivoPeer::doUpdate($this, $con);
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


												
			if ($this->aEvaluacion !== null) {
				if (!$this->aEvaluacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvaluacion->getValidationFailures());
				}
			}


			if (($retval = FestivoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FestivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEvaluacionId();
				break;
			case 2:
				return $this->getFecha();
				break;
			case 3:
				return $this->getMotivo();
				break;
			case 4:
				return $this->getActivo();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FestivoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEvaluacionId(),
			$keys[2] => $this->getFecha(),
			$keys[3] => $this->getMotivo(),
			$keys[4] => $this->getActivo(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FestivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEvaluacionId($value);
				break;
			case 2:
				$this->setFecha($value);
				break;
			case 3:
				$this->setMotivo($value);
				break;
			case 4:
				$this->setActivo($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FestivoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEvaluacionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFecha($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMotivo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setActivo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FestivoPeer::DATABASE_NAME);

		if ($this->isColumnModified(FestivoPeer::ID)) $criteria->add(FestivoPeer::ID, $this->id);
		if ($this->isColumnModified(FestivoPeer::EVALUACION_ID)) $criteria->add(FestivoPeer::EVALUACION_ID, $this->evaluacion_id);
		if ($this->isColumnModified(FestivoPeer::FECHA)) $criteria->add(FestivoPeer::FECHA, $this->fecha);
		if ($this->isColumnModified(FestivoPeer::MOTIVO)) $criteria->add(FestivoPeer::MOTIVO, $this->motivo);
		if ($this->isColumnModified(FestivoPeer::ACTIVO)) $criteria->add(FestivoPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(FestivoPeer::UPDATED_AT)) $criteria->add(FestivoPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FestivoPeer::DATABASE_NAME);

		$criteria->add(FestivoPeer::ID, $this->id);

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

		$copyObj->setEvaluacionId($this->evaluacion_id);

		$copyObj->setFecha($this->fecha);

		$copyObj->setMotivo($this->motivo);

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
			self::$peer = new FestivoPeer();
		}
		return self::$peer;
	}

	
	public function setEvaluacion($v)
	{


		if ($v === null) {
			$this->setEvaluacionId(NULL);
		} else {
			$this->setEvaluacionId($v->getId());
		}


		$this->aEvaluacion = $v;
	}


	
	public function getEvaluacion($con = null)
	{
		if ($this->aEvaluacion === null && ($this->evaluacion_id !== null)) {
						include_once 'lib/model/om/BaseEvaluacionPeer.php';

			$this->aEvaluacion = EvaluacionPeer::retrieveByPK($this->evaluacion_id, $con);

			
		}
		return $this->aEvaluacion;
	}

} 