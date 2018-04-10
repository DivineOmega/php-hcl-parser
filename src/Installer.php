<?php

namespace DivineOmega\HCLParser;

abstract class Installer
{
    public static function installBinaries()
    {
        $binaryUrls = ['https://github.com/kvz/json2hcl/releases/download/v0.0.6/json2hcl_v0.0.6_linux_amd64'];

        foreach ($binaryUrls as $binaryUrl) {
            $destination = __DIR__.'/../bin/'.basename($binaryUrl);

            if (file_exists($destination)) {
                continue;
            }

            file_put_contents($destination, file_get_contents($binaryUrl));
            chmod($destination, 0755);
        }
    }
}
