<form action="{{ route('getReport') }}" method="post" id="form-report">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <label class="fs-6 form-label fw-bolder text-dark">Настройки Asana</label>
                    <div class="position-relative">
                        <input id="access_token" type="text" class="form-control form-control-solid" name="access_token" value="" required placeholder="Access token">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="fs-6 form-label fw-bolder text-dark">Настройки Toggl</label>
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-4">
                            <input id="email" type="email" class="form-control form-control-solid" name="email" value="" required placeholder="Email">
                        </div>
                        <div class="col-12 col-sm-6 mb-4">
                            <input id="password" type="password" class="form-control form-control-solid" name="password" value="" required placeholder="Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input id="daterangepicker" class="form-control form-control-solid w-100" placeholder="Pick date range" name="dates">
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-8"></div>
            <div class="d-flex align-items-center justify-content-end">
                <input type="submit" class="btn btn-primary" value="Вывести отчет">
            </div>
        </div>
    </div>
</form>
<div class="separator separator-dashed mb-4"></div>
