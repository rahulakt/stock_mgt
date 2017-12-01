/* Setup sale product page controller */
angular.module('MetronicApp').controller('SaleController', ['$rootScope', '$scope', 'settings', function($rootScope, $scope, settings) {
    var vm = this;
    
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();

        // set default layout mode
        $rootScope.settings.layout.pageContentWhite = true;
        $rootScope.settings.layout.pageBodySolid = false;
        $rootScope.settings.layout.pageSidebarClosed = false;
    });

    // Button Text
    vm.buttonText = "Save";

    // Purchase Details Array
    vm.purchaseDetails = [
    {
        'purchase_id':'',
        'pur_product_name':'',
        'pur_date':'',
        'pur_product_desc':'',
        'pur_product_qty':''
    }];

    // Add New Purchase Details
    vm.addNew = function(purchaseDetails){
        vm.purchaseDetails.push({
            'purchase_id':'',
            'pur_product_name':'',
            'pur_date':'',
            'pur_product_desc':'',
            'pur_product_qty':''
        });
    };

    // Remove new item
    vm.removeNew = function(){
        var newDataList=[];
        vm.selectedAll = false;
        angular.forEach(vm.purchaseDetails, function(selected){
            if(!selected.selected){
                newDataList.push(selected);
            }
        });
        vm.purchaseDetails = newDataList;
    };
}]);
