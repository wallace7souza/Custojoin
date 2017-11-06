app.controller('CadastroCtrl', function($rootScope, $location){
	$rootScope.activetab = $location.path();

	this.categoriasFilme = [
		{abr:"AVE", completo:"Aventura"},
		{abr:"FIC", completo:"Ficção"},
		{abr:"COM", completo:"Comédia"},
		{abr:"POL", completo:"Policial"},
		{abr:"ACA", completo:"Ação"}
	];

	this.filmesCadastrados = [];

	this.novoFilme = {};

	this.cadastraFilme = function(filme){
		this.filmesCadastrados.push(filme);
		this.novoFilme = {};
	};

});

app.controller('SobreCtrl', function($rootScope, $location){
	$rootScope.activetab = $location.path();
});

app.controller('ContatoCtrl', function($rootScope, $location){
	$rootScope.activetab = $location.path();
});

app.controller('ListagemCtrl', function($rootScope, $location){
	$rootScope.activetab = $location.path();

	this.filmesCadastrados = [];

	this.filme = {
		titulo: 'Homem de Ferro',
		categotia: 'Ação',
		diretor: 'Jon Fevrou',
		duracao: 126
	};

});