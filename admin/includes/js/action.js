"use strict";
var $ = jQuery;
$(function () {
    $(".action").each(function (e, k) {
        var $k = $(k);
        $k.click(function () {
            var action = $k.attr("action");
            if (jn.hasAction(action)) {
                jn.callAction(action);
            }
        });
    });
});
var Actions = /** @class */ (function () {
    function Actions() {
        this.addAction = function (name, callback) {
            if (!this.actions[name]) {
                this.actions[name] = callback;
            }
        };
        this.hasAction = function (name) {
            return Boolean(this.actions[name]);
        };
        this.callAction = function (name) {
            if (this.hasAction(name)) {
                this.actions[name]();
            }
        };
        this.actions = [];
    }
    return Actions;
}());
var jn = new Actions();
jn.addAction("mediaUpload", function () { });
//# sourceMappingURL=action.js.map