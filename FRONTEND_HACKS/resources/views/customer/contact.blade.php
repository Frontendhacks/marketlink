@extends('customer.master')
@section('main')


<main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                    <h1 class="mb-3">Contact MarketLink</h1>
                    <p class="lead">For project feedback or general questions, use the contact details below. This page
                        is part of the customer interface and can later be connected to a backend contact form.</p>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3"><strong>Email</strong><br>support@marketlink.com</div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3"><strong>Phone</strong><br>+92 300 0000000</div>
                        </div>
                    </div><a href="./index.html" class="btn btn-primary mt-4">Back to Home</a>
                </div>
            </div>
        </div>
    </main>

    @endsection