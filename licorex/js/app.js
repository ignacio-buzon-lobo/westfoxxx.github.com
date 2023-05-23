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

  var mainView = app.views.create('.view-main');

  document.getElementById("button1").style.backgroundImage = "url('amarillo.jpg')";
  document.getElementById("button2").style.backgroundImage = "url('azul.jpeg')";
  document.getElementById("button3").style.backgroundImage = "url('multi.jpeg')";
  document.getElementById("button4").style.backgroundImage = "url('imagen4.jpg')";
  document.getElementById("button5").style.backgroundImage = "url('imagen5.jpg')";
  