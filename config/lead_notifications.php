<?php

return [
    /*
     * With MAIL_MAILER=log this recipient and email body are written to the
     * Laravel log. Set MAIL_MAILER=smtp later to deliver the same alerts.
     */
    'recipient' => env('LEAD_NOTIFICATION_TO', 'info@kodrank.com'),
];
