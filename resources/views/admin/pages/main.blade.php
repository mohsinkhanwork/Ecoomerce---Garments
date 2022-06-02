@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<div class="main-content">
    <div class="row">


        <div class="col-lg-4">
            <div class="card card-body">
                <h6>
                    <span class="text-uppercase">Total Revenue</span>
                    <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
                </h6>
                <br>
                <p class="fs-28 fw-100">$21,642</p>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="text-gray fs-12"><i class="ti-stats-down text-danger mr-1"></i> %18 decrease from last month</div>
            </div>
        </div>




        <div class="col-md-6 col-lg-4">
            <div class="card card-body">
                <h6>
                    <span class="text-uppercase">Average Invoice</span>
                    <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
                </h6>
                <br>
                <p class="fs-28 fw-100">$2,354</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 65%; height: 4px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="text-gray fs-12"><i class="ti-stats-up text-success mr-1"></i> 324 more than last year</div>
            </div>
        </div>




        <div class="col-md-6 col-lg-4">
            <div class="card card-body">
                <h6>
                    <span class="text-uppercase">Orders</span>
                    <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
                </h6>
                <br>
                <p class="fs-28 fw-100">653</p>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 65%; height: 4px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="text-gray fs-12"><i class="ti-stats-down text-danger mr-1"></i> %32 down from last month</div>
            </div>
        </div>



        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><strong>Earnings</strong></h5>
                </div>

                <div class="card-body">
                    <ul class="list-inline text-center gap-items-4 mb-30">
                        <li class="list-inline-item">
                            <span class="badge badge-lg badge-dot mr-1" style="background-color: rgba(51,202,185,1)"></span>
                            <span>Invoices</span>
                        </li>
                        <li class="list-inline-item">
                            <span class="badge badge-lg badge-dot mr-1" style="background-color: rgba(243,245,246,1)"></span>
                            <span>Payments</span>
                        </li>
                    </ul>

                    <canvas id="chartjs-earnings" height="100" data-provide="chartjs"></canvas>
                </div>
            </div>
        </div>






        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><strong>Recent</strong> Payments</h5>
                    <select class="form-control form-control-sm" data-provide="selectpicker" data-width="140">
                        <option>Today</option>
                        <option>Yesterday</option>
                        <option>Last week</option>
                        <option>Last month</option>
                    </select>
                </div>

                <div class="card-body bl-3 border-success flexbox flex-justified">
                    <div>
                        <div class="fs-12 text-muted"><i class="ti-time mr-1"></i> 24 hours</div>
                        <div class="fs-18 text-success">26 Sales</div>
                    </div>

                    <div>
                        <div class="fs-12 text-muted"><i class="ti-time mr-1"></i> 7 days</div>
                        <div class="fs-18 text-danger">134 Sales</div>
                    </div>

                    <div class="fs-40 fw-100 text-right pr-2 text-success">$6,750</div>
                </div>

                <table class="table table-striped table-hover">
                    <tbody>
                    <tr>
                        <td><a class="hover-info" href="#">Web design for Facebook</a></td>
                        <td class="text-muted w-80px">21:53</td>
                        <td class="text-success fw-500 w-90px">+ $1,900</td>
                    </tr>

                    <tr>
                        <td><a class="hover-info" href="#">PSD to HTML for Google</a></td>
                        <td class="text-muted">20:15</td>
                        <td class="text-success fw-500">+ $2,100</td>
                    </tr>

                    <tr>
                        <td><a class="hover-info" href="#">Logo for Instagram</a></td>
                        <td class="text-muted">17:09</td>
                        <td class="text-success fw-500">+ $800</td>
                    </tr>

                    <tr>
                        <td><a class="hover-info" href="#">Page design for Twitter</a></td>
                        <td class="text-muted">14:36</td>
                        <td class="text-success fw-500">+ $1,600</td>
                    </tr>

                    <tr>
                        <td><a class="hover-info" href="#">UI Kit design for Envato</a></td>
                        <td class="text-muted">11:26</td>
                        <td class="text-success fw-500">+ $4,800</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>









        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><strong>Upcoming</strong> Invoices</h5>
                    <a class="btn btn-xs btn-light" href="#">See all</a>
                </div>

                <table class="table table-striped table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#21555</td>
                        <td><a class="hover-primary" href="#">Ranian</a></td>
                        <td>$900</td>
                        <td>25 July</td>
                    </tr>
                    <tr>
                        <td>#26546</td>
                        <td><a class="hover-primary" href="#">Makein</a></td>
                        <td>$2,500</td>
                        <td>21 July</td>
                    </tr>
                    <tr>
                        <td>#24863</td>
                        <td><a class="hover-primary" href="#">Suhan</a></td>
                        <td>$1,900</td>
                        <td>16 July</td>
                    </tr>
                    <tr>
                        <td>#98746</td>
                        <td><a class="hover-primary" href="#">Inamu</a></td>
                        <td>$5,000</td>
                        <td>12 June</td>
                    </tr>
                    <tr>
                        <td>#56585</td>
                        <td><a class="hover-primary" href="#">Finak</a></td>
                        <td>$4,900</td>
                        <td>09 Jan</td>
                    </tr>
                    <tr>
                        <td>#69831</td>
                        <td><a class="hover-primary" href="#">Kurady</a></td>
                        <td>$550</td>
                        <td>20 Dec 2015</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>








    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')