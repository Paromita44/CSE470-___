<h2>Reports</h2>
<form method="GET" style="display:flex; gap:8px; flex-wrap:wrap">
  <input type="date" name="start_date" value="{{ request('start_date') }}">
  <input type="date" name="end_date" value="{{ request('end_date') }}">
  <input type="text" name="location" placeholder="Location" value="{{ request('location') }}">
  <select name="status">
    <option value="">Any status</option>
    @foreach(['open','under_review','resolved'] as $s)
      <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
    @endforeach
  </select>
  <label><input type="checkbox" name="flagged" value="1" @checked(request('flagged'))> Flagged</label>
  <label><input type="checkbox" name="anonymous" value="1" @checked(request('anonymous'))> Anonymous</label>
  <button>Filter</button>
</form>

<table border="1" cellpadding="6" style="margin-top:12px">
  <tr><th>ID</th><th>Occurred / Created</th><th>Location</th><th>Reporter</th><th>Status</th><th>Flagged</th><th>Actions</th></tr>
  @foreach($reports as $r)
  <tr>
    <td>{{ $r->id }}</td>
    <td>{{ $r->occurred_at ?? $r->created_at }}</td>
    <td>{{ $r->location }}</td>
    <td>{{ ($r->is_anonymous || empty($r->user)) ? 'Anonymous' : $r->user->name }}</td>
    <td>{{ $r->status }}</td>
    <td>{{ $r->flagged ? 'Yes':'No' }}</td>
    <td style="display:flex; gap:6px">
      <form method="POST" action="{{ route('admin.reports.flag',$r) }}">@csrf @method('PATCH') <button>{{ $r->flagged?'Unflag':'Flag' }}</button></form>
      <form method="POST" action="{{ route('admin.reports.status',$r) }}">@csrf @method('PATCH')
        <select name="status">@foreach(['open','under_review','resolved'] as $s)<option value="{{ $s }}" @selected($r->status===$s)>{{ $s }}</option>@endforeach</select>
        <button>Update</button>
      </form>
      <form method="POST" action="{{ route('admin.reports.destroy',$r) }}" onsubmit="return confirm('Delete report?')">
        @csrf @method('DELETE') <button>Delete</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>

{{ $reports->withQueryString()->links() }}