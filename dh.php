<?php
	require_once 'autoload.php';

	function myDebug($item)
	{
		echo "<pre>";
		print_r($item);
		echo "</pre>";
	}

	$DH = new DigitalHouseManager;

	$DH->altaNuevoCurso('Fullstack', 20001, 3);
	$DH->altaNuevoCurso('Mobile', 20002, 2);
	$DH->altaNuevoCurso('UX', 20004, 4);

	$DH->altaProfesorTitular('Walter', 'White', 2727, 'Frontend');
	$DH->altaProfesorAdjunto('Jessi', 'Pinkman', 1524, 30);
	$DH->altaProfesorTitular('Marc', 'Antony', 1818, 'Frontend');
	$DH->altaProfesorAdjunto('Lorenzo', 'Lamas', 1685, 10);
	$DH->altaProfesorTitular('Pan', 'Dero', 3453, '.NET');

	echo $DH->altaNuevoAlumno('Romi', 'Lanesas', 28023);
	echo $DH->altaNuevoAlumno('Elsa', 'Pashito', 45678);
	echo $DH->altaNuevoAlumno('Yaki', 'Sieras', 23423);
	echo $DH->altaNuevoAlumno('Xime', 'Ciguieras', 12345);
	// Alta alumno con mismo código
	echo $DH->altaNuevoAlumno('Segunda Xime', 'Ciguieras', 12345) ?? '';
	echo "<br>================<br>";

	echo $DH->inscribirAlumno(28023, 20001);
	echo "<br>";
	echo $DH->inscribirAlumno(28023, 20001);
	echo "<br>";
	echo $DH->inscribirAlumno(12345, 20001);
	echo "<br>";
	echo $DH->inscribirAlumno(45678, 20001);
	echo "<br>================<br>";
	echo $DH->inscribirAlumno(45678, 20002);
	echo "<br>";
	echo $DH->inscribirAlumno(23423, 20002);
	echo "<br>";
	echo $DH->inscribirAlumno(12345, 20002);
	echo "<br>================<br>";
	echo $DH->inscribirAlumno(1234554444, 20002);
	echo "<br>";
	echo $DH->inscribirAlumno(12345, 2000244444);
	echo "<br>";
	echo $DH->inscribirAlumno(12345234, 90223423504);
	echo "<br>================<br>";

	$DH->asignarProfesores(20001, 2727, 1524);
	$DH->asignarProfesores(20002, 1818, 1685);
	echo !$DH->bajaCurso(20004) ? 'No hay curso con ese código' : '';
	echo !$DH->bajaProfesor(3453) ? 'No hay profesor con ese código' : '';

	$cursoABuscar = $DH->getCursoPorCodigo(20001);
	$alumnoQueSeBusca = $DH->getAlumnoPorCodigo(28023);
	$cursoABuscar->eliminarAlumno($alumnoQueSeBusca);

	$otroAlumnoQueSeBusca = $DH->getAlumnoPorCodigo(45678);

	// myDebug($DH);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php foreach ($DH->getListadoCursos() as $curso): ?>
			<h1><?php echo $curso->getNombreCurso() . ' - cod: ' . $curso->getCodigoCurso(); ?></h1>
			<h2>Cupo máximo: <?php echo $curso->getCupoMaximoAlumnos() ?></h2>
			<h3>Profesores</h3>
			<p><b>Titular:</b> <?php echo $curso->getProfesorTitular()->getNombre() . ' ' . $curso->getProfesorTitular()->getApellido() ?></p>
			<p><b>Adjunto:</b> <?php echo $curso->getProfesorAdjunto()->getNombre() . ' ' . $curso->getProfesorAdjunto()->getApellido() ?></p>
			<ul>
				<?php foreach ($curso->getAlumnos() as $unAlumno): ?>
				<li><?php echo $unAlumno->getNombre() . ' ' . $unAlumno->getApellido() . ' - cod: ' . $unAlumno->getCodigo()?></li>
				<?php endforeach; ?>
			</ul>
			<b>Vacantes: <?php echo $curso->getCupoMaximoAlumnos() - count($curso->getAlumnos())  ?></b>
		<?php endforeach; ?>

		<hr>

		<h2><?php echo $otroAlumnoQueSeBusca->getNombre() . ' ' . $otroAlumnoQueSeBusca->getApellido(); ?></h2>
		<p>Inscripta a:</p>
		<ul>
			<?php foreach ($otroAlumnoQueSeBusca->getCursos() as $curso): ?>
			<li><?php echo $curso->getNombreCurso() . ' - cod: ' . $curso->getCodigoCurso(); ?></li>
			<?php endforeach; ?>
		</ul>
	</body>
</html>
