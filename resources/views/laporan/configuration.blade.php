@extends('laporan.semua')
@section('menu_laporan')
    <form method="post">
        @csrf
        <div class="tab-content profile-tab-cont">
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#columns">Columns</a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link active" data-toggle="tab" href="#filter_param">Filter & Parameters</a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#groups">Groups</a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#numbers">Numbers</a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#header_footer">Header/Footer</a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#setup_fonts">Setup/Fonts</a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#analysis">Analysis</a> 
                    </li>
                </ul>
            </div>
            <div id="columns" class="tab-pane fade">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title">Available</h5>
                                <hr>
                                <div class="form-group">
                                    <input type="text" name="" id="" class="form-control" placeholder="Cari Sesuatu">
                                </div>
                                <div id="column_available" class="ml-1">
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Akun</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">NType</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Linetype</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Line No</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Deskripsi</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Saldo</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Kolom Hitungan 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title">Used</h5>
                                <hr>
                                <div class="form-group">
                                    <input type="text" name="" id="" class="form-control" placeholder="Cari Sesuatu">
                                </div>
                                <div id="column_used" class="ml-1">
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Akun</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">NType</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Linetype</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Line No</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Deskripsi</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Saldo</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="checkbox" name="" id="">
                                        <label class="h6" for="">Kolom Hitungan 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="filter_param" class="tab-pane fade show active">
                <div class="tab-content profile-tab-cont pt-1">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="tab" href="#selected_column">Selected Column & Filter</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#parameter">Parameter</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="selected_column" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card ">
                                    <div class="card-body">
                                        <h5 class="card-title">Selected Column</h5>
                                        <hr>
                                        <div id="" class="ml-1">
                                            <div class="form-group mb-2">
                                                <input type="checkbox" name="" id="">
                                                <label class="h6" for="">Akun</label>
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="checkbox" name="" id="">
                                                <label class="h6" for="">NType</label>
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="checkbox" name="" id="">
                                                <label class="h6" for="">Linetype</label>
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="checkbox" name="" id="">
                                                <label class="h6" for="">Line No</label>
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="checkbox" name="" id="">
                                                <label class="h6" for="">Deskripsi</label>
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="checkbox" name="" id="">
                                                <label class="h6" for="">Saldo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card ">
                                    <div class="card-body">
                                        <h5 class="card-title">Parameter</h5>
                                        <hr>
                                        <div class="form-group">
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="h6">All</label>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="mr-3 h5">=</label>
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="mr-3 h5">≠</label>
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="mr-3 h5"><</label>
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="mr-3 h5"><=</label>
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="mr-3 h5">></label>
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="mr-3 h5">>=</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="" id="" class="form-control">
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="radio" name="filter" id="">
                                            <label for="" class="mr-3 h6">Between</label>
                                        </div>
                                        <div class="form-group ml-4 mb-1">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="" class="h6">From</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="form-group ml-4">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="" class="h6">To</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="parameter" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="" class="h6">As of</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="date" name="" id="" class="form-control">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="groups" class="tab-pane fade">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Record Data</h5>
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <input type="checkbox" name="" id="">
                                            <label class="h6" for="">Show Only</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <input type="number" class="form-control" name="" id="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <label class="h6" for="">Top Rows</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <input type="checkbox" name="" id="">
                                            <label class="h6" for="">Split Page</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <input type="number" class="form-control" name="" id="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <label class="h6" for="">Columns</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Show Grand Total</label>
                                </div>
                                <hr>
                                <h5 class="card-title mb-2">Grouping</h5>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Auto Indent</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="numbers" class="tab-pane fade">
                <div class="card mb-0">
                    <div class="card-body">
                        <label for="">Format Tanggal</label>
                        <select class="form-select form-control" name="" id="">
                            <option value="">27/01/20</option>
                            <option value="">27/01/2020</option>
                            <option value="">27 Jan 20</option>
                            <option value="">27 Jan 2020</option>
                            <option value="">27 Januari 20</option>
                            <option value="">27 Januari 2020</option>
                            <option value="">Custom Format</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title mb-4">All Numbers</h5>
                                <h6 class="mb-2">Decimal Options</h6>
                                <div class="form-group mb-2">
                                    <input type="radio" name="decimal_options" id="">
                                    <label class="h6" for="">Always With Cents</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="decimal_options" id="">
                                    <label class="h6" for="">With Cents</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="decimal_options" id="">
                                    <label class="h6" for="">Without Cents</label>
                                </div>
                                <hr>
                                <h5 class="card-title mb-2">Negatives</h5>
                                <div class="form-group">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Print In Red</label>
                                </div>
                                <h6 class="mb-2">Negative Sign</h6>
                                <div class="form-group mb-2">
                                    <input type="radio" name="negative_sign" id="">
                                    <label class="h6" for="">Heading Menu Sign -500.00</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="negative_sign" id="">
                                    <label class="h6" for="">Trailing Minus Sign 500.00-</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="negative_sign" id="">
                                    <label class="h6" for="">In Parentheses (500.00)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="h6">Thousand Separator</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="" id="" class="form-control mb-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="h6">Decimal Separator</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="" id="" class="form-control mb-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="h6">Decimal Place</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="" id="" class="form-control mb-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="h6">Divided By</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="" id="" class="form-control mb-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header_footer" class="tab-pane fade">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title">Header Information</h5>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Show Report Header</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Show Company Name</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Report Title (Indonesia)</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Report Title (English)</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Subtitle</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Filtered by</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Show Report Header on Each Page</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Column Title</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Show Column Title on Each Page</label>
                                </div>
                                <hr>
                                <h5 class="card-title">Footer Information</h5>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Show Report Footer</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Printed Date</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Page Number</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="setup_fonts" class="tab-pane fade">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>{Item} Properties:</h5>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-end">Name</p>
                                    </div>
                                    <div class="col-7">
                                        <select name="" id="" class="form-control mb-1">
                                            <option value="">Tahoma</option>
                                            <option value="">Times New Roman</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-end">Size</p>
                                    </div>
                                    <div class="col-7">
                                        <input type="number" name="" id="" class="form-control mb-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-end">Color</p>
                                    </div>
                                    <div class="col-7">
                                        <input type="color" name="" id="" class="form-control mb-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-end">Alignment</p>
                                    </div>
                                    <div class="col-7">
                                        <select name="" id="" class="form-control mb-2">
                                            <option value="">Center</option>
                                            <option value="">Left</option>
                                            <option value="">Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-end">Style</p>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group mb-1">
                                            <input type="checkbox" name="" id="">
                                            <label class="h6" for="">Bold</label>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="checkbox" name="" id="">
                                            <label class="h6" for="">Italic</label>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="checkbox" name="" id="">
                                            <label class="h6" for="">Underline</label>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="checkbox" name="" id="">
                                            <label class="h6" for="">Strikeout</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-end">Paper Size</p>
                                    </div>
                                    <div class="col-7">
                                        <select name="" id="" class="form-control mb-2">
                                            <option value="">A4</option>
                                            <option value="">F4</option>
                                            <option value="">Letter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-end">Orientation</p>
                                    </div>
                                    <div class="col-7">
                                        <select name="" id="" class="form-control mb-2">
                                            <option value="">Potrait</option>
                                            <option value="">Landscape</option>
                                        </select>
                                    </div>
                                </div>
                                <p>Page Margins (mm)</p>
                                <div class="row">
                                    <div class="col-3">
                                        <p class="text-end">Left</p>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="" id="" class="form-control mb-1">
                                    </div>
                                    <div class="col-3">
                                        <p class="text-end">Right</p>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="" id="" class="form-control mb-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <p class="text-end">Top</p>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="" id="" class="form-control mb-1">
                                    </div>
                                    <div class="col-3">
                                        <p class="text-end">Bottom</p>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="" id="" class="form-control mb-2">
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Show Column Centered</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Unlimited Paper Width</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="checkbox" name="" id="">
                                    <label class="h6" for="">Unlimited Paper Height</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="analysis" class="tab-pane fade">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <input type="checkbox" name="" id="">
                            <label class="h6" for="">Show In Pivot Format</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header">
            <div class="mb-15 row align-items-center">
                <div class="col">
                    <div class="">
                        <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                        <a href="{{ route('laporan/pembelian') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection