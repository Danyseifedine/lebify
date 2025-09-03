import { __API_CFG__ } from '../../common/base/config/config.js';
import { Toast } from '../../common/base/messages/toast.js';
import { FunctionUtility } from '../../common/base/utils/utils.js';
import { $SingleFormPostController } from '../../common/core/controllers.js'

const sendEmailConfig = {
    formSelector: '#send-message-form',
    buttonSelector: '#send-message-form button[type="submit"]',
    endpoint: `${__API_CFG__.LOCAL_URL}/contact`,
    feedback: true,
    onSuccess: (res) => {
        Toast.showSuccessToast('', res.message);
        FunctionUtility.clearForm('#send-message-form');
    },

    oneError: (res) => {
        console.log(res)
    }
}

const sendEmail = new $SingleFormPostController(sendEmailConfig)
sendEmail.init();
