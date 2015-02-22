<?php
/**
 * Created by PhpStorm.
 * User: justice
 * Date: 22.02.15
 * Time: 23:26
 */

namespace ThreadsAndTrolls\MessageLoader;


interface MessageLoader {

    /**
     * Fetches the list of message from the source.
     * @return array[] Array of associative arrays representing the messages. Each element contains the keys:
     * "id" => The ID of the message, unique and increasing for each message.
     * "user" => The user that posted the message.
     * "text" => The content of the message, contains the commands (...@...,...)
     */
    public function loadMessages();
}