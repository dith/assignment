<?php

/* changed namespace to App\Misc for the sake of mocking built-in function scandir */
namespace App\Misc;
use Tests\TestCase;

/* To mock built-in function scandir()
 * Alternatively, can use vfsStream to mock file-system.
 **/
function scandir($dir)
{
    return AssignmentQ1Test::$allFiles ?: \scandir($dir);
}

class AssignmentQ1Test extends TestCase
{
    public static $allFiles;

    public function testGetDetailsOnly()
    {
        self::$allFiles = [
            'EVoucherH1709250947.csv',
            'EVoucherD1709250947.csv',
            'ERVoucherH1709230947.csv',
            'ERVoucherD1709230947.csv',
            'EOutslipH1709220947.csv', 
            'EOutslipD1709220947.csv',
            'EInvoiceH1709220947.csv',
            'EInvoiceD1709220947.csv',
            'ERVoucherH1709222947.csv',
            'ERVoucherD1709222947.csv',
            'ERVoucherH170922194712.csv',
            'ERVoucherD170922194712.csv',
        ];

        $expected = [ 'EInvoiceD1709220947.csv', 'EOutslipD1709220947.csv' ];
        $result = AssignmentQ1::getDetailsOnly('/var/www/report/malaysia', '22-09-2017');
        sort($result);

        $this->assertEquals($expected, $result, 'getDetailsOnly() return expected result.');
    }

    protected function tearDown()
    {
        self::$allFiles = null;
    }
}


