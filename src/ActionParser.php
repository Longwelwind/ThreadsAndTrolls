<?php


namespace ThreadsAndTrolls;


class ActionParser {
    public static function loadActions($text) {
        $actions = array();
        $matches = array();

        preg_match_all("/(\\S*)@(\\S*)/i", $text, $matches);

        for ($i=0;$i < count($matches[0]);$i++) {

            $actions[] = array("name" => $matches[1][$i],
                                "args" => explode(",", $matches[2][$i]));

        }

        return $actions;
    }
} 