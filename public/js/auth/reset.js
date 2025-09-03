import { ENDPOINT, __API_CFG__ } from "../common/base/config/config.js";
import { $SingleFormPostController } from "../common/core/controllers.js";

let resetConfig = {
    formSelector: '#reset-form',
    buttonSelector: '#reset-form button[type="submit"]',
    endpoint: `${__API_CFG__.LOCAL_URL}${ENDPOINT.AUTHENTICATION.RESET_PASSWORD}`,
    feedback: true,

    onSuccess: (res) => {
        window.location.href = res.redirect;
    },

    onError: (error) => {
        console.log(error);
    }
}

let reset = new $SingleFormPostController(resetConfig)
reset.init();

