app.controller("EntradaCtrl", function ($scope, $http, $location, $window, $rootScope) {
// Esse controller busca as subcategorias de entrada para adicionar conta (não admin)

	var idempresa = $rootScope.idempresa;
	var idusuario = $rootScope.idusuario;

	var carregaSubcategoriaEntrada = function(){
		//console.log(idempresa);
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaSubcategoriasEntrada.php").success(function(data){
			$scope.subcategoriasEntrada = data;
		});
	}

	carregaSubcategoriaEntrada();

	var carregaContaEntrada =  function(){
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaContasEntrada.php?idempresa="+idempresa).success(function(data){
			//console.log(data);
			$scope.contasEntradas = data;
		});
	}

	carregaContaEntrada();




	$scope.conta = {};
	$scope.salvarEntrada = function(conta){
		conta.idempresa = idempresa;
		//console.log(conta);

		if(conta.data == undefined){
			var dia = moment().format(); //2016-02-16 T 16:05:52-02:00
			conta.data = dia;
		}

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/salvarEntrada.php", conta).success(function(data){
			//console.log(data);
			$scope.conta = {};
			exibeEntrada();
		});

	}

	var exibeEntrada = function(){
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/exibeEntrada.php?idempresa="+idempresa).success(function(data){
			//console.log(data);
			$scope.entradas = data;
			valorTotalEntrada();
		})
	}

	exibeEntrada();

	var valorTotalEntrada =  function(){
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/valorTotalEntrada.php?idempresa="+idempresa).success(function(data){
			$scope.valorTotalEntrada = data.valorTotalEntrada;
		})
	}

	valorTotalEntrada();

});