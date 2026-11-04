// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Factory for creating the standard Moodle modal types.
 *
 * @module     core/modal_factory
 * @copyright  2026
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('core/modal_factory', ['jquery', 'core/modal', 'core/modal_cancel', 'core/modal_save_cancel', 'core/modal_delete_cancel', 'core/notification', 'core/templates'], function ($, Modal, ModalCancel, ModalSaveCancel, ModalDeleteCancel, Notification, Templates) {
    var types = {
        CANCEL: 'CANCEL',
        SAVE_CANCEL: 'SAVE_CANCEL',
        DELETE_CANCEL: 'DELETE_CANCEL',
        DEFAULT: 'default'
    };

    var register = function (type, module, template) {
        Modal.register(type, module, template);
    };

    var create = function (config) {
        config = config || {};

        var modalType = config.type || types.DEFAULT;
        var type = modalType;
        var modalModule = Modal;
        var templateName = config.template || null;

        switch (type) {
            case types.CANCEL:
                modalModule = ModalCancel;
                templateName = templateName || 'core/modal_cancel';
                break;
            case types.SAVE_CANCEL:
                modalModule = ModalSaveCancel;
                templateName = templateName || 'core/modal_save_cancel';
                break;
            case types.DELETE_CANCEL:
                modalModule = ModalDeleteCancel;
                templateName = templateName || 'core/modal_delete_cancel';
                break;
            default:
                modalModule = Modal;
                templateName = templateName || 'core/modal';
                break;
        }

        if (!Modal.registry.has(type)) {
            Modal.register(type, modalModule, templateName);
        }

        if (!config.type) {
            config.type = modalType;
        }

        return modalModule.create(config);
    };

    var ModalFactory = {
        types: types,
        create: create,
        createFromTemplate: create,
        register: register,
        default: null
    };

    ModalFactory.default = ModalFactory;

    return ModalFactory;
});
