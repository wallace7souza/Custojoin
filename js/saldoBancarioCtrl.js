app.controller("SaldoBancarioCtrl", function ($scope, $http, $window, $rootScope, $filter) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');
	$scope.idusuario = $rootScope.idusuario = localStorage.getItem('idusuario');

	var buscarTodosOsBancos = function(){
		var opcao = "Buscar todos";
		var todoOsBancos = {
			"opcao": opcao,
			"idempresa": $scope.idempresa
		};

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php", todoOsBancos).success(function(response){
			$scope.bancos = response;
		})
	}

	buscarTodosOsBancos();

	$scope.saldoBanco = {};
	$scope.salvarSaldoBancario = function(saldoBanco){

		if(saldoBanco.data){
			var data = $filter('date')(saldoBanco.data, 'yyyy-MM-dd');
			saldoBanco.data = data;
		}else{
			var data = new Date();
			var data = $filter('date')(data, 'yyyy-MM-dd');
		}

		saldoBanco.data = data;
		saldoBanco.idempresa = $scope.idempresa;
		saldoBanco.opcao = "Adicionar saldo";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php", saldoBanco).success(function(data){
			$scope.saldoBanco = {};
			buscarSaldos();
		})
	}


	var buscarSaldos = function(){
		var opcao = "Buscar saldo";
		var saldo = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa
	    	};

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php", saldo).success(function(response){
			$scope.saldos = response;
		});
	}

	buscarSaldos();

	var somarSaldos = function(){
		var opcao = "Saldo total";
		var saldoTotal = {
	    		"opcao": opcao
	    	};

	    $http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php", saldoTotal).success(function(response){
	    	$scope.saldoTotal = response;
	    });

	}

	somarSaldos();

});


