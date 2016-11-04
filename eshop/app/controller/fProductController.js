function fProductController($scope, $http) {
	$scope.products= [];
	$http.get('products.json').success(function(data) { 
		$scope.products = data;
	});    
}