@extends('web.layout.main')

@section('title', 'Application')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/project/web/application.css') }}">
    @endpush
    <div class="container-xxl">
        <div class="pt-6">
            <!--begin::Engage widget 1-->
            <div
                class="card app-card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-300px bg-body mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body top-card-application d-flex flex-column justify-content-center ps-lg-12">
                    <!--begin::Title-->
                    <h3 class="text-gray-900 fs-2qx fw-bold mb-7">
                        We are working <br>
                        to create innovative digital solutions
                    </h3>
                    <!--end::Title-->

                    <!--begin::Action-->
                    <div class="m-0">
                        <p class="text-muted fs-6">
                            <span style="font-size: larger;">Empowering businesses with cutting-edge technology<br> to drive
                                growth and innovation in the digital era.</span>
                        </p>
                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 1-->
        </div>

        <div class="">
            <div class="pb-0 px-9">
                <!--begin::Navs-->
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                    <!--begin::Nav item-->
                    @foreach ($applicationTypes as $applicationType)
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary active ms-0 me-10 py-5"
                                tab-name="{{ $applicationType->identifier }}" href="#">
                                {{ $applicationType->label }} ({{ $applicationType->application_count }})</a>
                        </li>
                    @endforeach
                    <!--end::Nav item-->
                </ul>
                <!--begin::Navs-->
            </div>
        </div>
    </div>
    <div class="tab-content mt-12">

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/web/applications/applications.js') }}" type="module"></script>
@endpush
