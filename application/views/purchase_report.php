<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb hide">
    <li>
        <a href="#">Blank Page</a>
        <i class="fa fa-circle"></i>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN MAIN CONTENT -->
<div class="row" ng-controller="PurchaseReportController as vm">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-list font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">Purchase Report</span>
                    <span class="caption-helper hide"></span>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form class="horizontal-form" ng-submit="vm.generateReport()" method="post" id="purchase_report" name="vm.purchase_report" novalidate>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Product Name <span class="required">*</span></label>
                                    <select name="purchase_product_name" ng-model="vm.purchase_product_name" class="form-control select2me" select2 placeholder="Select" required>
                                        <option value="">Select</option>
                                        <option value="all">All</option>
                                        <option ng-repeat="client in vm.client_option track by client.client_id" value="{{ client.client_name }}">{{ client.client_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Purchase Date </label>
                                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="form-control mask_date2" name="purchase_date" ng-model="vm.purchase_date">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <center>
                            <button type="button" class="btn default" ng-click="vm.clearData">Cancel</button>
                            <button type="submit" class="btn green" ng-init="vm.myVar = false">Generate</button>
                        </center>
                    </div>
                </form>
                <!-- End FORM-->
            </div>
        </div>

        <div class="row" ng-if="vm.myVar">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-docs font-green-sharp"></i>
                            <span class="caption-subject bold uppercase">Purchase Report</span>
                        </div>
                        <div class="actions">
                            <button type="button" class="btn green" ng-click="vm.export_excel_report(vm.client_name, vm.from_date, vm.to_date)">Export To Excel</button>
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
                                        Purchase Date
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="invoice in vm.invoice_data track by $index">
                                    <td>{{ ::invoice.invoice_no }}</td>
                                    <td>{{ ::invoice.invoice_date | date: 'dd-MM-yyyy' }}</td>
                                    <td>{{ ::invoice.client_name }}</td>
                                    <td>{{ ::invoice.client_contact_no }}</td>
                                    <td>
                                        <center>
                                            <a style="text-decoration:none;" href="#/invoice_pdf_data/{{ invoice.invoice_id }}" title="Pdf" data-toggle="tooltip" data-placement="top" tooltip>
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS-->
<script>
    ComponentsDateTimePickers.init(); // init ComponentsDateTimePickers page
</script>
<!-- BEGIN MAIN JS -->