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
namespace UaRequest\Header;

use UaRequest\Constants;

final class XUcbrowserPhoneUa implements HeaderInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * Useragent constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }


    /**
     * Retrieve header name
     *
     * @return string
     */
    public function getFieldName(): string
    {
        return Constants::HEADER_UCBROWSER_PHONE_UA;
    }

    /**
     * Retrieve header value
     *
     * @return string
     */
    public function getFieldValue(): string
    {
        return $this->value;
    }

    public function hasDeviceInfo(): bool
    {
        if ('maui browser' === $this->value) {
            return false;
        }

        return true;
    }

    public function hasBrowserInfo(): bool
    {
        if ('maui browser' === $this->value) {
            return true;
        }

        return false;
    }

    public function hasPlatformInfo(): bool
    {
        return false;
    }

    public function hasEngineInfo(): bool
    {
        return false;
    }
}
