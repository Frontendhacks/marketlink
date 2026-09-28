@extends('farmer.master')
@section('title','Farmer Customers')
@section('main')
<div class="mb-4"><h1 class="fw-bold">Customers</h1><p class="text-muted">Customers who have ordered your products.</p></div><div class="card border-0 shadow-sm"><div class="card-body"><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Customer</th><th>Email</th><th>Contact</th><th>Orders With You</th></tr></thead><tbody>@forelse($customers as $customer)<tr><td>{{ $customer->name }}</td><td>{{ $customer->email }}</td><td>{{ $customer->contact ?? '—' }}</td><td>{{ $customer->farmer_orders_count }}</td></tr>@empty<tr><td colspan="4">No customers have ordered your products yet.</td></tr>@endforelse</tbody></table></div></div></div>
@endsection