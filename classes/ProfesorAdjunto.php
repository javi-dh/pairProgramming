<?php

	class ProfesorAdjunto extends Profesor
	{
		protected $cantidadHoras;

		public function getCantidadHoras()
		{
			return $this->cantidadHoras;
		}

		public function setCantidadHoras(Int $cantidadHoras)
		{
			$this->cantidadHoras = $cantidadHoras;
		}
	}
