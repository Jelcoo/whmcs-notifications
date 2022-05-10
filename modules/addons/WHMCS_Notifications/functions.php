<?php
/**
 * WHMCS Notifications functions
 */

use WHMCS\Database\Capsule;

function isEnabled($type) {
    $setting = Capsule::table('tbladdonmodules')
        ->where('module', 'WHMCS_Notifications')
        ->where('setting', $type)
        ->first();
    
    if (!is_null($setting) && $setting->value == 'on') {
        return true;
    } else {
        return false;
    }
}

function getSetting($setting_name) {
    $setting = Capsule::table('tbladdonmodules')
        ->where('module', 'WHMCS_Notifications')
        ->where('setting', $setting_name)
        ->first();

    return $setting->value;
}

function send($data) {
    $webhook_url = getSetting('webhook_url');
    $curl = curl_init($webhook_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
	
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
        logModuleCall('WHMCS Notifications', 'Failed sending message', json_encode($data), curl_getinfo($curl, CURLINFO_HTTP_CODE)." ".json_encode($output));
    } else {
		logModuleCall('WHMCS Notifications', 'Message send successfully', json_encode($data), json_encode($output));
	}
	
    curl_close($curl);
}