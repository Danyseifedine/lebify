import { Toast } from '../common/base/messages/toast.js';
import { $SingleFormPostController } from '../common/core/controllers.js';
import { ENDPOINT, __API_CFG__ } from '../common/base/config/config.js';


const sendEmailConfig = {
    formSelector: '#send-email-form',
    buttonSelector: '#send-email-form button[type="submit"]',
    endpoint: `${__API_CFG__.LOCAL_URL}${ENDPOINT.AUTHENTICATION.FORGOT_PASSWORD}`,
    feedback: true,
    onSuccess: (res) => {
        Toast.showSuccessToast('', res.message);
    },
}

const sendEmail = new $SingleFormPostController(sendEmailConfig)
sendEmail.init();

