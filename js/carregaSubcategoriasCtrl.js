app.controller("CarregaSubcategoriasCtrl", function ($scope, $http, $window) {

	var idempresa = $window.localStorage.getItem('idemp');
	var empresa = $window.localStorage.getItem('empresa');
	var usuario = $window.localStorage.getItem('usuario');
	var idusuario = $window.localStorage.getItem('idusuario');

	$scope.empresa = empresa;
	$scope.usuario = usuario;

	//carrega dropdown para salvar conta
	var carregaSubcategoriaEntrada = function(){

		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaSubcategoriasEntrada.php").success(function(data){
			$scope.subcategoriasEntrada = data;
		});
	}

	carregaSubcategoriaEntrada();

	//carrega dropdown para salvar conta
	var carregaSubcategoriaSaida = function(){

		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaSubcategoriasSaida.php").success(function(data){
			$scope.subcategoriasSaida = data;
		});
	}

	carregaSubcategoriaSaida();

});


