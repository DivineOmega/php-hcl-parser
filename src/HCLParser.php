<?php

namespace DivineOmega\HCLParser;

class HCLParser
{
    private $hcl;

    public function __construct($hcl)
    {
        $this->hcl = $hcl;
    }

    public function parse()
    {
        $working = $this->hcl;

        // Remove single line comments
        $working = preg_replace('/#.*/', '', $working);

        // Replace = with :
        $working = str_replace('=', ':', $working);

        // Surround with { }
        $working = '{'.$working.'}';

        // Surround keys with " "
        preg_match_all('/(?:\s*)(\w+)\s+:/', $working, $matches, PREG_OFFSET_CAPTURE);

        for ($i=count($matches[1])-1; $i >= 0; $i--) { 
            $match = $matches[1][$i];
            $matchText = $match[0];
            $startPos = $match[1];
            $working = substr_replace($working, '"'.$matchText.'"', $startPos, strlen($matchText));
        }

        // Add : between " and {
        $working = preg_replace('/"\s*{/', '": {', $working);

        // Add , between "} and "
        $working = preg_replace('/"\s*}\s*"/', '\"}, '.PHP_EOL.PHP_EOL.'"', $working);

        // Add , between " and "
        $working = preg_replace('/"\s*"/', '",'.PHP_EOL.'"', $working);

        // Removing trailing comma before ]
        $working = preg_replace('/,\s*]/', PHP_EOL.']', $working);

        var_dump($working); die;

        return json_decode($working);
    }
}