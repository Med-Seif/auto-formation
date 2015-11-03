<!DOCTYPE html>
<html ng-app="spc">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.1/angular.min.js"></script>
        <script>
            (function () {
                var app = angular.module('spc', []);
                app.config(['$httpProvider', function ($httpProvider) {
                        // ajouter ce paramètre aux appels envoyés avec ajax pour pouvoir être détectés par AjaxContext
                        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
                    }]);
                app.controller('ProductsController', function ($scope, $http, $compile) {
                    $http.get('/auto-formation/angular/app/list.php', {params: {}}).success(
                            function (response) {
                                $scope.products = response;
                            });
                    $scope.populateForm = function (product) {
                        console.log(product);
                        $scope.product = product;
                        $scope.label = product.label;
                    };
                    $scope.insert = function (event) {
                        vars = $('#frm-product').serializeArray();
                        console.log(vars);
                        //$("#frm-product").trigger('reset');
                        $http.post('/auto-formation/angular/app/insert.php', {params: { vars }}).success(
                                function (response) {
                                    console.log(response);
                                });
                        //$.post( "test.php", $( "#testform" ).serialize() );
                        $scope.products.unshift({'label': $scope.label, 'id': 100});
                        $scope.label = null;
                        event.preventDefault();
                    };
                    $scope.edit = function (event) {
                        console.log([$scope.product.id, $scope.label]);
                        $scope.product.label = $scope.label;
                        event.preventDefault();
                    };
                    $scope.delete = function (index) {
                        console.log($scope.products[index].id);
                        $scope.products.splice(index, 1);
                    };
                });
            })();
        </script>
    </head>
    <body ng-controller="ProductsController">
        <div class="container">
            <br>
            <?php
            if (in_array($_GET['q'], ['list', 'insert'])) {
                require_once __DIR__ . "\app\/" . $_GET['q'] . ".php";
            }
            ?>
            <form id="frm-product" name="frm-product" ng-action="<?= $_SERVER['PHP_SELF'] ?>" novalidate>
                <input type="text" id="label" name="label" placeholder="Label" ng-model="label"/>
                <button class="btn" ng-click="insert($event)">New</button>
                <button class="btn" ng-click="edit($event)">Edit</button>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="p in products">
                        <td>{{p.id}}</td>
                        <td><a class="btn" ng-click="populateForm(p)">{{p.label}}</a></td>
                        <td><a class="btn btn-danger" ng-click="delete($index)">Supprimer</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
