app.controller("EditarContaSaidaCtrl", function ($scope, $http, $location, $window, $routeParams, $rootScope) {

	var carregaSaida = function(){
		var idcontaSaida = $routeParams.idcontaSaida;
		var idempresa = $rootScope.idempresa;
		//console.log(idcontaSaida+' - '+idempresa);
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaSaida.php?idcontaSaida="+idcontaSaida+"&idempresa="+idempresa).success(function(data){
			//console.log(data);
			$scope.saidas = data;
		});
	}

	carregaSaida();

	var carregaSubcategoriaSaida = function(){

		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaSubcategoriaEdicaoSaida.php").success(function(data){
			//console.log(data);
			$scope.subcategorias = data;
		});
	}

	carregaSubcategoriaSaida();

	var carregaContasSaida = function(){
		var idempresa = $rootScope.idempresa;
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaContasSaida.php?idempresa="+idempresa).success(function(data){
			//console.log(data);
			$scope.contasSaida = data;
		});
	}

	carregaContasSaida();

	$scope.salvarContaSaida = function(contaS){
		var idempresa = $rootScope.idempresa;
		contaS.idempresa = idempresa;

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/atualizaSaida.php", contaS).success(function(data){
			$scope.msgAtualizadaSucesso = data.msgAtualContaSucesso;
		});
	}

});

