declare var jQuery: any;
var $ = jQuery;
$(() => {
  $(".action").each((e, k) => {
    var $k = $(k);
    $k.click(() => {
      var action = $k.attr("action");
      if (jn.hasAction(action)) {
        jn.callAction(action);
      }
    });
  });
});

class Actions {
  private actions: any;
  constructor() {
    this.actions = [];
  }
  addAction = function (name: string, callback) {
    if (!this.actions[name]) {
      this.actions[name] = callback;
    }
  };
  hasAction = function (name: string) {
    return Boolean(this.actions[name]);
  };
  callAction = function (name: string) {
    if (this.hasAction(name)) {
      this.actions[name]();
    }
  };
}
var jn = new Actions();

jn.addAction("mediaUpload", () => {});
