<?php


abstract class BaseAsignatura extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $profesor_id;


	
	protected $nombre;


	
	protected $descripcion;


	
	protected $aula;


	
	protected $porcentajepruebas = 80;


	
	protected $porcentajefaltas = 10;


	
	protected $porcentajecomportamiento = 10;


	
	protected $maximofaltas = 10;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aProfesor;

	
	protected $collHorarios;

	
	protected $lastHorarioCriteria = null;

	
	protected $collFaltas;

	
	protected $lastFaltaCriteria = null;

	
	protected $collRetrasos;

	
	protected $lastRetrasoCriteria = null;

	
	protected $collPruebas;

	
	protected $lastPruebaCriteria = null;

	
	protected $collNotaevaluacions;

	
	protected $lastNotaevaluacionCriteria = null;

	
	protected $collComportamientos;

	
	protected $lastComportamientoCriteria = null;

	
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

	
	public function getAula()
	{

		return $this->aula;
	}

	
	public function getPorcentajepruebas()
	{

		return $this->porcentajepruebas;
	}

	
	public function getPorcentajefaltas()
	{

		return $this->porcentajefaltas;
	}

	
	public function getPorcentajecomportamiento()
	{

		return $this->porcentajecomportamiento;
	}

	
	public function getMaximofaltas()
	{

		return $this->maximofaltas;
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
			$this->modifiedColumns[] = AsignaturaPeer::ID;
		}

	} 
	
	public function setProfesorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profesor_id !== $v) {
			$this->profesor_id = $v;
			$this->modifiedColumns[] = AsignaturaPeer::PROFESOR_ID;
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
			$this->modifiedColumns[] = AsignaturaPeer::NOMBRE;
		}

	} 
	
	public function setDescripcion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = AsignaturaPeer::DESCRIPCION;
		}

	} 
	
	public function setAula($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->aula !== $v) {
			$this->aula = $v;
			$this->modifiedColumns[] = AsignaturaPeer::AULA;
		}

	} 
	
	public function setPorcentajepruebas($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->porcentajepruebas !== $v || $v === 80) {
			$this->porcentajepruebas = $v;
			$this->modifiedColumns[] = AsignaturaPeer::PORCENTAJEPRUEBAS;
		}

	} 
	
	public function setPorcentajefaltas($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->porcentajefaltas !== $v || $v === 10) {
			$this->porcentajefaltas = $v;
			$this->modifiedColumns[] = AsignaturaPeer::PORCENTAJEFALTAS;
		}

	} 
	
	public function setPorcentajecomportamiento($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->porcentajecomportamiento !== $v || $v === 10) {
			$this->porcentajecomportamiento = $v;
			$this->modifiedColumns[] = AsignaturaPeer::PORCENTAJECOMPORTAMIENTO;
		}

	} 
	
	public function setMaximofaltas($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->maximofaltas !== $v || $v === 10) {
			$this->maximofaltas = $v;
			$this->modifiedColumns[] = AsignaturaPeer::MAXIMOFALTAS;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = AsignaturaPeer::ACTIVO;
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
			$this->modifiedColumns[] = AsignaturaPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->profesor_id = $rs->getInt($startcol + 1);

			$this->nombre = $rs->getString($startcol + 2);

			$this->descripcion = $rs->getString($startcol + 3);

			$this->aula = $rs->getString($startcol + 4);

			$this->porcentajepruebas = $rs->getInt($startcol + 5);

			$this->porcentajefaltas = $rs->getInt($startcol + 6);

			$this->porcentajecomportamiento = $rs->getInt($startcol + 7);

			$this->maximofaltas = $rs->getInt($startcol + 8);

			$this->activo = $rs->getBoolean($startcol + 9);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Asignatura object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AsignaturaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AsignaturaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(AsignaturaPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AsignaturaPeer::DATABASE_NAME);
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
					$pk = AsignaturaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AsignaturaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collHorarios !== null) {
				foreach($this->collHorarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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

			if ($this->collPruebas !== null) {
				foreach($this->collPruebas as $referrerFK) {
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


			if (($retval = AsignaturaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHorarios !== null) {
					foreach($this->collHorarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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

				if ($this->collPruebas !== null) {
					foreach($this->collPruebas as $referrerFK) {
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
		$pos = AsignaturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAula();
				break;
			case 5:
				return $this->getPorcentajepruebas();
				break;
			case 6:
				return $this->getPorcentajefaltas();
				break;
			case 7:
				return $this->getPorcentajecomportamiento();
				break;
			case 8:
				return $this->getMaximofaltas();
				break;
			case 9:
				return $this->getActivo();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AsignaturaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProfesorId(),
			$keys[2] => $this->getNombre(),
			$keys[3] => $this->getDescripcion(),
			$keys[4] => $this->getAula(),
			$keys[5] => $this->getPorcentajepruebas(),
			$keys[6] => $this->getPorcentajefaltas(),
			$keys[7] => $this->getPorcentajecomportamiento(),
			$keys[8] => $this->getMaximofaltas(),
			$keys[9] => $this->getActivo(),
			$keys[10] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AsignaturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAula($value);
				break;
			case 5:
				$this->setPorcentajepruebas($value);
				break;
			case 6:
				$this->setPorcentajefaltas($value);
				break;
			case 7:
				$this->setPorcentajecomportamiento($value);
				break;
			case 8:
				$this->setMaximofaltas($value);
				break;
			case 9:
				$this->setActivo($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AsignaturaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProfesorId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescripcion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAula($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPorcentajepruebas($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPorcentajefaltas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPorcentajecomportamiento($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMaximofaltas($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setActivo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AsignaturaPeer::DATABASE_NAME);

		if ($this->isColumnModified(AsignaturaPeer::ID)) $criteria->add(AsignaturaPeer::ID, $this->id);
		if ($this->isColumnModified(AsignaturaPeer::PROFESOR_ID)) $criteria->add(AsignaturaPeer::PROFESOR_ID, $this->profesor_id);
		if ($this->isColumnModified(AsignaturaPeer::NOMBRE)) $criteria->add(AsignaturaPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(AsignaturaPeer::DESCRIPCION)) $criteria->add(AsignaturaPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(AsignaturaPeer::AULA)) $criteria->add(AsignaturaPeer::AULA, $this->aula);
		if ($this->isColumnModified(AsignaturaPeer::PORCENTAJEPRUEBAS)) $criteria->add(AsignaturaPeer::PORCENTAJEPRUEBAS, $this->porcentajepruebas);
		if ($this->isColumnModified(AsignaturaPeer::PORCENTAJEFALTAS)) $criteria->add(AsignaturaPeer::PORCENTAJEFALTAS, $this->porcentajefaltas);
		if ($this->isColumnModified(AsignaturaPeer::PORCENTAJECOMPORTAMIENTO)) $criteria->add(AsignaturaPeer::PORCENTAJECOMPORTAMIENTO, $this->porcentajecomportamiento);
		if ($this->isColumnModified(AsignaturaPeer::MAXIMOFALTAS)) $criteria->add(AsignaturaPeer::MAXIMOFALTAS, $this->maximofaltas);
		if ($this->isColumnModified(AsignaturaPeer::ACTIVO)) $criteria->add(AsignaturaPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(AsignaturaPeer::UPDATED_AT)) $criteria->add(AsignaturaPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AsignaturaPeer::DATABASE_NAME);

		$criteria->add(AsignaturaPeer::ID, $this->id);

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

		$copyObj->setAula($this->aula);

		$copyObj->setPorcentajepruebas($this->porcentajepruebas);

		$copyObj->setPorcentajefaltas($this->porcentajefaltas);

		$copyObj->setPorcentajecomportamiento($this->porcentajecomportamiento);

		$copyObj->setMaximofaltas($this->maximofaltas);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getHorarios() as $relObj) {
				$copyObj->addHorario($relObj->copy($deepCopy));
			}

			foreach($this->getFaltas() as $relObj) {
				$copyObj->addFalta($relObj->copy($deepCopy));
			}

			foreach($this->getRetrasos() as $relObj) {
				$copyObj->addRetraso($relObj->copy($deepCopy));
			}

			foreach($this->getPruebas() as $relObj) {
				$copyObj->addPrueba($relObj->copy($deepCopy));
			}

			foreach($this->getNotaevaluacions() as $relObj) {
				$copyObj->addNotaevaluacion($relObj->copy($deepCopy));
			}

			foreach($this->getComportamientos() as $relObj) {
				$copyObj->addComportamiento($relObj->copy($deepCopy));
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
			self::$peer = new AsignaturaPeer();
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

				$criteria->add(HorarioPeer::ASIGNATURA_ID, $this->getId());

				HorarioPeer::addSelectColumns($criteria);
				$this->collHorarios = HorarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HorarioPeer::ASIGNATURA_ID, $this->getId());

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

		$criteria->add(HorarioPeer::ASIGNATURA_ID, $this->getId());

		return HorarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHorario(Horario $l)
	{
		$this->collHorarios[] = $l;
		$l->setAsignatura($this);
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

				$criteria->add(HorarioPeer::ASIGNATURA_ID, $this->getId());

				$this->collHorarios = HorarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		} else {
									
			$criteria->add(HorarioPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastHorarioCriteria) || !$this->lastHorarioCriteria->equals($criteria)) {
				$this->collHorarios = HorarioPeer::doSelectJoinProfesor($criteria, $con);
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

				$criteria->add(HorarioPeer::ASIGNATURA_ID, $this->getId());

				$this->collHorarios = HorarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(HorarioPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastHorarioCriteria) || !$this->lastHorarioCriteria->equals($criteria)) {
				$this->collHorarios = HorarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastHorarioCriteria = $criteria;

		return $this->collHorarios;
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

				$criteria->add(FaltaPeer::ASIGNATURA_ID, $this->getId());

				FaltaPeer::addSelectColumns($criteria);
				$this->collFaltas = FaltaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FaltaPeer::ASIGNATURA_ID, $this->getId());

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

		$criteria->add(FaltaPeer::ASIGNATURA_ID, $this->getId());

		return FaltaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFalta(Falta $l)
	{
		$this->collFaltas[] = $l;
		$l->setAsignatura($this);
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

				$criteria->add(FaltaPeer::ASIGNATURA_ID, $this->getId());

				$this->collFaltas = FaltaPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(FaltaPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastFaltaCriteria) || !$this->lastFaltaCriteria->equals($criteria)) {
				$this->collFaltas = FaltaPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		}
		$this->lastFaltaCriteria = $criteria;

		return $this->collFaltas;
	}


	
	public function getFaltasJoinAlumno($criteria = null, $con = null)
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

				$criteria->add(FaltaPeer::ASIGNATURA_ID, $this->getId());

				$this->collFaltas = FaltaPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(FaltaPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastFaltaCriteria) || !$this->lastFaltaCriteria->equals($criteria)) {
				$this->collFaltas = FaltaPeer::doSelectJoinAlumno($criteria, $con);
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

				$criteria->add(RetrasoPeer::ASIGNATURA_ID, $this->getId());

				RetrasoPeer::addSelectColumns($criteria);
				$this->collRetrasos = RetrasoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RetrasoPeer::ASIGNATURA_ID, $this->getId());

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

		$criteria->add(RetrasoPeer::ASIGNATURA_ID, $this->getId());

		return RetrasoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRetraso(Retraso $l)
	{
		$this->collRetrasos[] = $l;
		$l->setAsignatura($this);
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

				$criteria->add(RetrasoPeer::ASIGNATURA_ID, $this->getId());

				$this->collRetrasos = RetrasoPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RetrasoPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastRetrasoCriteria) || !$this->lastRetrasoCriteria->equals($criteria)) {
				$this->collRetrasos = RetrasoPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		}
		$this->lastRetrasoCriteria = $criteria;

		return $this->collRetrasos;
	}


	
	public function getRetrasosJoinAlumno($criteria = null, $con = null)
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

				$criteria->add(RetrasoPeer::ASIGNATURA_ID, $this->getId());

				$this->collRetrasos = RetrasoPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(RetrasoPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastRetrasoCriteria) || !$this->lastRetrasoCriteria->equals($criteria)) {
				$this->collRetrasos = RetrasoPeer::doSelectJoinAlumno($criteria, $con);
			}
		}
		$this->lastRetrasoCriteria = $criteria;

		return $this->collRetrasos;
	}

	
	public function initPruebas()
	{
		if ($this->collPruebas === null) {
			$this->collPruebas = array();
		}
	}

	
	public function getPruebas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPruebas === null) {
			if ($this->isNew()) {
			   $this->collPruebas = array();
			} else {

				$criteria->add(PruebaPeer::ASIGNATURA_ID, $this->getId());

				PruebaPeer::addSelectColumns($criteria);
				$this->collPruebas = PruebaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PruebaPeer::ASIGNATURA_ID, $this->getId());

				PruebaPeer::addSelectColumns($criteria);
				if (!isset($this->lastPruebaCriteria) || !$this->lastPruebaCriteria->equals($criteria)) {
					$this->collPruebas = PruebaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPruebaCriteria = $criteria;
		return $this->collPruebas;
	}

	
	public function countPruebas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PruebaPeer::ASIGNATURA_ID, $this->getId());

		return PruebaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPrueba(Prueba $l)
	{
		$this->collPruebas[] = $l;
		$l->setAsignatura($this);
	}


	
	public function getPruebasJoinEvaluacion($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPruebas === null) {
			if ($this->isNew()) {
				$this->collPruebas = array();
			} else {

				$criteria->add(PruebaPeer::ASIGNATURA_ID, $this->getId());

				$this->collPruebas = PruebaPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(PruebaPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastPruebaCriteria) || !$this->lastPruebaCriteria->equals($criteria)) {
				$this->collPruebas = PruebaPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		}
		$this->lastPruebaCriteria = $criteria;

		return $this->collPruebas;
	}


	
	public function getPruebasJoinGrupo($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPruebas === null) {
			if ($this->isNew()) {
				$this->collPruebas = array();
			} else {

				$criteria->add(PruebaPeer::ASIGNATURA_ID, $this->getId());

				$this->collPruebas = PruebaPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(PruebaPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastPruebaCriteria) || !$this->lastPruebaCriteria->equals($criteria)) {
				$this->collPruebas = PruebaPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastPruebaCriteria = $criteria;

		return $this->collPruebas;
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

				$criteria->add(NotaevaluacionPeer::ASIGNATURA_ID, $this->getId());

				NotaevaluacionPeer::addSelectColumns($criteria);
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotaevaluacionPeer::ASIGNATURA_ID, $this->getId());

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

		$criteria->add(NotaevaluacionPeer::ASIGNATURA_ID, $this->getId());

		return NotaevaluacionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotaevaluacion(Notaevaluacion $l)
	{
		$this->collNotaevaluacions[] = $l;
		$l->setAsignatura($this);
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

				$criteria->add(NotaevaluacionPeer::ASIGNATURA_ID, $this->getId());

				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(NotaevaluacionPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastNotaevaluacionCriteria) || !$this->lastNotaevaluacionCriteria->equals($criteria)) {
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		}
		$this->lastNotaevaluacionCriteria = $criteria;

		return $this->collNotaevaluacions;
	}


	
	public function getNotaevaluacionsJoinAlumno($criteria = null, $con = null)
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

				$criteria->add(NotaevaluacionPeer::ASIGNATURA_ID, $this->getId());

				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(NotaevaluacionPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastNotaevaluacionCriteria) || !$this->lastNotaevaluacionCriteria->equals($criteria)) {
				$this->collNotaevaluacions = NotaevaluacionPeer::doSelectJoinAlumno($criteria, $con);
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

				$criteria->add(ComportamientoPeer::ASIGNATURA_ID, $this->getId());

				ComportamientoPeer::addSelectColumns($criteria);
				$this->collComportamientos = ComportamientoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ComportamientoPeer::ASIGNATURA_ID, $this->getId());

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

		$criteria->add(ComportamientoPeer::ASIGNATURA_ID, $this->getId());

		return ComportamientoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComportamiento(Comportamiento $l)
	{
		$this->collComportamientos[] = $l;
		$l->setAsignatura($this);
	}


	
	public function getComportamientosJoinAlumno($criteria = null, $con = null)
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

				$criteria->add(ComportamientoPeer::ASIGNATURA_ID, $this->getId());

				$this->collComportamientos = ComportamientoPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(ComportamientoPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastComportamientoCriteria) || !$this->lastComportamientoCriteria->equals($criteria)) {
				$this->collComportamientos = ComportamientoPeer::doSelectJoinAlumno($criteria, $con);
			}
		}
		$this->lastComportamientoCriteria = $criteria;

		return $this->collComportamientos;
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

				$criteria->add(ComportamientoPeer::ASIGNATURA_ID, $this->getId());

				$this->collComportamientos = ComportamientoPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(ComportamientoPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastComportamientoCriteria) || !$this->lastComportamientoCriteria->equals($criteria)) {
				$this->collComportamientos = ComportamientoPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		}
		$this->lastComportamientoCriteria = $criteria;

		return $this->collComportamientos;
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

				$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

				DiarioPeer::addSelectColumns($criteria);
				$this->collDiarios = DiarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

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

		$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

		return DiarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDiario(Diario $l)
	{
		$this->collDiarios[] = $l;
		$l->setAsignatura($this);
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

				$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinEvaluacion($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinEvaluacion($criteria, $con);
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

				$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinGrupo($criteria, $con);
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

				$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

				$this->collDiarios = DiarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		} else {
									
			$criteria->add(DiarioPeer::ASIGNATURA_ID, $this->getId());

			if (!isset($this->lastDiarioCriteria) || !$this->lastDiarioCriteria->equals($criteria)) {
				$this->collDiarios = DiarioPeer::doSelectJoinProfesor($criteria, $con);
			}
		}
		$this->lastDiarioCriteria = $criteria;

		return $this->collDiarios;
	}

} 