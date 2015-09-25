(function() {
  var CardReader, base,
    bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    hasProp = {}.hasOwnProperty;

  CardReader = (function(superClass) {
    extend(CardReader, superClass);

    function CardReader() {
      this.keypress = bind(this.keypress, this);
      return CardReader.__super__.constructor.apply(this, arguments);
    }

    CardReader.prototype.error_start = "é";

    CardReader.prototype.track_start = ";";

    CardReader.prototype.track_end = "?";

    CardReader.prototype.enter = 13;

    CardReader.prototype.timeout = 50;

    CardReader.prototype.started = false;

    CardReader.prototype.finished = false;

    CardReader.prototype.is_error = false;

    CardReader.prototype.buffer = "";

    CardReader.prototype.initialize = function() {
      this.$el = $(window);
      this.error_start = this.error_start.charCodeAt(0);
      this.track_start = this.track_start.charCodeAt(0);
      this.track_end = this.track_end.charCodeAt(0);
      return this.$el.keypress(this.keypress);
    };

    CardReader.prototype.keypress = function(e) {
      if (!this.started) {
        return this.notStartedKeyPress(e);
      } else {
        return this.startedKeyPress(e);
      }
    };

    CardReader.prototype.dispatch = function(string, is_error) {
      while (string.charAt(0) === '9' || string.charAt(0) === '0') {
        string = string.substr(1);
      }
      string = string.slice(0, -1);
      if (is_error) {
        return this.trigger('error', string);
      } else {
        return this.trigger('read', string);
      }
    };

    CardReader.prototype.notStartedKeyPress = function(e) {
      if (e.which === this.track_start || e.which === this.error_start) {
        this.started = true;
        return this.isError = e.which === this.error_start;
      }
    };

    CardReader.prototype.startedKeyPress = function(e) {
      this.stopEvent(e);
      if (this.finished && e.which === this.enter) {
        this.dispatch(this.buffer, this.isError);
        this.clearTimeout();
        return this.reset();
      } else if (e.which === this.track_end) {
        this.finished = true;
        return this.resetTimeout();
      } else {
        this.buffer += String.fromCharCode(e.which);
        return this.resetTimeout();
      }
    };

    CardReader.prototype.stopEvent = function(e) {
      e.stopImmediatePropagation();
      return e.preventDefault();
    };

    CardReader.prototype.clearTimeout = function() {
      return clearTimeout(this.timer);
    };

    CardReader.prototype.resetTimeout = function() {
      this.clearTimeout();
      return this.timer = setTimeout(this.reset, this.timeout);
    };

    CardReader.prototype.reset = function() {
      this.started = false;
      this.finished = false;
      this.is_error = false;
      return this.buffer = "";
    };

    return CardReader;

  })(Backbone.Model);

  (base = (this.Tactus || (this.Tactus = {}))).CardReader || (base.CardReader = CardReader);

}).call(this);

(function() {
  $(document).on('touchstart touchend pointerdown MSPointerDown pointerup MSPointerUp', 'a', function(event) {
    var ref;
    if (((ref = event.originalEvent) != null ? ref.pointerType : void 0) === 'touch') {
      return $(this).toggleClass('hover', event.type === 'MSPointerDown' || event.type === 'pointerdown');
    } else {
      return $(this).toggleClass('hover', event.type === 'touchstart');
    }
  });

}).call(this);
