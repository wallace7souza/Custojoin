/*app.controller("CadEmpresaCtrl", function ($scope, $http, $location, $window) {

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
});*/

/*app.controller("CadUsuarioCtrl", function ($scope, $http, $location, $window) {

	$scope.cadastraUsuario = function (usuario) {

		var idempresa = $window.localStorage.getItem('idemp');
		var opcao = 'cadUsuario';

		usuario.idempresa = idempresa;
		usuario.opcao = opcao;

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/usuario.php', usuario).success(function (data){
			//console.log(data);
			$window.localStorage.setItem('usuario', data[0].usuario);
			$window.localStorage.getItem('idemp', data.idempresa);
		});

		$location.path('/inicial');
	}
});*/

/*app.controller("LoginCtrl", function ($scope, $http, $window, $location) {

	$scope.logar = function(usuario){

		var opcao = 'logar';
		usuario.opcao = opcao;

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/usuario.php', usuario).success(function (data){
			//console.log(data);
			if(data != ''){
				$window.localStorage.setItem('usuario', data[0].usuario);
				$window.localStorage.setItem('empresa', data[0].empresa);
				$window.localStorage.setItem('idemp', data[0].idempresa);

				$scope.idempresa = data[0].idempresa;
				$scope.empresa = data[0].empresa;
				$scope.usuario = data[0].usuario;

				$location.path('/inicial');
			}else{
				$location.path('/');
				$scope.msgErro = "E-mail ou senha inválido";
			}
		});
	};
});*/

/*app.controller("InicialCtrl", function ($scope, $http, $window) {

	var empresa = $window.localStorage.getItem('empresa');
	var usuario = $window.localStorage.getItem('usuario');
	var idempresa = $window.localStorage.getItem('idemp');

	$scope.idempresa = idempresa;
	$scope.empresa = empresa;
	$scope.usuario = usuario;

	$scope.sair = function(){
		localStorage.clear();
		//localStorage.removeItem(usuarioEmp);
	}



});*/

/*app.controller("ConfigCtrl", function ($scope, $http, $window) {

	var empresa = $window.localStorage.getItem('empresa');
	var usuario = $window.localStorage.getItem('usuarioEmp');

	$scope.empresa = empresa;
	$scope.usuario = usuario;


});*/

/*app.controller("CategoriaSubcategoriaCtrl", function ($scope, $http, $window) {

	var empresa = $window.localStorage.getItem('empresa');
	var usuario = $window.localStorage.getItem('usuarioEmp');

	$scope.empresa = empresa;
	$scope.usuario = usuario;

	$scope.adicionaCategoria = function(catsubcat){

		$opcao = 'categoria';
		catsubcat.opcao = $opcao;
		catsubcat.idempresa = $window.localStorage.getItem('idemp');

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/catsubcat.php', catsubcat).success(function(data){
			
		});

	};

	var buscaCategorias = function(){

		$scope.categorias = [];
		var idempresa = $window.localStorage.getItem('idemp');
		var opcao = 'pegarCategoria';
		var buscaCat = {
			    "opcao":opcao, 
			    "idempresa":idempresa
			}

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/buscaCatSubcat.php', buscaCat).success(function(data){
			//console.log(data);
			$scope.categorias = data;
			//console.log($scope.categorias);
		});
	};

	buscaCategorias();


});*/

/*app.controller("LoginAdminCtrl", function ($scope, $http, $location, $window) {

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
});*/

/*app.controller("SubcategoriaAdminCtrl", function ($scope, $http, $location, $window) {

	$scope.subcategorias = [];
	$scope.subcategoria = {categoria: "", subcategoria: ""};

	var pegaSubcategorias = function(){

		$http.get('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/pegaSubcategoriasAdmin.php').success(function(data){
			$scope.subcategorias = data;
		});
	}

	pegaSubcategorias();

	$scope.salvarSubcategoria = function(subcategoria){

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/subcategoriaAdmin.php', subcategoria).success(function(data){
			$scope.subcategoria = {categoria: "", subcategoria: ""};
		});

	}

	pegaSubcategorias();

});*/





