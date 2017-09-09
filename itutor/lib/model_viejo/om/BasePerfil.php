<?php


abstract class BasePerfil extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nombre;


	
	protected $descripcion;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $collProfesors;

	
	protected $lastProfesorCriteria = null;

	
	protected $collHoraperfils;

	
	protected $lastHoraperfilCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNombre()
	{

		return $this->nombre;
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
			$this->modifiedColumns[] = PerfilPeer::ID;
		}

	} 
	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = PerfilPeer::NOMBRE;
		}

	} 
	
	public function setDescripcion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = PerfilPeer::DESCRIPCION;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = PerfilPeer::ACTIVO;
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
			$this->modifiedColumns[] = PerfilPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->descripcion = $rs->getString($startcol + 2);

			$this->activo = $rs->getBoolean($startcol + 3);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Perfil object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PerfilPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PerfilPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(PerfilPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PerfilPeer::DATABASE_NAME);
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
					$pk = PerfilPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PerfilPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProfesors !== null) {
				foreach($this->collProfesors as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = PerfilPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProfesors !== null) {
					foreach($this->collProfesors as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNombre();
				break;
			case 2:
				return $this->getDescripcion();
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
		$keys = PerfilPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getDescripcion(),
			$keys[3] => $this->getActivo(),
			$keys[4] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
			case 2:
				$this->setDescripcion($value);
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
		$keys = PerfilPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescripcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setActivo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PerfilPeer::DATABASE_NAME);

		if ($this->isColumnModified(PerfilPeer::ID)) $criteria->add(PerfilPeer::ID, $this->id);
		if ($this->isColumnModified(PerfilPeer::NOMBRE)) $criteria->add(PerfilPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(PerfilPeer::DESCRIPCION)) $criteria->add(PerfilPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(PerfilPeer::ACTIVO)) $criteria->add(PerfilPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(PerfilPeer::UPDATED_AT)) $criteria->add(PerfilPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PerfilPeer::DATABASE_NAME);

		$criteria->add(PerfilPeer::ID, $this->id);

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

		$copyObj->setNombre($this->nombre);

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProfesors() as $relObj) {
				$copyObj->addProfesor($relObj->copy($deepCopy));
			}

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
			self::$peer = new PerfilPeer();
		}
		return self::$peer;
	}

	
	public function initProfesors()
	{
		if ($this->collProfesors === null) {
			$this->collProfesors = array();
		}
	}

	
	public function getProfesors($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProfesorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfesors === null) {
			if ($this->isNew()) {
			   $this->collProfesors = array();
			} else {

				$criteria->add(ProfesorPeer::PERFIL_ID, $this->getId());

				ProfesorPeer::addSelectColumns($criteria);
				$this->collProfesors = ProfesorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProfesorPeer::PERFIL_ID, $this->getId());

				ProfesorPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfesorCriteria) || !$this->lastProfesorCriteria->equals($criteria)) {
					$this->collProfesors = ProfesorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfesorCriteria = $criteria;
		return $this->collProfesors;
	}

	
	public function countProfesors($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProfesorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfesorPeer::PERFIL_ID, $this->getId());

		return ProfesorPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProfesor(Profesor $l)
	{
		$this->collProfesors[] = $l;
		$l->setPerfil($this);
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

				$criteria->add(HoraperfilPeer::PERFIL_ID, $this->getId());

				HoraperfilPeer::addSelectColumns($criteria);
				$this->collHoraperfils = HoraperfilPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HoraperfilPeer::PERFIL_ID, $this->getId());

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

		$criteria->add(HoraperfilPeer::PERFIL_ID, $this->getId());

		return HoraperfilPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHoraperfil(Horaperfil $l)
	{
		$this->collHoraperfils[] = $l;
		$l->setPerfil($this);
	}


	
	public function getHoraperfilsJoinHora($criteria = null, $con = null)
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

				$criteria->add(HoraperfilPeer::PERFIL_ID, $this->getId());

				$this->collHoraperfils = HoraperfilPeer::doSelectJoinHora($criteria, $con);
			}
		} else {
									
			$criteria->add(HoraperfilPeer::PERFIL_ID, $this->getId());

			if (!isset($this->lastHoraperfilCriteria) || !$this->lastHoraperfilCriteria->equals($criteria)) {
				$this->collHoraperfils = HoraperfilPeer::doSelectJoinHora($criteria, $con);
			}
		}
		$this->lastHoraperfilCriteria = $criteria;

		return $this->collHoraperfils;
	}

} 