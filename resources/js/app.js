import {Notyf} from 'notyf';
import 'notyf/notyf.min.css';
import Alpine from 'alpinejs';

require('./bootstrap');


window.Alpine = Alpine;
Alpine.start();

const notyf = new Notyf();

// Make sure userId is globally available
if (typeof userId !== 'undefined' && userId) {

    // Notifications (e.g. new task assigned)
    window.Echo.private(`App.Models.User.${userId}`)
        .notification(function (data) {
            // Show popup
            notyf.success(data.body);

            // Prepend to notification list
            $('#notificationsList').prepend(`
                <li class="notifications-not-read">
                    <a href="${data.url}?notify_id=${data.id}">
                        <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                        <span class="notification-text">
                            <strong>*</strong> ${data.body}
                        </span>
                    </a>
                </li>
            `);

            // Update badge count
            let count = Number($('#newNotifications').text()) || 0;
            count++;
            $('#newNotifications').text(count > 99 ? '99+' : count);
        });

    // Real-time messages
    window.Echo.join(`messages.${userId}`)
        .listen('.message.created', function (data) {
            console.log('Notification received:', data);

            notyf.success(data.body);
        });
}
