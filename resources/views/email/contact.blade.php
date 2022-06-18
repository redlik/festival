<h3>Contact form query</h3>
<p><strong>Email from:</strong> {{ $request->email }}</p>
<p><strong>Name:</strong> {{ $request->name }}</p>
@if ($request->phone)
    <p><strong>Phone:</strong> {{ $request->phone }}</p>
@endif
<strong>Message:</strong></br/>
{{ $request->message }}
