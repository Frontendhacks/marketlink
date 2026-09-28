@extends('customer.master')
@section('main')


<main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                    <h1 class="mb-3">About MarketLink</h1>
                    <p class="lead">MarketLink is a web platform designed to make it easier for customers to discover
                        local farmers, markets and fresh products in one place. The customer side focuses on browsing
                        products, checking market information and preparing pickup pre-orders.</p>
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