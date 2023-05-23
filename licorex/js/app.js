var app = new Framework7({
    // App root element
    el: '#app',
    // App Name
    name: 'My App',
    // Enable swipe panel
    panel: {
      swipe: true,
    },
    // Add default routes
    routes: [
      {
        path: '/home/',
        url: 'home.html',
      },
      {
        path: '/pedidos/',
        url: 'hacerpedidos.html',
      },
    ],
    // ... other parameters
  });



// Función para obtener los productos de una categoría
function getProductos(categoriaId) {
  $.ajax({
    url: 'connection.php',
    type: 'GET',
    data: {categoriaId: categoriaId},
    dataType: 'json',
    success: function(data) {
      var productList = '';
      var template = $('#producto-template').html();
      $.each(data, function(index, producto) {
        var listItem = template
          .replace('{{nombre}}', producto.nombre)
          .replace('{{descripcion}}', producto.descripcion)
          .replace('{{precio}}', producto.precio);
        productList += listItem;
      });
      $('.productos-list').html(productList);
    },
    error: function(xhr, status, error) {
      console.log('Error al obtener los productos');
    }
  });
}

var stepper = app.stepper.create({
  el: '.stepper',
  value: 1,
  step: 1,
  min: 1,
  max: 10,
  formatValue: function (value) {
    return value.toString();
  }
});
//DataTable Cajas
var dt = app.dataTable.create({
  el: '.data-table',
  sortable: true,
  swipeout: true,
  // Ajusta las columnas a su contenido
  resizeCol: true,
  // Habilita la paginación
  pagination: {
    el: '.data-table-pagination',
  },
  // Habilita la búsqueda
  searchbar: {
    el: '.data-table-search',
  },
  // Realiza una petición AJAX para obtener los datos de la tabla cajas
  dataSource: function(done) {
    $$.ajax({
      method: 'GET',
      url: 'registrocaja.php',
      dataType: 'json',
      success: function(data) {
        done(data);
      },
      error: function(xhr, status) {
        console.log('Error al obtener los datos de la tabla cajas.');
      }
    });
  },
});

 // Manejar la presentación del carrito de compras
 var cart = [];

// Agregar un manejador de eventos a cada formulario para añadir al carrito
var forms = document.getElementsByClassName('add-to-cart-form');
for (var i = 0; i < forms.length; i++) {
  forms[i].addEventListener('submit', function(event) {
      event.preventDefault();
      var form = event.target;
      var formData = new FormData(form);
      var item = {
        id: formData.get('id'),
        cantidad: formData.get('cantidad')
      };
      cart.push(item);
      updateCartDisplay();
    });
  }

  // Actualizar la presentación del carrito de compras
  function updateCartDisplay() {
    var cartElement = document.getElementById('cart');
    cartElement.value = JSON.stringify(cart);
  }

  
  $(document).ready(function () {
    $('#productos-table').DataTable();
  });