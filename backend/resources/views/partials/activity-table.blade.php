@if (!empty($ajaxWrapper))
<div id="activity-table-wrapper">
@endif

<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="px-4 py-2 border-b">Type</th>
            <th class="px-4 py-2 border-b">User</th>
            <th class="px-4 py-2 border-b">Description</th>
            <th class="px-4 py-2 border-b">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($activities as $activity)
            <tr>
                <td class="px-4 py-2 border-b">{{ ucfirst(str_replace('_', ' ', $activity->type)) }}</td>
                <td class="px-4 py-2 border-b">{{ $activity->user ? $activity->user->user_name : 'System' }}</td>
                <td class="px-4 py-2 border-b">{{ $activity->description }}</td>
                <td class="px-4 py-2 border-b">{{ $activity->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-2 text-center">No activity found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
<input type="hidden" id="current-activity-type" value="{{ request('activity_type', 'all') }}">

@if (!empty($ajaxWrapper))
</div>
@endif 