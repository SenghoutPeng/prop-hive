@extends('layouts.app')

@section('content')
<style>
    .recent-activity {
        background: #f9fafb;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 2rem;
    }
    .recent-activity h2 {
        color: #1a202c;
    }
    #activity-filter {
        min-width: 180px;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 1rem;
    }
    #activity-table-wrapper table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        background: #fff;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    #activity-table-wrapper th, #activity-table-wrapper td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }
    #activity-table-wrapper th {
        background: #f3f4f6;
        font-weight: 600;
        color: #374151;
    }
    #activity-table-wrapper tr:last-child td {
        border-bottom: none;
    }
    #activity-table-wrapper tr:hover {
        background: #f1f5f9;
    }
</style>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Manage your platform efficiently.</p>
    </div>
    <div class="stats-container">
        <div class="stat-card">
            <h2>Total Users</h2>
            <p>{{ $activeUsers }}</p>
        </div>
        <div class="stat-card">
            <h2>Total Sales</h2>
            <p>${{ number_format($totalSales, 2) }}</p>
        </div>
        <div class="stat-card">
            <h2>Total Properties</h2>
            <p>{{ $totalProperties }}</p>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="recent-activity mt-8">
        <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
        <div class="mb-4">
            <label for="activity-filter" class="mr-2">Filter by type:</label>
            <select id="activity-filter" class="border rounded px-2 py-1">
                <option value="all">All</option>
                <option value="payment">Payment</option>
                <option value="utility_payment">Utility Payment</option>
                <option value="tenant_create">Tenant Created</option>
                <option value="tenant_edit">Tenant Edited</option>
                <option value="login">User Login</option>
            </select>
        </div>
        <div id="activity-table-wrapper">
            @include('partials.activity-table', ['activities' => $activities])
        </div>
    </div>
</div>

@push('scripts')
<script>
function setActivityFilterValue() {
    const currentType = document.getElementById('current-activity-type')?.value;
    if (currentType) {
        document.getElementById('activity-filter').value = currentType;
    }
}

document.getElementById('activity-filter').addEventListener('change', function() {
    const type = this.value;
    fetch(`{{ url('/dashboard') }}?activity_type=${type}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.text())
    .then(html => {
        // Extract the activity table from the returned HTML
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const table = doc.getElementById('activity-table-wrapper');
        document.getElementById('activity-table-wrapper').innerHTML = table.innerHTML;
        setActivityFilterValue();
    });
});
// Set filter value on page load (for initial render)
setActivityFilterValue();
</script>
@endpush
@endsection