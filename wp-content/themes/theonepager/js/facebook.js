var facebook = {
    reziseIframe: function () {
        if (!(top === self)) {
            if (window.bodyHeight != $('body').outerHeight(true)) {
                window.bodyHeight = $('body').outerHeight(true);
                FB.Canvas.setSize({ width: 810, height: window.bodyHeight });
            }
            setTimeout("facebook.reziseIframe()", 500);
        }
    },
    checkPermissions: function (permsRequired, options) {
        if (permsRequired.length > 0) {
            FB.api('/me/permissions', function (response) {
                if (response.error) {
                    options.fail();
                } else {
                    var permsGranted = true;
                    var perms = permsRequired.split(',');

                    for (var i = 0; i <= perms.length - 1; i++) {
                        if (response['data'][0][perms[i]] != 1) {
                            permsGranted = false;
                        }
                    }

                    if (!permsGranted) {
                        options.fail();
                    } else {
                        options.success();
                    }
                }
            });
        }
    },
    getUserEmail: function (callback) {
        FB.api('/me?fields=email',
            function (response) {
                if (response.email) {
                    callback(response.email);
                }
            });
    },
    getUserName: function (facebookId,callback) {
        FB.api('/' + facebookId + '?fields=name',
            function (response) {
                if (response.name) {
                    callback(response.name);
                }
            });
    }
}