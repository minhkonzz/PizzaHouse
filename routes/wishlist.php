<?php 
   $router->get("/wishlist", "WishlistController@init")->applyMiddlewares("GET", "/wishlist", "AuthMiddleware");
?>