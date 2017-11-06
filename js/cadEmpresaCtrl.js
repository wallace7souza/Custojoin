app.controller("CadEmpresaCtrl", function ($scope, $http, $location, $window) {

	$scope.cadastraEmpresa = function (empresa) {

		$opcao = 'cadEmpresa';
		empresa.opcao = $opcao;

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/empresa.php', empresa).success(function (data){
			//console.log(data);
			$window.localStorage.setItem('idemp', data.idempresa);
			$window.localStorage.setItem('empresa', data.empresa);
		});

		$location.path('/cadusuario');
	}
});