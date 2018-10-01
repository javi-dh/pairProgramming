<?php

	class DigitalHouseManager
	{

		private $listaAlumnos = [];
		private $listaProfesores = [];
		private $listaCursos = [];

		public function getListadoCursos(){
			return $this->listaCursos;
		}

		public function getListadoProfesores(){
			return $this->listaProfesores;
		}

		public function getListadoAlumnos(){
			return $this->listaAlumnos;
		}

		public function altaNuevoCurso(String $nombreCurso, Int $codigoCurso, Int $cupoMaximoDealumnos) {
			$nuevoCurso = new Curso($nombreCurso, $codigoCurso);
			$nuevoCurso->setCupoMaximoAlumnos($cupoMaximoDealumnos);

			$this->listaCursos[] = $nuevoCurso;
		}

		public function altaProfesorAdjunto(String $nombre, String $apellido, Int $codigoProfesor, Int $cantidadDeHoras)
		{
			$nuevoProfesorAdjunto = new ProfesorAdjunto($nombre, $apellido);
			$nuevoProfesorAdjunto->setCodigo($codigoProfesor);
			$nuevoProfesorAdjunto->setCantidadHoras($cantidadDeHoras);
			$nuevoProfesorAdjunto->setAntiguedad(0);

			$this->listaProfesores[] = $nuevoProfesorAdjunto;
		}

		public function altaProfesorTitular(String $nombre, String $apellido, Int $codigoProfesor, String $especialidad)
		{
			$nuevoProfesorTitular = new ProfesorTitular($nombre, $apellido);
			$nuevoProfesorTitular->setCodigo($codigoProfesor);
			$nuevoProfesorTitular->setEspecialidad($especialidad);
			$nuevoProfesorTitular->setAntiguedad(0);

			$this->listaProfesores[] = $nuevoProfesorTitular;
		}

		public function altaNuevoAlumno(String $nombre, String $apellido, Int $codigoAlumno)
		{
			if ( count($this->listaAlumnos) ) {
				foreach ($this->listaAlumnos as $alumno) {
					if ( $alumno->getCodigo() === $codigoAlumno ) {
						return 'Código de alumno ya existe';
					}
				}
				$nuevoAlumno = new Alumno($nombre, $apellido, $codigoAlumno);

				$this->listaAlumnos[] = $nuevoAlumno;
				return;
			}

			$nuevoAlumno = new Alumno($nombre, $apellido, $codigoAlumno);

			$this->listaAlumnos[] = $nuevoAlumno;
		}

		public function inscribirAlumno($codigoAlumno, $codigoCurso)
		{
			$elCurso = self::getCursoPorCodigo($codigoCurso);
			$elAlumno = self::getAlumnoPorCodigo($codigoAlumno);

			if ( $elCurso && $elAlumno ) {
				if ( count($elCurso->getAlumnos()) ) {
					foreach ( $elCurso->getAlumnos() as $alumno) {
						if ( $alumno->getCodigo() === $elAlumno->getCodigo() ) {
							return "El alumno {$elAlumno->getNombre()} {$elAlumno->getApellido()} ya está inscripto en el curso {$elCurso->getNombreCurso()}";
						} else {
							$ok = $elCurso->setNuevoAlumno($elAlumno);
							$elAlumno->setNuevoCurso($elCurso);
							return $ok ? "Alumno ({$elAlumno->getNombre()} {$elAlumno->getApellido()}) inscripto en el curso {$elCurso->getNombreCurso()}" : "No hay cupo para {$elCurso->getNombreCurso()}";
						}
					}
				} else {
					$elCurso->setNuevoAlumno($elAlumno);
					$elAlumno->setNuevoCurso($elCurso);
					return "1er. Alumno ({$elAlumno->getNombre()} {$elAlumno->getApellido()}) inscripto en el curso {$elCurso->getNombreCurso()}";
				}
			} elseif ( !$elCurso && !$elAlumno ) {
				return 'No existe el alumno ni el curso';
			} elseif ( !$elCurso ) {
				return 'No hay curso con ese código';
			} elseif ( !$elAlumno ) {
				return 'No existe el Alumno';
			}
		}

		public function asignarProfesores($codigoCurso, $codigoProfesorTitular, $codigoProfesorAdjunto)
		{
			$elCurso = self::getCursoPorCodigo($codigoCurso);
			$elProfesorTitular = false;
			$elProfesorAdjunto = false;

			foreach ($this->listaProfesores as $unProfesor) {
				if ( $unProfesor->getCodigo() === $codigoProfesorTitular ) {
					global $elProfesorTitular;
					$elProfesorTitular = $unProfesor;
				}
				if ( $unProfesor->getCodigo() === $codigoProfesorAdjunto ) {
					global $elProfesorAdjunto;
					$elProfesorAdjunto = $unProfesor;
				}
			}

			$elCurso->setProfesorTitular($elProfesorTitular);
			$elCurso->setProfesorAdjunto($elProfesorAdjunto);
		}

		public function bajaCurso($codigoCurso)
		{
			foreach ($this->listaCursos as $posicion => $unCurso) {
				if ( $unCurso->getCodigoCurso() === $codigoCurso ) {
					unset($this->listaCursos[$posicion]);
					return true;
				}
			}
			return false;
		}

		public function bajaProfesor($codigoProfesor)
		{
			foreach ($this->listaProfesores as $posicion => $unProfesor) {
				if ( $unProfesor->getCodigo() === $codigoProfesor ) {
					unset($this->listaProfesores[$posicion]);
					return true;
				}
			}
			return false;
		}

		public function getCursoPorCodigo($codigoCurso)
		{
			foreach ($this->listaCursos as $unCurso) {
				if ( $unCurso->getCodigoCurso() === $codigoCurso ) {
					return $unCurso;
				}
			}
			return false;
		}

		public function getAlumnoPorCodigo($codigoAlumno)
		{
			foreach ($this->listaAlumnos as $unAlumno) {
				if ( $unAlumno->getCodigo() === $codigoAlumno ) {
					return $unAlumno;
				}
			}
			return false;
		}
	}
