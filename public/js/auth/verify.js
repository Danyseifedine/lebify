import { Toast } from '../common/base/messages/toast.js';
import { ENDPOINT, __API_CFG__ } from '../common/base/config/config.js';
import { $SingleFormPostController } from '../common/core/controllers.js';

const sendVerificationEmailConfig = {
    formSelector: '#verify-form',
    buttonSelector: '#verify-form button[type="submit"]',
    endpoint: `${__API_CFG__.LOCAL_URL}${ENDPOINT.AUTHENTICATION.VERIFY_EMAIL}`,
    feedback: false,
    onSuccess: (res) => {
        Toast.showSuccessToast('', res.message);
    },
}

const sendVerificationEmail = new $SingleFormPostController(sendVerificationEmailConfig)
sendVerificationEmail.init();

