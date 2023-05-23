<?php
include('connection.php')
  ?>
<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags-->
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <!-- Color theme for statusbar (Android only) -->
  <meta name="theme-color" content="#2196f3">
  <!-- Your app title -->
  <title>My App</title>
  <!-- Enlace a la biblioteca jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Path to Framework7 Library Bundle CSS -->
  <link rel="stylesheet" href="node_modules\framework7\framework7-bundle.min.css">
  <!-- Path to your custom app styles-->
  <link rel="stylesheet" href="css\estilos.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script type="text/javascript" src="js\app.js"></script>

  <style>

  </style>
</head>

<body>
  <!-- App root element -->
  <div id="app">
    <!-- Menu lateral -->
    <div class="panel panel-left fondo-panel">
      <div>
        <img src="images/logoapp.png" class="external">
      </div>
      <div class="list" style="margin-top: 0;">
        <ul>
        <li><a href="home.php" class="item-link item-content external" style="margin-top: 0;">INICIO<i class="material-icons icono">home</i></a></li>
          <li><a href="hacerpedidos.php" class="item-link item-content external">HACER PEDIDO<i class="material-icons icono">shopping_cart</i></a></li>
          <li><a href="registropedidos.php" class="item-link item-content external">REGISTRO PEDIDOS<i class="material-icons icono">receipt</i></a></li>
          <li><a href="distribuidores.php" class="item-link item-content external">DISTRIBUIDORES<i class="material-icons icono">contact_mail</i></a></li>
          <li><a href="hacercaja.php" class="item-link item-content external">HACER CAJA<i class="material-icons icono">euro</i></a></li>
          <li><a href="registrocaja.php" class="item-link item-content external">REGISTRO CAJAS<i class="material-icons icono">list_alt</i></a></li>
        </ul>
      </div>
      <div>
        <img src="images/letraslic.png" class="external" style="position: absolute; bottom: 0;">
      </div>
    </div>

    <!-- Your main view, should have "view-main" class -->
    <div class="view view-main">
      <!-- Initial Page, "data-name" contains page name -->
      <div data-name="home" class="page">

        <!-- Top Navbar -->
        <div class="navbar">
          <div class="navbar-bg"></div>

          <div class="navbar-inner">
            <div class="left">
              <a href="#" class="link panel-open" data-panel="left" data-panel-id="panel-menu">
                <span class="material-symbols-outlined">
                  menu
                </span>
              </a>

            </div>
            <div class="title">
              <img src="images/letraslic.png" class="external img1">
            </div>
          </div>
        </div>

        <!-- BOTONES DE ABAJO -->
        <div class="toolbar toolbar-bottom">
          <div class="toolbar-inner pie">
            <!-- Toolbar links -->
            <a href="home.php" class="item-link item-content external">
              <i class="material-icons icono">home</i>
            </a>
            <a href="hacerpedidos.php" class="item-link item-content external">
              <i class="material-icons icono">shopping_cart</i>
            </a>

            <a href="distribuidores.php" class="item-link item-content external">
              <i class="material-icons icono">contact_mail</i>
            </a>
            <a href="hacercaja.php" class="item-link item-content external">
              <i class="material-icons icono">euro</i>
            </a>
            <a href="registrocaja.php" class="item-link item-content external">
              <i class="material-icons icono">list_alt</i>
            </a>
          </div>
        </div>

        <!-- METER LO DE LAS CATEGORÍAS AQUI -->
        <div class="page-content">
          <form method="POST" action="pedido.php">
            <div class="block-title">CATEGORÍAS</div>
            <div class="list list-strong list-outline-ios list-dividers-ios inset-md accordion-list desplegable">
              <ul>

                <li class="accordion-item">
                  <a class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title">RON</div>
                    </div>
                  </a>
                  <div class="accordion-item-content">
                    <div class="block">
                      <!-- Aquí se muestra una tabla con los productos -->
                      <table id="" class="display table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          require("connection.php");
                          // Se hace una consulta a la base de datos para obtener los productos
                          $sql = $pdo->prepare("SELECT * FROM productos WHERE categoria_id = ?");
                          $sql->execute([1]);


                          while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            // Convierte los datos BLOB en una URL de imagen
                            $imagen_url = 'data:image/png;base64,' . base64_encode($resultado['imagen']);

                            // Muestra la imagen en una etiqueta <img>
                            echo '<td><div><img src="' . $imagen_url . '" style="background-color: transparent;"></div></td>';
                            echo '<td><div>' . $resultado['nombre'] . '</div></td>';
                            echo '<td><div>' . $resultado['precio'] . '</div></td>';


                            // Agregar formulario para añadir al carrito de compra
                            echo '<td>';
                            // Agregar el campo de entrada oculto solo si la cantidad es mayor que cero
                            echo '<input type="hidden" name="producto_id[]" value="' . $resultado['producto_id'] . '">';
                            echo '<div class="list">';
                            echo '<ul>';
                            echo '<li class="item-content item-input">';
                            echo '<div class="item-inner">';
                            echo '<div class="item-input-wrap">';
                            echo '<select name="cantidad[]">';
                            for ($i = 0; $i <= 10; $i++) {
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';

                            echo '</tr>';
                          }

                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </li>

                <li class="accordion-item">
                  <a class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title">GINEBRA</div>
                    </div>
                  </a>
                  <div class="accordion-item-content">
                    <div class="block">
                      <!-- Aquí se muestra una tabla con los productos -->
                      <table id="" class="display table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          require("connection.php");
                          // Se hace una consulta a la base de datos para obtener los productos
                          $sql = $pdo->prepare("SELECT * FROM productos WHERE categoria_id = ?");
                          $sql->execute([2]);


                          while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            // Convierte los datos BLOB en una URL de imagen
                            $imagen_url = 'data:image/png;base64,' . base64_encode($resultado['imagen']);

                            // Muestra la imagen en una etiqueta <img>
                            echo '<td><div><img src="' . $imagen_url . '" style="background-color: transparent;"></div></td>';
                            echo '<td><div>' . $resultado['nombre'] . '</div></td>';
                            echo '<td><div>' . $resultado['precio'] . '</div></td>';


                            // Agregar formulario para añadir al carrito de compra
                            echo '<td>';
                            echo '<input type="hidden" name="producto_id[]" value="' . $resultado['producto_id'] . '">';
                            echo '<div class="list">';
                            echo '<ul>';
                            echo '<li class="item-content item-input">';
                            echo '<div class="item-inner">';
                            echo '<div class="item-input-wrap">';
                            echo '<select name="cantidad[]">';
                            for ($i = 0; $i <= 10; $i++) {
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                            echo '</div>';
                            //echo '</form>';
                            echo '</div>';
                            echo '</td>';

                            echo '</tr>';
                          }

                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </li>

                <li class="accordion-item">
                  <a class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title">WHISKY</div>
                    </div>
                  </a>
                  <div class="accordion-item-content">
                    <div class="block">
                      <!-- Aquí se muestra una tabla con los productos -->
                      <table id="" class="display table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          require("connection.php");
                          // Se hace una consulta a la base de datos para obtener los productos
                          $sql = $pdo->prepare("SELECT * FROM productos WHERE categoria_id = ?");
                          $sql->execute([3]);


                          while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            // Convierte los datos BLOB en una URL de imagen
                            $imagen_url = 'data:image/png;base64,' . base64_encode($resultado['imagen']);

                            // Muestra la imagen en una etiqueta <img>
                            echo '<td><div><img src="' . $imagen_url . '" style="background-color: transparent;"></div></td>';
                            echo '<td><div>' . $resultado['nombre'] . '</div></td>';
                            echo '<td><div>' . $resultado['precio'] . '</div></td>';


                            // Agregar formulario para añadir al carrito de compra
                            echo '<td>';
                            echo '<input type="hidden" name="producto_id[]" value="' . $resultado['producto_id'] . '">';
                            echo '<div class="list">';
                            echo '<ul>';
                            echo '<li class="item-content item-input">';
                            echo '<div class="item-inner">';
                            echo '<div class="item-input-wrap">';
                            echo '<select name="cantidad[]">';
                            for ($i = 0; $i <= 10; $i++) {
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                            echo '</div>';
                            //echo '</form>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                          }

                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </li>

                <li class="accordion-item">
                  <a class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title">LICORES</div>
                    </div>
                  </a>
                  <div class="accordion-item-content">
                    <div class="block">
                      <!-- Aquí se muestra una tabla con los productos -->
                      <table id="" class="display table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          require("connection.php");
                          // Se hace una consulta a la base de datos para obtener los productos
                          $sql = $pdo->prepare("SELECT * FROM productos WHERE categoria_id = ?");
                          $sql->execute([4]);


                          while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            // Convierte los datos BLOB en una URL de imagen
                            $imagen_url = 'data:image/png;base64,' . base64_encode($resultado['imagen']);

                            // Muestra la imagen en una etiqueta <img>
                            echo '<td><div><img src="' . $imagen_url . '" style="background-color: transparent;"></div></td>';
                            echo '<td><div>' . $resultado['nombre'] . '</div></td>';
                            echo '<td><div>' . $resultado['precio'] . '</div></td>';


                            // Agregar formulario para añadir al carrito de compra
                            echo '<td>';
                            echo '<input type="hidden" name="producto_id[]" value="' . $resultado['producto_id'] . '">';
                            echo '<div class="list">';
                            echo '<ul>';
                            echo '<li class="item-content item-input">';
                            echo '<div class="item-inner">';
                            echo '<div class="item-input-wrap">';
                            echo '<select name="cantidad[]">';
                            for ($i = 0; $i <= 10; $i++) {
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                            echo '</div>';
                            //echo '</form>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                          }

                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </li>

                <li class="accordion-item">
                  <a class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title">REFRESCOS</div>
                    </div>
                  </a>
                  <div class="accordion-item-content">
                    <div class="block">
                      <!-- Aquí se muestra una tabla con los productos -->
                      <table id="" class="display table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          require("connection.php");
                          // Se hace una consulta a la base de datos para obtener los productos
                          $sql = $pdo->prepare("SELECT * FROM productos WHERE categoria_id = ?");
                          $sql->execute([5]);


                          while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            // Convierte los datos BLOB en una URL de imagen
                            $imagen_url = 'data:image/png;base64,' . base64_encode($resultado['imagen']);

                            // Muestra la imagen en una etiqueta <img>
                            echo '<td><div><img src="' . $imagen_url . '" style="background-color: transparent;"></div></td>';
                            echo '<td><div>' . $resultado['nombre'] . '</div></td>';
                            echo '<td><div>' . $resultado['precio'] . '</div></td>';


                            // Agregar formulario para añadir al carrito de compra
                            echo '<td>';
                            echo '<input type="hidden" name="producto_id[]" value="' . $resultado['producto_id'] . '">';
                            echo '<div class="list">';
                            echo '<ul>';
                            echo '<li class="item-content item-input">';
                            echo '<div class="item-inner">';
                            echo '<div class="item-input-wrap">';
                            echo '<select name="cantidad[]">';
                            for ($i = 0; $i <= 10; $i++) {
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                            echo '</div>';
                            //echo '</form>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                          }

                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </li>

                <li class="accordion-item">
                  <a class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title">CERVEZAS / VINO</div>
                    </div>
                  </a>
                  <div class="accordion-item-content">
                    <div class="block">
                      <!-- Aquí se muestra una tabla con los productos -->
                      <table id="" class="display table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          require("connection.php");
                          // Se hace una consulta a la base de datos para obtener los productos
                          $sql = $pdo->prepare("SELECT * FROM productos WHERE categoria_id = ?");
                          $sql->execute([6]);


                          while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            // Convierte los datos BLOB en una URL de imagen
                            $imagen_url = 'data:image/png;base64,' . base64_encode($resultado['imagen']);

                            // Muestra la imagen en una etiqueta <img>
                            echo '<td><div><img src="' . $imagen_url . '" style="background-color: transparent;"></div></td>';
                            echo '<td><div>' . $resultado['nombre'] . '</div></td>';
                            echo '<td><div>' . $resultado['precio'] . '</div></td>';


                            // Agregar formulario para añadir al carrito de compra
                            echo '<td>';
                            echo '<input type="hidden" name="producto_id[]" value="' . $resultado['producto_id'] . '">';
                            echo '<div class="list">';
                            echo '<ul>';
                            echo '<li class="item-content item-input">';
                            echo '<div class="item-inner">';
                            echo '<div class="item-input-wrap">';
                            echo '<select name="cantidad[]">';
                            for ($i = 0; $i <= 10; $i++) {
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                            echo '</div>';
                            //echo '</form>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                          }

                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </li>
            </div>
            <button class="button button-fill button-round custom-color">Añadir al carrito</button>
          </form>
        </div>

      </div>

      <!-- Path to Framework7 Library Bundle JS-->
      <script type="text/javascript" src="node_modules\framework7\framework7-bundle.min.js"></script>
      <!-- Path to your app js-->
      <script type="text/javascript" src="js\app.js"></script>


</body>

</html>