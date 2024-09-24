<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = '172.20.0.10:3306';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'videgrenierenligne';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'webapplication';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '653rag9T';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;

    
    const SMTP_HOST = 'sandbox.smtp.mailtrap.io';
    const SMTP_PORT = 2525;
    const SMTP_USER = 'b011153ce18941';
    const SMTP_PASSWORD = '9fecf77f8ae191';
    
}    