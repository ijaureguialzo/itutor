<?php


abstract class BaseFalta extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $evaluacion_id;


	
	protected $alumno_id;


	
	protected $asignatura_id;


	
	protected $dia;


	
	protected $hora;


	
	protected $fecha;


	
	protected $justificado = false;


	
	protected $observaciones;


	
	protected $activo = true;


	
	protected $updated_at;

	
	protected $aEvaluacion;

	
	protected $aAlumno;

	
	protected $aAsignatura;

	
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

	
	public function getAlumnoId()
	{

		return $this->alumno_id;
	}

	
	public function getAsignaturaId()
	{

		return $this->asignatura_id;
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

	
	public function getJustificado()
	{

		return $this->justificado;
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
			$this->modifiedColumns[] = FaltaPeer::ID;
		}

	} 
	
	public function setEvaluacionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->evaluacion_id !== $v) {
			$this->evaluacion_id = $v;
			$this->modifiedColumns[] = FaltaPeer::EVALUACION_ID;
		}

		if ($this->aEvaluacion !== null && $this->aEvaluacion->getId() !== $v) {
			$this->aEvaluacion = null;
		}

	} 
	
	public function setAlumnoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->alumno_id !== $v) {
			$this->alumno_id = $v;
			$this->modifiedColumns[] = FaltaPeer::ALUMNO_ID;
		}

		if ($this->aAlumno !== null && $this->aAlumno->getId() !== $v) {
			$this->aAlumno = null;
		}

	} 
	
	public function setAsignaturaId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->asignatura_id !== $v) {
			$this->asignatura_id = $v;
			$this->modifiedColumns[] = FaltaPeer::ASIGNATURA_ID;
		}

		if ($this->aAsignatura !== null && $this->aAsignatura->getId() !== $v) {
			$this->aAsignatura = null;
		}

	} 
	
	public function setDia($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dia !== $v) {
			$this->dia = $v;
			$this->modifiedColumns[] = FaltaPeer::DIA;
		}

	} 
	
	public function setHora($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->hora !== $v) {
			$this->hora = $v;
			$this->modifiedColumns[] = FaltaPeer::HORA;
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
			$this->modifiedColumns[] = FaltaPeer::FECHA;
		}

	} 
	
	public function setJustificado($v)
	{

		if ($this->justificado !== $v || $v === false) {
			$this->justificado = $v;
			$this->modifiedColumns[] = FaltaPeer::JUSTIFICADO;
		}

	} 
	
	public function setObservaciones($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->observaciones !== $v) {
			$this->observaciones = $v;
			$this->modifiedColumns[] = FaltaPeer::OBSERVACIONES;
		}

	} 
	
	public function setActivo($v)
	{

		if ($this->activo !== $v || $v === true) {
			$this->activo = $v;
			$this->modifiedColumns[] = FaltaPeer::ACTIVO;
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
			$this->modifiedColumns[] = FaltaPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->evaluacion_id = $rs->getInt($startcol + 1);

			$this->alumno_id = $rs->getInt($startcol + 2);

			$this->asignatura_id = $rs->getInt($startcol + 3);

			$this->dia = $rs->getInt($startcol + 4);

			$this->hora = $rs->getInt($startcol + 5);

			$this->fecha = $rs->getDate($startcol + 6, null);

			$this->justificado = $rs->getBoolean($startcol + 7);

			$this->observaciones = $rs->getString($startcol + 8);

			$this->activo = $rs->getBoolean($startcol + 9);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Falta object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FaltaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FaltaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(FaltaPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FaltaPeer::DATABASE_NAME);
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

			if ($this->aAlumno !== null) {
				if ($this->aAlumno->isModified()) {
					$affectedRows += $this->aAlumno->save($con);
				}
				$this->setAlumno($this->aAlumno);
			}

			if ($this->aAsignatura !== null) {
				if ($this->aAsignatura->isModified()) {
					$affectedRows += $this->aAsignatura->save($con);
				}
				$this->setAsignatura($this->aAsignatura);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FaltaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FaltaPeer::doUpdate($this, $con);
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

			if ($this->aAlumno !== null) {
				if (!$this->aAlumno->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAlumno->getValidationFailures());
				}
			}

			if ($this->aAsignatura !== null) {
				if (!$this->aAsignatura->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAsignatura->getValidationFailures());
				}
			}


			if (($retval = FaltaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FaltaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAlumnoId();
				break;
			case 3:
				return $this->getAsignaturaId();
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
				return $this->getJustificado();
				break;
			case 8:
				return $this->getObservaciones();
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
		$keys = FaltaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEvaluacionId(),
			$keys[2] => $this->getAlumnoId(),
			$keys[3] => $this->getAsignaturaId(),
			$keys[4] => $this->getDia(),
			$keys[5] => $this->getHora(),
			$keys[6] => $this->getFecha(),
			$keys[7] => $this->getJustificado(),
			$keys[8] => $this->getObservaciones(),
			$keys[9] => $this->getActivo(),
			$keys[10] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FaltaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAlumnoId($value);
				break;
			case 3:
				$this->setAsignaturaId($value);
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
				$this->setJustificado($value);
				break;
			case 8:
				$this->setObservaciones($value);
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
		$keys = FaltaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEvaluacionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlumnoId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAsignaturaId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDia($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHora($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFecha($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setJustificado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setObservaciones($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setActivo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FaltaPeer::DATABASE_NAME);

		if ($this->isColumnModified(FaltaPeer::ID)) $criteria->add(FaltaPeer::ID, $this->id);
		if ($this->isColumnModified(FaltaPeer::EVALUACION_ID)) $criteria->add(FaltaPeer::EVALUACION_ID, $this->evaluacion_id);
		if ($this->isColumnModified(FaltaPeer::ALUMNO_ID)) $criteria->add(FaltaPeer::ALUMNO_ID, $this->alumno_id);
		if ($this->isColumnModified(FaltaPeer::ASIGNATURA_ID)) $criteria->add(FaltaPeer::ASIGNATURA_ID, $this->asignatura_id);
		if ($this->isColumnModified(FaltaPeer::DIA)) $criteria->add(FaltaPeer::DIA, $this->dia);
		if ($this->isColumnModified(FaltaPeer::HORA)) $criteria->add(FaltaPeer::HORA, $this->hora);
		if ($this->isColumnModified(FaltaPeer::FECHA)) $criteria->add(FaltaPeer::FECHA, $this->fecha);
		if ($this->isColumnModified(FaltaPeer::JUSTIFICADO)) $criteria->add(FaltaPeer::JUSTIFICADO, $this->justificado);
		if ($this->isColumnModified(FaltaPeer::OBSERVACIONES)) $criteria->add(FaltaPeer::OBSERVACIONES, $this->observaciones);
		if ($this->isColumnModified(FaltaPeer::ACTIVO)) $criteria->add(FaltaPeer::ACTIVO, $this->activo);
		if ($this->isColumnModified(FaltaPeer::UPDATED_AT)) $criteria->add(FaltaPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FaltaPeer::DATABASE_NAME);

		$criteria->add(FaltaPeer::ID, $this->id);

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

		$copyObj->setAlumnoId($this->alumno_id);

		$copyObj->setAsignaturaId($this->asignatura_id);

		$copyObj->setDia($this->dia);

		$copyObj->setHora($this->hora);

		$copyObj->setFecha($this->fecha);

		$copyObj->setJustificado($this->justificado);

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
			self::$peer = new FaltaPeer();
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

	
	public function setAlumno($v)
	{


		if ($v === null) {
			$this->setAlumnoId(NULL);
		} else {
			$this->setAlumnoId($v->getId());
		}


		$this->aAlumno = $v;
	}


	
	public function getAlumno($con = null)
	{
		if ($this->aAlumno === null && ($this->alumno_id !== null)) {
						include_once 'lib/model/om/BaseAlumnoPeer.php';

			$this->aAlumno = AlumnoPeer::retrieveByPK($this->alumno_id, $con);

			
		}
		return $this->aAlumno;
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

} 