<?php
/**
 * WHMCS Notifications module
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/**
 * Create module config
 *
 * @return array
 */
function WHMCS_Notifications_config()
{
    return [
        'name' => 'WHMCS Notifications',
        'description' => 'This module send notifications using a Discord webhook.',
        'author' => 'Jelcoo',
        'language' => 'english',
        'version' => '0.0.1',
        'fields' => [
            'webhook_url' => [
                'FriendlyName' => 'Webhook URL',
                'Type' => 'text',
                'Size' => '150',
            ],
            'color' => [
                'FriendlyName' => 'Embed Color',
                'Type' => 'text',
                'Size' => '7',
                'Default' => '#ff0000',
                'Description' => 'Color HEX value with #',
            ],
            'tag' => [
                'FriendlyName' => 'Tag a role?',
                'Type' => 'yesno',
            ],
            'tag_role' => [
                'FriendlyName' => 'Role to tag',
                'Type' => 'text',
                'Size' => '20',
                'Description' => 'Role ID',
            ],

            // Tickets
            'TicketOpen' => [
                'FriendlyName' => 'Ticket Open',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when a ticket gets opened',
            ],
            'TicketUserReply' => [
                'FriendlyName' => 'Ticket Reply',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when a user replies to a ticket',
            ],
            'TicketFlagged' => [
                'FriendlyName' => 'Ticket Flagged',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when a ticket gets flagged to a staffmember',
            ],
            'TicketAddNote' => [
                'FriendlyName' => 'Ticket Note',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when a note is added to a ticket',
            ],

            // Invoice
            'InvoicePaid' => [
                'FriendlyName' => 'Invoice Paid',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an invoice is paid',
            ],
            'InvoiceRefunded' => [
                'FriendlyName' => 'Invoice Refund',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an invoice is refunded',
            ],
            'AddInvoiceLateFee' => [
                'FriendlyName' => 'Invoice Late Fee',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an invoice gets late fee added',
            ],

            // Orders
            'PendingOrder' => [
                'FriendlyName' => 'Order Pending',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an order gets set as pending',
            ],
            'OrderPaid' => [
                'FriendlyName' => 'Order Paid',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an order gets paid',
            ],
            'AcceptOrder' => [
                'FriendlyName' => 'Order Accepted',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an order gets accepted',
            ],
            'CancelOrder' => [
                'FriendlyName' => 'Order Cancelled',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an order gets cancelled',
            ],
            'CancelAndRefundOrder' => [
                'FriendlyName' => 'Order Cancelled and Refunded',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an order gets cancelled and refunded',
            ],
            'FraudOrder' => [
                'FriendlyName' => 'Order Fraud',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an order gets marked as fraud',
            ],

            // Misc
            'CancellationRequest' => [
                'FriendlyName' => 'Request Cancellation',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an cancellaction is requested',
            ],
            'AnnouncementAdd' => [
                'FriendlyName' => 'Announcement Created',
                'Type' => 'yesno',
                'Default' => 'yes',
                'Description' => 'Notify when an announcement is created',
            ],
        ]
    ];
}