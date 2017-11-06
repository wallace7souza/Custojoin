app.controller("EditarContaEntradaCtrl", function ($scope, $http, $location, $window, $routeParams, $rootScope) {

	//PARA CARREGAR O DROPDOWN SUBCATEGORIA DA TELA DE EDIÇÃO DA CONTA DE ENTRADA
	var pegaSubcategoriaEntrada = function(){
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaSubcategoriasEntrada.php").success(function(data){
			//console.log(data);
			$scope.subcategorias = data;
		});
	}

	pegaSubcategoriaEntrada();

	//PARA CARREGAR O DROPDOWN CONTAS ENTRADA DA TELA DE EDIÇÃO DA CONTA DE ENTRADA
	var carregaContasEntrada = function(){
		var idempresa = $rootScope.idempresa;
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaContasEntrada.php?idempresa="+idempresa).success(function(data){
			//console.log(data);
			$scope.contasEntrada = data;
		});
	}

	carregaContasEntrada();




	var carregaEntrada = function(conta){
		var idcontaEntrada = $routeParams.idcontaEntrada;
		var idempresa = $rootScope.idempresa;

		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaEntrada.php?idempresa="+idempresa+"&idcontaEntrada="+idcontaEntrada).success(function(data){
			//console.log(data);
			$scope.entradas = data;
		});
	}

	carregaEntrada();

	$scope.salvarContaEditada = function(editarConta){

		var idempresa = $rootScope.idempresa;
		editarConta.idempresa = idempresa;
		//console.log(editarConta);

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/atualizaEntrada.php", editarConta).success(function(data){
			//console.log(data);
			$scope.msgSucesso = data.msgSucesso;
		});
	}
});