app.controller("EditarInvestimentoCtrl", function ($scope, $http, $window, $rootScope, $filter, $routeParams) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');
	$scope.idusuario = $rootScope.idusuario = localStorage.getItem('idusuario');


	var buscarInvestimentoEditar = function(){
		var idinvestimento = $routeParams.idinvestimento;
		var opcao = "Buscar Investimento para editar";
		var investimento = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa,
	    		"idinvestimento": idinvestimento

	    	};

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/investimentos.php", investimento).success(function(response){
			$scope.investimento = response;
		});
	}

	buscarInvestimentoEditar();

	$scope.AtualizarInvest = function(investimento){

		investimento.idempresa = $scope.idempresa;
		investimento.opcao = "Atualizar Investimento";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/investimentos.php", investimento).success(function(data){
			$scope.msgAtualizaOK = "Dado atualizado com sucesso!";
		})
	}


});


