<?php

function get_db_config()
{
    if (getenv('IS_IN_HEROKU')) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        return $db_config = [

            'host' => $url["host"],
            'database'  => substr($url["path"], 1),
            'username'  => $url["user"],
            'password'  => $url["pass"],
        ];
    } else {
        return $db_config = [

            'host' => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
        ];
    }
}
