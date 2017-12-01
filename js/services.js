/***
GLobal Services
***/

// Inbox count services
MetronicApp.service('commonService', ['$http', function($http){
	var $this = this;
	// Insert new record
	$this.Add = function (method, url, user) {
        var request = $http({
            method: method,
            url: url,
            data: JSON.stringify(user),
            dataType: "json"
        });
        return request;
    }

	// Fetch Single Data
	$this.GetSingleData = function (id, url) {
        var request = $http({
            method: 'GET',
            // url: 'edit_client_registration_master/' + id,
            url: url + '/' + id
        });
        return request;
    }

    // Fetch All Data
    $this.GetAllData = function (url) {
        var request = $http({
            method: 'GET',
            // url: 'get_all_client_registration',
            url: url
        });
        return request;
    }

    // Delete
    $this.Delete = function (client, url) {
        var request = $http({
            method: 'DELETE',
            // url: 'delete_client_registration_master',
            url: url,
            data: JSON.stringify(client),
            dataType: "json"
        });
        return request;
    }

}]);