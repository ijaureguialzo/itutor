<?php


abstract class BaseHoraperfil extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $hora_id;


	
	protected $perfil_id;


	
	protected $orden;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aHora;

	
	protected $aPerfil;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getHoraId()
	{

		return $this->hora_id;
	}

	
	public function getPerfilId()
	{

		return $this->perfil_id;
	}

	
	public function getOrden()
	{

		return $this->orden;
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
			$this->modifiedColumns[] = HoraperfilPeer::ID;
		}

	} 
	
	public function setHoraId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->hora_id !== $v) {
			$this->hora_id = $v;
			$this->modifiedColumns[] = HoraperfilPeer::HORA_ID;
		}

		if ($this->aHora !== null && $this->aHora->getId() !== $v) {
			$this->aHora = null;
		}

	} 
	
	public function setPerfilId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->perfil_id !== $v) {
			$this->perfil_id = $v;
			$this->modifiedColumns[] = HoraperfilPeer::PERFIL_ID;
		}

		if ($this->aPerfil !== null && $this->aPerfil->getId() !== $v) {
			$this->aPerfil = null;
		}

	} 
	
	public function setOrden($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->orden !== $v) {
			$this->orden = $v;
			$this->modifiedColumns[] = HoraperfilPeer::ORDEN;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = HoraperfilPeer::ACTIVO;
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
			$this->modifiedColumns[] = HoraperfilPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->hora_id = $rs->getInt($startcol + 1);

			$this->perfil_id = $rs->getInt($startcol + 2);

			$this->orden = $rs->getInt($startcol + 3);

			$this->activo = $rs->getBoolean($startcol + 4);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Horaperfil object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HoraperfilPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HoraperfilPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(HoraperfilPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HoraperfilPeer::DATABASE_NAME);
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


												
			if ($this->aHora !== null) {
				if ($this->aHora->isModified()) {
					$affectedRows += $this->aHora->save($con);
				}
				$this->setHora($this->aHora);
			}

			if ($this->aPerfil !== null) {
				if ($this->aPerfil->isModified()) {
					$affectedRows += $this->aPerfil->save($con);
				}
				$this->setPerfil($this->aPerfil);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HoraperfilPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HoraperfilPeer::doUpdate($this, $con);
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


												
			if ($this->aHora !== null) {
				if (!$this->aHora->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHora->getValidationFailures());
				}
			}

			if ($this->aPerfil !== null) {
				if (!$this->aPerfil->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfil->getValidationFailures());
				}
			}


			if (($retval = HoraperfilPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HoraperfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getHoraId();
				break;
			case 2:
				return $this->getPerfilId();
				break;
			case 3:
				return $this->getOrden();
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
		$keys = HoraperfilPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getHoraId(),
			$keys[2] => $this->getPerfilId(),
			$keys[3] => $this->getOrden(),
			$keys[4] => $this->getActivo(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HoraperfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setHoraId($value);
				break;
			case 2:
				$this->setPerfilId($value);
				break;
			case 3:
				$this->setOrden($value);
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
		$keys = HoraperfilPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setHoraId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPerfilId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setOrden($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setActivo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HoraperfilPeer::DATABASE_NAME);

		if ($this->isColumnModified(HoraperfilPeer::ID)) $criteria->add(HoraperfilPeer::ID, $this->id);
		if ($this->isColumnModified(HoraperfilPeer::HORA_ID)) $criteria->add(HoraperfilPeer::HORA_ID, $this->hora_id);
		if ($this->isColumnModified(HoraperfilPeer::PERFIL_ID)) $criteria->add(HoraperfilPeer::PERFIL_ID, $this->perfil_id);
		if ($this->isColumnModified(HoraperfilPeer::ORDEN)) $criteria->add(HoraperfilPeer::ORDEN, $this->orden);
		if ($this->isColumnModified(HoraperfilPeer::ACTIVO)) $criteria->add(HoraperfilPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(HoraperfilPeer::UPDATED_AT)) $criteria->add(HoraperfilPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HoraperfilPeer::DATABASE_NAME);

		$criteria->add(HoraperfilPeer::ID, $this->id);

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

		$copyObj->setHoraId($this->hora_id);

		$copyObj->setPerfilId($this->perfil_id);

		$copyObj->setOrden($this->orden);

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
			self::$peer = new HoraperfilPeer();
		}
		return self::$peer;
	}

	
	public function setHora($v)
	{


		if ($v === null) {
			$this->setHoraId(NULL);
		} else {
			$this->setHoraId($v->getId());
		}


		$this->aHora = $v;
	}


	
	public function getHora($con = null)
	{
		if ($this->aHora === null && ($this->hora_id !== null)) {
						include_once 'lib/model/om/BaseHoraPeer.php';

			$this->aHora = HoraPeer::retrieveByPK($this->hora_id, $con);

			
		}
		return $this->aHora;
	}

	
	public function setPerfil($v)
	{


		if ($v === null) {
			$this->setPerfilId(NULL);
		} else {
			$this->setPerfilId($v->getId());
		}


		$this->aPerfil = $v;
	}


	
	public function getPerfil($con = null)
	{
		if ($this->aPerfil === null && ($this->perfil_id !== null)) {
						include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfil = PerfilPeer::retrieveByPK($this->perfil_id, $con);

			
		}
		return $this->aPerfil;
	}

} 