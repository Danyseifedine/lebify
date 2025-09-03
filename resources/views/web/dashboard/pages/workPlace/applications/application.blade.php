@extends('web.dashboard.layouts.dashboard')

@section('title', 'application')


@section('toolbar')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Application</h1>
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
    <style>
        .CodeMirror-wrap {
            min-width: 300% !important;
            width: 300% !important;
        }

        @media (max-width: 768px) {
            .CodeMirror-wrap {
                min-width: 100% !important;
                width: 100% !important;
            }
        }
    </style>
    <div class="row g-6 g-xl-9">
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
                        <div data-table-toggle-base="base">
                            <!-- Your existing toolbar buttons -->
                        </div>
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
                <table id="application-datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input select-all-checkbox" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_datatable_example_1 .row-select-checkbox"
                                        value="1" />
                                </div>
                            </th>
                            <th>name</th>
                            <th>type</th>
                            <th>url</th>
                            <th>visibility</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title mb-4">Application Icon Uploader</h3>

                <div class="alert alert-warning" role="alert">
                    <strong>Important:</strong> For each application you create, you should upload an icon to represent it.
                    This icon will be displayed alongside your application's information.
                </div>
                <form id="icon-upload-form" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="file" name="icon" class="form-control" id="icon">
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" placeholder="Name..." name="name" class="form-control" id="name">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" id="icon-upload-button" loading="Uploading..." class="btn btn-primary mt-3"
                            with-spinner="true">
                            <span class="ld-span">Upload</span>
                        </button>
                    </div>
                </form>
                <div class="d-flex mt-12 justify-content-start align-items-center flex-wrap gap-2 all-icons-container">
                    @foreach ($iconNames as $icon)
                        <p class="badge d-flex align-items-center gap-2 badge-lg badge-light-primary">
                            {{ $icon }}
                            <i class="bi bi-x fs-2 delete-icon text-danger cursor-pointer"
                                data-icon="{{ $icon }}"></i>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- preview frame --}}
    <div class="modal fade" tabindex="-1" id="preview-modal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h3 class="modal-title">Preview</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x fs-2x"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <iframe id="preview-frame" style="width: 100%; height: 1000px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
                    <form id="create-application-form" method="post" action="{{ route('dashboard.application.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="name" class="form-label">name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="developer" class="form-label">developer</label>
                                <input type="text" class="form-control" name="developer_name" id="developer_name">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="type" class="form-label">type</label>
                                <select name="type" id="type" class="form-control">
                                    <option class="text-muted" value="">Select Type...</option>
                                    @foreach ($applicationTypes as $applicationType)
                                        <option value="{{ $applicationType->identifier }}">{{ $applicationType->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6 mt-3">
                                <label for="url" class="form-label">url</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="icon" class="form-label">icon</label>
                                <input type="text" class="form-control" name="icon" id="icon">
                            </div>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="features" class="form-label">features</label>
                            <div id="features_content" name="features_content"></div>
                            <input type="hidden" name="features" id="features">
                        </div>

                        <div class="mb-3 mt-5">
                            <label for="description" class="form-label">description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="col-md-4 mb-3 mt-5">
                            <label for="htmlEditor" class="form-label fw-bold">HTML</label>
                            <textarea id="html-create" class="form-control" name="html"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cssEditor" class="form-label fw-bold">CSS</label>
                            <textarea id="css-create" class="form-control" name="css"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="jsEditor" class="form-label fw-bold">JavaScript</label>
                            <textarea id="js-create" class="form-control" name="js"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="visibility" class="form-label">visibility</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="visibility" id="visibility"
                                    value="public" checked onchange="this.value = this.checked ? 'public' : 'private';">
                            </div>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="status" class="form-label">status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="status"
                                    value="working_on_it"
                                    onchange="this.value = this.checked ? 'available' : 'working_on_it';">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn close-modal btn-light">Close</button>
                    <button type="submit" with-spinner="true" class="btn btn-primary" id="create-application-button">
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
                    <form id="edit-application-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id-edit">
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="name" class="form-label">name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="developer" class="form-label">developer</label>
                                <input type="text" class="form-control" name="developer_name" id="developer_name">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="type" class="form-label">type</label>
                                <select name="type" id="type" class="form-control">
                                    <option class="text-muted" value="">Select Type...</option>
                                    @foreach ($applicationTypes as $applicationType)
                                        <option value="{{ $applicationType->identifier }}">{{ $applicationType->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6 mt-3">
                                <label for="url" class="form-label">url</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="icon" class="form-label">icon</label>
                                <input type="text" class="form-control" name="icon" id="icon">
                            </div>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="features" class="form-label">features</label>
                            <div id="edit_features_content" name="features_content"></div>
                            <input type="hidden" class="edit_features" name="features" id="features">
                        </div>

                        <div class="mb-12 mt-5">
                            <label for="description" class="form-label">description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="col-md-4 mb-3 mt-5">
                            <label for="htmlEditor" class="form-label fw-bold">HTML</label>
                            <textarea id="html" class="form-control" name="html"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cssEditor" class="form-label fw-bold">CSS</label>
                            <textarea id="css" class="form-control" name="css"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="jsEditor" class="form-label fw-bold">JavaScript</label>
                            <textarea id="js" class="form-control" name="js"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn close-edit-modal btn-light">Close</button>
                    <button type="submit" with-spinner="true" class="btn btn-primary" id="edit-application-button">
                        <span class="ld-span">Edit</span>
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#preview-modal">
                        Preview Code
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
    <script src="{{ asset('js/dashboard/applications/application.js') }}" type="module"></script>
@endpush
