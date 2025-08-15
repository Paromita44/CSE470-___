<h2>Users</h2>
<form method="GET" style="display:flex; gap:8px">
  <input name="search" placeholder="Name or email" value="{{ request('search') }}">
  <select name="role">
    <option value="">Any role</option>
    <option value="admin" @selected(request('role')==='admin')>Admin</option>
    <option value="user"  @selected(request('role')==='user')>User</option>
  </select>
  <select name="status">
    <option value="">Any status</option>
    <option value="active"   @selected(request('status')==='active')>Active</option>
    <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
  </select>
  <button>Filter</button>
</form>

<table border="1" cellpadding="6" style="margin-top:12px">
  <tr><th>Name</th><th>Email</th><th>Role</th><th>Reports</th><th>Status</th><th>Actions</th></tr>
  @foreach($users as $u)
  <tr>
    <td>{{ $u->name }}</td>
    <td>{{ $u->email }}</td>
    <td>{{ $u->is_admin ? 'Admin' : 'User' }}</td>
    <td>{{ $u->incident_reports_count ?? 0 }}</td>
    <td>{{ ($u->is_active ?? 1) ? 'Active' : 'Disabled' }}</td>
    <td style="display:flex; gap:6px">
      <form method="POST" action="{{ route('admin.users.role',$u) }}">@csrf @method('PATCH') <button>{{ $u->is_admin?'Remove admin':'Make admin' }}</button></form>
      <form method="POST" action="{{ route('admin.users.status',$u) }}">@csrf @method('PATCH') <button>{{ ($u->is_active ?? 1)?'Disable':'Enable' }}</button></form>
    </td>
  </tr>
  @endforeach
</table>

{{ $users->withQueryString()->links() }}