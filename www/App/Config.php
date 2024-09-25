<?php

namespace App;

class Config
{
    /**
     * Database host
     * @var string
     */
    public static $DB_HOST;

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

    /**
     * SMTP settings
     */
    const SMTP_HOST = 'sandbox.smtp.mailtrap.io';
    const SMTP_PORT = 2525;
    const SMTP_USER = 'b011153ce18941';
    const SMTP_PASSWORD = '9fecf77f8ae191';

    /**
     * Initialize configuration settings based on environment
     */
    public static function init()
    {
        $dbHost = getenv("DB_HOST");

        if ($dbHost == "172.20.0.10") {
            self::$DB_HOST = "172.20.0.10:3306";
        } elseif ($dbHost == "172.30.0.20") {
            self::$DB_HOST = "172.30.0.20:3306";
        } elseif ($dbHost == "172.10.0.10") {
            self::$DB_HOST = "172.10.0.10:3306";
        } else {
            self::$DB_HOST = "172.10.0.10:3306"; 
        }
    }
}
