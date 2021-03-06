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

final class XRequestedWith implements HeaderInterface
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
        return false;
    }

    public function hasBrowserInfo(): bool
    {
        return 0 >= preg_match('/xmlhttprequest|fake/i', $this->value);
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
