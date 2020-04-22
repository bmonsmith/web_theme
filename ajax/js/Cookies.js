 (function () {
      var cookiesAgreed = localStorage.getItem('cookiesAgreed');

      if (cookiesAgreed) {
        return;
      }

      var wrapper = $('<div class="cookies-notification"></div>');
      var notification = $('<div class="cookies-notification-content"></div>');
      var text = $('<div class="cookies-notification-text"><p>This website uses cookies to ensure the best browsing experience. You may change your cookie preferences in your browser or device settings. <a href=\"http://www.aboutcookies.org/\" target=\"_blank\">Learn More<\/a> <a href=\"http://www.aboutcookies.org/how-to-delete-cookies/\" target=\"_blank\">How To Delete Cookies<\/a><\/p></div>');
      var button = $('<button class="cookies-notification-button">Accept</button>');

      button.click(handleAcceptClick);
      notification
        .append(text)
        .append(button);
      wrapper.append(notification);

      $('body').append(wrapper);
      setTimeout(function() {
        wrapper.addClass('cookies-notification--visible');
      }, 1000);

      function handleAcceptClick() {
        localStorage.setItem('cookiesAgreed', 'true');
        wrapper.removeClass('cookies-notification--visible');
        wrapper.on('transitionend', handleTransitionEnd);
      }

      function handleTransitionEnd() {
        wrapper.remove();
      }
    });
  
  var swRegisterManager = {
    goals: [],
    add: function(swGoalRegister) {
      this.goals.push(swGoalRegister);
    },
    registerGoals: function() {
      while(this.goals.length) {
        this.goals.shift().call();
      }
    }
  };

  window.swPostRegister = swRegisterManager.registerGoals.bind(swRegisterManager);