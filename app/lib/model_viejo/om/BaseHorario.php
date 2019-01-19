<?php


abstract class BaseHorario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $profesor_id;


	
	protected $asignatura_id;


	
	protected $grupo_id;


	
	protected $dia;


	
	protected $hora;


	
	protected $observaciones;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aProfesor;

	
	protected $aAsignatura;

	
	protected $aGrupo;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProfesorId()
	{

		return $this->profesor_id;
	}

	
	public function getAsignaturaId()
	{

		return $this->asignatura_id;
	}

	
	public function getGrupoId()
	{

		return $this->grupo_id;
	}

	
	public function getDia()
	{

		return $this->dia;
	}

	
	public function getHora()
	{

		return $this->hora;
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
			$this->modifiedColumns[] = HorarioPeer::ID;
		}

	} 
	
	public function setProfesorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profesor_id !== $v) {
			$this->profesor_id = $v;
			$this->modifiedColumns[] = HorarioPeer::PROFESOR_ID;
		}

		if ($this->aProfesor !== null && $this->aProfesor->getId() !== $v) {
			$this->aProfesor = null;
		}

	} 
	
	public function setAsignaturaId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->asignatura_id !== $v) {
			$this->asignatura_id = $v;
			$this->modifiedColumns[] = HorarioPeer::ASIGNATURA_ID;
		}

		if ($this->aAsignatura !== null && $this->aAsignatura->getId() !== $v) {
			$this->aAsignatura = null;
		}

	} 
	
	public function setGrupoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->grupo_id !== $v) {
			$this->grupo_id = $v;
			$this->modifiedColumns[] = HorarioPeer::GRUPO_ID;
		}

		if ($this->aGrupo !== null && $this->aGrupo->getId() !== $v) {
			$this->aGrupo = null;
		}

	} 
	
	public function setDia($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dia !== $v) {
			$this->dia = $v;
			$this->modifiedColumns[] = HorarioPeer::DIA;
		}

	} 
	
	public function setHora($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->hora !== $v) {
			$this->hora = $v;
			$this->modifiedColumns[] = HorarioPeer::HORA;
		}

	} 
	
	public function setObservaciones($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->observaciones !== $v) {
			$this->observaciones = $v;
			$this->modifiedColumns[] = HorarioPeer::OBSERVACIONES;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = HorarioPeer::ACTIVO;
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
			$this->modifiedColumns[] = HorarioPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->profesor_id = $rs->getInt($startcol + 1);

			$this->asignatura_id = $rs->getInt($startcol + 2);

			$this->grupo_id = $rs->getInt($startcol + 3);

			$this->dia = $rs->getInt($startcol + 4);

			$this->hora = $rs->getInt($startcol + 5);

			$this->observaciones = $rs->getString($startcol + 6);

			$this->activo = $rs->getBoolean($startcol + 7);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Horario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HorarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HorarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(HorarioPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HorarioPeer::DATABASE_NAME);
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


												
			if ($this->aProfesor !== null) {
				if ($this->aProfesor->isModified()) {
					$affectedRows += $this->aProfesor->save($con);
				}
				$this->setProfesor($this->aProfesor);
			}

			if ($this->aAsignatura !== null) {
				if ($this->aAsignatura->isModified()) {
					$affectedRows += $this->aAsignatura->save($con);
				}
				$this->setAsignatura($this->aAsignatura);
			}

			if ($this->aGrupo !== null) {
				if ($this->aGrupo->isModified()) {
					$affectedRows += $this->aGrupo->save($con);
				}
				$this->setGrupo($this->aGrupo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HorarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HorarioPeer::doUpdate($this, $con);
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


												
			if ($this->aProfesor !== null) {
				if (!$this->aProfesor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfesor->getValidationFailures());
				}
			}

			if ($this->aAsignatura !== null) {
				if (!$this->aAsignatura->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAsignatura->getValidationFailures());
				}
			}

			if ($this->aGrupo !== null) {
				if (!$this->aGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGrupo->getValidationFailures());
				}
			}


			if (($retval = HorarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HorarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProfesorId();
				break;
			case 2:
				return $this->getAsignaturaId();
				break;
			case 3:
				return $this->getGrupoId();
				break;
			case 4:
				return $this->getDia();
				break;
			case 5:
				return $this->getHora();
				break;
			case 6:
				return $this->getObservaciones();
				break;
			case 7:
				return $this->getActivo();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HorarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProfesorId(),
			$keys[2] => $this->getAsignaturaId(),
			$keys[3] => $this->getGrupoId(),
			$keys[4] => $this->getDia(),
			$keys[5] => $this->getHora(),
			$keys[6] => $this->getObservaciones(),
			$keys[7] => $this->getActivo(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HorarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProfesorId($value);
				break;
			case 2:
				$this->setAsignaturaId($value);
				break;
			case 3:
				$this->setGrupoId($value);
				break;
			case 4:
				$this->setDia($value);
				break;
			case 5:
				$this->setHora($value);
				break;
			case 6:
				$this->setObservaciones($value);
				break;
			case 7:
				$this->setActivo($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HorarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProfesorId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAsignaturaId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGrupoId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDia($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHora($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setActivo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HorarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(HorarioPeer::ID)) $criteria->add(HorarioPeer::ID, $this->id);
		if ($this->isColumnModified(HorarioPeer::PROFESOR_ID)) $criteria->add(HorarioPeer::PROFESOR_ID, $this->profesor_id);
		if ($this->isColumnModified(HorarioPeer::ASIGNATURA_ID)) $criteria->add(HorarioPeer::ASIGNATURA_ID, $this->asignatura_id);
		if ($this->isColumnModified(HorarioPeer::GRUPO_ID)) $criteria->add(HorarioPeer::GRUPO_ID, $this->grupo_id);
		if ($this->isColumnModified(HorarioPeer::DIA)) $criteria->add(HorarioPeer::DIA, $this->dia);
		if ($this->isColumnModified(HorarioPeer::HORA)) $criteria->add(HorarioPeer::HORA, $this->hora);
		if ($this->isColumnModified(HorarioPeer::OBSERVACIONES)) $criteria->add(HorarioPeer::OBSERVACIONES, $this->observaciones);
		if ($this->isColumnModified(HorarioPeer::ACTIVO)) $criteria->add(HorarioPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(HorarioPeer::UPDATED_AT)) $criteria->add(HorarioPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HorarioPeer::DATABASE_NAME);

		$criteria->add(HorarioPeer::ID, $this->id);

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

		$copyObj->setProfesorId($this->profesor_id);

		$copyObj->setAsignaturaId($this->asignatura_id);

		$copyObj->setGrupoId($this->grupo_id);

		$copyObj->setDia($this->dia);

		$copyObj->setHora($this->hora);

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
			self::$peer = new HorarioPeer();
		}
		return self::$peer;
	}

	
	public function setProfesor($v)
	{


		if ($v === null) {
			$this->setProfesorId(NULL);
		} else {
			$this->setProfesorId($v->getId());
		}


		$this->aProfesor = $v;
	}


	
	public function getProfesor($con = null)
	{
		if ($this->aProfesor === null && ($this->profesor_id !== null)) {
						include_once 'lib/model/om/BaseProfesorPeer.php';

			$this->aProfesor = ProfesorPeer::retrieveByPK($this->profesor_id, $con);

			
		}
		return $this->aProfesor;
	}

	
	public function setAsignatura($v)
	{


		if ($v === null) {
			$this->setAsignaturaId(NULL);
		} else {
			$this->setAsignaturaId($v->getId());
		}


		$this->aAsignatura = $v;
	}


	
	public function getAsignatura($con = null)
	{
		if ($this->aAsignatura === null && ($this->asignatura_id !== null)) {
						include_once 'lib/model/om/BaseAsignaturaPeer.php';

			$this->aAsignatura = AsignaturaPeer::retrieveByPK($this->asignatura_id, $con);

			
		}
		return $this->aAsignatura;
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

} 