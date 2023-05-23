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
  <!-- Path to Framework7 Library Bundle CSS -->
  <link rel="stylesheet" href="node_modules\framework7\framework7-bundle.min.css">
  <!-- Path to your custom app styles-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="css\estilos.css">
  <!-- Incluir jQuery desde un CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Incluir DataTables desde un CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>


  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
          <li><a href="home.php" class="item-link item-content external" style="margin-top: 0;">INICIO<i
                class="material-icons icono">home</i></a></li>
          <li><a href="hacerpedidos.php" class="item-link item-content external">HACER PEDIDO<i
                class="material-icons icono">shopping_cart</i></a></li>
          <li><a href="registropedidos.php" class="item-link item-content external">REGISTRO PEDIDOS<i
                class="material-icons icono">receipt</i></a></li>
          <li><a href="distribuidores.php" class="item-link item-content external">DISTRIBUIDORES<i
                class="material-icons icono">contact_mail</i></a></li>
          <li><a href="hacercaja.php" class="item-link item-content external">HACER CAJA<i
                class="material-icons icono">euro</i></a></li>
          <li><a href="registrocaja.php" class="item-link item-content external">REGISTRO CAJAS<i
                class="material-icons icono">list_alt</i></a></li>
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

        <!-- Scrollable page content -->
        <div class="page-content">
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los valores de cantidad y producto_id
            $cantidades = $_POST['cantidad'];
            $producto_ids = $_POST['producto_id'];

            //print_r($cantidades);
            function obtenerNombreProductoPorId($producto_id)
            {
              // Establecer la conexión a la base de datos (reemplaza los valores con los tuyos)
              $dsn = 'mysql:host=localhost;dbname=nombre_base_de_datos;charset=utf8mb4';
              $usuario = 'nombre_usuario';
              $contraseña = 'contraseña';

              try {
                require("connection.php");

                // Realizar la consulta para obtener el nombre del producto
                $sql = 'SELECT nombre FROM productos WHERE producto_id = :producto_id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':producto_id', $producto_id, PDO::PARAM_INT);
                $stmt->execute();

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado) {
                  return $resultado['nombre'];
                } else {
                  return 'Nombre no encontrado';
                }
              } catch (PDOException $e) {
                // Manejar el error de conexión a la base de datos
                echo 'Error de conexión a la base de datos: ' . $e->getMessage();
              }
            }
            function obtenerPrecioProductoPorId($producto_id)
            {
              // Establecer la conexión a la base de datos (reemplaza los valores con los tuyos)
              $dsn = 'mysql:host=localhost;dbname=nombre_base_de_datos;charset=utf8mb4';
              $usuario = 'nombre_usuario';
              $contraseña = 'contraseña';

              try {
                require("connection.php");

                // Realizar la consulta para obtener el nombre del producto
                $sql = 'SELECT precio FROM productos WHERE producto_id = :producto_id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':producto_id', $producto_id, PDO::PARAM_INT);
                $stmt->execute();

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado) {
                  return $resultado['precio'];
                } else {
                  return 'Precio no encontrado';
                }


              } catch (PDOException $e) {
                // Manejar el error de conexión a la base de datos
                echo 'Error de conexión a la base de datos: ' . $e->getMessage();
              }
            }
            function obtenerDistribuidorIdPorProductoId($producto_id)
            {
              require("connection.php");

              $sql = $pdo->prepare("SELECT distribuidor_id FROM productos WHERE producto_id = ?");
              $sql->execute([$producto_id]);
              $resultado = $sql->fetch(PDO::FETCH_ASSOC);

              if ($resultado) {
                return $resultado['distribuidor_id'];
              }

              return null;
            }

            function obtenerNombreDistribuidorPorId($distribuidor_id)
            {
              require("connection.php");

              $sql = $pdo->prepare("SELECT nombre FROM distribuidores WHERE distribuidor_id = ?");
              $sql->execute([$distribuidor_id]);
              $resultado = $sql->fetch(PDO::FETCH_ASSOC);

              if ($resultado) {
                return $resultado['nombre'];
              }

              return 'Distribuidor Desconocido';
            }

            function obtenerPedidosDistribuidor($distribuidor_id)
            {
              require("connection.php");

              $sql = $pdo->prepare("SELECT pedido_id FROM pedidos WHERE distribuidor_id = ?");
              $sql->execute([$distribuidor_id]);
              $resultado = $sql->fetch(PDO::FETCH_ASSOC);

              if ($resultado) {
                return $resultado['pedido_id'];
              }

              return '0';
            }
            function obtenerUltimoPedidoDistribuidor($distribuidor_id)
            {
              require("connection.php");
              // Realizar la consulta SQL para obtener el último pedido del distribuidor
              $sql = "SELECT pedido_id FROM pedidos WHERE distribuidor_id = ? ORDER BY pedido_id DESC LIMIT 1";
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$distribuidor_id]);
              $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

              if ($resultado) {
                return $resultado['pedido_id'];
              } else {
                return null; // Si no hay pedidos existentes, retorna null
              }
            }
            function obtenerTotalPedido($pedido_id)
            {
              require("connection.php");
              // Realizar la consulta SQL para obtener el total del pedido
              $sql = "SELECT total FROM pedidos WHERE pedido_id = ?";
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$pedido_id]);
              $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

              if ($resultado) {
                return $resultado['total'];
              } else {
                return 0; // Si no se encuentra el pedido, retorna 0
              }
            }


            try {
              require("connection.php");
          
              // Filtrar los producto_id correspondientes a las cantidades mayores que cero
              $producto_ids_seleccionados = [];
              foreach ($producto_ids as $indice => $producto_id) {
                  $cantidad = $cantidades[$indice];
                  if ($cantidad > 0) {
                      $producto_ids_seleccionados[] = $producto_id;
                  }
              }
          
              // Almacenar los pedidos en la base de datos
              $totalPedidoPorDistribuidor = []; // Variable para almacenar el total del pedido por distribuidor
          
              foreach ($producto_ids_seleccionados as $producto_id) {
                  $indice = array_search($producto_id, $producto_ids);
          
                  $cantidad = $cantidades[$indice];
                  $subtotal = obtenerPrecioProductoPorId($producto_id) * $cantidad;
                  $distribuidor_id = obtenerDistribuidorIdPorProductoId($producto_id);
          
                  // Acumular el subtotal para el total del pedido del distribuidor
                  if (!isset($totalPedidoPorDistribuidor[$distribuidor_id])) {
                      $totalPedidoPorDistribuidor[$distribuidor_id] = 0;
                  }
                  $totalPedidoPorDistribuidor[$distribuidor_id] += $subtotal;
              }
          
              // Guardar los pedidos completos en la base de datos
              foreach ($totalPedidoPorDistribuidor as $distribuidor_id => $totalPedido) {
                  // Insertar un nuevo pedido completo en la tabla pedidos
                  $sqlGuardarPedidoCompleto = $pdo->prepare("INSERT INTO pedidos (total, distribuidor_id) VALUES (?, ?)");
                  $sqlGuardarPedidoCompleto->execute([$totalPedido, $distribuidor_id]);
                  $pedido_id = $pdo->lastInsertId();
          
                  // Guardar los detalles del producto en la base de datos
                  foreach ($producto_ids_seleccionados as $producto_id) {
                      $indice = array_search($producto_id, $producto_ids);
          
                      $cantidad = $cantidades[$indice];
                      $subtotal = obtenerPrecioProductoPorId($producto_id) * $cantidad;
                      $distribuidor_id_producto = obtenerDistribuidorIdPorProductoId($producto_id);
          
                      if ($distribuidor_id === $distribuidor_id_producto) {
                          $sqlGuardarPedido = $pdo->prepare("INSERT INTO lineas_pedidos (cantidad, subtotal, producto_id, distribuidor_id, pedido_id) VALUES (?, ?, ?, ?, ?)");
                          $sqlGuardarPedido->execute([$cantidad, $subtotal, $producto_id, $distribuidor_id, $pedido_id]);
                      }
                  }
              }
          
              echo "Pedidos almacenados correctamente en la base de datos.";
          } catch (PDOException $e) {
              // Manejar el error de conexión a la base de datos
              echo 'Error de conexión a la base de datos: ' . $e->getMessage();
          }
          
          
          
          

            // Mostrar los productos y calcular el total
            $pedidos_por_distribuidor = [];

            foreach ($producto_ids_seleccionados as $producto_id) {
              $indice = array_search($producto_id, $producto_ids);

              $cantidad = $cantidades[$indice];
              $nombre = obtenerNombreProductoPorId($producto_id);
              $precio = obtenerPrecioProductoPorId($producto_id);
              $subtotal = $cantidad * $precio;
              $distribuidor_id = obtenerDistribuidorIdPorProductoId($producto_id); // Obtener el ID del distribuidor por el ID del producto
              $distribuidor_nombre = obtenerNombreDistribuidorPorId($distribuidor_id); // Obtener el nombre del distribuidor por el ID del distribuidor
          
              if (!isset($pedidos_por_distribuidor[$distribuidor_nombre])) {
                $pedidos_por_distribuidor[$distribuidor_nombre] = [
                  'productos' => [],
                  'total' => 0
                ];
              }

              $pedidos_por_distribuidor[$distribuidor_nombre]['productos'][] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal
              ];

              $pedidos_por_distribuidor[$distribuidor_nombre]['total'] += $subtotal;
            }

            // Mostrar los pedidos por distribuidor
            foreach ($pedidos_por_distribuidor as $distribuidor_nombre => $pedido) {

              echo '<div class="text-align-center">';
              echo "<h2>$distribuidor_nombre</h2>";
              echo '</div>';
              echo '<div class="data-table">';
              echo '<table>';
              echo '<thead>';
              echo '<tr>';
              echo '<th class="label-cell" style="color: #D0BDA4; font-weight: bold;">Nombre</th>';
              echo '<th class="numeric-cell" style="color: #D0BDA4; font-weight: bold;">Cantidad</th>';
              echo '<th class="numeric-cell" style="color: #D0BDA4; font-weight: bold;">Precio</th>';
              echo '<th class="numeric-cell" style="color: #D0BDA4; font-weight: bold;">Subtotal</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
              foreach ($pedido['productos'] as $producto) {
                $nombre = $producto['nombre'];
                $cantidad = $producto['cantidad'];
                $precio = $producto['precio'];
                $subtotal = $producto['subtotal'];

                echo '<tr>';
                echo '<td class="label-cell">' . $nombre . '</td>';
                echo '<td class="numeric-cell">' . $cantidad . '</td>';
                echo '<td class="numeric-cell">' . $precio . '€</td>';
                echo '<td class="numeric-cell">' . $subtotal . '€</td>';
                echo '</tr>';
              }
              echo '</tbody>';
              echo '</table>';
              echo '</div>';
              echo '<div class="text-align-center">';
              echo '<h3>Total: ' . $pedido['total'] . '€</h3>';
              echo '</div>';

            }

          }





          ?>



        </div>
      </div>
    </div>
  </div>
  <!-- Path to Framework7 Library Bundle JS-->
  <script type="text/javascript" src="node_modules\framework7\framework7-bundle.min.js"></script>
  <!-- Path to your app js-->
  <script type="text/javascript" src="js\app.js"></script>
  <script>

  </script>



</body>

</html>