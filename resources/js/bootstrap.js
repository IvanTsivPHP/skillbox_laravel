window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
/* global bootstrap: false */

(function () {
    'use strict'

    // Tooltip and popover demos
    document.querySelectorAll('.tooltip-demo')
        .forEach(function (tooltip) {
            new bootstrap.Tooltip(tooltip, {
                selector: '[data-bs-toggle="tooltip"]'
            })
        })

    document.querySelectorAll('[data-bs-toggle="popover"]')
        .forEach(function (popover) {
            new bootstrap.Popover(popover)
        })

    document.querySelectorAll('.toast')
        .forEach(function (toastNode) {
            var toast = new bootstrap.Toast(toastNode, {
                autohide: false
            })

            toast.show()
        })

    // Disable empty links and submit buttons
    document.querySelectorAll('[href="#"], [type="submit"]')
        .forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault()
            })
        })

    function setActiveItem() {
        var hash = window.location.hash

        if (hash === '') {
            return
        }

        var link = document.querySelector('.bd-aside a[href="' + hash + '"]')

        if (!link) {
            return
        }

        var active = document.querySelector('.bd-aside .active')
        var parent = link.parentNode.parentNode.previousElementSibling

        link.classList.add('active')

        if (parent.classList.contains('collapsed')) {
            parent.click()
        }

        if (!active) {
            return
        }

        var expanded = active.parentNode.parentNode.previousElementSibling

        active.classList.remove('active')

        if (expanded && parent !== expanded) {
            expanded.click()
        }
    }

    setActiveItem()
    window.addEventListener('hashchange', setActiveItem)
})()
