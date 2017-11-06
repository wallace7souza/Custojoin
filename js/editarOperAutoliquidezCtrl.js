app.controller("EditarOperacoesAutoliquidezCtrl", function ($scope, $http, $window, $rootScope, $filter, $routeParams) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	var buscarOperAutoliquidezEditar = function(){
			var idoperacoesAutoliquidez = $routeParams.idoperacoesAutoliquidez;
			var opcao = "Buscar Operações Autoliquidez para editar";
			var operAutoliq = {
		    		"opcao": opcao,
		    		"idempresa": $scope.idempresa,
		    		"idoperacoesAutoliquidez": idoperacoesAutoliquidez

		    	};

			$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesAutoliquidez.php", operAutoliq).success(function(response){
				$scope.operAutoliquidez = response
			});
		}

	buscarOperAutoliquidezEditar();

	$scope.atualizarAutoliquidez = function(operAutoliquidez){
		operAutoliquidez.idempresa = $scope.idempresa;
		operAutoliquidez.opcao = "Atualizar Operações Autoliquidez";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesAutoliquidez.php", operAutoliquidez).success(function(data){
			$scope.msgAtualizaOK = "Dado atualizado com sucesso!";
		})
	}

});


