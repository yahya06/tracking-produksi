@push('styles')
    <!-- Custom styles for this page -->
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush



@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <h2>Division Outputs</h2>

    </div>
    <div class="row">
        <div class="col-xl-8 col-md-8 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between ">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Output Production</h6>
                    <a href="{{ route('inputdivisi.create') }}" class="btn btn-primary">Add Division Output</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tgl Input</th>
                                    <th>Code_Product</th>
                                    <th>Product</th>
                                    <th>Division</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tgl Input</th>
                                    <th>Code_Product</th>
                                    <th>Product</th>
                                    <th>Division</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($divisionOutputs as $output)
                                <tr>
                                    <td>{{ $output->input_date }}</td>
                                    <td>{{ $output->products->code_product }}</td>
                                    <td>{{ $output->products->name_product }}</td>
                                    <td>{{ $output->division->name }}</td>
                                    <td class="text-center">{{ $output->unitSize->name }}</td>
                                    <td class="text-center">{{ $output->qty }} Pcs</td>
                                    <td>
                                        <a href="{{ route('inputdivisi.edit', $output->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('inputdivisi.destroy', $output->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");

        const chartLabels = @json($chartData['labels']);
        const chartData = @json($chartData['data']);

        var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
            label: "Product",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: chartData,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'Product'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 6
                },
                maxBarThickness: 25,
            }],
            yAxes: [{
                ticks: {
                min: 0,
                // max: 15000,
                maxTicksLimit: 5,
                padding: 2,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return number_format(value);
                    // return '$' + number_format(value);
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                // return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                }
            }
            },
        }
        });

    </script>

@endpush
