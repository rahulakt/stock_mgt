<!-- BEGIN MAIN CONTENT -->
<div class="row" ng-controller="PurchaseController as vm">
    <div growl></div>   
    <div class="col-md-12">
        <!-- BEGIN: ACCORDION DEMO -->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-basket-loaded font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">Purchase Products</span>
                    <span class="caption-helper hide"></span>
                </div>
                <div class="actions">
                    <button type="button" class="btn blue" ng-click="vm.addNew()"><i class="fa fa-download"></i> Download</button>
                    <button type="button" class="btn yellow" ng-click="vm.addNew()"><i class="fa fa-share"></i> Import</button>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form class="horizontal-form" ng-submit="vm.submit_purchase_invoice(vm.purchase_invoice.$valid)" method="post" id="purchase_report" name="vm.purchase_invoice" novalidate>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" ng-model="selectedAll" ng-click="vm.checkAll()" />
                                            </th>
                                            <th>
                                                <label class="control-label">Product Name <span class="required">*</span></label>
                                            </th>
                                            <th>
                                                <label class="control-label">Date <span class="required">*</span></label>
                                            </th>
                                            <th>
                                                <label class="control-label">Product Description </label>
                                            </th>
                                            <th>
                                                <label class="control-label">Quantity <span class="required">*</span></label>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="purchaseDetail in vm.purchaseDetails track by $index">
                                            <td>
                                                <input type="checkbox" ng-model="purchaseDetail.selected"/>
                                                <input type="hidden" name="purchase_id" ng-model="purchaseDetail.purchase_id">
                                            </td>
                                            <td >
                                                <input type="text" class="form-control" name="pur_product_name" id="pur_product_name" ng-model="purchaseDetail.pur_product_name" required>
                                            </td>
                                            <td width="20%">
                                                <div class="input-group date date-picker">
                                                    <input type="text" class="form-control" name="pur_date" ng-model="purchaseDetail.pur_date" jqdatepicker readonly required>
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="pur_product_desc" id="pur_product_desc" ng-model="purchaseDetail.pur_product_desc">
                                            </td>
                                            <td width="8%">
                                                <input type="number" class="form-control" name="pur_product_qty" id="pur_product_qty" ng-model="purchaseDetail.pur_product_qty" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="button" class="btn green" ng-click="vm.addNew()" tabindex="24">Add</button>
                                    <button type="button" class="btn red" ng-if="vm.purchaseDetails.length" ng-click="vm.removeNew()">Remove</button>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <center>
                            <button type="button" class="btn default" tabindex="26" ng-click="vm.clearData">Cancel</button>
                            <button type="submit" class="btn green" tabindex="25" ng-disabled="vm.purchase_invoice.$invalid">{{vm.buttonText}}</button>
                        </center>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-list font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">Purchase Product List</span>
                </div>
            </div>
            <div class="portlet-body">
                <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>
                                Product Name
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Product Description
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="inv in vm.invoiceList track by $index">
                            <td>{{ ::inv.invoice_no }}</td>
                            <td>{{ ::inv.invoice_date | date : "dd-MM-yyyy" }}</td>
                            <td>{{ ::inv.client_name }}</td>
                            <td>{{ ::inv.client_contact_no }}</td>
                            <td>
                                <center>
                                    <a style="text-decoration:none;" href="#/invoice_pdf_data/{{ inv.invoice_id }}" title="Pdf" data-toggle="tooltip" data-placement="top" tooltip>
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <a style="text-decoration:none;" href="<?php echo base_url();?>print_invoice/{{ inv.invoice_id }}" title="Print" data-toggle="tooltip" data-placement="top" tooltip>
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <span style="cursor: pointer; color:green;" ng-click="vm.selectToUpdate(inv.invoice_id)" title="Edit" data-toggle="tooltip" data-placement="top" tooltip>
                                        <i class="fa fa-edit"></i>
                                    </span>                    
                                    <span style="cursor: pointer; color:red;" ng-click="vm.selectToDelete(inv.invoice_id)" title="Delete" data-toggle="tooltip" data-placement="top" tooltip>
                                        <i class="fa fa-trash-o"></i>
                                    </span>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS-->
<script>
    ComponentsDateTimePickers.init(); // init todo page
</script>
<!-- BEGIN MAIN JS -->