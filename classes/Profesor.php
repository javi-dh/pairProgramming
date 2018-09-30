<?php

	abstract class Profesor extends Persona
	{
		protected $antiguedad;
		protected $codigo;

		public function getAntiguedad()
		{
			return $this->antiguedad;
		}

		public function setAntiguedad(Int $antiguedad)
		{
			$this->antiguedad = $antiguedad;
		}

		public function getCodigo()
		{
			return $this->codigo;
		}

		public function setCodigo(Int $codigo)
		{
			$this->codigo = $codigo;
		}
	}
