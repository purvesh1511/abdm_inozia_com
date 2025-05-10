<style>
    .custom-tab .nav-link {
        background-color: #222533;
        color: white;
        margin: 5px;
        border-radius: 5px;
        padding: 10px 15px;
        font-weight: 500;
        display: grid;
        align-items: center;
        justify-content: center;
    }

    .custom-tab .nav-item.active .nav-link {
        background-color: #B0BEC5;
        color: white;
        margin: 5px;
        border-radius: 5px;
        padding: 10px 15px;
        font-weight: 500;
        display: grid;
        align-items: center;
        justify-content: center;
    }

    .custom-tab .nav-link i {
        font-size: 1rem;
        font-size: 16px;
    }

    /* .custom-tab .nav-item.active {
        background-color: #B0BEC5;
        color: #000;
    } */

    .card-header.header {
        background-color: #90A4AE !important;
        font-weight: bold;
        padding: 15px;
    }

    input[type="date"] {
        min-width: 140px;
    }

    /* .tab-pane .dataTables_wrapper {
        width: 95%;
    } */


    .dt-buttons .btn {
        background-color: #222533;
        margin: 5px;
        color: #fff;
    }

    thead.table-success th {
        background-color: #222533 !important;
        color: white;
        padding: 12px 0px;
    }

    .card-body form.form-inline {
        padding: 10px;
    }

    .form-inline .btn-success {
        background-color: #222533;
        margin-top: 5px;
    }

    .mt-4 {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
<div class="col-md-12">
    <div class="containers mt-4">
        <div class="card">
            <div class="tabDatatable">
                <div class="card-header p-2">
                    <ul class="nav nav-pills justify-content-center custom-tab" id="custom-tabs" role="tablist">
                        <li class="nav-item active" role="presentation">
                            <button class="nav-link" id="linking-tab" data-toggle="tab" data-target="#linking" type="button" role="tab">
                                <i class="fas fa-link me-1"></i> Consent request List
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="linking" role="tabpanel">
                            <div class="containers">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header header bg-secondary text-white">
                                        Requested Consent List
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter From Date" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter To date" name="text">
                                            </div>
                                            <button type="submit" class="btn btn-primary ms-3">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Clear</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table id="fhirTable" class="table table-bordered table-striped">
                                            <thead class="table-success text-dark">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Name</th>
                                                    <th>Abha Address</th>
                                                    <th>Abha Number</th>
                                                    <th>DOB/Sex</th>
                                                    <th>Linking Token</th>
                                                    <th>Linking Date</th>
                                                    <th>Auth Mode</th>
                                                    <th>Error</th>
                                                    <th>Linking CC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Bindu</td>
                                                    <td>sahoodebasish1992@abdm</td>
                                                    <td>7878878788</td>
                                                    <td>1981-03-22 / Female</td>
                                                    <td>-</td>
                                                    <td>18-feb-2025</td>
                                                    <td>Demo</td>
                                                    <td></td>
                                                    <td>Unlink</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.nav-tabs-custom -->
</div>




<script>
    $(document).ready(function() {
        $('#fhirTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            responsive: true
        });
    });
</script>