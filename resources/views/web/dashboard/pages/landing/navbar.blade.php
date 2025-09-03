@extends('web.dashboard.layouts.dashboard')

@section('title', 'navbar')

@section('toolbar')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">navbar</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="index.html" class="text-muted text-hover-primary">Dashboard</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Table</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection

@section('content')
    <div class="row g-6 g-xl-9">

        {{-- datatable --}}
        <div class="card">
            <div class="card-body">
                <div class="datatable-body mb-5">
                    <div class="d-flex align-items-center position-relative my-1"> <i
                            class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span
                                class="path2"></span></i>
                        <input type="text" data-table-filter="search"
                            class="form-control form-control-solid w-250px ps-15" placeholder="Search Customers" />
                        <div class="column-visibility-container ms-5">
                            <button class="btn btn-icon btn-sm btn-light" type="button" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="bi bi-gear text-warning"></i>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">
                                <div class="px-7 py-5">
                                    <div class="fs-5 fw-bolder">Column Settings</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <div class="px-7 py-5" id="column-toggles">
                                    <!-- Column toggles will be dynamically inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex filter-toolbar flex-wrap align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm create fw-bold btn-primary" data-bs-toggle="modal"
                            data-bs-target="#create-modal">Create</a>
                        <div data-table-toggle-base="base"><!-- Your existing toolbar buttons --></div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center d-none" data-table-toggle-selected="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-table-toggle-select-count="selected_count"></span> Selected
                        </div>
                        <button type="button" class="btn btn-danger" data-table-toggle-action-btn="selected_action">
                            Delete Selected
                        </button>
                    </div>
                </div>
                <table id="navbar-datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input select-all-checkbox" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_datatable_example_1 .row-select-checkbox"
                                        value="1" />
                                </div>
                            </th>
                            <th>label</th>
                            <th>url</th>
                            <th>order</th>
                            <th>visibility</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- logo --}}
    <div class="row mt-5">
        <div class="col-md-6 m-0 p-0 pe-3">
            <div class="card">
                <div class="card-body">
                    <div></div>
                    <h3 class="mb-12">Logo</h3>
                    <form action="" method="post" id="edit-logo-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="alt" class="form-label">Alt</label>
                                    <input type="text" value="{{ $logo['alt'] ?? '' }}" class="form-control"
                                        name="alt" id="alt">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="url" class="form-label">Url</label>
                                    <input type="text" value="{{ $logo['url'] ?? '' }}" class="form-control"
                                        name="url" id="url">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-5">
                            <div class="form-check form-switch d-flex align-items-center gap-4">
                                <input class="form-check-input" type="checkbox" name="visibility" id="visibility"
                                    value="1" {{ isset($logo['visibility']) && $logo['visibility'] ? 'checked' : '' }}
                                    onchange="this.value = this.checked ? 1 : 0;">
                                <label for="visibility" class="form-label mt-2">visible</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" with-spinner="true" class="btn btn-primary" id="edit-logo-button">
                                <span class="ld-span">Save</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Theme --}}
        <div class="col-md-6 m-0 p-0 ps-3">
            <div class="card">
                <div class="card-body">
                    <div></div>
                    <h3 class="mb-12">Theme</h3>
                    <form action="" method="post" id="edit-theme-form">
                        @csrf
                        <div class="mb-5">
                            <label for="theme" class="form-label">Default</label>
                            <select class="form-select" name="default" id="default">
                                <option value="light" {{ ($theme['default'] ?? '') == 'light' ? 'selected' : '' }}>
                                    Light</option>
                                <option value="dark" {{ ($theme['default'] ?? '') == 'dark' ? 'selected' : '' }}>Dark
                                </option>
                            </select>
                        </div>
                        <div class="mb-3 mt-10">
                            <div class="form-check form-switch d-flex align-items-center gap-4">
                                <input class="form-check-input" type="checkbox" name="visibility" id="visibility"
                                    value="1"
                                    {{ isset($theme['visibility']) && $theme['visibility'] ? 'checked' : '' }}
                                    onchange="this.value = this.checked ? 1 : 0;">
                                <label for="visibility" class="form-label mt-2">visible</label>

                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" with-spinner="true" class="btn btn-primary" id="edit-theme-button">
                                <span class="ld-span">Save</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- create modal --}}
    <div class="modal fade" tabindex="-1" id="create-modal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h3 class="modal-title">Create</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 float-end close-modal">
                        <i class="bi bi-x fs-1"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="create-navbar-form">
                        <div class="mb-5">
                            <label for="label" class="form-label">label</label>
                            <input type="text" class="form-control" name="label" id="label">
                        </div>
                        <div class="mb-5">
                            <label for="url" class="form-label">url</label>
                            <input type="text" class="form-control" name="url" id="url">
                        </div>
                        <div class="mb-5">
                            <label for="order" class="form-label">order</label>
                            <input type="text" class="form-control" name="order" id="order">
                        </div>
                        <div class="mb-3">
                            <label for="visibility" class="form-label">visibility</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="visibility" id="visibility"
                                    value="1" checked onchange="this.value = this.checked ? 1 : 0;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn close-modal btn-light">Close</button>
                    <button type="button" with-spinner="true" class="btn btn-primary" id="create-navbar-button">
                        <span class="ld-span">Create</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div class="modal fade" tabindex="-1" id="edit-modal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h3 class="modal-title">Edit</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 float-end close-edit-modal">
                        <i class="bi bi-x fs-1"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2" style="color: #ffc107"></i>
                        <strong>Warning:</strong> Modifying these settings may significantly impact the design and
                        functionality of the navbar. Please proceed with caution.
                    </div>
                    <form id="edit-navbar-form">
                        <input type="hidden" name="id" id="id-edit">
                        <div class="mb-5">
                            <label for="label" class="form-label">label</label>
                            <input type="text" class="form-control" name="label" id="label">
                        </div>
                        <div class="mb-5">
                            <label for="url" class="form-label">url</label>
                            <input type="text" class="form-control" name="url" id="url">
                        </div>
                        <div class="mb-5">
                            <label for="order" class="form-label">order</label>
                            <input type="text" class="form-control" name="order" id="order">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn close-edit-modal btn-light">Close</button>
                    <button type="submit" with-spinner="true" class="btn btn-primary" id="edit-navbar-button"
                        form="edit-navbar-form">
                        <span class="ld-span">Edit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/dashboard/general/navbar.js') }}" type="module"></script>
@endpush
