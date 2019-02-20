<?php
/**
 * This file is part of the ua-generic-request package.
 *
 * Copyright (c) 2015-2019, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaRequestTest\Header;

use PHPUnit\Framework\TestCase;
use UaRequest\Header\XOperaminiPhoneUa;

class XOperaminiPhoneUaTest extends TestCase
{
    /**
     * @dataProvider providerUa
     *
     * @param string $ua
     * @param bool   $hasDeviceInfo
     * @param bool   $hasBrowserInfo
     * @param bool   $hasPlatformInfo
     *
     * @return void
     */
    public function testData(string $ua, bool $hasDeviceInfo, bool $hasBrowserInfo, bool $hasPlatformInfo): void
    {
        $header = new XOperaminiPhoneUa($ua);

        self::assertSame($ua, $header->getValue());
        self::assertSame($hasDeviceInfo, $header->hasDeviceInfo());
        self::assertSame($hasBrowserInfo, $header->hasBrowserInfo());
        self::assertSame($hasPlatformInfo, $header->hasPlatformInfo());
        self::assertFalse($header->hasEngineInfo());
    }

    /**
     * @return array[]
     */
    public function providerUa(): array
    {
        return [
            ['BlackBerry8520/5.0.0.681 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/613', true],
            ['BlackBerry8900/5.0.0.1113 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/100', true],
            ['SAMSUNG-GT-i8000/1.0 (Windows CE; Opera Mobi; U; en) Opera 9.5 UNTRUSTED/1.0', false],
            ['Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S5380D/S5380DZHLB1; U; Bada/2.0; zh-cn) AppleWebKit/534.20 (KHTML, like Gecko) Dolfin/3.0 Mobile HVGA SMM-MMS/1.2.0 OPN-B', true],
            ['HTC_Touch_Pro_T7272', true],
            ['SAMSUNG-GT-S8500', true],
            ['Mozilla/5.0 (Linux; U; Android 4.2.5; zh-cn; MI 2SC Build/YunOS) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30', true],
            ['Mozilla/5.0 (Series40; Nokia501/11.1.1/java_runtime_version=Nokia_Asha_1_1_1; Profile/MIDP-2.1 Configuration/CLDC-1.1) Gecko/20100401 S40OviBrowser/3.9.0.0.22', true],
            ['Mozilla/5.0 (Series40; Nokia501/11.1.1/java_runtime_version=Nokia_Asha_1_1_1; Profile/MIDP-2.1 Configuration/CLDC-1.1) Gecko/20100401 S40OviBrowser/3.1.1.0.27', true],
            ['Mozilla/5.0 (Bada 2.0.0)', false],
            ['BlackBerry8520/5.0.0.1036 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/613', true],
            ['BlackBerry9700/5.0.0.235 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/1', true],
            ['BlackBerry9300', true],
            ['BlackBerry8530/5.0.0.973 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/105', true],
            ['Samsung SCH-U380', true],
            ['Pantech TXT8045', true],
            ['ZTE F-450', true],
            ['LG VN271', true],
            ['Casio C781', true],
            ['Samsung SCH-U485', true],
            ['Pantech CDM8992', true],
            ['LG VN530', true],
            ['Samsung SCH-U680', true],
            ['Pantech CDM8999', true],
            ['NativeOperaMini(Haier;Native Opera Mini/4.2.99;id;BREW 3.1.5)', false],
            ['Mozilla/5.0_(Smartfren-E781A/E2_SQID_V0.1.6; U; REX/4.3;BREW/3.1.5.189; Profile/MIDP-2.0_Configuration/CLDC-1.1; 240*320; CTC/2.0)_Obigo Browser/Q7', true],
            ['Mozilla/4.0 (Brew MP 1.0.2; U; en-us; Kyocera; NetFront/4.1/AMB) Sprint E4255', true],
            ['Mozilla/4.0 (BREW 3.1.5; U; en-us; Sanyo; NetFront/3.5.1/AMB) Sprint SCP-6760', true],
            ['Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5', true],
            ['OperaMini(MAUI_MRE;Opera Mini/4.4.31223;en)', false],
            ['OperaMini(Fucus/Unknown;Opera Mini/4.4.31223;en)', false],
            ['OperaMini(Lava-Discover135;Opera Mini/4.4.31762;en)', true],
            ['OperaMini(Gionee_1305;Opera Mini/4.4.31989;en)', true],
            ['NativeOperaMini(MRE_VER_3000;240X320;MT6256;V/;Opera Mini/6.1.27412;en)', false],
            ['NativeOperaMini(MTK;Native Opera Mini/4.2.1198;fr)', false],
            ['NativeOperaMini(MTK;Opera Mini/5.1.3119;es)', false],
            ['NativeOperaMini(MTK/Unknown;Opera Mini/7.0.32977;en-US)', false],
            ['NativeOperaMini(Spreadtrum/Unknown;Native Opera Mini/4.4.29625;pt)', false],
            ['NativeOperaMini(Spreadtrum/HW Version:        SC6531_OPENPHONE;Native Opera Mini/4.4.31227;en)', true],
            ['PhilipsX2300/W1245_V12 ThreadX_OS/4.0 MOCOR/W12 Release/11.08.2012 Browser/Dorado1.0', true],
            ['ReksioVRE(196683)', false],
            ['Motorola', false],
            ['Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; HTC_HD2_T8585; Windows Phone 6.5)', true],
            ['Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 710)', true],
        ];
    }
}
