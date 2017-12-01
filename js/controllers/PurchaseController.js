/* Setup purhcase product page controller */
angular.module('MetronicApp').controller('PurchaseController', ['$rootScope', '$scope', 'settings', 'commonFactory', 'growl', function($rootScope, $scope, settings, commonFactory, growl) {
    var vm = this;

    // Show current date
    vm.Date = function () {return new Date();}
    
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
        'pur_product_name':'',
        'pur_date':'',
        'pur_product_desc':'',
        'pur_product_qty':''
    }];

    // Add New Purchase Details
    vm.addNew = function(purchaseDetails){
        vm.purchaseDetails.push({
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

    // Save Purchase Invoice
    vm.submit_purchase_invoice = function(isValid) {
        if (isValid) {
            App.blockUI({boxed: true,message: 'Loading...'});
            
            // Purchase Invoice Details
            var puchaseInvoiceDetails = JSON.parse(angular.toJson(vm.purchaseDetails));

            var requestResponse = commonFactory.AddNewRecord('POST', 'save_purchase_invoice', puchaseInvoiceDetails);
            
            requestResponse.then(function(response) {
                vm.item = response.data;

                var purchaseDetail = [{
                    'pur_product_name':'',
                    'pur_date':'',
                    'pur_product_desc':'',
                    'pur_product_qty':''
                }];

                angular.forEach(purchaseDetail, function(element) {               
                    vm.purchaseDetails.push(element);
                });

                vm.purchase_invoice.$setPristine();
                vm.purchase_invoice.$setUntouched();

                App.unblockUI();
                if(vm.item.valid == 'true')
                {
                    $('html,body').animate({scrollTop:0});
                    growl.success(vm.item.msg, {title:'Success', ttl: 2000}); 
                    vm.buttonText="Save";
                }
                else
                {
                    growl.error(vm.item.msg, {title:'Error', ttl: 2000});
                }
            },
            function () {
                growl.error('While saving purchase invoice details', {title:'Error', ttl: 2000});
            });
        }
    }
}]);
