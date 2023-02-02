<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lacak</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('themes/sneat/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <style>
        ul.timeline-list {
            position: relative;
            margin: 0;
            padding: 0
        }
        ul.timeline-list:before {
            position: absolute;
            content: "";
            width: 2px;
            height: 100%;
            background-color: #233446;
            left: 50%;
            top: 0;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
        }
        ul.timeline-list li {
            position: relative;
            clear: both;
            display: table;
        }
        .timeline_content {
            border: 2px solid #233446;
            background-color:#fff
        }
        ul.timeline-list li .timeline_content {
            width: 45%;
            padding: 30px;
            float: left;
            text-align: right;
        }
        ul.timeline-list li:nth-child(2n) .timeline_content {
            float: right;
            text-align: left;
        }
        .timeline_content h4 {
            font-size: 22px;
            font-weight: 600;
            margin: 10px 0;
        }
        ul.timeline-list li:before {
            position: absolute;
            content: "";
            width: 25px;
            height: 25px;
            background-color: #233446;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }
        .timeline_content span {
            font-size: 18px;
        }
    </style>
    <script src="{{asset('themes/sneat/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('themes/sneat/js/config.js')}}"></script>

</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-end mb-4">
                <a href="{{route('login')}}" class="btn btn-dark">Login</a>
            </div>
            <div class="card mb-4 p-4">
                <h5 class="card-header bg-dark text-white">Lacak CMF</h5>
                <div class="card-body mb-4">
                    <div class="my-4">
                        <form action="{{route('cmf.lacak')}}" method="get">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="no_cmf" class="form-label">No CMF</label>
                                <input type="text" name="no_cmf" id="no_cmf" class="form-control form-control-lg" placeholder="Masukkan No CMF" value="{{old('no_cmf')}}">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">Lacak</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body mb-4">
                    @if($cmf)
                        <div class="alert alert-success mb-4">CMF Ditemukan</div>
                            <ol class="list-group list-group-numbered">
                            @foreach($cmf->signatures as $signature)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold {{$signature->is_signature == 1 ? 'text-success' : ''}}">{{$signature->keterangan}}</div>
                                            @if($signature->catatan != null)
                                                {{$signature->catatan}}
                                            @else
                                                @if($signature->review != null)
                                                    {{$signature->review->review}}
                                                @endif
                                                @if($signature->evaluation != null)
                                                    {{$signature->evaluation->evaluasi}}
                                                @endif
                                            @endif
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{$signature->created_at->format('d M Y H:i:s')}}</span>
                                    </li>
                                    @endforeach
                                </ol>
                    @else
                        <div class="alert alert-danger">CMF Tidak Ditemukan</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('themes/sneat/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('themes/sneat/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('themes/sneat/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('themes/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('themes/sneat/vendor/js/menu.js')}}"></script>
<script src="{{asset('themes/sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('themes/sneat/js/main.js')}}"></script>
<script src="{{asset('themes/sneat/js/dashboards-analytics.js')}}"></script>

</body>
</html>
