app.controller("CadastrarBensImoveisCtrl", function ($scope, $http, $window, $rootScope, $filter) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');
	$scope.idusuario = $rootScope.idusuario = localStorage.getItem('idusuario');

	$scope.salvarBem = function(bem){
		//console.log(bem)
		if(bem.dataAquisicao){
			var dataAquisicao = $filter('date')(bem.dataAquisicao, 'yyyy-MM-dd');
			bem.dataAquisicao = dataAquisicao;
		}else{
			var dataAquisicao = new Date();
			var dataAquisicao = $filter('date')(dataAquisicao, 'yyyy-MM-dd');
		}

		bem.dataAquisicao = dataAquisicao;
		bem.idempresa = $scope.idempresa;
		bem.opcao = "Cadastrar Bem";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bensImoveis.php", bem).success(function(data){
			buscarBem();
		})
	}


	var buscarBem = function(){
		var opcao = "Buscar Bem";
		var bem = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa
	    	};

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bensImoveis.php", bem).success(function(response){
			$scope.bens = response;
		});
	}

	buscarBem();

});


