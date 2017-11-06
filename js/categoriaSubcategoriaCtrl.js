app.controller("CategoriaSubcategoriaCtrl", function ($scope, $http, $window) {

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


});