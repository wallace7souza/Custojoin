app.controller("EditarBensImoveisCtrl", function ($scope, $http, $window, $rootScope, $filter, $routeParams) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');
	$scope.idusuario = $rootScope.idusuario = localStorage.getItem('idusuario');


	var buscarBenImovelEditar = function(){
		var idbensimoveis = $routeParams.idbensimoveis;
		var opcao = "Buscar Bem Imóvel para editar";
		var bem = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa,
	    		"idbensimoveis": idbensimoveis

	    	};

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bensImoveis.php", bem).success(function(response){
			$scope.bensImoveis = response;
		});
	}

	buscarBenImovelEditar();

	$scope.atualizaBensImoveis = function(bensImoveis){
		//console.log(bensImoveis)
		if(bensImoveis.dataAquisicao){
			var dataAquisicao = $filter('date')(bensImoveis.dataAquisicao, 'yyyy-MM-dd');
			bensImoveis.dataAquisicao = dataAquisicao;
		}else{
			var dataAquisicao = new Date();
			var dataAquisicao = $filter('date')(dataAquisicao, 'yyyy-MM-dd');
		}

		bensImoveis.dataAquisicao = dataAquisicao;
		bensImoveis.idempresa = $scope.idempresa;
		bensImoveis.opcao = "Atualizar Bem Imóvel";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bensImoveis.php", bensImoveis).success(function(data){
			$scope.msgAtualizaOK = "Dados atualizados com sucesso!";
		})
	}


});


