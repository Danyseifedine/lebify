import { $SingleFormPostController } from '../common/core/controllers.js';
import { ENDPOINT, __API_CFG__ } from "../common/base/config/config.js";
import { Toast } from '../common/base/messages/toast.js';

const loginConfig = {
    formSelector: '#login-form',
    buttonSelector: '#login-form button[type="submit"]',
    feedback: true,
    endpoint: `${__API_CFG__.LOCAL_URL}${ENDPOINT.AUTHENTICATION.LOGIN}`,
    onSuccess: (res) => {
        if (res.redirect) {
            window.location.href = res.redirect;
        } else {
            Toast.showErrorToast(res.message);
        }
    },
}

const login = new $SingleFormPostController(loginConfig)
login.init();



