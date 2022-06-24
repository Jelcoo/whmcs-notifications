<?php
/**
 * WHMCS Notifications hooks
 */

require_once __DIR__ . '/../../modules/addons/WHMCS_Notifications/functions.php';

if (isEnabled('TicketOpen')) {
    add_hook('TicketOpen', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Ticket #".$vars["ticketid"],
                    "type" => "rich",
                    "description" => "**".trimText($vars["subject"], 150)."**\n\n".trimText($vars["message"], 1500),
                    "url" => getSetting("url")."/supporttickets.php?action=view&id=".$vars["ticketid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "New Ticket Created"
                    ],
                    "fields" => [
                        [
                            "name" => "Priority",
                            "value" => $vars["priority"],
                            "inline" => true
                        ],
                        [
                            "name" => "Department",
                            "value" => $vars["deptname"],
                            "inline" => true
                        ]
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('TicketUserReply')) {
    add_hook('TicketUserReply', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Ticket #".$vars["ticketmask"],
                    "type" => "rich",
                    "description" => trimText($vars["message"], 1900),
                    "url" => getSetting("url")."/supporttickets.php?action=view&id=".$vars["ticketid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Ticket Reply"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('TicketFlagged')) {
    add_hook('TicketFlagged', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Ticket #".$vars["ticketid"],
                    "type" => "rich",
                    "description" => "Ticket **#".$vars["ticketid"]."** got flagged to **".$vars["adminname"]."**",
                    "url" => getSetting("url")."/supporttickets.php?action=view&id=".$vars["ticketid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Ticket Flagged"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('TicketAddNote')) {
    add_hook('TicketAddNote', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Ticket #".$vars["ticketid"],
                    "type" => "rich",
                    "description" => trimText($vars["message"], 1900),
                    "url" => getSetting("url")."/supporttickets.php?action=view&id=".$vars["ticketid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Ticket Note Added"
                    ],
                    "fields" => [
                        [
                            "name" => "Attachments",
                            "value" => $vars["attachments"],
                            "inline" => true
                        ]
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('InvoicePaid')) {
    add_hook('InvoicePaid', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Invoice #".$vars["invoiceid"],
                    "type" => "rich",
                    "description" => "Invoice **#".$vars["invoiceid"]."** got paid",
                    "url" => getSetting("url")."/invoices.php?action=edit&id=".$vars["invoiceid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Invoice Paid"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('InvoiceRefunded')) {
    add_hook('InvoiceRefunded', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Invoice #".$vars["invoiceid"],
                    "type" => "rich",
                    "description" => "Invoice **#".$vars["invoiceid"]."** has been refunded",
                    "url" => getSetting("url")."/invoices.php?action=edit&id=".$vars["invoiceid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Invoice Refunded"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('AddInvoiceLateFee')) {
    add_hook('AddInvoiceLateFee', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Invoice #".$vars["invoiceid"],
                    "type" => "rich",
                    "description" => "Invoice **#".$vars["invoiceid"]."** got a late fee added",
                    "url" => getSetting("url")."/invoices.php?action=edit&id=".$vars["invoiceid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Invoice Late Fee"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('PendingOrder')) {
    add_hook('PendingOrder', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Order #".$vars["orderid"],
                    "type" => "rich",
                    "description" => "Order **#".$vars["orderid"]."** is pending",
                    "url" => getSetting("url")."/orders.php?action=view&id=".$vars["orderid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Order Pending"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('OrderPaid')) {
    add_hook('OrderPaid', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Order #".$vars["orderid"],
                    "type" => "rich",
                    "description" => "Order **#".$vars["orderid"]."** has been paid",
                    "url" => getSetting("url")."/orders.php?action=view&id=".$vars["orderid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Order Paid"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('AcceptOrder')) {
    add_hook('AcceptOrder', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Order #".$vars["orderid"],
                    "type" => "rich",
                    "description" => "Order **#".$vars["orderid"]."** has been accepted",
                    "url" => getSetting("url")."/orders.php?action=view&id=".$vars["orderid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Order Accepted"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('CancelOrder')) {
    add_hook('CancelOrder', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Order #".$vars["orderid"],
                    "type" => "rich",
                    "description" => "Order **#".$vars["orderid"]."** has been cancelled",
                    "url" => getSetting("url")."/orders.php?action=view&id=".$vars["orderid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Order Cancelled"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('CancelAndRefundOrder')) {
    add_hook('CancelAndRefundOrder', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Order #".$vars["orderid"],
                    "type" => "rich",
                    "description" => "Order **#".$vars["orderid"]."** has been cancelled and refundeded",
                    "url" => getSetting("url")."/orders.php?action=view&id=".$vars["orderid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Order Cancelled & Refunded"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('FraudOrder')) {
    add_hook('FraudOrder', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Order #".$vars["orderid"],
                    "type" => "rich",
                    "description" => "Order **#".$vars["orderid"]."** has been marked as fraud",
                    "url" => getSetting("url")."/orders.php?action=view&id=".$vars["orderid"],
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Order Fraud"
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('CancellationRequest')) {
    add_hook('CancellationRequest', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Cancel #".$vars["relid"],
                    "type" => "rich",
                    "description" => "A cancellation request has been submitted for service **#".$vars["relid"]."**",
                    "url" => getSetting("url")."/cancelrequests.php",
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "Service Cancallation Request"
                    ]
                ],
                "fields" => [
                    [
                        "name" => "Type",
                        "value" => $vars["type"],
                        "inline" => true
                    ],
                    [
                        "name" => "Reason",
                        "value" => trimText($vars["reason"], 500),
                        "inline" => true
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}

if (isEnabled('AnnouncementAdd')) {
    add_hook('AnnouncementAdd', 1, function($vars) {
        $json_data = json_encode([
            "content" => getSetting("tag") ? "<@&".getSetting("tag_role").">" : null,
            "tts" => false,
            "embeds" => [
                [
                    "title" => "Announcement #".$vars["announcementid"],
                    "type" => "rich",
                    "description" => trimText($vars["title"], 100)."\n\n".trimText($vars["announcement"], 1800),
                    "url" => getSetting("url")."/cancelrequests.php",
                    "timestamp" => date("c", strtotime("now")),
                    "color" => getSetting("color"),
                    "author" => [
                        "name" => "New Announcement Created"
                    ]
                ],
                "fields" => [
                    [
                        "name" => "Date",
                        "value" => $vars["date"],
                        "inline" => true
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        send($json_data);
    });
}
