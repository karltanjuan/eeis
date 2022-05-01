<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<h1 class="text-center mt-5 mb-5">Returned CSS Item - &copy; CEIS {{date('Y')}}</h1>
<table class="table table table-bordered table-sm css-borrow-table">
    <thead>
        <tr>
          <th scope="col">Borrower</th>
          <th scope="col">Item</th>
          <th scope="col">Quantity</th>
          <th scope="col">Type</th>
          <th scope="col">Expiration</th>
          <th scope="col">Created</th>
          <th scope="col">Updated</th>
          <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($css as $c_borrow)
        <tr>
            <td>{{ $c_borrow['borrower_name'] }}</td>
            <td>{{ $c_borrow['item_name'] }}</td>
            <td>{{ $c_borrow['quantity'] }}</td>
            <td>{{ $c_borrow['type'] }}</td>
            <td>{{ $c_borrow['expired_at'] == '0000-00-00 00:00:00' ? 'N/A' : date('M d, Y', strtotime($c_borrow['expired_at'])) }}</td>
            <td>{{ $c_borrow['created_at'] }}</td>
            <td>{{ $c_borrow['updated_at'] }}</td>
            <td>{{ $c_borrow['status'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>