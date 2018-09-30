<?php

	class Curso
	{
		protected $nombreCurso;
		protected $codigoCurso;
		protected $profesorTitular;
		protected $profesorAdjunto;
		protected $cupoMaximoAlumnos;
		protected $listadoAlumnos = [];

		public function __construct(String $nombreCurso, Int $codigoCurso)
		{
			$this->nombreCurso = $nombreCurso;
			$this->codigoCurso = $codigoCurso;
		}

		public function getNombreCurso()
		{
			return $this->nombreCurso;
		}

		public function setNombreCurso(String $nombreCurso)
		{
			$this->nombre = $nombreCurso;
		}

		public function getCodigoCurso()
		{
			return $this->codigoCurso;
		}

		public function setCodigoCurso(Int $codigoCurso)
		{
			$this->codigo = $codigoCurso;
		}

		public function getProfesorTitular()
		{
			return $this->profesorTitular;
		}

		public function setProfesorTitular(ProfesorTitular $profesorTitular)
		{
			$this->profesorTitular = $profesorTitular;
		}

		public function getProfesorAdjunto()
		{
			return $this->profesorAdjunto;
		}

		public function setProfesorAdjunto(ProfesorAdjunto $profesorAdjunto)
		{
			$this->profesorAdjunto = $profesorAdjunto;
		}

		public function getProfesores()
		{
			return $this->profesorTitular->getNombre() . ' y ' . $this->profesorAdjunto->getNombre();
		}

		public function setCupoMaximoAlumnos(Int $cupoMaximoAlumnos)
		{
			$this->cupoMaximoAlumnos = $cupoMaximoAlumnos;
		}

		public function getCupoMaximoAlumnos()
		{
			return $this->cupoMaximoAlumnos;
		}

		public function setNuevoAlumno(Alumno $nuevoAlumno)
		{
			if ( count($this->listadoAlumnos) < $this->cupoMaximoAlumnos ) {
				$this->listadoAlumnos[] = $nuevoAlumno;
				return true;
			}

			return false;
		}

		public function eliminarAlumno(Alumno $elAlumno)
		{
			foreach ($this->listadoAlumnos as $posicion => $alumno) {
				if ( $alumno->getCodigo() === $elAlumno->getCodigo() ) {
					unset($this->listadoAlumnos[$posicion]);
					return;
				}
			}
		}

		public function getAlumnos()
		{
			return $this->listadoAlumnos;
		}
	}
