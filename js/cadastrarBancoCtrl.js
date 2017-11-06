app.controller("CadastrarBancoCtrl", function ($scope, $http, $window, $rootScope) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	$scope.salvarBanco = function(banco){
		banco.idempresa = $scope.idempresa;
		banco.opcao = "Cadastrar";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php", banco).success(function(response){
			$scope.msgBanco = response.msg;
			buscaBancos();
		});
	}

	var buscaBancos = function(){
		var opcao = "buscar";
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php?idempresa="+$scope.idempresa+"&opcao="+opcao).success(function(response){
			//console.log(response);
			$scope.bancos = response;
		});
	}

	buscaBancos();

	$scope.apagarBanco = function(banco){
		var opcao = "Deletar";
		var idempresa = $scope.idempresa;
		var idbanco = banco;

		$http.delete("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php?idempresa="+idempresa+"&opcao="+opcao+"&idbanco="+idbanco).success(function (data, status){
			buscaBancos();
		});
	}

});


