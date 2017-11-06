app.controller("EditarBancoCtrl", ['$scope', '$http', '$window', '$rootScope', '$routeParams', function ($scope, $http, $window, $rootScope, $routeParams) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	var buscarBanco = function(){
		var opcao = "Buscar para edição";
		var idbanco = $routeParams.idbanco;
		var idempresa = $scope.idempresa;

		//console.log(opcao +' '+ idbanco +' '+ idempresa)
		$http.get("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php?idempresa="+idempresa+"&opcao="+opcao+"&idbanco="+idbanco).success(function(response){
			$scope.banco = response;
		});
	}

	buscarBanco();

	$scope.atualizarBanco = function(banco){
		console.log(banco)
		var opcao = "Atualizar Banco";
		banco.opcao = opcao;
		banco.idempresa = $scope.idempresa;

		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/bancos.php", banco).success(function(response){
			console.log(response)
		});
	}


}]);





