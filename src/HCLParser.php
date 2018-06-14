<?php

namespace DivineOmega\HCLParser;

/**
 * Class HCLParser
 * @package DivineOmega\HCLParser
 */
class HCLParser
{
    /**
     * @var
     */
    private $hcl;

    /**
     * HCLParser constructor.
     * @param $hcl
     */
    public function __construct($hcl)
    {
        $this->hcl = $hcl;
    }

    /**
     * @return string
     */
    private function getJSONString()
    {
        $command = __DIR__.'/../bin/json2hcl_v0.0.6_linux_amd64 --reverse <<\'EOF\''.PHP_EOL.$this->hcl.PHP_EOL.'EOF';

        exec($command, $lines);

        return implode(PHP_EOL, $lines);
    }

    /**
     * @return mixed
     */
    public function parse()
    {
        return json_decode($this->getJSONString());
    }
}
