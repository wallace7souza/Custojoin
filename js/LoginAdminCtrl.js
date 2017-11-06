app.controller("LoginAdminCtrl", function ($scope, $http, $location, $window) {

	$scope.logarAdmin = function (admin) {

		var opcao = "logar";
		admin.opcao = opcao;

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/usuarioAdmin.php', admin).success(function(data){
			//console.log(data);
			if(data != ''){
				$location.path('/areaadmin');
			}else{
				$location.path('/loginadmin');
				$scope.erroLoginAdmin = "Email ou senha inválido";
			}
		});
		
	}
});