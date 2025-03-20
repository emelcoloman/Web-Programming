$(document).ready(function() {
  var app = $.spapp({ pageNotFound: 'error_404' }); // Initialize the app

  // Define routes
  app.route({
    view: 'home',
    load: "index.html"
  });
  app.route({ view: 'about', load: 'about.html' });
  app.route({ view: 'shop', load: 'shop.html' });
  app.route({ view: 'contact', load: 'contact.html' });

  // Run the app
  app.run();

  // Handle 'home' link click event to trigger home load
  $("#home-link").on("click", function(e) {
    e.preventDefault();
    window.location.hash = "#home"; // Change hash to home
  });
});
