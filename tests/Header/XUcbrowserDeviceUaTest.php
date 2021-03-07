<?php
/**
 * This file is part of the ua-generic-request package.
 *
 * Copyright (c) 2015-2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaRequestTest\Header;

use PHPUnit\Framework\TestCase;
use UaRequest\Header\XUcbrowserDeviceUa;

final class XUcbrowserDeviceUaTest extends TestCase
{
    /**
     * @dataProvider providerUa
     *
     * @param string $ua
     * @param bool   $hasDeviceInfo
     * @param bool   $hasBrowserInfo
     * @param bool   $hasPlatformInfo
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @return void
     */
    public function testData(string $ua, bool $hasDeviceInfo, bool $hasBrowserInfo, bool $hasPlatformInfo): void
    {
        $header = new XUcbrowserDeviceUa($ua);

        self::assertSame($ua, $header->getValue(), 'header mismatch');
        self::assertSame($hasDeviceInfo, $header->hasDeviceInfo(), 'device info mismatch');
        self::assertSame($hasBrowserInfo, $header->hasBrowserInfo(), 'browser info mismatch');
        self::assertSame($hasPlatformInfo, $header->hasPlatformInfo(), 'platform info mismatch');
        self::assertFalse($header->hasEngineInfo(), 'engine info mismatch');
    }

    /**
     * @return array[]
     */
    public function providerUa(): array
    {
        return [
            ['Mozilla/5.0 (Linux; U; Android 2.3.5; en-US; Micromax_A36 Build/MocorDroid2.3.5_Trout) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1', true, true, true],
            ['Mozilla/5.0 (Linux; U; Android 4.0.4; en-US; GT-S7562 Build/IMM76I) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1', true, true, true],
            ['Mozilla/5.0 (Linux; U; Android 4.1.2; en-US; Nokia_X Build/JZO54K) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1', true, true, true],
            ['Mozilla/5.0 (Linux; U; Android 4.2.2; en-US; KYY21 Build/209.0.1700) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1', true, true, true],
            ['Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; TECNO S3 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30', true, true, true],
            ['Mozilla/5.0 (Series40; Nokia200/11.81; Profile/MIDP-2.1 Configuration/CLDC-1.1) Gecko/20100401 S40OviBrowser/3.7.0.0.11', true, true, false],
            ['?', false, false, false],
            ['SAMSUNG-GT-C3312/1.0 NetFront/4.2 Profile/MIDP-2.0 Configuration/CLDC-1.1', true, true, false],
            ['SAMSUNG-GT-S3770K/S3770KDDKH4 NetFront/4.1 Profile/MIDP-2.0 Configuration/CLDC-1.1', true, true, false],
            ['MOT-A1200e/1.0 LinuxOS/2.4.20 Release/1.31.2007 Browser/Opera8.00 Profile/MIDP-2.0 Configuration/CLDC-1.1 Software/R541_G_11.56.11R', true, false, false],
            ['SAMSUNG-GT-S3850/1.0 SHP/VPP/R5 Dolfin/2.0 NexPlayer/3.0 SMM-MMS/1.2.0 profile/MIDP-2.1 configuration/CLDC-1.1 OPN-B', true, true, false],
            ['Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S5250/S5250XEKC1; U; Bada/1.0; uk-ua) AppleWebKit/533.1 (KHTML, like Gecko) Dolfin/2.0 Mobile WQVGA SMM-MMS/1.2.0 NexPlayer/3.0 profile/MIDP-2.1 configuration/CLDC-1.1 OPN-B', true, true, true],
            ['Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NOKIA6120c/07.20; Profile/MIDP-2.0 Configuration/CLDC-1.1) AppleWebKit/413 (KHTML, like Gecko) Safari/413', true, true, true],
            ['Mozilla/5.0 (Symbian/3; Series60/5.3 NokiaE7-00/1.040.1511; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.4.1.14 Mobile Safari/533.4 3gpp-gba', true, true, true],
            ['Nokia501s/2.0 (10.0.12) Profile/MIDP-2.1 Configuration/CLDC-1.1', true, false, false],
            ['Nokia501/2.0 (14.0.4) Profile/MIDP-2.1 Configuration/CLDC-1.1', true, false, false],
            ['Nokia501/2.0 (10.0.14) Profile/MIDP-2.1 Configuration/CLDC-1.1', true, false, false],
            ['Nokia503s/2.0 (14.0.4) Profile/MIDP-2.1 Configuration/CLDC-1.1', true, false, false],
            ['NokiaAsha230DualSIM/2.0 (14.0.4) Profile/MIDP-2.1 Configuration/CLDC-1.1', true, false, false],
            ['Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S5380D/S5380DGTLE1; U; Bada/2.0; en-us) AppleWebKit/534.20 (KHTML, like Gecko) Dolfin/3.0 Mobile HVGA SMM-MMS/1.2.0 OPN-B', true, true, true],
            ['Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S5380K/S5380KDDLD1; U; Bada/2.0; en-us) AppleWebKit/534.20 (KHTML, like Gecko) Dolfin/3.0 Mobile HVGA SMM-MMS/1.2.0 OPN-B', true, true, true],
            ['Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S5253/S5253DDJI7; U; Bada/1.0; en-us) AppleWebKit/533.1 (KHTML, like Gecko) Dolfin/2.0 Mobile WQVGA SMM-MMS/1.2.0 OPN-B', true, true, true],
            ['Mozilla/4.0 (BREW 3.1.5; U; en-us; Sanyo; NetFront/3.5.1/AMB) Boost SCP6760', true, true, true],
            ['Mozilla/5.0_(OneTouch-710C/710C_OMH_V1.6; U; REX/4.3;BREW/3.1.5.189; Profile/MIDP-2.0_Configuration/CLDC-1.1; 240*320; CTC/2.0)_Obigo Browser/1.14', true, true, true],
            ['NetFront/3.5.1(BREW 5.0.2.1; U; en-us; Samsung ; NetFront/3.5.1/WAP) Boost M260 MMP/2.0 Profile/MIDP-2.1 Configuration/CLDC-1.1', true, true, true],
            ['MOT-EX226 MIDP-2.0/CLDC-1.1 Release/31.12.2010 Browser/Opera Sync/SyncClient1.1 Profile/MIDP-2.0 Configuration/CLDC-1.1 Opera/9.80 (MTK; U; en-US) Presto/2.5.28 Version/10.10', true, false, true],
            ['ASTRO36_TD/v3 (MRE\2.3.00(20480) resolution\320480 chipset\MT6255 touch\1 tpannel\1 camera\0 gsensor\0 keyboard\reduced) MAUI/10A1032MP_ASTRO_W1052 Release/31.12.2010 Browser/Opera Profile/MIDP-2.0 Configuration/CLDC-1.1 Sync/SyncClient1.1 Opera/9.80 (MTK; Nucleus; Opera Mobi/4000; U; en-US) Presto/2.5.28 Version/10.10', true, false, true],
        ];
    }
}
