app.controller("EditarPerfilCtrl", function ($scope, $http, $window, $rootScope) {

	$scope.idempresa = $rootScope.idempresa = localStorage.getItem('idempresa');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');
	$scope.idusuario = $rootScope.idusuario = localStorage.getItem('idusuario');

	var paramsUsuario = {
		"idusuario": $scope.idusuario
	}

	var buscaUsuario = function(){
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/buscaUsuario.php", paramsUsuario).success(function(data){
			//console.log(data);
			$scope.usuarios = data;
		});
	}

	buscaUsuario();

	$scope.msgSucesso;

	$scope.atualizarUsuario = function(usuario){

		usuario.opcao = "atualizarUsuario";
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/usuario.php", usuario).success(function(data){
			$scope.msgSucesso = data[0].msgAtualizadoSucesso;
			$scope.usuario = data[0].usuario;
			$rootScope.usuario = data[0].usuario;
		})
	}

	var paramsEmpresa = {
		"idempresa": $scope.idempresa
	}
	
	var buscaEmpresa = function(){
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/buscaEmpresa.php", paramsEmpresa).success(function(data){
			$scope.empresas = data;
		})
	}

	buscaEmpresa();

	$scope.atualizarEmpresa = function(empresa){
		//console.log(empresa);
		empresa.opcao = "atualizarEmpresa";
		$http.post("http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/empresa.php", empresa).success(function(data){
			//console.log(data);

			localStorage.setItem('empresa', data.empresa);
			$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
			$scope.msgAtualEmpresaSucesso = data.msgAtualEmpresaSucesso;
			
		})
	}

});

