<?php


abstract class BaseHora extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $tramo;


	
	protected $descanso = false;


	
	protected $descripcion;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $collHoraperfils;

	
	protected $lastHoraperfilCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTramo()
	{

		return $this->tramo;
	}

	
	public function getDescanso()
	{

		return $this->descanso;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
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
			$this->modifiedColumns[] = HoraPeer::ID;
		}

	} 
	
	public function setTramo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tramo !== $v) {
			$this->tramo = $v;
			$this->modifiedColumns[] = HoraPeer::TRAMO;
		}

	} 
	
	public function setDescanso($v)
	{

		if ($this->descanso !== $v || $v === false) {
			$this->descanso = $v;
			$this->modifiedColumns[] = HoraPeer::DESCANSO;
		}

	} 
	
	public function setDescripcion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = HoraPeer::DESCRIPCION;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = HoraPeer::ACTIVO;
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
			$this->modifiedColumns[] = HoraPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->tramo = $rs->getString($startcol + 1);

			$this->descanso = $rs->getBoolean($startcol + 2);

			$this->descripcion = $rs->getString($startcol + 3);

			$this->activo = $rs->getBoolean($startcol + 4);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Hora object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HoraPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HoraPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(HoraPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HoraPeer::DATABASE_NAME);
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
					$pk = HoraPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HoraPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collHoraperfils !== null) {
				foreach($this->collHoraperfils as $referrerFK) {
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


			if (($retval = HoraPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHoraperfils !== null) {
					foreach($this->collHoraperfils as $referrerFK) {
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
		$pos = HoraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTramo();
				break;
			case 2:
				return $this->getDescanso();
				break;
			case 3:
				return $this->getDescripcion();
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
		$keys = HoraPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTramo(),
			$keys[2] => $this->getDescanso(),
			$keys[3] => $this->getDescripcion(),
			$keys[4] => $this->getActivo(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HoraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTramo($value);
				break;
			case 2:
				$this->setDescanso($value);
				break;
			case 3:
				$this->setDescripcion($value);
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
		$keys = HoraPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTramo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescanso($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescripcion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setActivo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HoraPeer::DATABASE_NAME);

		if ($this->isColumnModified(HoraPeer::ID)) $criteria->add(HoraPeer::ID, $this->id);
		if ($this->isColumnModified(HoraPeer::TRAMO)) $criteria->add(HoraPeer::TRAMO, $this->tramo);
		if ($this->isColumnModified(HoraPeer::DESCANSO)) $criteria->add(HoraPeer::DESCANSO, $this->descanso);
		if ($this->isColumnModified(HoraPeer::DESCRIPCION)) $criteria->add(HoraPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(HoraPeer::ACTIVO)) $criteria->add(HoraPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(HoraPeer::UPDATED_AT)) $criteria->add(HoraPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HoraPeer::DATABASE_NAME);

		$criteria->add(HoraPeer::ID, $this->id);

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

		$copyObj->setTramo($this->tramo);

		$copyObj->setDescanso($this->descanso);

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getHoraperfils() as $relObj) {
				$copyObj->addHoraperfil($relObj->copy($deepCopy));
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
			self::$peer = new HoraPeer();
		}
		return self::$peer;
	}

	
	public function initHoraperfils()
	{
		if ($this->collHoraperfils === null) {
			$this->collHoraperfils = array();
		}
	}

	
	public function getHoraperfils($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHoraperfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHoraperfils === null) {
			if ($this->isNew()) {
			   $this->collHoraperfils = array();
			} else {

				$criteria->add(HoraperfilPeer::HORA_ID, $this->getId());

				HoraperfilPeer::addSelectColumns($criteria);
				$this->collHoraperfils = HoraperfilPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HoraperfilPeer::HORA_ID, $this->getId());

				HoraperfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastHoraperfilCriteria) || !$this->lastHoraperfilCriteria->equals($criteria)) {
					$this->collHoraperfils = HoraperfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHoraperfilCriteria = $criteria;
		return $this->collHoraperfils;
	}

	
	public function countHoraperfils($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHoraperfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HoraperfilPeer::HORA_ID, $this->getId());

		return HoraperfilPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHoraperfil(Horaperfil $l)
	{
		$this->collHoraperfils[] = $l;
		$l->setHora($this);
	}


	
	public function getHoraperfilsJoinPerfil($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHoraperfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHoraperfils === null) {
			if ($this->isNew()) {
				$this->collHoraperfils = array();
			} else {

				$criteria->add(HoraperfilPeer::HORA_ID, $this->getId());

				$this->collHoraperfils = HoraperfilPeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
									
			$criteria->add(HoraperfilPeer::HORA_ID, $this->getId());

			if (!isset($this->lastHoraperfilCriteria) || !$this->lastHoraperfilCriteria->equals($criteria)) {
				$this->collHoraperfils = HoraperfilPeer::doSelectJoinPerfil($criteria, $con);
			}
		}
		$this->lastHoraperfilCriteria = $criteria;

		return $this->collHoraperfils;
	}

} 