<?php

use PHPUnit\Framework\TestCase;
use DivineOmega\HCLParser\Installer;

class InstallerTest extends TestCase
{
    public function testBinariesInstallation()
    {
        foreach(glob(__DIR__.'/../../bin/*') as $file) {
            unlink($file);
        }

        Installer::installBinaries();

        $files = glob(__DIR__.'/../../bin/*');

        array_walk($files, function(&$value) {
            $value = basename($value);
        });

        $expectedFiles = ['json2hcl_v0.0.6_linux_amd64'];

        foreach($expectedFiles as $expectedFile) {
            $this->assertContains($expectedFile, $files);
        }

    }

}
