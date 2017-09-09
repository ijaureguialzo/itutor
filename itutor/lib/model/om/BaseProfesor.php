<?php


abstract class BaseProfesor extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $perfil_id;


	
	protected $nombre;


	
	protected $codigo;


	
	protected $email;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aPerfil;

	
	protected $collAsignaturas;

	
	protected $lastAsignaturaCriteria = null;

	
	protected $collGrupos;

	
	protected $lastGrupoCriteria = null;

	
	protected $collHorarios;

	
	protected $lastHorarioCriteria = null;

	
	protected $collDiarios;

	
	protected $lastDiarioCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPerfilId()
	{

		return $this->perfil_id;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getCodigo()
	{

		return $this->codigo;
	}

	
	public function getEmail()
	{

		return $this->email;
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
			$this->modifiedColumns[] = ProfesorPeer::ID;
		}

	} 
	
	public function setPerfilId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->perfil_id !== $v) {
			$this->perfil_id = $v;
			$this->modifiedColumns[] = ProfesorPeer::PERFIL_ID;
		}

		if ($this->aPerfil !== null && $this->aPerfil->getId() !== $v) {
			$this->aPerfil = null;
		}

	} 
	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = ProfesorPeer::NOMBRE;
		}

	} 
	
	public function setCodigo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->codigo !== $v) {
			$this->codigo = $v;
			$this->modifiedColumns[] = ProfesorPeer::CODIGO;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = ProfesorPeer::EMAIL;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = ProfesorPeer::ACTIVO;
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
			$this->modifiedColumns[] = ProfesorPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->perfil_id = $rs->getInt($startcol + 1);

			$this->nombre = $rs->getString($startcol + 2);

			$this->codigo = $rs->getString($startcol + 3);

			$this->email = $rs->getString($startcol + 4);

			$this->activo = $rs->getBoolean($startcol + 5);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Profesor object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProfesorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProfesorPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(ProfesorPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProfesorPeer::DATABASE_NAME);
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


												
			if ($this->aPerfil !== null) {
				if ($this->aPerfil->isModified()) {
					$affectedRows += $this->aPerfil->save($con);
				}
				$this->setPerfil($this->aPerfil);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProfesorPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProfesorPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAsignaturas !== null) {
				foreach($this->collAsignaturas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGrupos !== null) {
				foreach($this->collGrupos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHorarios !== null) {
				foreach($this->collHorarios as $referrerFK) {
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


												
			if ($this->aPerfil !== null) {
				if (!$this->aPerfil->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfil->getValidationFailures());
				}
			}


			if (($retval = ProfesorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAsignaturas !== null) {
					foreach($this->collAsignaturas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGrupos !== null) {
					foreach($this->collGrupos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHorarios !== null) {
					foreach($this->collHorarios as $referrerFK) {
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
		$pos = ProfesorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPerfilId();
				break;
			case 2:
				return $this->getNombre();
				break;
			case 3:
				return $this->getCodigo();
				break;
			case 4:
				return $this->getEmail();
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
		$keys = ProfesorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPerfilId(),
			$keys[2] => $this->getNombre(),
			$keys[3] => $this->getCodigo(),
			$keys[4] => $this->getEmail(),
			$keys[5] => $this->getActivo(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProfesorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPerfilId($value);
				break;
			case 2:
				$this->setNombre($value);
				break;
			case 3:
				$this->setCodigo($value);
				break;
			case 4:
				$this->setEmail($value);
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
		$keys = ProfesorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPerfilId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCodigo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActivo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProfesorPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProfesorPeer::ID)) $criteria->add(ProfesorPeer::ID, $this->id);
		if ($this->isColumnModified(ProfesorPeer::PERFIL_ID)) $criteria->add(ProfesorPeer::PERFIL_ID, $this->perfil_id);
		if ($this->isColumnModified(ProfesorPeer::NOMBRE)) $criteria->add(ProfesorPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(ProfesorPeer::CODIGO)) $criteria->add(ProfesorPeer::CODIGO, $this->codigo);
		if ($this->isColumnModified(ProfesorPeer::EMAIL)) $criteria->add(ProfesorPeer::EMAIL, $this->email);
		if ($this->isColumnModified(ProfesorPeer::ACTIVO)) $criteria->add(ProfesorPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(ProfesorPeer::UPDATED_AT)) $criteria->add(ProfesorPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProfesorPeer::DATABASE_NAME);

		$criteria->add(ProfesorPeer::ID, $this->id);

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

		$copyObj->setPerfilId($this->perfil_id);

		$copyObj->setNombre($this->nombre);

		$copyObj->setCodigo($this->codigo);

		$copyObj->setEmail($this->email);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAsignaturas() as $relObj) {
				$copyObj->addAsignatura($relObj->copy($deepCopy));
			}

			foreach($this->getGrupos() as $relObj) {
				$copyObj->addGrupo($relObj->copy($deepCopy));
			}

			foreach($this->getHorarios() as $relObj) {
				$copyObj->addHorario($relObj->copy($deepCopy));
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
			self::$peer = new ProfesorPeer();
		}
		return self::$peer;
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

	
	public function initAsignaturas()
	{
		if ($this->collAsignaturas === null) {
			$this->collAsignaturas = array();
		}
	}

	
	public function getAsignaturas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAsignaturaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAsignaturas === null) {
			if ($this->isNew()) {
			   $this->collAsignaturas = array();
			} else {

				$criteria->add(AsignaturaPeer::PROFESOR_ID, $this->getId());

				AsignaturaPeer::addSelectColumns($criteria);
				$this->collAsignaturas = AsignaturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AsignaturaPeer::PROFESOR_ID, $this->getId());

				AsignaturaPeer::addSelectColumns($criteria);
				if (!isset($this->lastAsignaturaCriteria) || !$this->lastAsignaturaCriteria->equals($criteria)) {
					$this->collAsignaturas = AsignaturaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAsignaturaCriteria = $criteria;
		return $this->collAsignaturas;
	}

	
	public function countAsignaturas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAsignaturaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AsignaturaPeer::PROFESOR_ID, $this->getId());

		return AsignaturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAsignatura(Asignatura $l)
	{
		$this->collAsignaturas[] = $l;
		$l->setProfesor($this);
	}

	
	public function initGrupos()
	{
		if ($this->collGrupos === null) {
			$this->collGrupos = array();
		}
	}

	
	public function getGrupos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupos === null) {
			if ($this->isNew()) {
			   $this->collGrupos = array();
			} else {

				$criteria->add(GrupoPeer::PROFESOR_ID, $this->getId());

				GrupoPeer::addSelectColumns($criteria);
				$this->collGrupos = GrupoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GrupoPeer::PROFESOR_ID, $this->getId());

				GrupoPeer::addSelectColumns($criteria);
				if (!isset($this->lastGrupoCriteria) || !$this->lastGrupoCriteria->equals($criteria)) {
					$this->collGrupos = GrupoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGrupoCriteria = $criteria;
		return $this->collGrupos;
	}

	
	public function countGrupos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GrupoPeer::PROFESOR_ID, $this->getId());

		return GrupoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGrupo(Grupo $l)
	{
		$this->collGrupos[] = $l;
		$l->setProfesor($this);
	}

	
	public function initHorarios()
	{
		if ($this->collHorarios === null) {
			$this->collHorarios = array();
		}
	}

	
	public function getHorarios($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHorarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHorarios === null) {
			if ($this->isNew()) {
			   $this->collHorarios = array();
			} else {

				$criteria->add(HorarioPeer::PROFESOR_ID, $this->getId());

				HorarioPeer::addSelectColumns($criteria);
				$this->collHorarios = HorarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HorarioPeer::PROFESOR_ID, $this->getId());

				HorarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastHorarioCriteria) || !$this->lastHorarioCriteria->equals($criteria)) {
					$this->collHorarios = HorarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHorarioCriteria = $criteria;
		return $this->collHorarios;
	}

	
	public function countHorarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHorarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HorarioPeer::PROFESOR_ID, $this->getId());

		return HorarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHorario(Horario $l)
	{
		$this->collHorarios[] = $l;
		$l->setProfesor($this);
	}


	
	public function getHorariosJoinAsignatura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHorarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHorarios === null) {
			if ($this->isNew()) {
				$this->collHorarios = array();
			} else {

				$criteria->add(HorarioPeer::PROFESOR_ID, $this->getId());

				$this->collHorarios = HorarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(HorarioPeer::PROFESOR_ID, $this->getId());

			if (!isset($this->lastHorarioCriteria) || !$this->lastHorarioCriteria->equals($criteria)) {
				$this->collHorarios = HorarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastHorarioCriteria = $criteria;

		return $this->collHorarios;
	}


	
	public function getHorariosJoinGrupo($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHorarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHorarios === null) {
			if ($this->isNew()) {
				$this->collHorarios = array();
			} else {

				$criteria->add(HorarioPeer::PROFESOR_ID, $this->getId());

				$this->collHorarios = HorarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(HorarioPeer::PROFESOR_ID, $this->getId());

			if (!isset($this->lastHorarioCriteria) || !$this->lastHorarioCriteria->equals($criteria)) {
				$this->collHorarios = HorarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastHorarioCriteria = $criteria;

		return $this->collHorarios;
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

				$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

				DiarioPeer::addSelectColumns($criteria);
				$this->collDiarios = DiarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

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

		$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

		return DiarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDiario(Diario $l)
	{
		$this->collDiarios[] = $l;
		$l->setProfesor($this);
	}


	
	public function getDiariosJoinEvaluacion($criteria = null, $con = null)
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

				$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		}
		$this->lastDiarioCriteria = $criteria;

		return $this->collDiarios;
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

				$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

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

				$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::PROFESOR_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastDiarioCriteria = $criteria;

		return $this->collDiarios;
	}

} 