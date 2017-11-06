app.controller("CadUsuarioCtrl", function ($scope, $http, $location, $window) {

	$scope.cadastraUsuario = function (usuario) {

		var idempresa = $window.localStorage.getItem('idemp');
		var opcao = 'cadUsuario';

		usuario.idempresa = idempresa;
		usuario.opcao = opcao;

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/usuario.php', usuario).success(function (data){
			//console.log(data);
			$window.localStorage.setItem('idusuario', data.idusuario);
			$window.localStorage.setItem('usuario', data.usuario);
			$window.localStorage.getItem('idemp', data.idempresa);
		});

		$location.path('/inicial');
	}
});