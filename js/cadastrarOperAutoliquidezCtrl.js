app.controller("CadastrarOperacoesAutoliquidezCtrl", function ($scope, $http, $window, $rootScope, $filter) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	$scope.salvarAutoliquidez = function(auto){
		
		if(auto.data){
			var data = $filter('date')(auto.data, 'yyyy-MM-dd');
			auto.data = data;
		}else{
			var data = new Date();
			var data = $filter('date')(data, 'yyyy-MM-dd');
		}

		auto.data = data;
		auto.idempresa = localStorage.getItem('idempresa');
		auto.opcao = "Cadastrar Operações de Autoliquidez";
		
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesAutoliquidez.php", auto).success(function(data){
			buscarOperacoesAutoliquidez();
		})
		
	}

	var buscarOperacoesAutoliquidez = function(){
		var opcao = "Buscar Operações de Autoliquidez";
		var operAuto = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa
	    	};
	    	
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/operacoesAutoliquidez.php", operAuto).success(function(response){
			$scope.operacoesAutoliquidez = response;
		});
	}

	buscarOperacoesAutoliquidez();

});


