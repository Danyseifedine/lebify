<div class="row g-6 g-xl-9">
    @foreach ($applications as $application)
        <!--begin::Col-->
        @if ($application->visibility == 'public')
            <div class="col-md-6 col-xl-4">
                <!--begin::Card-->
                <div
                    class="card big-card common-card border-hover-primary {{ $mostVisitedApplication->id == $application->id ? 'most-visited' : '' }}">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-9">
                        <!--begin::Card Title-->
                        <div class="card-title m-0">
                            <!--begin::Avatar-->
                            <div class="symbol p-5 bg-light d-flex justify-content-center align-items-center">
                                <img src="{{ asset('vendor/img/lebify/application-icon/' . $application->icon) }}"
                                    style="height: 37px; width: 37px;" alt="{{ $application->name }}" loading="eager"
                                    decoding="async" class="lebify-scale-up">
                            </div>
                            <!--end::Avatar-->
                        </div>
                        <!--end::Car Title-->

                        <!--begin::Card toolbar-->
                        @if ($mostVisitedApplication->id !== $application->id)
                            <div class="card-toolbar mt-4">
                                <p
                                    class="badge {{ $application->status == 'available' ? 'badge-light-success' : 'badge-light-danger' }} fw-bold px-4 py-3 ">
                                    {{ $application->status == 'available' ? 'Available' : 'Coming Soon' }}</p>
                            </div>
                        @endif
                        <!--end::Card toolbar-->
                    </div>
                    <!--end:: Card header-->

                    <!--begin:: Card body-->
                    <div class="card-body p-9">
                        <!--begin::Name-->
                        @if ($mostVisitedApplication->id == $application->id)
                            <div class="fs-3 fw-bold text-white theme-light-show">
                                {{ $application->name }}
                            </div>
                            <div class="fs-3 fw-bold text-gray-900 theme-dark-show">
                                {{ $application->name }}
                            </div>
                        @else
                            <div class="fs-3 fw-bold text-gray-900">
                                {{ $application->name }}
                            </div>
                        @endif
                        <!--end::Name-->

                        <!--begin::Info-->
                        <div class="d-flex flex-wrap mb-5 mt-5">
                            <!--begin::Due-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                <div
                                    class="fs-6 {{ $mostVisitedApplication->id == $application->id ? 'text-white' : 'text-gray-900' }} fw-bold">
                                    {{ $application->created_at->format('M d, Y') }}
                                </div>
                                <div
                                    class="fw-semibold {{ $mostVisitedApplication->id == $application->id ? 'text-white' : 'text-gray-500' }}">
                                    Released date</div>
                            </div>
                            <!--end::Due-->

                            <!--begin::Budget-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                <div
                                    class="fs-6 fw-bold {{ $mostVisitedApplication->id == $application->id ? 'text-white' : 'text-gray-900' }}">
                                    {{ $application->visitor_count }}</div>
                                <div
                                    class="fw-semibold {{ $mostVisitedApplication->id == $application->id ? 'text-white' : 'text-gray-500' }}">
                                    Visitors</div>
                            </div>
                            <!--end::Budget-->
                        </div>
                        <!--end::Info-->

                        <!--begin::Users-->
                        <div class="d-flex justify-content-between gap-5">
                            <button data-id="{{ $application->id }}" type="submit"
                                class="view-details-btn btn btn-primary">
                                <i class="bi bi-eye fs-3"></i>
                                View Details
                            </button>
                            @if ($application->status == 'available')
                                <a href="application/{{ $application->url }}?visited_click=true" target="_blank"
                                    data-id="{{ $application->id }}"
                                    class="btn btn-visit d-flex align-items-center gap-3 justify-content-center btn-light-primary hover-rotate-end">
                                    <span class="text-white theme-dark-show">Visit</span>
                                    <span class="text-dark theme-light-show">Visit</span>
                                    <i class="bi bi-arrow-right fs-5"></i></a>
                            @endif
                        </div>
                        <!--end::Users-->
                    </div>
                    <!--end:: Card body-->
                </div>
                <!--end::Card-->
            </div>
        @endif
        <!--end::Col-->
    @endforeach

    @if ($applications->isEmpty() || $publicApplicationsCount == 0)
        <div class="col-md-12">
            <div class=" text-center p-9">
                <i class="bi bi-exclamation-circle fs-3x text-warning mb-5 py-5"></i>
                <h3 class="card-title fw-bold text-gray-800 mb-3 mt-5">No Applications Found</h3>
                <p class="text-gray-600 fs-6 mb-5">It looks like there are no applications available at the
                    moment.</p>
            </div>
        </div>
    @endif
</div>

<!-- Modal -->
<div class="modal common-card-modal fade" id="applicationDetailsModal" tabindex="-1"
    aria-labelledby="applicationDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicationDetailsModalLabel">Application Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content will be dynamically loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary" id="visitApplicationBtn">Visit Application</a>
            </div>
        </div>
    </div>
</div>
