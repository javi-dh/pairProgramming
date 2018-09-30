<?php

	abstract class Persona
	{
		private $nombre;
		private $apellido;

		public function __construct(String $nombre, String $apellido)
		{
			$this->nombre = $nombre;
			$this->apellido = $apellido;
		}

		public function getNombre()
		{
			return $this->nombre;
		}

		public function setNombre(String $nombre)
		{
			$this->nombre = $nombre;
		}

		public function getApellido()
		{
			return $this->apellido;
		}

		public function setApellido(String $apellido)
		{
			$this->apellido = $apellido;
		}
	}
