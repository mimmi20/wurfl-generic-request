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

use BrowserDetector\Loader\NotFoundException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use UaRequest\Constants;
use UaRequest\Header\HeaderInterface;
use UaRequest\Header\HeaderLoader;

final class HeaderLoaderTest extends TestCase
{
    private HeaderLoader $subject;

    protected function setUp(): void
    {
        $this->subject = new HeaderLoader();
    }

    /**
     * @throws NotFoundException
     */
    public function testLoadFail(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('the header with name "unknown header" was not found');

        $this->subject->load('unknown header');
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws NotFoundException
     */
    public function testLoadOk(): void
    {
        $value  = 'header-value';
        $header = $this->subject->load(Constants::HEADER_USERAGENT, $value);

        self::assertInstanceOf(HeaderInterface::class, $header);
        self::assertSame($value, $header->getValue());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testHas(): void
    {
        self::assertTrue($this->subject->has(Constants::HEADER_USERAGENT));
    }
}
