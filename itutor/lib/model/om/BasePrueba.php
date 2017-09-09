<?php


abstract class BasePrueba extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $evaluacion_id;


	
	protected $asignatura_id;


	
	protected $grupo_id;


	
	protected $dia;


	
	protected $hora;


	
	protected $fecha;


	
	protected $duracion;


	
	protected $porcentaje = 100;


	
	protected $observaciones;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aEvaluacion;

	
	protected $aAsignatura;

	
	protected $aGrupo;

	
	protected $collNotapruebas;

	
	protected $lastNotapruebaCriteria = null;

	
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

	
	public function getDuracion()
	{

		return $this->duracion;
	}

	
	public function getPorcentaje()
	{

		return $this->porcentaje;
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
			$this->modifiedColumns[] = PruebaPeer::ID;
		}

	} 
	
	public function setEvaluacionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->evaluacion_id !== $v) {
			$this->evaluacion_id = $v;
			$this->modifiedColumns[] = PruebaPeer::EVALUACION_ID;
		}

		if ($this->aEvaluacion !== null && $this->aEvaluacion->getId() !== $v) {
			$this->aEvaluacion = null;
		}

	} 
	
	public function setAsignaturaId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->asignatura_id !== $v) {
			$this->asignatura_id = $v;
			$this->modifiedColumns[] = PruebaPeer::ASIGNATURA_ID;
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
			$this->modifiedColumns[] = PruebaPeer::GRUPO_ID;
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
			$this->modifiedColumns[] = PruebaPeer::DIA;
		}

	} 
	
	public function setHora($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->hora !== $v) {
			$this->hora = $v;
			$this->modifiedColumns[] = PruebaPeer::HORA;
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
			$this->modifiedColumns[] = PruebaPeer::FECHA;
		}

	} 
	
	public function setDuracion($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->duracion !== $v) {
			$this->duracion = $v;
			$this->modifiedColumns[] = PruebaPeer::DURACION;
		}

	} 
	
	public function setPorcentaje($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->porcentaje !== $v || $v === 100) {
			$this->porcentaje = $v;
			$this->modifiedColumns[] = PruebaPeer::PORCENTAJE;
		}

	} 
	
	public function setObservaciones($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->observaciones !== $v) {
			$this->observaciones = $v;
			$this->modifiedColumns[] = PruebaPeer::OBSERVACIONES;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = PruebaPeer::ACTIVO;
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
			$this->modifiedColumns[] = PruebaPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->evaluacion_id = $rs->getInt($startcol + 1);

			$this->asignatura_id = $rs->getInt($startcol + 2);

			$this->grupo_id = $rs->getInt($startcol + 3);

			$this->dia = $rs->getInt($startcol + 4);

			$this->hora = $rs->getInt($startcol + 5);

			$this->fecha = $rs->getDate($startcol + 6, null);

			$this->duracion = $rs->getInt($startcol + 7);

			$this->porcentaje = $rs->getInt($startcol + 8);

			$this->observaciones = $rs->getString($startcol + 9);

			$this->activo = $rs->getBoolean($startcol + 10);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Prueba object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PruebaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PruebaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(PruebaPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PruebaPeer::DATABASE_NAME);
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
					$pk = PruebaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PruebaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collNotapruebas !== null) {
				foreach($this->collNotapruebas as $referrerFK) {
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


												
			if ($this->aEvaluacion !== null) {
				if (!$this->aEvaluacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvaluacion->getValidationFailures());
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


			if (($retval = PruebaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNotapruebas !== null) {
					foreach($this->collNotapruebas as $referrerFK) {
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
		$pos = PruebaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFecha();
				break;
			case 7:
				return $this->getDuracion();
				break;
			case 8:
				return $this->getPorcentaje();
				break;
			case 9:
				return $this->getObservaciones();
				break;
			case 10:
				return $this->getActivo();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PruebaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEvaluacionId(),
			$keys[2] => $this->getAsignaturaId(),
			$keys[3] => $this->getGrupoId(),
			$keys[4] => $this->getDia(),
			$keys[5] => $this->getHora(),
			$keys[6] => $this->getFecha(),
			$keys[7] => $this->getDuracion(),
			$keys[8] => $this->getPorcentaje(),
			$keys[9] => $this->getObservaciones(),
			$keys[10] => $this->getActivo(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PruebaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFecha($value);
				break;
			case 7:
				$this->setDuracion($value);
				break;
			case 8:
				$this->setPorcentaje($value);
				break;
			case 9:
				$this->setObservaciones($value);
				break;
			case 10:
				$this->setActivo($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PruebaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEvaluacionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAsignaturaId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGrupoId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDia($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHora($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFecha($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDuracion($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPorcentaje($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setObservaciones($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setActivo($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PruebaPeer::DATABASE_NAME);

		if ($this->isColumnModified(PruebaPeer::ID)) $criteria->add(PruebaPeer::ID, $this->id);
		if ($this->isColumnModified(PruebaPeer::EVALUACION_ID)) $criteria->add(PruebaPeer::EVALUACION_ID, $this->evaluacion_id);
		if ($this->isColumnModified(PruebaPeer::ASIGNATURA_ID)) $criteria->add(PruebaPeer::ASIGNATURA_ID, $this->asignatura_id);
		if ($this->isColumnModified(PruebaPeer::GRUPO_ID)) $criteria->add(PruebaPeer::GRUPO_ID, $this->grupo_id);
		if ($this->isColumnModified(PruebaPeer::DIA)) $criteria->add(PruebaPeer::DIA, $this->dia);
		if ($this->isColumnModified(PruebaPeer::HORA)) $criteria->add(PruebaPeer::HORA, $this->hora);
		if ($this->isColumnModified(PruebaPeer::FECHA)) $criteria->add(PruebaPeer::FECHA, $this->fecha);
		if ($this->isColumnModified(PruebaPeer::DURACION)) $criteria->add(PruebaPeer::DURACION, $this->duracion);
		if ($this->isColumnModified(PruebaPeer::PORCENTAJE)) $criteria->add(PruebaPeer::PORCENTAJE, $this->porcentaje);
		if ($this->isColumnModified(PruebaPeer::OBSERVACIONES)) $criteria->add(PruebaPeer::OBSERVACIONES, $this->observaciones);
		if ($this->isColumnModified(PruebaPeer::ACTIVO)) $criteria->add(PruebaPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(PruebaPeer::UPDATED_AT)) $criteria->add(PruebaPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PruebaPeer::DATABASE_NAME);

		$criteria->add(PruebaPeer::ID, $this->id);

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

		$copyObj->setAsignaturaId($this->asignatura_id);

		$copyObj->setGrupoId($this->grupo_id);

		$copyObj->setDia($this->dia);

		$copyObj->setHora($this->hora);

		$copyObj->setFecha($this->fecha);

		$copyObj->setDuracion($this->duracion);

		$copyObj->setPorcentaje($this->porcentaje);

		$copyObj->setObservaciones($this->observaciones);

		$copyObj->setActivo($this->activo);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getNotapruebas() as $relObj) {
				$copyObj->addNotaprueba($relObj->copy($deepCopy));
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
			self::$peer = new PruebaPeer();
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

	
	public function initNotapruebas()
	{
		if ($this->collNotapruebas === null) {
			$this->collNotapruebas = array();
		}
	}

	
	public function getNotapruebas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotapruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotapruebas === null) {
			if ($this->isNew()) {
			   $this->collNotapruebas = array();
			} else {

				$criteria->add(NotapruebaPeer::PRUEBA_ID, $this->getId());

				NotapruebaPeer::addSelectColumns($criteria);
				$this->collNotapruebas = NotapruebaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotapruebaPeer::PRUEBA_ID, $this->getId());

				NotapruebaPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotapruebaCriteria) || !$this->lastNotapruebaCriteria->equals($criteria)) {
					$this->collNotapruebas = NotapruebaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotapruebaCriteria = $criteria;
		return $this->collNotapruebas;
	}

	
	public function countNotapruebas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotapruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotapruebaPeer::PRUEBA_ID, $this->getId());

		return NotapruebaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotaprueba(Notaprueba $l)
	{
		$this->collNotapruebas[] = $l;
		$l->setPrueba($this);
	}


	
	public function getNotapruebasJoinAlumno($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotapruebaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotapruebas === null) {
			if ($this->isNew()) {
				$this->collNotapruebas = array();
			} else {

				$criteria->add(NotapruebaPeer::PRUEBA_ID, $this->getId());

				$this->collNotapruebas = NotapruebaPeer::doSelectJoinAlumno($criteria, $con);
			}
		} else {
									
			$criteria->add(NotapruebaPeer::PRUEBA_ID, $this->getId());

			if (!isset($this->lastNotapruebaCriteria) || !$this->lastNotapruebaCriteria->equals($criteria)) {
				$this->collNotapruebas = NotapruebaPeer::doSelectJoinAlumno($criteria, $con);
			}
		}
		$this->lastNotapruebaCriteria = $criteria;

		return $this->collNotapruebas;
	}

} 