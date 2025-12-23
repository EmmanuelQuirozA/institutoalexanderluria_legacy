<?php
	include '../../../build/config.php';
  $counter=1;

  $inpText = $_POST['idRol'];
  $query = 'SELECT idPermiso,nombreRol,nombre,c,r,u,d FROM permisos INNER JOIN roles ON permisos.idRol=roles.idRol INNER JOIN modulos ON permisos.idModulo=modulos.idModulo WHERE permisos.idRol LIKE '.$_POST['idRol'];
  $sql = $connection->prepare($query);
  $sql->execute();
  $result = $sql->fetchAll();
  if ($result) {
    echo '
    <div class="row d-flex justify-content-center"> 
      <h3>Significado de cada una de las siglas</h3>
      <div class="form-group col-md-9 col-sm-6">
        <p class="text-md-left"><span class="font-weight-bold">C:</span> Create. Esto significa que el usuario podrá crear registros en la base de dátos del módulo.</p>
        <p class="text-md-left"><span class="font-weight-bold">R:</span> Read. Esto significa que el usuario podrá ver los registros de la base de dátos del módulo.</p>
        <p class="text-md-left"><span class="font-weight-bold">U:</span> Update. Esto significa que el usuario podrá modificar registros de la base de dátos del módulo.</p>
        <p class="text-md-left"><span class="font-weight-bold">D:</span> Delete. Esto significa que el usuario podrá eliminar registros de la base de dátos del módulo.</p>
      </div>
    </div>

    <table id="modulosPermisosTable" class=" table table-bordered  table-striped  nowrap"  cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>Módulo</th>
        <th>C <small>(Crear)</small></th>
        <th>R <small>(Ver)</small></th>
        <th>U <small>(Modificar)</small></th>
        <th>D <small>(Eliminar)</small></th>
      </tr>
      </thead>
      <tbody>
      ';
      foreach ($result as $row) {
      // echo $row['venta'];
      echo'
        <tr>
          <td>';echo $row['nombre']; echo '</td>
          <td>
            <div class="form-check">
            ';
              if ($row['c']==1) {
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_c" value="';echo $row['idPermiso']; echo '_c" checked>';
              }else{
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_c" value="';echo $row['idPermiso']; echo '_c">';
              }
              echo '
            </div>
          </td>
          <td>
            <div class="form-check">
            ';
              if ($row['r']==1) {
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_r" value="';echo $row['idPermiso']; echo '_r" checked>';
              }else{
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_r" value="';echo $row['idPermiso']; echo '_r">';
              }
              echo '
            </div>
          </td>
          <td>
            <div class="form-check">
            ';
              if ($row['u']==1) {
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_u" value="';echo $row['idPermiso']; echo '_u" checked>';
              }else{
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_u" value="';echo $row['idPermiso']; echo '_u">';
              }
              echo '
            </div>
          </td>
          <td>
            <div class="form-check">
            ';
              if ($row['d']==1) {
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_d" value="';echo $row['idPermiso']; echo '_d" checked>';
              }else{
                echo '<input class="form-check-input moduloPermiso" type="checkbox" id="';echo $row['idPermiso']; echo '_d" value="';echo $row['idPermiso']; echo '_d">';
              }
              echo '
            </div>
          </td>
        </tr>
      ';
      $counter++;
    }
    echo'
    </tbody>
  </table>
  ';
  }else{
    echo '
    <div class="col-md-6 card" style="padding: 5px; margin: 10px; margin-left: auto;margin-right: auto;">
      <div class="thumb-wrapper" style="width: 100%!important;">
        <div class="thumb-content">
          <h4>¡Este rol no tiene acceso a ningún módulo!</h4>
          <span>Por favor, agregue la relación con un módulo a este rol</span>
        </div>						
      </div>
    </div>
  ';
  }
?>