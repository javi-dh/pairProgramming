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

	$DH->altaProfesorAdjunto('Lorenzo', 'Lamas', 1524, 30);
	$DH->altaProfesorTitular('Marc', 'Antony', 2727, 'Frontend');
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
	echo !$DH->bajaCurso(20004) ? 'No hay curso con ese código' : '';
	echo !$DH->bajaProfesor(3453) ? 'No hay profesor con ese código' : '';

	$cursoQueSeBusca = $DH->getCursoPorCodigo(20001);
	$alumnoQueSeBusca = $DH->getAlumnoPorCodigo(28023);
	$cursoQueSeBusca->eliminarAlumno($alumnoQueSeBusca);

	$otroAlumnoQueSeBusca = $DH->getAlumnoPorCodigo(45678);

	foreach ($DH->getListadoCursos() as $curso) {
		if ($curso->getCodigoCurso() == 20001) {
			echo "{$curso->getNombreCurso()} - vacantes: " . ( $curso->getCupoMaximoAlumnos() - count($curso->getAlumnos()) ) . '<br>';
		}
		if ($curso->getCodigoCurso() == 20002) {
			echo "{$curso->getNombreCurso()} - vacantes: " . ( $curso->getCupoMaximoAlumnos() - count($curso->getAlumnos()) ) . '<br>';
		}
	}

	// myDebug($DH);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<h1><?php echo $cursoQueSeBusca->getNombreCurso() . ' - cod: ' . $cursoQueSeBusca->getCodigoCurso(); ?></h1>
		<h2>Cupo máximo: <?php echo $cursoQueSeBusca->getCupoMaximoAlumnos() ?></h2>
		<h3>Profesores</h3>
		<p><b>Titular:</b> <?php echo $cursoQueSeBusca->getProfesorTitular()->getNombre() . ' ' . $cursoQueSeBusca->getProfesorTitular()->getApellido() ?></p>
		<p><b>Adjunto:</b> <?php echo $cursoQueSeBusca->getProfesorAdjunto()->getNombre() . ' ' . $cursoQueSeBusca->getProfesorAdjunto()->getApellido() ?></p>
		<ul>
			<?php foreach ($cursoQueSeBusca->getAlumnos() as $unAlumno): ?>
			<li><?php echo $unAlumno->getNombre() . ' ' . $unAlumno->getApellido() . ' - cod: ' . $unAlumno->getCodigo()?></li>
			<?php endforeach; ?>
		</ul>
		<b>Vacantes: <?php echo $cursoQueSeBusca->getCupoMaximoAlumnos() - count($cursoQueSeBusca->getAlumnos())  ?></b>

		<hr>

		<h2><?php echo $otroAlumnoQueSeBusca->getNombre() . ' ' . $otroAlumnoQueSeBusca->getApellido(); ?></h2>
		<p>Inscripta a:</p>
		<ul>
			<?php foreach ($otroAlumnoQueSeBusca->getCursos() as $curso): ?>
			<li><?php echo $curso->getNombreCurso(); ?></li>
			<?php endforeach; ?>
		</ul>
	</body>
</html>
