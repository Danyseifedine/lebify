// JS for datatable
import { HttpRequest } from '../../common/base/api/request.js';
import { __API_CFG__ } from '../../common/base/config/config.js'
import { SweetAlert } from '../../common/base/messages/sweetAlert.js';
import { Toast } from '../../common/base/messages/toast.js';
import { FunctionUtility } from '../../common/base/utils/utils.js';
import { $SingleFormPostController, $DatatableController, $ModalFormFetchController } from '../../common/core/controllers.js'


const navbarDataTable = new $DatatableController('navbar-datatable', {

    lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, 'All']],

    search: true,
    toggleToolbar: false,
    columnVisibility: true,
    filter: true,
    resetFilter: true,
    order: [[3, 'asc']],

    // selectedAction: (selectedIds) => {
    //     // note: Perform action on selected IDs (the checked rows)
    //     console.log('ids: ', selectedIds);
    // },

    ajax: {
        url: `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar/datatable`,
        data: (d) => ({
            ...d,
            // note: add your data here such as fiter option
            // example: name_with_4_letter: document.querySelector('input[name="name_with_4_letter"]').checked,
        })
    },


    columns: [
        { data: 'id' },
        { data: 'label' },
        { data: 'url' },
        { data: 'order' },
        { data: 'visibility' },
        { data: null },
    ],

    columnDefs: $DatatableController.generateColumnDefs([
        { targets: [0], htmlType: 'selectCheckbox' },
        // note: add your columnDef here
        {
            targets: [2], htmlType: 'link',
            hrefFunction: (data, type, row) => {
                return data;
            },
        },
        {
            targets: [3], htmlType: 'badge', orderable: true,
            badgeClass: 'badge-light-warning',
        },
        {
            targets: [4], htmlType: 'toggle', dataClassName: 'visibility-toggle',
            checkWhen: (data, type, row) => {
                return data == true || data == 1;
            },
            uncheckWhen: (data, type, row) => {
                return data == false || data == 0;
            },
        },
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

        // note: edit:
        get: async function (id, endpoint, onSuccess, onError) {
            const modalHandler = new $ModalFormFetchController({
                modalId: 'edit-modal',
                endpoint: `${endpoint}`,
                formId: '#edit-navbar-form',
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
        }
    },


    eventListeners: [
        {
            event: 'click',
            selector: '.visibility-toggle',
            handler: function (id, event) {
                const toggle = event.target;
                this.callCustomFunction('changeVisibility',
                    `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar/change-visibility/${id}`,
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
                    `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar/${id}`,
                    (res) => {
                        if (res.risk) {
                            SweetAlert.error();
                        } else {
                            SweetAlert.deleteSuccess();
                            this.reload();
                        }
                    },
                    (err) => { console.error('Error deleting user', err); },

                );
            }
        },

        {
            event: 'click',
            selector: '.btn-edit',
            handler: function (id, event) {

                this.callCustomFunction('get',
                    id,
                    `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar/get`,
                    (res) => {
                        // console.log('res: ', res);
                    },
                    (err) => { console.error('Error editing navbar', err); },
                );
            }
        }
    ],

});

function createNavbar() {
    FunctionUtility.closeModalWithButton('create-modal', '.close-modal', () => {
        FunctionUtility.clearForm('#create-navbar-form');
    });

    const createNavbarConfig = {
        formSelector: '#create-navbar-form',
        externalButtonSelector: '#create-navbar-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar`,
        feedback: true,
        onSuccess: (res) => {
            Toast.showNotificationToast('', res.message)
            FunctionUtility.closeModal('create-modal', () => {
                FunctionUtility.clearForm('#create-navbar-form');
            });
            navbarDataTable.reload();
        },
        onError: (err) => { console.error('Error adding navbar', err); },
    };

    const form = new $SingleFormPostController(createNavbarConfig);
    form.init();
}
createNavbar();


const editNavbar = () => {
    const editNavbarConfig = {
        formSelector: '#edit-navbar-form',
        externalButtonSelector: '#edit-navbar-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar/edit`,
        feedback: true,
        onSuccess: (res) => {
            Toast.showNotificationToast('', res.message)
            FunctionUtility.closeModal('edit-modal', () => {
                FunctionUtility.clearForm('#edit-navbar-form');
            });
            navbarDataTable.reload();
        },
        onError: (err) => { console.error('Error editing navbar', err); },
    };

    const form = new $SingleFormPostController(editNavbarConfig);
    form.init();
}

editNavbar();

const editNavbarLogo = () => {
    const editNavbarLogoConfig = {
        formSelector: '#edit-logo-form',
        externalButtonSelector: '#edit-logo-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar/update-logo`,
        feedback: true,
        onSuccess: (res) => {
            Toast.showNotificationToast('', res.message)
        },
        onError: (err) => { console.error('Error editing navbar', err); },
    };

    const form = new $SingleFormPostController(editNavbarLogoConfig);
    form.init();
}

editNavbarLogo();

const editNavbarTheme = () => {

    const editNavbarThemeConfig = {
        formSelector: '#edit-theme-form',
        externalButtonSelector: '#edit-theme-button',
        endpoint: `${__API_CFG__.LOCAL_URL}/dashboard/components/navbar/update-theme`,
        feedback: true,
        onSuccess: (res) => {
            Toast.showNotificationToast('', res.message)
        },
        onError: (err) => { console.error('Error editing navbar', err); },
    };

    const form = new $SingleFormPostController(editNavbarThemeConfig);
    form.init();
}

editNavbarTheme();

