// JS for datatable
import { HttpRequest } from '../../common/base/api/request.js';
import { __API_CFG__ } from '../../common/base/config/config.js'
import { SweetAlert } from '../../common/base/messages/sweetAlert.js';
import { Toast } from '../../common/base/messages/toast.js';
import { FunctionUtility } from '../../common/base/utils/utils.js';
import { $SingleFormPostController, $DatatableController, $ModalFormFetchController, $SingleClickController } from '../../common/core/controllers.js'

const editors = {
    html: createEditor('html', 'htmlmixed', ''),
    css: createEditor('css', 'css', ''),
    js: createEditor('js', 'javascript', '')
};

const createEditors = {
    html: createEditor('html-create', 'htmlmixed', ''),
    css: createEditor('css-create', 'css', ''),
    js: createEditor('js-create', 'javascript', '')
};


function createEditor(id, mode, initialValue) {
    const editor = CodeMirror.fromTextArea(document.getElementById(id), {
        mode: mode,
        theme: 'monokai',
        lineNumbers: true,
        autoCloseBrackets: true,
        matchBrackets: true,
        indentUnit: 4,
        tabSize: 4,
        foldGutter: true,
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
        extraKeys: {
            "Ctrl-Space": "autocomplete",
            "F11": function (cm) {
                cm.setOption("fullScreen", !cm.getOption("fullScreen"));
            },
            "Esc": function (cm) {
                if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
            }
        },
        viewportMargin: Infinity,
        lineWrapping: true
    });

    editor.setValue(initialValue);
    editor.on('change', function () {
        document.getElementById(id).value = editor.getValue();
    });
    editor.refresh();

    // Make the editor take full width
    const editorElement = editor.getWrapperElement();
    editorElement.style.width = '100%';
    editor.refresh();

    return editor;
}

// Add event listeners for real-time preview
Object.values(editors).forEach(editor => {
    editor.on('change', updatePreview);
});

function updatePreview() {
    const htmlContent = editors.html.getValue();
    const cssContent = editors.css.getValue();
    const jsContent = editors.js.getValue();

    const previewFrame = document.getElementById('preview-frame');
    const previewDocument = previewFrame.contentDocument;

    previewDocument.open();
    previewDocument.write(`
        <html>
            <head>
                <style>${cssContent}</style>
            </head>
            <body>
                ${htmlContent}
                <script>
                    try {
                        ${jsContent}
                    } catch (error) {
                        console.error('Error in preview JS:', error);
                    }
                </script>
            </body>
        </html>
    `);
    previewDocument.close();
}

updatePreview();

const applicationDataTable = new $DatatableController('application-datatable', {

    lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, 'All']],

    search: true,
    toggleToolbar: true,
    columnVisibility: true,
    filter: true,
    resetFilter: true,

    selectedAction: (selectedIds) => {
        // note: Perform action on selected IDs (the checked rows)
        // example: console.log('ids: ', selectedIds);
    },

    ajax: {
        url: `${__API_CFG__.LOCAL_URL}/dashboard/application/datatable`,
        data: (d) => ({
            ...d,
            // note: add your data here such as fiter option
            // example: name_with_4_letter: document.querySelector('input[name="name_with_4_letter"]').checked,
        })
    },


    columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'type' },
        { data: 'url' },
        { data: 'visibility' },
        { data: 'status' },
        { data: null },
    ],

    columnDefs: $DatatableController.generateColumnDefs([
        { targets: [0], htmlType: 'selectCheckbox' },
        // note: add your columnDef here
        // example: { targets: [1], htmlType: 'badge', badgeClass: 'badge-light-danger' },
        {
            targets: [3], htmlType: 'link', hrefFunction: (data, type, row) => {
                return data;
            }
        },
        {
            targets: [4], htmlType: 'toggle', dataClassName: 'visibility-toggle',
            checkWhen: (data, type, row) => {
                return data == 'public';
            },
            uncheckWhen: (data, type, row) => {
                return data == 'private';
            },
        },
        {
            targets: [5], htmlType: 'toggle', dataClassName: 'status-toggle',
            checkWhen: (data, type, row) => {
                return data == 'available';
            },
            uncheckWhen: (data, type, row) => {
                return data == 'working_on_it';
            },
        },
        // example: uncheckWhen: (data, type, row) => {
        // example: return data === 'pending';
        // example: },
        // example: },
        { targets: [-1], htmlType: 'actions', className: 'text-end', actionButtons: { edit: true, delete: true, view: true } },
    ]),



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
            // console.log("Show application", id);
        },

        get: async function (id, endpoint, onSuccess, onError) {
            const modalHandler = new $ModalFormFetchController({
                modalId: 'edit-modal',
                endpoint: `${endpoint}`,
                formId: '#edit-application-form',
                quillSelector: '#edit_features_content',
                onSuccess: (data) => {
                    onSuccess(data);
                },
                onError: (error) => {
                    onError(error);
                },
            });

            modalHandler.show(id);
        },

        changeVisibility: async function (endpoint, onSuccess, onError) {
            try {
                const response = await
                    HttpRequest.put(endpoint);
                onSuccess(response);
            } catch (error) {
                onError(error);
            }
        },

        changeStatus: async function (endpoint, onSuccess, onError) {
            try {
                const response = await
                    HttpRequest.put(endpoint);
                onSuccess(response);
            } catch (error) {
                onError(error);
            }
        }
    },


    eventListeners: [
        {
            event: 'click',
            selector: '.visibility-toggle',
            handler: function (id, event) {
                const toggle = event.target;
                this.callCustomFunction('changeVisibility',
                    `${__API_CFG__.LOCAL_URL}/dashboard/application/change-visibility/${id}`,
                    (res) => {
                        Toast.showSuccessToast('', res.message);
                    },
                    (err) => {
                        console.error('Error updating status', err);
                        SweetAlert.error('Failed to update status');
                        toggle.checked = !toggle.checked;
                    }
                );
            }
        },
        {
            event: 'click',
            selector: '.status-toggle',
            handler: function (id, event) {
                const toggle = event.target;
                this.callCustomFunction('changeStatus',
                    `${__API_CFG__.LOCAL_URL}/dashboard/application/change-status/${id}`,
                    (res) => {
                        Toast.showSuccessToast('', res.message);
                    },
                    (err) => {
                        console.error('Error updating status', err);
                        SweetAlert.error('Failed to update status');
                        toggle.checked = !toggle.checked;
                    }
                );
            }
        },
        {
            event: 'click',
            selector: '.delete-btn',
            handler: function (id, event) {
                this.callCustomFunction(
                    'delete',
                    `${__API_CFG__.LOCAL_URL}/dashboard/application/${id}`,
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

                this.callCustomFunction('get',
                    id,
                    `${__API_CFG__.LOCAL_URL}/dashboard/application/get`,
                    (res) => {
                        if (res.codes) {
                            console.log(res)
                            editors.html.setValue(res.codes.html || '');
                            editors.css.setValue(res.codes.css || '');
                            editors.js.setValue(res.codes.js || '');
                            updatePreview();
                        }
                    },
                    (err) => { console.error('Error editing navbar', err); },
                );
            }
        }
    ],

});

function createApplication() {

    var quill = new Quill('#features_content', {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['clean'],
                ['link', 'image', 'video']
            ]
        },
        placeholder: 'Type your text here...',
        theme: 'snow'
    });

    // Set the height of the Quill editor
    const quillContainer = document.querySelector('#features_content');
    quillContainer.style.height = '300px'; // Adjust this value as needed

    // Adjust the Quill editor's content area
    const quillEditor = quillContainer.querySelector('.ql-editor');
    quillEditor.style.minHeight = '250px'; // Adjust this value as needed
    quillEditor.style.maxHeight = '250px'; // Adjust this value as needed
    quillEditor.style.overflowY = 'auto';

    document.getElementById('create-application-button').addEventListener('click', function (event) {
        event.preventDefault();
        const featuresContent = quill.root.innerHTML;
        let feature_content = document.getElementById('features');
        feature_content.value = featuresContent;
    });

    FunctionUtility.closeModalWithButton('create-modal', '.close-modal', () => {
        FunctionUtility.clearForm('#create-application-form');
    });

    const createApplicationConfig = {
        formSelector: '#create-application-form',
        externalButtonSelector: '#create-application-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/application`,
        feedback: true,
        onSuccess: (res) => {
            Toast.showNotificationToast('', res.message)
            FunctionUtility.closeModal('create-modal', () => {
                FunctionUtility.clearForm('#create-application-form');
            });
            applicationDataTable.reload();
        },
        onError: (err) => { console.error('Error adding application', err); },
    };

    const form = new $SingleFormPostController(createApplicationConfig);
    form.init();
}
createApplication();

const editApplication = () => {
    var quill = new Quill('#edit_features_content', {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['clean'],
                ['link', 'image', 'video']
            ]
        },
        placeholder: 'Type your text here...',
        theme: 'snow'
    });

    const quillContainer = document.querySelector('#edit_features_content');
    quillContainer.style.height = '300px'; // Adjust this value as needed

    // Adjust the Quill editor's content area
    const quillEditor = quillContainer.querySelector('.ql-editor');
    quillEditor.style.minHeight = '250px'; // Adjust this value as needed
    quillEditor.style.maxHeight = '250px'; // Adjust this value as needed
    quillEditor.style.overflowY = 'auto';

    document.getElementById('edit-application-button').addEventListener('click', function (event) {
        event.preventDefault();
        const featuresContent = quill.root.innerHTML;
        let feature_content = document.querySelector('.edit_features');
        feature_content.value = featuresContent;
    });

    const editApplicationConfig = {
        formSelector: '#edit-application-form',
        externalButtonSelector: '#edit-application-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/application/edit`,
        feedback: true,
        onSuccess: (res) => {
            console.log(res);
            Toast.showNotificationToast('', res.message)
            FunctionUtility.closeModal('edit-modal', () => {
                FunctionUtility.clearForm('#edit-application-form');
            });
            applicationDataTable.reload();
        },
        onError: (err) => { console.error('Error editing application', err); },
    };

    const form = new $SingleFormPostController(editApplicationConfig);
    form.init();
}
editApplication();


const uploadIcon = () => {
    const uploadIconConfig = {
        formSelector: '#icon-upload-form',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/application/icon/upload`,
        externalButtonSelector: '#icon-upload-button',
        feedback: true,
        onSuccess: (res) => {
            if (res.success) {
                Toast.showNotificationToast('', res.message)
                let html = `
                    <p class="badge d-flex align-items-center gap-2 badge-lg badge-light-primary">
                        ${res.icon_name}
                        <i class="bi bi-x fs-2 delete-icon text-danger cursor-pointer"
                            data-icon="${res.icon_name}"></i>
                    </p>
                `
                document.querySelector('.all-icons-container').innerHTML += html;
                iconDeleteController();
            }
        },
        onError: (err) => {
            console.log(err);
            Toast.showErrorToast(err.response.data.message)
        },
    };

    const form = new $SingleFormPostController(uploadIconConfig);
    form.init();
}

uploadIcon();


const iconDeleteController = () => {
    const deleteIconConfig = {
        clickSelector: '.delete-icon',
        dataAttribute: 'data-icon',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/application/icon/delete`,
        method: 'DELETE',
        onSubmit: async (element, iconName) => {
            element.parentElement.remove();
        },
        onSuccess: (response, element, iconName) => {
            //
        },
        onError: (error, element, iconName) => {
            console.error(`Error deleting icon ${iconName}:`, error);
            Toast.showErrorToast('Failed to delete icon');
        }
    }
    const deleteIcon = new $SingleClickController(deleteIconConfig)
    deleteIcon.init();
}

iconDeleteController();
