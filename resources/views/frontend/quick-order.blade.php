@extends('layouts.frontend-layout')
@section('title', 'Quick Order')

@section('content')
<section class="log-in-section background-image-2 section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/prescription-guide.png') }}" class="img-fluid" alt="Prescription Order Image">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h4>Order With Prescription</h4>
                    </div>

                    <div class="input-box">
                        <form class="row g-4">
                            <div class="col-12">
                                <div class="form-floating theme-form-floating log-in-form">
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating theme-form-floating log-in-form">
                                    <input type="number" class="form-control" id="number" placeholder="Number">
                                    <label for="number">Number</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating theme-form-floating log-in-form">
                                    <input type="text" class="form-control" id="instruction" placeholder="Enter Instruction">
                                    <label for="instruction">Enter Instruction</label>
                                </div>
                            </div>

                            <div class="col-12" style="background:white;">
                                <br>
                                <label for="file">Upload Prescription</label><br>
                                <div class="form-floating theme-form-floating log-in-form">
                                    <input type="file" class="form-control" id="file" placeholder="Choose File">
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-animation w-100 justify-content-center" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection