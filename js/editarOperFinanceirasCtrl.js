app.controller("EditarOperacoesFinanceirasCtrl", function ($scope, $http, $window, $rootScope, $filter, $routeParams) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	var buscarOperFinanceirasEditar = function(){
			var idoperacoesFinanceiras = $routeParams.idoperacoesFinanceiras;
			var opcao = "Buscar Operações Financeiras para editar";
			var operFinan = {
		    		"opcao": opcao,
		    		"idempresa": $scope.idempresa,
		    		"idoperacoesFinanceiras": idoperacoesFinanceiras

		    	};

			$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesFinanceiras.php", operFinan).success(function(response){
				$scope.operacoesFinan = response
			});
		}

	buscarOperFinanceirasEditar();

	$scope.atualizarOperFinan = function(operacoesFinan){
		operacoesFinan.idempresa = $scope.idempresa;
		operacoesFinan.opcao = "Atualizar Operações Financeiras";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesFinanceiras.php", operacoesFinan).success(function(data){
			$scope.msgAtualizaOK = "Dado atualizado com sucesso!";
		})
	}

});


