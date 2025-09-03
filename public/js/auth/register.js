import { $SingleFormPostController } from '../common/core/controllers.js';
import { ENDPOINT, __API_CFG__ } from "../common/base/config/config.js";


const registerConfig = {
    formSelector: '#register-form',
    buttonSelector: '#register-form button[type="submit"]',
    feedback: true,
    endpoint: `${__API_CFG__.LOCAL_URL}${ENDPOINT.AUTHENTICATION.REGISTER}`,

    onSuccess: function (res) {
        window.location.href = res.redirect;
    },
    onError: function (res) {
        console.log(res);
    }
}

const register = new $SingleFormPostController(registerConfig)
register.init();
