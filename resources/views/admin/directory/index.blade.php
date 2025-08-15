<h2>NGO & Police Directory</h2>
<form method="POST" action="{{ route('admin.directory.store') }}" style="display:flex; gap:6px; flex-wrap:wrap">
  @csrf
  <select name="type"><option value="ngo">NGO</option><option value="police">Police</option></select>
  <input name="name" placeholder="Name" required>
  <input name="phone" placeholder="Phone" required>
  <input name="district" placeholder="District" required>
  <input name="address" placeholder="Address" required>
  <input name="website" placeholder="Website">
  <input name="hours" placeholder="Hours">
  <button>Add</button>
</form>

<table border="1" cellpadding="6" style="margin-top:12px">
  <tr><th>Type</th><th>Name</th><th>Phone</th><th>District</th><th>Address</th><th>Actions</th></tr>
  @foreach($entries as $e)
  <tr>
    <td>{{ strtoupper($e->type) }}</td>
    <td>{{ $e->name }}</td>
    <td>{{ $e->phone }}</td>
    <td>{{ $e->district }}</td>
    <td>{{ $e->address }}</td>
    <td style="display:flex; gap:6px">
      <form method="POST" action="{{ route('admin.directory.update',$e) }}">@csrf @method('PUT') <button>Update</button></form>
      <form method="POST" action="{{ route('admin.directory.destroy',$e) }}" onsubmit="return confirm('Delete entry?')">@csrf @method('DELETE') <button>Delete</button></form>
    </td>
  </tr>
  @endforeach
</table>