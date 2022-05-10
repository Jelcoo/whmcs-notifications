<?php
/**
 * WHMCS Notifications hooks
 */

require_once __DIR__ . '/../../modules/addons/WHMCS_Notifications/functions.php';

if (isEnabled('AnnouncementAdd')) {
    add_hook('AnnouncementAdd', 1, function($vars) {
        
    });
}
