define(['app'], function (app) {
    app.register.controller('HomeCtrl', ['$scope',function ($scope) {
        $scope.message = "Message from HomeCtrl";
    }]);
});
