<?php 
  date_default_timezone_set('America/Mexico_City');
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    //If user doesn't have the correct credentials, the session is destroyed and goes to the main page
    header('Location: ../index.html');
    session_destroy();
    exit;
  } else {
    // Show users the page!
    include_once "../build/config.php";
  }
  $cGrupos=$rGrupos=$uGrupos=$dGrupos=0;

  $cMaterias=$rMaterias=$uMaterias=$dMaterias=0;

  $cCocina=$rCocina=$uCocina=$dCocina=0;

  $cInicio=$rInicio=$uInicio=$dInicio=0;

  $cConfig=$rConfig=$uConfig=$dConfig=0;

  $cUsuarios=$rUsuarios=$uUsuarios=$dUsuarios=0;

  $cTrabajadores=$rTrabajadores=$uTrabajadores=$dTrabajadores=0;

  $cAlumnos=$rAlumnos=$uAlumnos=$dAlumnos=0;

  $cTutores=$rTutores=$uTutores=$dTutores=0;

  $cReportesFinancieros=$rReportesFinancieros=$uReportesFinancieros=$dReportesFinancieros=0;

  $cEgresos=$rEgresos=$uEgresos=$dEgresos=0;
  
  $cCalificaciones=$rCalificaciones=$uCalificaciones=$dCalificaciones=0;

  $cTareas=$rTareas=$uTareas=$dTareas=0;

  $cNotasAdmin=$rNotasAdmin=$uNotasAdmin=$dNotasAdmin=0;

  $cNotasAlumnos=$rNotasAlumnos=$uNotasAlumnos=$dNotasAlumnos=0;
  
  $cInventario=$rInventario=$uInventario=$dInventario=0;
  
  $cMaterialEducativo=$rMaterialEducativo=$uMaterialEducativo=$dMaterialEducativo=0;
  

  try{
    $sqlselect="SELECT c,r,u,d,nombre FROM roles INNER JOIN permisos ON roles.idRol=permisos.idRol INNER JOIN modulos ON permisos.idModulo=modulos.idModulo WHERE roles.idRol = ".$_SESSION['idRol'];
    $stmtselect=$connection->prepare($sqlselect);
    $stmtselect->execute();
    $results=$stmtselect->fetchAll();
    
    foreach ($results as $output){
      if($output["nombre"]=="Configuración"){
        $cConfig=$output["c"];
        $rConfig=$output["r"];
        $uConfig=$output["u"];
        $dConfig=$output["d"];
      }elseif ($output["nombre"]=="Usuarios") {
        $cUsuarios=$output["c"];
        $rUsuarios=$output["r"];
        $uUsuarios=$output["u"];
        $dUsuarios=$output["d"];
      }elseif ($output["nombre"]=="Trabajadores") {
        $cTrabajadores=$output["c"];
        $rTrabajadores=$output["r"];
        $uTrabajadores=$output["u"];
        $dTrabajadores=$output["d"];
      }elseif ($output["nombre"]=="Alumnos") {
        $cAlumnos=$output["c"];
        $rAlumnos=$output["r"];
        $uAlumnos=$output["u"];
        $dAlumnos=$output["d"];
      }elseif ($output["nombre"]=="Tutores") {
        $cTutores=$output["c"];
        $rTutores=$output["r"];
        $uTutores=$output["u"];
        $dTutores=$output["d"];
      }elseif ($output["nombre"]=="Reportes Financieros") {
        $cReportesFinancieros=$output["c"];
        $rReportesFinancieros=$output["r"];
        $uReportesFinancieros=$output["u"];
        $dReportesFinancieros=$output["d"];
      }elseif ($output["nombre"]=="Inicio") {
        $cInicio=$output["c"];
        $rInicio=$output["r"];
        $uInicio=$output["u"];
        $dInicio=$output["d"];
      }elseif ($output["nombre"]=="Egresos") {
        $cEgresos=$output["c"];
        $rEgresos=$output["r"];
        $uEgresos=$output["u"];
        $dEgresos=$output["d"];
      }elseif ($output["nombre"]=="Cocina") {
        $cCocina=$output["c"];
        $rCocina=$output["r"];
        $uCocina=$output["u"];
        $dCocina=$output["d"];
      }elseif ($output["nombre"]=="Materias") {
        $cMaterias=$output["c"];
        $rMaterias=$output["r"];
        $uMaterias=$output["u"];
        $dMaterias=$output["d"];
      }elseif ($output["nombre"]=="Grupos") {
        $cGrupos=$output["c"];
        $rGrupos=$output["r"];
        $uGrupos=$output["u"];
        $dGrupos=$output["d"];
      }elseif ($output["nombre"]=="Calificaciones") {
        $cCalificaciones=$output["c"];
        $rCalificaciones=$output["r"];
        $uCalificaciones=$output["u"];
        $dCalificaciones=$output["d"];
      }elseif ($output["nombre"]=="Tareas") {
        $cTareas=$output["c"];
        $rTareas=$output["r"];
        $uTareas=$output["u"];
        $dTareas=$output["d"];
      }elseif ($output["nombre"]=="Notas A Docentes") {
        $cNotasAdmin=$output["c"];
        $rNotasAdmin=$output["r"];
        $uNotasAdmin=$output["u"];
        $dNotasAdmin=$output["d"];
      }elseif ($output["nombre"]=="Notas A Alumnos") {
        $cNotasAlumnos=$output["c"];
        $rNotasAlumnos=$output["r"];
        $uNotasAlumnos=$output["u"];
        $dNotasAlumnos=$output["d"];
      }elseif ($output["nombre"]=="Inventario") {
        $cInventario=$output["c"];
        $rInventario=$output["r"];
        $uInventario=$output["u"];
        $dInventario=$output["d"];
      }elseif ($output["nombre"]=="Material Educativo") {
        $cMaterialEducativo=$output["c"];
        $rMaterialEducativo=$output["r"];
        $uMaterialEducativo=$output["u"];
        $dMaterialEducativo=$output["d"];
      }
      
    }
    if ($rInicio!=1) {
      echo '
    <section class="home-section" >
      <div class="home-content">
        <i class="bx bx-menu" ></i>
      </div>
      <div class="col-md-6 card" style="margin-left: auto;margin-right: auto;">
        <div class="thumb-wrapper">
          <div class="thumb-content">
            <h4>¡No tienes permisos para ver esta página :( !</h4>
            <span>Por favor, contacta a tu administrador para más información</span>
          </div>						
        </div>
      </div>
    </section>';
    header('Location: ../index.html');
    session_destroy();
    exit;
    }
  }
  catch(Exception $ex){
      echo($ex -> getMessage());
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IAL | <?php echo $nombrePagina?></title>
    <link rel="icon" href="../src/img/logo.ico" type="image/png" />

    <!-- sweetAlert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.all.min.js" integrity="sha512-SFaxUL267Y1wH3eelsqXwDXir/ebciCMRmmqlbwnSKhQH8hmnqIbUm8FKiYWQ+8jcnagOColZIaQuhdZYUhcPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- bootstrap-datatables -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css"/> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Switchery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css" integrity="sha512-zKvhCkM8b3JMULax/MlTkNk4gQwMbY8CqpDQC74/n7H6UK3HOZA/mO/fvjhVlh0V/E6PCrp4U6Lw6pnueS9HCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- PNotify -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/attempt-to-update-packagist/pnotify.min.css" integrity="sha512-/odx7DzBB1VWp8CF129ic9JIUkR8Lv32iJcGeugeJ6JyeYwdUKtlYAs579Bg1EOtKnuFPyMYF/kFkc06YlBXLw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/attempt-to-update-packagist/pnotify.buttons.min.css" integrity="sha512-swjSypf3sg74W5zzlIwlQoz1pvVvvMUpCpqPQGiKmHLUPARPzxz5kV8Z6eMX5ZhXD/tRVnZDhBk4YItvS+GDXw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <!-- Google charts Link -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<link rel="stylesheet" href="https://fullcalendar.io/releases/fullcalendar/3.10.0/fullcalendar.min.css" />

   </head>
   
<body class="nav-md">
    
  <div class="sidebar close">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <img class="logo_img" src="../src/img/logo_big.png" alt="">
      <span class="logo_name">Sistema IAL</span>
    </div>
    <ul class="nav-links">
      <?php if ($rInicio==1) { echo'
      <li>
        <a href="index.php">
          <i class="bx bx-grid-alt" data-toggle="tooltip" data-placement="right" title="Inicio"></i>
          <span class="link_name">Inicio</span>
        </a>
      </li>
      ';} ?>

      <li>
        <div class="profile-details"style="margin-left: -15px;">
          <div class="profile-content">
            <!--<img src="image/profile.jpg" alt="profileImg">-->
          </div>
          <div class="name-job">
            <div class="profile_name"><?php echo $_SESSION['nombre']?></div>
            <div class="job"><?php echo $_SESSION['nombreRol']?></div>
          </div>
          <a href="../build/logout.php">
            <i class='bx bx-log-out' ></i>
          </a>
        </div>
      </li>
    </ul>
  </div>