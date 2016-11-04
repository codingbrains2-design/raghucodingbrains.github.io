app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	.when('/', {
		templateUrl: 'app/view/index.html',
		//controller: 'HomeController'	  
	})
	// .when('/account', {
	// 	templateUrl: 'app/view/index.html',
	// 	//controller: 'HomeController'	  
	// })
	// .when('/whishlist', {
	// 	templateUrl: 'app/view/index.html',
	// 	//controller: 'HomeController'	  
	// })
	.when('/checkout', {
		templateUrl: 'app/view/checkout.html',
		//controller: 'HomeController'	  
	})
	.when('/cart', {
		templateUrl: 'app/view/cart.html',
		//controller: 'HomeController'	  
	})
	.when('/login', {
		templateUrl: 'app/view/login.html',
		//controller: 'HomeController'	  
	})
	;

  // configure html5 to get links working on jsfiddle
  //$locationProvider.html5Mode(true);
});