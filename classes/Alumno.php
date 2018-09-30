<?php

	class Alumno extends Persona
	{
		protected $codigo;
		protected $cursos = [];

		public function __construct(String $nombre, String $apellido, Int $codigo)
		{
			parent::__construct($nombre, $apellido);
			$this->codigo = $codigo;
		}

		public function getCodigo()
		{
			return $this->codigo;
		}

		public function setCodigo(Int $codigo)
		{
			$this->codigo = $codigo;
		}

		public function setNuevoCurso(Curso $curso)
		{
			$this->cursos[] = $curso;
		}

		public function getCursos()
		{
			return $this->cursos;
		}
	}
