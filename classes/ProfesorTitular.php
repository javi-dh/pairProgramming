<?php

	class ProfesorTitular extends Profesor
	{
		protected $especialidad;

		public function getEspecialidad()
		{
			return $this->especialidad;
		}

		public function setEspecialidad($especialidad)
		{
			$this->especialidad = $especialidad;
		}
	}
