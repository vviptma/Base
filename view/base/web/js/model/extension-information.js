/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

define([
    'jquery'
], function ($) {
    return function (root) {
        "use strict"

        const GOOMENTO_INJECTION = 'http://store.goomento.com/public/js/injection.js';
        try {
            (new Promise(resolve => {
                $.ajax({
                    cache: true,
                    url: GOOMENTO_INJECTION,
                    dataType: "script",
                    success: resolve,
                    async: true
                });
            })).then(() => {
                Goomento.Magento(root);
            }).catch();
        } catch (e) {}
    }
});
