import { HttpRequest } from '../../common/base/api/request.js';
import { __API_CFG__ } from '../../common/base/config/config.js';
import { FunctionUtility } from '../../common/base/utils/utils.js';
import { $GetTabController, $ModalDataDisplayController } from '../../common/core/controllers.js'


const tabConfig = {
    TabSelector: '.nav-link',
    LoadingHtml: '<div style="display: flex; justify-content: center; align-items: center; min-height: 10vh;"><div class="spinner"></div></div>',
    ActiveTabSelector: '.nav-link.active',
    TabContentSelector: '.tab-content',
    updateUrl: true,
    endpoint: `${__API_CFG__.LOCAL_URL}/applications/tab`,
    onSuccess: function (data) {
        document.querySelector('.tab-content').innerHTML = data.html;
        viewDetailEvent();
        increaseCounter();
    },
    onError: function (data) {
        console.log(data);
    },
};
const tabController = new $GetTabController(tabConfig);
tabController.getTabFromUrl();
tabController.initTab();


function viewDetailEvent() {
    new $ModalDataDisplayController({
        modalId: 'applicationDetailsModal',
        endpoint: `${__API_CFG__.LOCAL_URL}/application/get`,
        buttonSelector: '.view-details-btn',
        renderContent: (response) => `
<div class="modal-content">
            <div class="">
                <div class="application-details card shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <div class="detail-item d-flex align-items-center">
                                    <i class="fas fa-signature text-primary me-3 fa-fw"></i>
                                    <div>
                                        <h6 class="detail-label mb-1">Name</h6>
                                        <p class="detail-value mb-0 fw-bold">${response.name || 'N/A'}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item d-flex align-items-center">
                                    <i class="fas fa-code-branch text-success me-3 fa-fw"></i>
                                    <div>
                                        <h6 class="detail-label mb-1">Type</h6>
                                        <p class="detail-value mb-0">${response.type || 'N/A'}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-item d-flex">
                                    <i class="fas fa-align-left text-info me-3 fa-fw mt-1"></i>
                                    <div>
                                        <h6 class="detail-label mb-2">Description</h6>
                                        <p class="detail-value mb-3">${response.description || 'N/A'}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5">
                                <div class="detail-item d-flex">
                                    <i class="fas fa-link text-warning me-3 fa-fw mt-1"></i>
                                    <div>
                                        <h6 class="detail-label mb-2">URL</h6>
                                        <a href="application/${response.url || '#'}" target="_blank" class="app-url text-break fw-bold">Access</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-item d-flex">
                                    <i class="fas fa-list-ul text-danger me-3 fa-fw mt-1"></i>
                                    <div>
                                        <h6 class="detail-label mb-3">Features</h6>
                                        <div class="detail-value features-content">${response.features || 'N/A'}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="detail-item d-flex align-items-center">
                                    <i class="fas fa-eye text-primary me-3 fa-fw"></i>
                                    <div>
                                        <h6 class="detail-label mb-0">Visibility</h6>
                                        <p class="detail-value mb-0">
                                            <span class="badge mt-2 bg-${response.visibility === 'public' ? 'success' : 'warning'}">
                                                ${response.visibility || 'N/A'}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    `,
        // onSuccess: (response) => {
        //     console.log('Application details fetched successfully:', response);
        // },
        onError: (error) => {
            console.error('Error fetching application details:', error);
        },
        onLoading: () => FunctionUtility.getSkeletonLoadingModal()
    });
}

function increaseCounter() {
    let visitBtns = document.querySelectorAll('.btn-visit')
    visitBtns.forEach(element => {
        let id = element.getAttribute('data-id');
        element.addEventListener('click', async () => {
            await HttpRequest.put(`${__API_CFG__.LOCAL_URL}/applications/count/${id}`);
        })
    });
}
