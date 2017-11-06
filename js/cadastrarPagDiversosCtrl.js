app.controller("CadastrarPagDivesosCtrl", function ($scope, $http, $window, $rootScope, $filter) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	$scope.salvarPagDiv = function(pagDiversos){

		if(pagDiversos.data){
			var data = $filter('date')(pagDiversos.data, 'yyyy-MM-dd');
			pagDiversos.dataFormatada = data;
		}else{
			var data = new Date();
			var dataFormatada = $filter('date')(data, 'yyyy-MM-dd');
		}

		pagDiversos.data = dataFormatada;
		pagDiversos.idempresa = localStorage.getItem('idempresa');
		pagDiversos.opcao = "Cadastrar Pagamentos Diversos";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/pagamentosDiversos.php", pagDiversos).success(function(data){
			buscarPagDiv();
		})
	}


	var buscarPagDiv = function(){
		var opcao = "Buscar Pagamentos Diversos";
		var pagDiv = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa
	    	};
	    
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/pagamentosDiversos.php", pagDiv).success(function(response){
			$scope.pagamentosDiversos = response;
		});
	}

	buscarPagDiv();

});


