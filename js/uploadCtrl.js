app.controller('UploadCtrl', ['$scope', '$window', 'Upload', function($scope, $window, Upload) {

    $scope.uploadFiles = function(file, errFiles) {
        $scope.f = file;
        $scope.errFile = errFiles && errFiles[0];
        file.id_empresa = $window.localStorage.getItem("idemp");
        id_empresa = $window.localStorage.getItem("idemp");

        if (file) {
            console.log(file);
            
            file.upload = Upload.upload({
                url: 'http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/importaArquivo.php',
                method: 'POST',
                data: {'id_empresa': id_empresa}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 * 
                                         evt.loaded / evt.total));
            });
        }   
    }


}]);
