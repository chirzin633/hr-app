@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="d-block burger-btn d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 py-4-5 card-body">
                                <div class="row">
                                    <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                        <div class="mb-2 stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Profile Views</h6>
                                        <h6 class="mb-0 font-extrabold">112.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 py-4-5 card-body">
                                <div class="row">
                                    <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                        <div class="mb-2 stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Followers</h6>
                                        <h6 class="mb-0 font-extrabold">183.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 py-4-5 card-body">
                                <div class="row">
                                    <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                        <div class="mb-2 stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Following</h6>
                                        <h6 class="mb-0 font-extrabold">80.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 py-4-5 card-body">
                                <div class="row">
                                    <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                        <div class="mb-2 stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Saved Post</h6>
                                        <h6 class="mb-0 font-extrabold">112</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="text-primary bi" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="{{ asset('mazer/dist/assets/static/images/bootstrap-icons.svg') }}#circle-fill" />
                                            </svg>
                                            <h5 class="ms-3 mb-0">Europe</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">862</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-europe"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="text-success bi" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="{{ asset('mazer/dist/assets/static/images/bootstrap-icons.svg') }}#circle-fill" />
                                            </svg>
                                            <h5 class="ms-3 mb-0">America</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">375</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-america"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="text-danger bi" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="{{ asset('mazer/dist/assets/static/images/bootstrap-icons.svg') }}#circle-fill" />
                                            </svg>
                                            <h5 class="ms-3 mb-0">Indonesia</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">1025</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-indonesia"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Comments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{ asset('mazer/dist/assets/compiled/jpg/5.jpg') }}">
                                                        </div>
                                                        <p class="ms-3 mb-0 font-bold">Si Cantik</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class="mb-0">Congratulations on your graduation!</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="px-4 py-4 card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">John Duck</h5>
                                <h6 class="mb-0 text-muted">@johnducky</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Messages</h4>
                    </div>
                    <div class="pb-4 card-content">
                        <div class="d-flex px-4 py-3 recent-message">
                            <div class="avatar avatar-lg">
                                <img src="{{ asset('mazer/dist/assets/compiled/jpg/4.jpg') }}">
                            </div>
                            <div class="ms-4 name">
                                <h5 class="mb-1">Hank Schrader</h5>
                                <h6 class="mb-0 text-muted">@johnducky</h6>
                            </div>
                        </div>

                        <div class="px-4">
                            <button class='btn-block mt-3 btn-outline-primary font-bold btn btn-xl'>Start
                                Conversation</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Visitors Profile</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
