app.controller("CadastrarInvestCtrl", function ($scope, $http, $window, $rootScope, $filter) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	$scope.salvarInvest = function(investimento){
		//console.log(investimento)
		var data = $filter('date')(investimento.data, 'yyyy-MM-dd');
		investimento.idempresa = localStorage.getItem('idempresa');
		investimento.dataFormatada = data;
		investimento.opcao = "Cadastrar investimento";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/investimentos.php", investimento).success(function(data){
			buscarInvest();
		})
	}


	var buscarInvest = function(){
		var opcao = "Buscar investimento";
		var invest = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa
	    	};

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/investimentos.php", invest).success(function(response){
			$scope.investimentos = response;
		});
	}

	buscarInvest();

});


