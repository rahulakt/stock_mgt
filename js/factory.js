/***
GLobal Factories
***/

MetronicApp.factory('commonFactory',['$http', '$q', function($http, $q){
    var savedData = {};
    return {
        // Fetch All Records
        GetAllPromiseData : function (url) {
            var deferred = $q.defer();
            var promise = $http.get(url)
                .then(function (data) {
                    deferred.resolve(data);
                },function (error) {
                    deferred.reject(error);
                });
            return deferred.promise;
        },

        // Fetch Single Data
        GetSinglePromiseData : function(id, url) {
            var deferred = $q.defer();
            var promise = $http({
                    method: 'GET',
                    url: url + '/' + id
                }).then(function (data) {
                    deferred.resolve(data);
                },function (error) {
                    deferred.reject(error);
                });
            return deferred.promise;
        },

        // Add New Record
        AddNewRecord : function(method, url, user) {
            var deferred = $q.defer();
            var promise = $http({
                    method: method,
                    url: url,
                    data: JSON.stringify(user),
                    dataType: "json"
                }).then(function (data) {
                    deferred.resolve(data);
                },function (error) {
                    deferred.reject(error);
                });
            return deferred.promise;
        }, 
        
        // Update data
        UpdateRecord : function(method, url, user){
            var deferred = $q.defer();
            var promise = $http({
                    method: method,
                    url: url,
                    data: JSON.stringify(user),
                    dataType: "json"
                }).then(function (data) {
                    deferred.resolve(data);
                },function (error) {
                    deferred.reject(error);
                });
            return deferred.promise;
        },

        // Delete data
        DeleteRecord : function(method, url, user){
            var deferred = $q.defer();
            var promise = $http({
                    method: method,
                    url: url,
                    data: JSON.stringify(user),
                    dataType: "json"
                }).then(function (data) {
                    deferred.resolve(data);
                },function (error) {
                    deferred.reject(error);
                });
            return deferred.promise;
        },

        // Fetch All Records
        getResults : function(query) {
            var req = {};
            req.query = query;

            return $http({
                method: 'GET', 
                url: 'get_live_search_list',
                params : req
            });
        }
    };
}]);