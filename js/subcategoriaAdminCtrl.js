app.controller("SubcategoriaAdminCtrl", function ($scope, $http, $location, $window) {

	$scope.subcategorias = [];
	$scope.subcategoria = {categoria: "", subcategoria: ""};

	$scope.salvarSubcategoria = function(subcategoria){

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/admin/subcategoriaAdmin.php', subcategoria).success(function(data){
			$scope.subcategoria = {categoria: "", subcategoria: ""};
			$scope.subcategorias = [];
			pegaSubcategorias();

		});

	}

	var pegaSubcategorias = function(){
		$http.get('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/admin/pegaSubcategoriasAdmin.php').success(function(data){
			$scope.subcategorias = data;
		});
	}

	pegaSubcategorias();

});