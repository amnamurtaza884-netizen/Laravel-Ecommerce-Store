<h1>Admin Dashboard</h1>

<h3>Customers</h3>
<table class="table table-bordered">
@foreach($customers as $c)
<tr>
<td>{{ $c->name }}</td>
<td>{{ $c->email }}</td>
<td>{{ $c->message }}</td>
</tr>
@endforeach
</table>

<h3>Orders</h3>
<table class="table table-bordered">
@foreach($orders as $o)
<tr>
<td>{{ $o->product_name }}</td>
<td>{{ $o->quantity }}</td>
<td>
<form method="POST" action="/update-status/{{ $o->id }}">
@csrf
<select name="status">
<option>pending</option>
<option>shipped</option>
<option>completed</option>
</select>
<button>Update</button>
</form>
</td>
</tr>
@endforeach
</table>