@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4">Trinity Metals Musha Dashboard</h1>

    <div class="row">

        <!-- Low Stock Alerts -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Low Stock Items
                </div>
                <div class="card-body">
                    <h3>{{ $items->count() ?? 0 }}</h3>
                    <ul class="list-unstyled">
                        @foreach($items as $item)
                            <li>{{ $item->name }} ({{ $item->current_stock }} {{ $item->unit }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Production Stats -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    Production (Last 7 Days)
                </div>
                <div class="card-body">
                    <p><strong>Total Ore:</strong> {{ $totalOre }} t</p>
                    <p><strong>Total Waste:</strong> {{ $totalWaste }} t</p>
                    <p><strong>Avg Grade:</strong> {{ number_format($avgGrade,2) }} g/t</p>
                </div>
            </div>
        </div>

        <!-- Equipment Status -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    Equipment Status
                </div>
                <div class="card-body">
                    <p><strong>Active:</strong> {{ $equipmentStatus['active'] ?? 0 }}</p>
                    <p><strong>Down:</strong> {{ $equipmentStatus['down'] ?? 0 }}</p>
                    <p><strong>Maintenance:</strong> {{ $equipmentStatus['maintenance'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Safety Incidents -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    Recent Safety Incidents
                </div>
                <div class="card-body">
                    @if($recentIncidents->isEmpty())
                        <p>No recent incidents</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach($recentIncidents as $incident)
                                <li>
                                    <strong>{{ \Carbon\Carbon::parse($incident->occurred_at)->format('d M') }}:</strong>
                                    {{ $incident->severity }} - {{ Str::limit($incident->description, 40) }}
                                    @if(!$incident->is_resolved)
                                        <span class="badge bg-danger">Open</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <!-- Production Trends Chart -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Production Trends (Last 7 Days)</div>
                <div class="card-body">
                    <canvas id="productionChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Stock Levels Chart -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">Current Stock Levels</div>
                <div class="card-body">
                    <canvas id="stockChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js Scripts -->
<script>
    // Production Chart
    const ctxProd = document.getElementById('productionChart').getContext('2d');
    new Chart(ctxProd, {
        type: 'line',
        data: {
            labels: @json($productionLabels),
            datasets: [
                {
                    label: 'Ore Tonnage',
                    data: @json($oreData),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Waste Tonnage',
                    data: @json($wasteData),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Ore vs Waste' }
            }
        }
    });

    // Stock Chart
    const ctxStock = document.getElementById('stockChart').getContext('2d');
    new Chart(ctxStock, {
        type: 'bar',
        data: {
            labels: @json($stockLabels),
            datasets: [{
                label: 'Current Stock',
                data: @json($stockData),
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Resource Item Stock Levels' }
            },
            scales: {
                x: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
