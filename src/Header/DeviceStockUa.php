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

namespace UaRequest\Header;

use function preg_match;

final class DeviceStockUa implements HeaderInterface
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Retrieve header value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function hasDeviceInfo(): bool
    {
        return (bool) preg_match('/samsung|nokia|blackberry|smartfren|sprint|iphone|lava|gionee|philips|htc|mi 2sc/i', $this->value);
    }

    public function hasBrowserInfo(): bool
    {
        return (bool) preg_match('/opera mini/i', $this->value);
    }

    public function hasPlatformInfo(): bool
    {
        return (bool) preg_match('/bada|android|blackberry|brew|iphone|mre|windows|mtk/i', $this->value);
    }

    public function hasEngineInfo(): bool
    {
        return (bool) preg_match('/trident|presto|webkit|gecko/i', $this->value);
    }
}
