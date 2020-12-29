<?php

/*
 * Route your mailboxes to their handler classes here.
 */
return [
    /*
     * Map emails sent from a specific address to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'from@test.org' => ExampleMailbox::class
     */

    'from' => [],

    /*
     * Map emails sent to a specific address to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'to@test.org' => ExampleMailbox::class
     */

    'to' => [],

    /*
     * Map emails cc'd to a specific address to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'cc@test.org' => ExampleMailbox::class
     */

    'cc' => [],

    /*
     * Map emails containing a specific subject to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'This Subject' => ExampleMailbox::class
     */

    'subject' => [],

    /*
     * Only when an email does not match any of the preceding
     * invoke this class to catch the email for processing.
     *
     * For example: ExampleFallbackMailbox::class,
     */

    'fallback' => null,

    /*
     * Regardless of when an email matches any of the preceding
     * always invoke this class to process the email message.
     *
     * For example: ExampleFallbackMailbox::class,
     */

    'catchAll' => null,
];
