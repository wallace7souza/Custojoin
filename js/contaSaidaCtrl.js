app.controller("ContaSaidaCtrl", function ($scope, $http, $location, $window, $rootScope) {

	var idempresa = $rootScope.idempresa;
	var idusuario = $rootScope.idusuario;


	//CARREGA AS SUBCATEGORIAS
	var carregaSubcategoriaSaida = function(){
		//console.log(idempresa);
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaSubcategoriasSaida.php").success(function(data){
			$scope.subcategoriasSaida = data;
		});
	}

	carregaSubcategoriaSaida();

	//CARREGA AS CONTAS SAÍDA
	var carregaContaSaida =  function(){
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/carregaContasSaida.php?idempresa="+idempresa).success(function(data){
			//console.log(data);
			$scope.contasSaida = data;
		});
	}

	carregaContaSaida();

	//SALVA SAÍDA
	$scope.conta = {};
	$scope.salvarContaSaida = function(conta){
		conta.idempresa = idempresa;

		if(conta.data == undefined){
			var dia = moment().format(); //2016-02-16 T 16:05:52-02:00
			conta.data = dia;
		}

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/salvarSaida.php", conta).success(function(data){
			//console.log(data);
			$scope.conta = {};
			exibeSaida();
		});

	}

	var exibeSaida = function(){
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/exibeSaida.php?idempresa="+idempresa).success(function(data){
			//console.log(data);
			$scope.contaSaida = data;
			valorTotalSaida();
		})
	}

	exibeSaida();

	var valorTotalSaida =  function(){
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/valorTotalSaida.php?idempresa="+idempresa).success(function(data){
			$scope.valorTotalSaida = data.valorTotalSaida;
		})
	}

	valorTotalSaida();

});