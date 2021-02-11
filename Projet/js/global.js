Fonction = {
  escapeHtml: function(text) {
    var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) {
      return map[m];
    });
  },
  random_password_generate: function(min, max) {
    var passwordChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz#@!%&()/";
    var randPwLen = Math.floor(Math.random() * (max - min + 1)) + min;
    var randPassword = Array(randPwLen).fill(passwordChars).map(function(x) {
      return x[Math.floor(Math.random() * x.length)]
    }).join('');
    return randPassword;
  },
  activation_code_generate: function() {
    var passwordChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var randPwLen = 8;
    var randPassword = Array(randPwLen).fill(passwordChars).map(function(x) {
      return x[Math.floor(Math.random() * x.length)]
    }).join('');
    return randPassword;
  }
};

$(document).ready(function() {
  $("input[type=text]").blur(function() {
    $(this).val(
      $(this)
      .val()
      .trim()
    );
  });

  $("textarea").blur(function() {
    $(this).val(
      $(this)
      .val()
      .trim()
    );
  });
});
