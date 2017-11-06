app.controller('AppController', ['$scope', 'FileUploader', function($scope, FileUploader) {

    
    /*var uploader = $scope.uploader = new FileUploader({
        url: 'php/uploadFile/'
    });

    $scope.upload = function() {
        uploader;
        //console.log(uploader);
        console.log(uploader.queue[0].file);

    }*/

    $scope.salvarArquivo = function(file, uploadUrl){
        console.log("chamou");
    }


}]);
