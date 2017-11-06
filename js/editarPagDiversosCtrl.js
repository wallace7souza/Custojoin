app.controller("EditarPagDiversosCtrl", function ($scope, $http, $window, $rootScope, $filter, $routeParams) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');
	$scope.idusuario = $rootScope.idusuario = localStorage.getItem('idusuario');


	var buscarPagamentosDiversosEditar = function(){
		var idpagamentosDiversos = $routeParams.idpagamentosDiversos;
		var opcao = "Buscar Pagamentos Diversos para editar";
		var pagDiversos = {
	    		"opcao": opcao,
	    		"idempresa": $scope.idempresa,
	    		"idpagamentosDiversos": idpagamentosDiversos

	    	};

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/pagamentosDiversos.php", pagDiversos).success(function(response){
			$scope.pagDiversos = response;
		});
	}

	buscarPagamentosDiversosEditar();

	$scope.atualizarPagDiv = function(pagDiversos){
		pagDiversos.idempresa = $scope.idempresa;
		pagDiversos.opcao = "Atualizar Pagamentos Diversos";

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/pagamentosDiversos.php", pagDiversos).success(function(data){
			$scope.msgAtualizaOK = "Dado atualizado com sucesso!";
		})
	}


});


