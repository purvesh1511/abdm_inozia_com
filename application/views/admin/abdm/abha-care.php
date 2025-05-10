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
                                <i class="fas fa-link me-1"></i> Linking Token
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="care-tab" data-toggle="tab" data-target="#care" type="button" role="tab">
                                <i class="fas fa-notes-medical me-1"></i> Care Context
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fhir-tab" data-toggle="tab" data-target="#fhir" type="button" role="tab">
                                <i class="fas fa-flask me-1"></i> FHIR Instance
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="context-tab" data-toggle="tab" data-target="#context" type="button" role="tab">
                                <i class="fas fa-bell me-1"></i> Context Notify
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="discovery-tab" data-toggle="tab" data-target="#discovery" type="button" role="tab">
                                <i class="fas fa-search me-1"></i> Data Discovery
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="consent-tab" data-toggle="tab" data-target="#consent" type="button" role="tab">
                                <i class="fas fa-pen me-1"></i> Care Consent
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="response-tab" data-toggle="tab" data-target="#response" type="button" role="tab">
                                <i class="fas fa-bars me-1"></i> Data Response
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
                                        Abha Linking Token
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter email" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter password" name="text">
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
                        <div class="tab-pane fade" id="care" role="tabpanel">
                            <div class="containers">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header header bg-secondary text-white">
                                        Abha Linking Token
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter email" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter password" name="text">
                                            </div>
                                            <button type="submit" class="btn btn-success ms-3">Submit</button>
                                            <button type="reset" class="btn btn-outline-success">Clear</button>
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
                                                    <th>Health ID</th>
                                                    <th>UHID</th>
                                                    <th>Care Ref.</th>
                                                    <th>Care Display</th>
                                                    <th>Patient Ref</th>
                                                    <th>Patient Display</th>
                                                    <th>Linking Status</th>
                                                    <th>Date Time</th>
                                                    <th>Hi Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Bindu</td>
                                                    <td>sahoodebasish1992@abdm</td>
                                                    <td>U-33</td>
                                                    <td>45455545</td>
                                                    <td>OPD</td>
                                                    <td>U-33</td>
                                                    <td>Records for INO4545454</td>
                                                    <td>Success</td>
                                                    <td>18-feb-2025</td>
                                                    <td>Prescription, opd, wellness</td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Makjs</td>
                                                    <td>makjs@abdm</td>
                                                    <td>U-33</td>
                                                    <td>45455545</td>
                                                    <td>OPD</td>
                                                    <td>U-33</td>
                                                    <td>Records for INO4545454</td>
                                                    <td>Success</td>
                                                    <td>18-feb-2025</td>
                                                    <td>Prescription, opd, wellness</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="fhir" role="tabpanel">
                            <div class="containers">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header header bg-secondary text-white">
                                        FHIR Instance
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter email" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter password" name="text">
                                            </div>
                                            <button type="submit" class="btn btn-success ms-3">Submit</button>
                                            <button type="reset" class="btn btn-outline-success">Clear</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table id="fhirTable" class="table table-bordered table-striped">
                                            <thead class="table-success text-dark">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>FHIR ID</th>
                                                    <th>Name</th>
                                                    <th>Health ID</th>
                                                    <th>Care Ref.</th>
                                                    <th>HI Type</th>
                                                    <th>Department</th>
                                                    <th>KEY-ID</th>
                                                    <th>Date Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>FHIR-145</td>
                                                    <td>Debasish Sahoo</td>
                                                    <td>sahoodebasish1992@abdm</td>
                                                    <td>1739859026</td>
                                                    <td>OPConsultation</td>
                                                    <td>GENERAL MEDICINE</td>
                                                    <td>opdId-86</td>
                                                    <td>18-Feb-2025 11:41:47 AM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="context" role="tabpanel">
                            <div class="containers">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header header bg-secondary text-white">
                                        Data Available Notification
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter email" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter password" name="text">
                                            </div>
                                            <button type="submit" class="btn btn-success ms-3">Submit</button>
                                            <button type="reset" class="btn btn-outline-success">Clear</button>
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
                                                    <th>Health ID</th>
                                                    <th>Mobile</th>
                                                    <th>Care Ref.</th>
                                                    <th>HI Type</th>
                                                    <th>SMS</th>
                                                    <th>PHR ACK</th>
                                                    <th>Error</th>
                                                    <th>Date Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Debasish Sahoo</td>
                                                    <td>sahoodebasish1992@abdm</td>
                                                    <td>8787878788</td>
                                                    <td>1739859026</td>
                                                    <td>OPD</td>
                                                    <td></td>
                                                    <td>Success</td>
                                                    <td></td>
                                                    <td>18-Feb-2025 11:41:47 AM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="discovery" role="tabpanel">
                            <div class="containers">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header header bg-secondary text-white">
                                        Data Discovery
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter email" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter password" name="text">
                                            </div>
                                            <button type="submit" class="btn btn-success ms-3">Submit</button>
                                            <button type="reset" class="btn btn-outline-success">Clear</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table id="fhirTable" class="table table-bordered table-striped">
                                            <thead class="table-success text-dark">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Discovery No.</th>
                                                    <th>Name</th>
                                                    <th>Health ID.</th>
                                                    <th>Mobile No.</th>
                                                    <th>Match By</th>
                                                    <th>OTP</th>
                                                    <th>Care Content</th>
                                                    <th>Error</th>
                                                    <th>Status</th>
                                                    <th>Date Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>54554555555</td>
                                                    <td>sahoode basish</td>
                                                    <td>dev@abs</td>
                                                    <td>1739859026</td>
                                                    <td></td>
                                                    <td>454545</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Success</td>
                                                    <td>18-Feb-2025 11:41:47 AM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="consent" role="tabpanel">
                            <div class="containers">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header header bg-secondary text-white">
                                        Abha Care Consent
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter email" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter password" name="text">
                                            </div>
                                            <button type="submit" class="btn btn-success ms-3">Submit</button>
                                            <button type="reset" class="btn btn-outline-success">Clear</button>
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
                                                    <th>Health ID</th>
                                                    <th>Conse ID</th>
                                                    <th>Care Ref</th>
                                                    <th>Status</th>
                                                    <th>Purpose</th>
                                                    <th>Mode</th>
                                                    <th>Date From</th>
                                                    <th>Date To</th>
                                                    <th>Doc</th>
                                                    <th>HIP ID</th>
                                                    <th>Date Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>John Doe</td>
                                                    <td>ABHA1234567890</td>
                                                    <td>CONS456789</td>
                                                    <td>CAREREF987654</td>
                                                    <td>Active</td>
                                                    <td>Treatment</td>
                                                    <td>Online</td>
                                                    <td>2025-04-01</td>
                                                    <td>2025-04-10</td>
                                                    <td>Dr. Smith</td>
                                                    <td>HIP123456</td>
                                                    <td>2025-04-01 10:30 AM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="response" role="tabpanel">
                            <div class="containers">
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header header bg-secondary text-white">
                                        Abha Care Consent
                                    </div>
                                    <div class="card-body bg-light">
                                        <form class="form-inline" action="/action_page.php">
                                            <div class="form-group">
                                                <label for="email">Date From :</label>
                                                <input type="text" class="form-control" id="date_from" placeholder="Enter email" name="date_from">
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Date To :</label>
                                                <input type="text" class="form-control" id="date_to" placeholder="Enter password" name="text">
                                            </div>
                                            <button type="submit" class="btn btn-success ms-3">Submit</button>
                                            <button type="reset" class="btn btn-outline-success">Clear</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table id="fhirTable" class="table table-bordered table-striped">
                                            <thead class="table-success text-dark">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Consent ID</th>
                                                    <th>DataPushURL</th>
                                                    <th>Name</th>
                                                    <th>Abha Address</th>
                                                    <th>Care Ref.</th>
                                                    <th>Encrypt</th>
                                                    <th>Responce HI</th>
                                                    <th>Date Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>CONS123456</td>
                                                    <td>https://hip.example.com/datapush/123</td>
                                                    <td>Alice Sharma</td>
                                                    <td>alice@abdm</td>
                                                    <td>CRF789654</td>
                                                    <td>Yes</td>
                                                    <td>{"bp": "120/80", "sugar": "90mg/dL"}</td>
                                                    <td>2025-04-29 11:45 AM</td>
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