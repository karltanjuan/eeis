<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<h1 class="text-center mt-5 mb-5">New EPAS Item - &copy; CEIS {{date('Y')}}</h1>
<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Item Quantity</th>
			<th>Item Status</th>
			<th>Expired At</th>
			<th>Date Created</th>
			<th>Date Update</th>
		</tr>
	</thead>
	<tbody>
		@foreach($epas as $item)
		<tr>
			<td>{{$item->item_name}}</td>
			<td>{{$item->item_quantity}}</td>
			<td>{{$item->item_status}}</td>
			<td>{{$item->expired_at}}</td>
			<td>{{$item->created_at}}</td>
			<td>{{$item->updated_at}}</td>
		</tr>
		@endforeach
	</tbody>
</table>