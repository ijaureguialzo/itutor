<?php


abstract class BaseGrupoevaluacion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $grupo_id;


	
	protected $evaluacion_id;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aGrupo;

	
	protected $aEvaluacion;

	
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

	
	public function getEvaluacionId()
	{

		return $this->evaluacion_id;
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
			$this->modifiedColumns[] = GrupoevaluacionPeer::ID;
		}

	} 
	
	public function setGrupoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->grupo_id !== $v) {
			$this->grupo_id = $v;
			$this->modifiedColumns[] = GrupoevaluacionPeer::GRUPO_ID;
		}

		if ($this->aGrupo !== null && $this->aGrupo->getId() !== $v) {
			$this->aGrupo = null;
		}

	} 
	
	public function setEvaluacionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->evaluacion_id !== $v) {
			$this->evaluacion_id = $v;
			$this->modifiedColumns[] = GrupoevaluacionPeer::EVALUACION_ID;
		}

		if ($this->aEvaluacion !== null && $this->aEvaluacion->getId() !== $v) {
			$this->aEvaluacion = null;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = GrupoevaluacionPeer::ACTIVO;
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
			$this->modifiedColumns[] = GrupoevaluacionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->grupo_id = $rs->getInt($startcol + 1);

			$this->evaluacion_id = $rs->getInt($startcol + 2);

			$this->activo = $rs->getBoolean($startcol + 3);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Grupoevaluacion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoevaluacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GrupoevaluacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(GrupoevaluacionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoevaluacionPeer::DATABASE_NAME);
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

			if ($this->aEvaluacion !== null) {
				if ($this->aEvaluacion->isModified()) {
					$affectedRows += $this->aEvaluacion->save($con);
				}
				$this->setEvaluacion($this->aEvaluacion);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GrupoevaluacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GrupoevaluacionPeer::doUpdate($this, $con);
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


												
			if ($this->aGrupo !== null) {
				if (!$this->aGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGrupo->getValidationFailures());
				}
			}

			if ($this->aEvaluacion !== null) {
				if (!$this->aEvaluacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvaluacion->getValidationFailures());
				}
			}


			if (($retval = GrupoevaluacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoevaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEvaluacionId();
				break;
			case 3:
				return $this->getActivo();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoevaluacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getGrupoId(),
			$keys[2] => $this->getEvaluacionId(),
			$keys[3] => $this->getActivo(),
			$keys[4] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoevaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEvaluacionId($value);
				break;
			case 3:
				$this->setActivo($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoevaluacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGrupoId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEvaluacionId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setActivo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GrupoevaluacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(GrupoevaluacionPeer::ID)) $criteria->add(GrupoevaluacionPeer::ID, $this->id);
		if ($this->isColumnModified(GrupoevaluacionPeer::GRUPO_ID)) $criteria->add(GrupoevaluacionPeer::GRUPO_ID, $this->grupo_id);
		if ($this->isColumnModified(GrupoevaluacionPeer::EVALUACION_ID)) $criteria->add(GrupoevaluacionPeer::EVALUACION_ID, $this->evaluacion_id);
		if ($this->isColumnModified(GrupoevaluacionPeer::ACTIVO)) $criteria->add(GrupoevaluacionPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(GrupoevaluacionPeer::UPDATED_AT)) $criteria->add(GrupoevaluacionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GrupoevaluacionPeer::DATABASE_NAME);

		$criteria->add(GrupoevaluacionPeer::ID, $this->id);

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

		$copyObj->setEvaluacionId($this->evaluacion_id);

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
			self::$peer = new GrupoevaluacionPeer();
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