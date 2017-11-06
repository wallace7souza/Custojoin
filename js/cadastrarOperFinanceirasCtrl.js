app.controller("CadastrarOperacoesFinanceirasCtrl", function ($scope, $http, $window, $rootScope, $filter) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	$scope.salvarOperFinan = function(operacoesFinan){
		//console.log(operacoesFinan)
		if(operacoesFinan.data){
			var data = $filter('date')(operacoesFinan.data, 'yyyy-MM-dd');
			operacoesFinan.dataFormatada = data;
		}else{
			var data = new Date();
			var dataFormatada = $filter('date')(data, 'yyyy-MM-dd');
		}

		operacoesFinan.data = dataFormatada;
		operacoesFinan.idempresa = localStorage.getItem('idempresa');
		operacoesFinan.opcao = "Cadastrar Operação Financeira";
		//console.log(operacoesFinan)
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesFinanceiras.php", operacoesFinan).success(function(data){
			buscarPagDiv();
		})
	}


	var buscarPagDiv = function(){
		var opcao = "Buscar Operação Financeira";
		var operFinan = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa
	    	};
	    	
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesFinanceiras.php", operFinan).success(function(response){
			$scope.operacoesFinanceiras = response;
		});
	}

	buscarPagDiv();

});


