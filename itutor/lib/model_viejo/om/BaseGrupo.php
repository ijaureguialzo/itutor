<?php


abstract class BaseGrupo extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $profesor_id;


	
	protected $nombre;


	
	protected $descripcion;


	
	protected $observaciones;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aProfesor;

	
	protected $collHorarios;

	
	protected $lastHorarioCriteria = null;

	
	protected $collAlumnos;

	
	protected $lastAlumnoCriteria = null;

	
	protected $collGrupoevaluacions;

	
	protected $lastGrupoevaluacionCriteria = null;

	
	protected $collDiarios;

	
	protected $lastDiarioCriteria = null;

	
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

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
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
			$this->modifiedColumns[] = GrupoPeer::ID;
		}

	} 
	
	public function setProfesorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profesor_id !== $v) {
			$this->profesor_id = $v;
			$this->modifiedColumns[] = GrupoPeer::PROFESOR_ID;
		}

		if ($this->aProfesor !== null && $this->aProfesor->getId() !== $v) {
			$this->aProfesor = null;
		}

	} 
	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = GrupoPeer::NOMBRE;
		}

	} 
	
	public function setDescripcion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = GrupoPeer::DESCRIPCION;
		}

	} 
	
	public function setObservaciones($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->observaciones !== $v) {
			$this->observaciones = $v;
			$this->modifiedColumns[] = GrupoPeer::OBSERVACIONES;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = GrupoPeer::ACTIVO;
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
			$this->modifiedColumns[] = GrupoPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->profesor_id = $rs->getInt($startcol + 1);

			$this->nombre = $rs->getString($startcol + 2);

			$this->descripcion = $rs->getString($startcol + 3);

			$this->observaciones = $rs->getString($startcol + 4);

			$this->activo = $rs->getBoolean($startcol + 5);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Grupo object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GrupoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(GrupoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GrupoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GrupoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collHorarios !== null) {
				foreach($this->collHorarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAlumnos !== null) {
				foreach($this->collAlumnos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGrupoevaluacions !== null) {
				foreach($this->collGrupoevaluacions as $referrerFK) {
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


												
			if ($this->aProfesor !== null) {
				if (!$this->aProfesor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfesor->getValidationFailures());
				}
			}


			if (($retval = GrupoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHorarios !== null) {
					foreach($this->collHorarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAlumnos !== null) {
					foreach($this->collAlumnos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGrupoevaluacions !== null) {
					foreach($this->collGrupoevaluacions as $referrerFK) {
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
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNombre();
				break;
			case 3:
				return $this->getDescripcion();
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
		$keys = GrupoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProfesorId(),
			$keys[2] => $this->getNombre(),
			$keys[3] => $this->getDescripcion(),
			$keys[4] => $this->getObservaciones(),
			$keys[5] => $this->getActivo(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNombre($value);
				break;
			case 3:
				$this->setDescripcion($value);
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
		$keys = GrupoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProfesorId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescripcion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObservaciones($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActivo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		if ($this->isColumnModified(GrupoPeer::ID)) $criteria->add(GrupoPeer::ID, $this->id);
		if ($this->isColumnModified(GrupoPeer::PROFESOR_ID)) $criteria->add(GrupoPeer::PROFESOR_ID, $this->profesor_id);
		if ($this->isColumnModified(GrupoPeer::NOMBRE)) $criteria->add(GrupoPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(GrupoPeer::DESCRIPCION)) $criteria->add(GrupoPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(GrupoPeer::OBSERVACIONES)) $criteria->add(GrupoPeer::OBSERVACIONES, $this->observaciones);
		if ($this->isColumnModified(GrupoPeer::ACTIVO)) $criteria->add(GrupoPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(GrupoPeer::UPDATED_AT)) $criteria->add(GrupoPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		$criteria->add(GrupoPeer::ID, $this->id);

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

		$copyObj->setNombre($this->nombre);

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setObservaciones($this->observaciones);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getHorarios() as $relObj) {
				$copyObj->addHorario($relObj->copy($deepCopy));
			}

			foreach($this->getAlumnos() as $relObj) {
				$copyObj->addAlumno($relObj->copy($deepCopy));
			}

			foreach($this->getGrupoevaluacions() as $relObj) {
				$copyObj->addGrupoevaluacion($relObj->copy($deepCopy));
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
			self::$peer = new GrupoPeer();
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

				$criteria->add(HorarioPeer::GRUPO_ID, $this->getId());

				HorarioPeer::addSelectColumns($criteria);
				$this->collHorarios = HorarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HorarioPeer::GRUPO_ID, $this->getId());

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

		$criteria->add(HorarioPeer::GRUPO_ID, $this->getId());

		return HorarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHorario(Horario $l)
	{
		$this->collHorarios[] = $l;
		$l->setGrupo($this);
	}


	
	public function getHorariosJoinProfesor($criteria = null, $con = null)
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

				$criteria->add(HorarioPeer::GRUPO_ID, $this->getId());

				$this->collHorarios = HorarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		} else {
									
			$criteria->add(HorarioPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastHorarioCriteria) || !$this->lastHorarioCriteria->equals($criteria)) {
				$this->collHorarios = HorarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		}
		$this->lastHorarioCriteria = $criteria;

		return $this->collHorarios;
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

				$criteria->add(HorarioPeer::GRUPO_ID, $this->getId());

				$this->collHorarios = HorarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(HorarioPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastHorarioCriteria) || !$this->lastHorarioCriteria->equals($criteria)) {
				$this->collHorarios = HorarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		}
		$this->lastHorarioCriteria = $criteria;

		return $this->collHorarios;
	}

	
	public function initAlumnos()
	{
		if ($this->collAlumnos === null) {
			$this->collAlumnos = array();
		}
	}

	
	public function getAlumnos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAlumnoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAlumnos === null) {
			if ($this->isNew()) {
			   $this->collAlumnos = array();
			} else {

				$criteria->add(AlumnoPeer::GRUPO_ID, $this->getId());

				AlumnoPeer::addSelectColumns($criteria);
				$this->collAlumnos = AlumnoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AlumnoPeer::GRUPO_ID, $this->getId());

				AlumnoPeer::addSelectColumns($criteria);
				if (!isset($this->lastAlumnoCriteria) || !$this->lastAlumnoCriteria->equals($criteria)) {
					$this->collAlumnos = AlumnoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAlumnoCriteria = $criteria;
		return $this->collAlumnos;
	}

	
	public function countAlumnos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAlumnoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AlumnoPeer::GRUPO_ID, $this->getId());

		return AlumnoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAlumno(Alumno $l)
	{
		$this->collAlumnos[] = $l;
		$l->setGrupo($this);
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

				$criteria->add(GrupoevaluacionPeer::GRUPO_ID, $this->getId());

				GrupoevaluacionPeer::addSelectColumns($criteria);
				$this->collGrupoevaluacions = GrupoevaluacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GrupoevaluacionPeer::GRUPO_ID, $this->getId());

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

		$criteria->add(GrupoevaluacionPeer::GRUPO_ID, $this->getId());

		return GrupoevaluacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGrupoevaluacion(Grupoevaluacion $l)
	{
		$this->collGrupoevaluacions[] = $l;
		$l->setGrupo($this);
	}


	
	public function getGrupoevaluacionsJoinEvaluacion($criteria = null, $con = null)
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

				$criteria->add(GrupoevaluacionPeer::GRUPO_ID, $this->getId());

				$this->collGrupoevaluacions = GrupoevaluacionPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(GrupoevaluacionPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastGrupoevaluacionCriteria) || !$this->lastGrupoevaluacionCriteria->equals($criteria)) {
				$this->collGrupoevaluacions = GrupoevaluacionPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		}
		$this->lastGrupoevaluacionCriteria = $criteria;

		return $this->collGrupoevaluacions;
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

				$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

				DiarioPeer::addSelectColumns($criteria);
				$this->collDiarios = DiarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

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

		$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

		return DiarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDiario(Diario $l)
	{
		$this->collDiarios[] = $l;
		$l->setGrupo($this);
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

				$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

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

				$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinAsignatura($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinAsignatura($criteria, $con);
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

				$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::GRUPO_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		}
		$this->lastDiarioCriteria = $criteria;

		return $this->collDiarios;
	}

} 