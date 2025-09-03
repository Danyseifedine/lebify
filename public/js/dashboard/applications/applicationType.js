// JS for datatable
import { HttpRequest } from '../../common/base/api/request.js';
import { __API_CFG__ } from '../../common/base/config/config.js'
import { SweetAlert } from '../../common/base/messages/sweetAlert.js';
import { Toast } from '../../common/base/messages/toast.js';
import { FunctionUtility } from '../../common/base/utils/utils.js';
import { $SingleFormPostController, $DatatableController, $ModalFormFetchController } from '../../common/core/controllers.js'


const applicationTypeDataTable = new $DatatableController('applicationType-datatable', {

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
        url: `${__API_CFG__.LOCAL_URL}/dashboard/type/application/datatable`,
        data: (d) => ({
            ...d,
            // note: add your data here such as fiter option
            // example: name_with_4_letter: document.querySelector('input[name="name_with_4_letter"]').checked,
        })
    },


    columns: [
        { data: 'id' },
        { data: 'label' },
        { data: 'identifier' },
        { data: 'application_count' },
        { data: null },
    ],

    columnDefs: $DatatableController.generateColumnDefs([
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
        { targets: [-1], htmlType: 'actions', className: 'text-end', actionButtons: { edit: true, delete: true, view: false } },
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
            console.log("Show applicationType", id);
        },

        get: async function (id, endpoint, onSuccess, onError) {
            const modalHandler = new $ModalFormFetchController({
                modalId: 'edit-modal',
                endpoint: `${endpoint}`,
                formId: '#edit-applicationType-form',
                onSuccess: (data) => {
                    onSuccess(data);
                },
                onError: (error) => {
                    onError(error);
                },
            });

            modalHandler.show(id);
        },
    },


    eventListeners: [
        {
            event: 'click',
            selector: '.delete-btn',
            handler: function (id, event) {
                this.callCustomFunction(
                    'delete',
                    `${__API_CFG__.LOCAL_URL}/dashboard/type/application/${id}`,
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
                    `${__API_CFG__.LOCAL_URL}/dashboard/type/application/get`,
                    (res) => {
                        // console.log(res)
                    },
                    (err) => { console.error('Error editing navbar', err); },
                );
            }
        }
    ],

});

function createApplicationType() {
    FunctionUtility.closeModalWithButton('create-modal', '.close-modal', () => {
        FunctionUtility.clearForm('#create-applicationType-form');
    });

    const createApplicationTypeConfig = {
        formSelector: '#create-applicationType-form',
        externalButtonSelector: '#create-applicationType-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/type/application`,
        feedback: true,
        onSuccess: (res) => {
            Toast.showNotificationToast('', res.message)
            FunctionUtility.closeModal('create-modal', () => {
                FunctionUtility.clearForm('#create-applicationType-form');
            });
            applicationTypeDataTable.reload();
        },
        onError: (err) => { console.error('Error adding applicationType', err); },
    };

    const form = new $SingleFormPostController(createApplicationTypeConfig);
    form.init();
}
createApplicationType();


function editApplicationType() {
    const editApplicationTypeConfig = {
        formSelector: '#edit-applicationType-form',
        externalButtonSelector: '#edit-applicationType-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/type/application/edit`,
        feedback: true,
        onSuccess: (res) => {
            Toast.showNotificationToast('', res.message)
            FunctionUtility.closeModal('edit-modal', () => {
                FunctionUtility.clearForm('#edit-applicationType-form');
            });
            applicationTypeDataTable.reload();
        },
        onError: (err) => { Toast.showErrorToast(err.response.data.error) },
    };

    const form = new $SingleFormPostController(editApplicationTypeConfig);
    form.init();
}
editApplicationType();
