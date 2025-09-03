<?php

namespace App\Console\Commands\Datatable;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateDatatable extends Command
{
    protected $signature = 'create:datatable {name} {--js-path=} {--view-path=}';

    protected $description = 'Create a new datatable with associated JS and view files';

    protected $features = [
        'header' => 'Include header?',
        'create' => 'Include create functionality?',
        'create-modal' => 'Include create modal?',
        'search' => 'Include search functionality?',
        'filter' => 'Include filter functionality?',
        'columnVisibility' => 'Include column visibility toggle?',
        'checkbox' => 'Include checkbox functionality?',
    ];

    protected $selectedFeatures = [];
    protected $columns = [];


    public function handle()
    {
        $name = $this->argument('name');
        $jsPath = $this->option('js-path') ?? '';
        $viewPath = $this->option('view-path') ?? '';

        $this->selectedFeatures = $this->askForFeatures();
        $this->columns = $this->askForColumns();


        $this->createJsFile($name, $jsPath);
        $this->createViewFile($name, $viewPath, $jsPath);
        $this->createNoteFile($name);
        $this->createControllerNoteFile($name);

        $this->info("Datatable '{$name}' created successfully!");
    }

    protected function askForFeatures()
    {
        return collect($this->features)
            ->filter(fn ($question, $feature) => $this->confirm($question, true))
            ->keys()
            ->toArray();
    }


    protected function askForColumns()
    {
        $columns = [];
        while (true) {
            $columnName = $this->ask('Enter column name (or press enter to finish)');
            if (empty($columnName)) {
                break;
            }
            $columns[] = $columnName;
        }
        return $columns;
    }

    protected function createJsFile($name, $path)
    {
        $jsPath = "public/js/{$path}";
        $jsContent = $this->generateJsContent($name);

        $this->createFile("{$jsPath}/{$name}.js", $jsContent);
    }

    protected function createViewFile($name, $path, $jsPath)
    {
        $viewPath = "resources/views/{$path}";
        $viewContent = $this->generateViewContent($name, $jsPath);

        $this->createFile("{$viewPath}/{$name}.blade.php", $viewContent);
    }

    protected function createFile($path, $content)
    {
        File::makeDirectory(dirname($path), 0755, true, true);
        File::put($path, $content);

        $this->info("File created at: {$path}");
    }

    protected function generateJsContent($name)
    {
        $upperName = ucfirst($name);

        $js = <<<'JS'
        // JS for datatable
        JS;

        $js .= <<<'JS'

import { HttpRequest } from '../../common/base/api/request.js';
import { __API_CFG__ } from '../../common/base/config/config.js'
import { SweetAlert } from '../../common/base/messages/sweetAlert.js';
import { Toast } from '../../common/base/messages/toast.js';
import { FunctionUtility } from '../../common/base/utils/utils.js';
import { $SingleFormPostController, $DatatableController } from '../../common/core/controllers.js'

JS;

        $js .= "\n\nconst {$name}DataTable = new \$DatatableController('{$name}-datatable', {\n\n";

        $js .= "    lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, 'All']],\n\n";

        if (in_array('search', $this->selectedFeatures)) {
            $js .= "    search: true,\n";
        }
        if (in_array('checkbox', $this->selectedFeatures)) {
            $js .= "    toggleToolbar: true,\n";
        }
        if (in_array('columnVisibility', $this->selectedFeatures)) {
            $js .= "    columnVisibility: true,\n";
        }
        if (in_array('filter', $this->selectedFeatures)) {
            $js .= "    filter: true,\n";
            $js .= "    resetFilter: true,\n\n";
        }

        if (in_array('checkbox', $this->selectedFeatures)) {
            $js .= <<<JS
                selectedAction: (selectedIds) => {
                    // note: Perform action on selected IDs (the checked rows)
                    // example: console.log('ids: ', selectedIds);
                },\n\n
            JS;
        }

        $js .= <<<JS
        ajax: {
            url: `\${__API_CFG__.BASE_URL}/dashboard/{$name}/datatable`,
            data: (d) => ({
                ...d,
                // note: add your data here such as fiter option
                // example: name_with_4_letter: document.querySelector('input[name="name_with_4_letter"]').checked,
            })
        },\n\n

        JS;

        $js .= "columns: [\n";
        $js .= "    { data: 'id' },\n";
        foreach ($this->columns as $column) {
            $js .= "    { data: '{$column}' },\n";
        }
        $js .= "    { data: null },\n";
        $js .= "],\n\n";

        $js .= <<<JS
        columnDefs: \$DatatableController.generateColumnDefs([
            { targets: [0], htmlType: 'selectCheckbox' },
            // note: add your columnDef here
            // example: { targets: [1], htmlType: 'badge', badgeClass: 'badge-light-danger' },
            // example: {
            // example: targets: [4], htmlType: 'toggle',
            // example: checkWhen: (data, type, row) => {
            // example: return data === 'in';
            // example: },
            // example: uncheckWhen: (data, type, row) => {
            // example: return data === 'pending';
            // example: },
            // example: },
            { targets: [-1], htmlType: 'actions', className: 'text-end', actionButtons: { edit: true, delete: true, view: true } },
        ]),\n\n

    // note: built-in function:
        customFunctions: {

            // note delete, show, edit
            delete: async function (endpoint, onSuccess, onError) {
                try {
                    const result = await SweetAlert.deleteAction();
                    if (result) {
                        const response = await HttpRequest.del(endpoint);
                        onSuccess(response);
                    }
                } catch (error) {
                    onError(error);
                }
            },

            // note: show:
            show: async function (id, endpoint, onSuccess, onError) {
                console.log("Show {$name}", id);
            },

            // note: edit:
            edit: async function (id, endpoint, onSuccess, onError) {
                console.log("Edit {$name}", id);
            },
        },


        eventListeners: [
            {
                event: 'click',
                selector: '.delete-btn',
                handler: function (id, event) {
                    this.callCustomFunction(
                        'delete',
                        `\${__API_CFG__.BASE_URL}/dashboard/{$name}/\${id}`,
                        (res) => {
                            if (res.risk) {
                                SweetAlert.error();
                            } else {
                                SweetAlert.deleteSuccess();
                                this.reload();
                            }
                        },
                        (err) => { console.error('Error deleting user', err); }
                    );
                }
            },
            {
                event: 'click',
                selector: '.btn-show',
                handler: function (id, event) {
                    this.callCustomFunction('show', id);
                }
            },
            {
                event: 'click',
                selector: '.btn-edit',
                handler: function (id, event) {
                    this.callCustomFunction('edit', id);
                }
            }
        ],
    JS;
        $js .= "\n\n});\n\n";

        $js .= <<<JS
    function create{$upperName}() {
        FunctionUtility.closeModalWithButton('create-modal', '.close-modal', () => {
            FunctionUtility.clearForm('#create-{$name}-form');
        });

        const create{$upperName}Config = {
            formSelector: '#create-{$name}-form',
            externalButtonSelector: '#create-{$name}-button',
            endpoint: `\${__API_CFG__.BASE_URL}/dashboard/{$name}`,
            feedback: true,
            onSuccess: (res) => {
                Toast.showNotificationToast('', res.message)
                FunctionUtility.closeModal('create-modal', () => {
                    FunctionUtility.clearForm('#create-{$name}-form');
                });
                {$name}DataTable.reload();
            },
            onError: (err) => { console.error('Error adding {$name}', err); },
        };

        const form = new \$SingleFormPostController(create{$upperName}Config);
        form.init();
    }
    create{$upperName}();
    JS;
        return $js;
    }


    protected function generateViewContent($name, $jsPath)
    {
        $content = "@extends('layouts.dashboard')\n\n@section('title', '{$name}')\n\n";
        if (in_array('header', $this->selectedFeatures)) {
            $content .= "\n" . $this->addHeader($name) . "\n\n";
        }
        $content .= "@section('content')\n";
        $content .= $this->getCardOpeningHtml();

        if (in_array('search', $this->selectedFeatures) || in_array('columnVisibility', $this->selectedFeatures)) {
            $content .= $this->getCombinedSearchAndVisibilityHtml();
        }

        if (in_array('filter', $this->selectedFeatures) || in_array('create', $this->selectedFeatures)) {
            $content .= $this->getCombinedFilterAndCreateHtml();
        }

        if (in_array('checkbox', $this->selectedFeatures)) {
            $content .= $this->checkboxToolbar();
        }

        $content .= $this->getTableHtml($name);
        $content .= $this->getCardClosingHtml();

        if (in_array('create-modal', $this->selectedFeatures)) {
            $content .= $this->getCreateModalHtml($name);
        }

        $content .= "@endsection\n\n";
        $content .= $this->addScripts($jsPath, $name);
        return $content;
    }

    protected function getCardOpeningHtml()
    {
        return <<<HTML
            <div class="row g-6 g-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="datatable-body mb-5">

HTML;
    }

    protected function getCombinedFilterAndCreateHtml()
    {
        $html = '<div class="d-flex filter-toolbar flex-wrap align-items-center gap-2 gap-lg-3">';

        if (in_array('filter', $this->selectedFeatures)) {
            $html .= <<<HTML
        <div class="m-0">
            <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>Filter
            </a>
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="filter-menu" style="">
                <div class="px-7 py-5">
                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                </div>
                <div class="separator border-gray-200"></div>
                <div class="px-7 py-5">
                    <div class="mb-10">
                        <label class="form-label fw-semibold">Name:</label>
                        <div class="d-flex">
                            <!-- start of option in here -->
                            <!-- example: -->
                            <!-- <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" name="name_with_4_letter" value="4_letter">
                                <span class="form-check-label">4 letter</span>
                            </label> -->
                            <!-- end of option -->
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button data-kt-docs-table-filter="reset" type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-table-reset="filter" data-kt-menu-dismiss="true">Reset</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true" data-table-filter="filter">Apply</button>
                    </div>
                </div>
            </div>
        </div>
HTML;
        }

        if (in_array('create', $this->selectedFeatures)) {
            $html .= <<<HTML
        <a href="#" class="btn btn-sm create fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">Create</a>
HTML;
        }

        $html .= '<div data-table-toggle-base="base"><!-- Your existing toolbar buttons --></div>';
        $html .= '</div>';

        return $html;
    }

    protected function getCombinedSearchAndVisibilityHtml()
    {
        $html = '<div class="d-flex align-items-center position-relative my-1">';

        if (in_array('search', $this->selectedFeatures)) {
            $html .= <<<HTML
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input type="text" data-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Customers" />
    HTML;
        }

        if (in_array('columnVisibility', $this->selectedFeatures)) {
            $html .= <<<HTML
                <div class="column-visibility-container ms-5">
                    <button class="btn btn-icon btn-sm btn-light" type="button" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
    HTML;
        }

        $html .= '</div>';

        return $html;
    }

    protected function checkboxToolbar()
    {
        if (in_array('checkbox', $this->selectedFeatures)) {

            $html = <<<HTML
        <div class="d-flex justify-content-end align-items-center d-none" data-table-toggle-selected="selected">
            <div class="fw-bold me-5">
                <span class="me-2" data-table-toggle-select-count="selected_count"></span> Selected
            </div>
            <button type="button" class="btn btn-danger" data-table-toggle-action-btn="selected_action">
                Delete Selected
            </button>
        </div>
        HTML;
        }

        return $html;
    }

    protected function getTableHtml($name)
    {
        $html = <<<HTML
            </div>
            <table id="{$name}-datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input select-all-checkbox" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_datatable_example_1 .row-select-checkbox"
                                    value="1" />
                            </div>
                        </th>
        HTML;

        foreach ($this->columns as $column) {
            $html .= "\n                    <th>{$column}</th>";
        }

        $html .= <<<HTML

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                </tbody>
            </table>

        HTML;

        return $html;
    }

    protected function getCardClosingHtml()
    {
        return <<<HTML
        </div>
    </div>
</div>
HTML;
    }

    protected function getCreateModalHtml($name)
    {
        if (in_array('create-modal', $this->selectedFeatures)) {
            $formFields = '';
            foreach ($this->columns as $column) {
                $formFields .= <<<HTML
                <div class="mb-3">
                    <label for="{$column}" class="form-label">{$column}</label>
                    <input type="text" class="form-control" name="{$column}" id="{$column}">
                </div>
                HTML;
            }

            $html = <<<HTML
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
                            <form id="create-{$name}-form">
                                {$formFields}
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn close-modal btn-light">Close</button>
                            <button type="button" with-spinner="true" class="btn btn-primary" id="create-{$name}-button">
                                <span class="ld-span">Create</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            HTML;
        }
        return $html ?? '';
    }


    protected function addScripts($jsPath, $name)
    {
        return <<<HTML
    @push('scripts')
        <script src="{{ asset('js/{$jsPath}/{$name}.js') }}" type="module"></script>
    @endpush
HTML;
    }


    protected function addHeader($name)
    {
        if (in_array('header', $this->selectedFeatures)) {
            $html = <<<HTML
@section('toolbar')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">{$name}</h1>
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
HTML;
        }
        return $html;
    }


    protected function createNoteFile($name)
    {
        $notePath = base_path("note/{$name}");
        if (!File::isDirectory($notePath)) {
            File::makeDirectory($notePath, 0755, true);
        }

        $filePath = "{$notePath}/{$name}_datatable_info.txt";

        $content = "Datatable: {$name}\n";
        $content .= "Created at: " . now()->toDateTimeString() . "\n\n";
        $content .= "Selected Features:\n";
        foreach ($this->selectedFeatures as $feature) {
            $content .= "- " . ucfirst($feature) . "\n";
        }
        $content .= "\nColumns:\n";
        foreach ($this->columns as $column) {
            $content .= "- {$column}\n";
        }
        $content .= "\nJS File: public/js/{$this->option('js-path')}/{$name}.js\n";
        $content .= "View File: resources/views/{$this->option('view-path')}/{$name}.blade.php\n";

        File::put($filePath, $content);

        $this->info("Detailed note file created at: {$filePath}");
    }

    protected function createControllerNoteFile($name)
    {
        $notePath = base_path("note/{$name}");
        if (!File::isDirectory($notePath)) {
            File::makeDirectory($notePath, 0755, true);
        }

        $filePath = "{$notePath}/{$name}Controller.txt";

        $content = $this->generateControllerContent($name);
        $content .= "\n\n" . $this->generateRouteContent($name);

        File::put($filePath, $content);

        $this->info("Controller note file created at: {$filePath}");
    }

    protected function generateControllerContent($name)
    {
        $modelName = ucfirst($name);
        $viewName = strtolower($name);

        $content = <<<PHP
    <?php

    namespace App\Http\Controllers;

    use App\Models\\{$modelName};
    use Illuminate\Http\Request;
    use Yajra\DataTables\Facades\DataTables;

    class {$modelName}Controller extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            \$user = auth()->user();
            return view('dashboard.pages.{$viewName}', compact('user'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request \$request)
        {
            \$request->validate([

    PHP;

        foreach ($this->columns as $column) {
            $content .= "            '{$column}' => 'required|string',\n";
        }

        $content .= <<<PHP
            ]);

            {$modelName}::create(\$request->all());
            return response()->json(['message' => '{$modelName} created successfully']);
        }

        /**
         * Display the specified resource.
         */
        public function show(string \$id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string \$id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request \$request, string \$id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string \$id)
        {
            \${$viewName} = {$modelName}::find(\$id);
            \${$viewName}->delete();
            return response()->json(['message' => '{$modelName} deleted successfully']);
        }

        public function datatable(Request \$request)
        {
            \$search = request()->get('search');
            \$value = isset(\$search['value']) ? \$search['value'] : null;

            \${$viewName}s = {$modelName}::select('id',

    PHP;

        $content .= "'" . implode("', '", $this->columns) . "', 'created_at')\n";

        $content .= <<<PHP
                ->when(\$value, function (\$query) use (\$value) {
                    return \$query->where(function (\$query) use (\$value) {

    PHP;

        foreach ($this->columns as $index => $column) {
            $content .= $index === 0
                ? "                    \$query->where('{$column}', 'like', '%' . \$value . '%')\n"
                : "                        ->orWhere('{$column}', 'like', '%' . \$value . '%')\n";
        }

        $content .= <<<PHP
                    });
                });

            return DataTables::of(\${$viewName}s->get())
                ->editColumn('created_at', function (\${$viewName}) {
                    return \${$viewName}->created_at->diffForHumans();
                })->make(true);
        }
    }
    PHP;

        return $content;
    }


    protected function generateRouteContent($name)
    {
        $controllerName = ucfirst($name) . 'Controller';
        $routeName = strtolower($name);

        return <<<PHP
Route::controller({$controllerName}::class)->group(function () {
    Route::get('{$routeName}/datatable', 'datatable')->name('{$routeName}.datatable');
    Route::resource('{$routeName}', {$controllerName}::class);
});
PHP;
    }
}
