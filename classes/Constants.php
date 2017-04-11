<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Constants
 *
 * @author Janno
 */
class Constants {
    //put your code here
    
    /**
     * Holds all the table definitions which can be run on the database engine.
     */
    static $CREATE_TABLES = array(
        "CREATE TABLE q3panel_users (user_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(100) NOT NULL, password VARCHAR(255), origin TINYINT DEFAULT 0, email VARCHAR(255), group_id TINYINT, allow_emails TINYINT, CONSTRAINT username_must_be_unique UNIQUE(username))",
        "CREATE TABLE q3panel_hosts (host_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, servername VARCHAR(255), hostname VARCHAR(255), sshport TINYINT, host_username VARCHAR(255), host_password VARCHAR(255), status TINYINT COMMENT '1 - ok, 2 - SSH problem, 3 - FTP problem')",
        "CREATE TABLE q3panel_servers (server_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, host_id INTEGER NOT NULL, server_name VARCHAR(255), game_id INTEGER, server_port SMALLINT UNSIGNED NOT NULL, server_account VARCHAR(255), server_password VARCHAR(255), server_status TINYINT COMMENT '0 - disabled, 1 - offline, 2 - online', server_startscript TEXT, current_players TINYINT, max_players TINYINT, rconpassword VARCHAR(255))",
        "CREATE TABLE q3panel_servers_map (servers_map_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, server_id INTEGER NOT NULL, user_id INTEGER NOT NULL, can_see_rcon TINYINT, can_see_ftp TINYINT, can_access_config TINYINT, can_access_maps TINYINT, can_stop_server TINYINT)",
        "CREATE TABLE q3panel_servers_logs (server_log_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, server_id INTEGER NOT NULL, user_id INTEGER NOT NULL, user_ip VARCHAR(255), severity TINYINT, action TEXT, timestamp DATETIME DEFAULT CURRENT_TIMESTAMP)",
        "CREATE TABLE q3panel_logs (log_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, user_id INTEGER NOT NULL, user_ip VARCHAR(255), action TEXT, timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)",
        "CREATE TABLE q3panel_games (game_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, game_name VARCHAR(255), game_location TEXT, startscript TEXT)",
        "CREATE TABLE q3panel_forgottenpsw (forgottenpsw_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, user_id INTEGER NOT NULL, request_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, request_key VARCHAR(255) NOT NULL)",
        "CREATE TABLE q3panel_failed_logins (failed_login_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, failed_username VARCHAR(255), failed_ip VARCHAR(255), failed_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)",
        "CREATE TABLE q3panel_support_ticket (support_ticket_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT, ticket_status TINYINT COMMENT '0 - open, 1 - closed, 2 - on hold, 3 - resolved', creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)",
        "CREATE TABLE q3panel_support_ticket_map (support_ticket_map_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, ticket_id INTEGER NOT NULL, user_id INTEGER NOT NULL)",
        "CREATE TABLE q3panel_support_ticket_messages (support_ticket_message_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, ticket_id INTEGER NOT NULL, user_id INTEGER NOT NULL, user_ip VARCHAR(255), message_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, message TEXT)",
        "CREATE TABLE q3panel_external_authentication (ext_auth_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, host VARCHAR(255), db_username VARCHAR(255), db_password VARCHAR(255), db_name VARCHAR(255), users_table_name VARCHAR(255), user_id_field VARCHAR(255), username_field VARCHAR(255), password_field VARCHAR(255), email_field VARCHAR(255))",
        "CREATE TABLE q3panel_external_email_service (ext_email_service_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, host VARCHAR(255), email VARCHAR(255), name VARCHAR(255), username VARCHAR(255), password VARCHAR(255))",
        "CREATE TABLE q3panel_style_preference (style_preference_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, style_id INTEGER NOT NULL)",
        "CREATE TABLE q3panel_styles (style_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, style_name VARCHAR(255))"
        
    );
    
    static $INSERT_QUERIES = array(
        "ADD_NEW_USER" => "INSERT INTO q3panel_users (username, password, origin, email, group_id, allow_emails) VALUES (?, ?, ?, ?, ?, ?)"
        
    );
    
    static $SELECT_QUERIES = array(
        "GET_USER_BY_NAME" => "SELECT * FROM q3panel_users WHERE username = ? AND group_id > 0",
        "GET_EXT_DATA" => "SELECT * FROM q3panel_external_authentication",
        "GET_USER_BY_EMAIL" => "SELECT * FROM q3panel_users WHERE email = ?"
    );
    
    static $DELETE_QUERIES = array(
        "DELETE_USER_BY_ID" => "DELETE FROM q3panel_users WHERE user_id = ?"
    );
    
    static $ERRORS = array(
        "AUTH_NO_DATA_ERROR" => "This account does not exist.",
        "AUTH_WRONG_PASSWORD_OR_DISABLED" => "Wrong password or the account is disabled."
    );
    
    private static $CSS = <<<EOT

        <link rel="stylesheet" href="{}/css/font-awesome.min.css">
        <link rel="stylesheet" href="{}/css/simple-line-icons.css">
        <link rel="stylesheet" href="{}/css/animate.min.css">
        <link rel="stylesheet" href="{}/css/whirl.css">
        <link rel="stylesheet" href="{}/css/bootstrap.css">
        <link rel="stylesheet" href="{}/css/app.css"> 

EOT;
    
    private static $JS = <<<EOT

        <script src="{}/js/jquery-2.2.0.min.js"></script>
        <script src="{}/js/modernizr.custom.js"></script>
        <script src="{}/js/matchMedia.js"></script>
        <script src="{}/js/bootstrap.js"></script>
        <script src="{}/js/jquery.easing.js"></script>
        <script src="{}/js/animo.js"></script>
        <script src="{}/js/jquery.slimscroll.min.js"></script>
        <script src="{}/js/screenfull.js"></script>
        <script src="{}/js/jquery.localize.js"></script>
        <script src="{}/js/jquery.storageapi.js"></script>
        <script src="{}/js/app.js"></script>
        <script src="{}/js/q3panel.js"></script>

EOT;
    
    
    public static function getCSS($url) {
        return str_replace("{}", $url, self::$CSS);
    }
    
    public static function getJS($url) {
        return str_replace("{}", $url, self::$JS);
    }
}