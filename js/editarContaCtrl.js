app.controller("EditarContaCtrl", function ($scope, $http, $window, $routeParams, $location) {

	var idempresa = $window.localStorage.getItem('idemp');
	var empresa = $window.localStorage.getItem('empresa');
	var usuario = $window.localStorage.getItem('usuario');
	var idusuario = $window.localStorage.getItem('idusuario');

	$scope.empresa = empresa;
	$scope.usuario = usuario;

	var pegaContaEntrada = function(conta){
		//console.log($routeParams.idconta);
		var idconta = $routeParams.idconta;

		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/pegaEntrada.php?idconta="+idconta+"&idempresa="+idempresa).success(function(data){
			$scope.conta = data;
		});
	}

	pegaContaEntrada();

	$scope.salvarContaEditada = function(conta){
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/admin/atualizaContaEntradaAdmin.php", conta).success(function(data){
			$scope.msgContaAtualizaSucesso = data.msgAtualContaSucesso;
		});
	}

});


