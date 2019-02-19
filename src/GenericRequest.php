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
namespace UaRequest;

use Psr\Http\Message\MessageInterface;
use UaRequest\Header\HeaderLoader;
use BrowserDetector\Loader\NotFoundException;

final class GenericRequest implements GenericRequestInterface
{
    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array
     */
    private $filteredHeaders = [];

    private const HEADERS = [
        Constants::HEADER_DEVICE_STOCK_UA    ,
        Constants::HEADER_DEVICE_UA          ,
        Constants::HEADER_UCBROWSER_DEVICE_UA,
        Constants::HEADER_UCBROWSER_DEVICE   ,
        Constants::HEADER_UCBROWSER_PHONE_UA ,
        Constants::HEADER_UCBROWSER_PHONE    ,
        Constants::HEADER_UCBROWSER_UA       ,
        Constants::HEADER_SKYFIRE_PHONE      ,
        Constants::HEADER_OPERAMINI_PHONE_UA ,
        Constants::HEADER_OPERAMINI_PHONE    ,
        Constants::HEADER_SKYFIRE_VERSION    ,
        Constants::HEADER_BLUECOAT_VIA       ,
        Constants::HEADER_BOLT_PHONE_UA      ,
        Constants::HEADER_MOBILE_UA          ,
        Constants::HEADER_REQUESTED_WITH     ,
        Constants::HEADER_ORIGINAL_UA        ,
        Constants::HEADER_UA_OS              ,
        Constants::HEADER_BAIDU_FLYFLOW      ,
        Constants::HEADER_PUFFIN_UA          ,
        Constants::HEADER_USERAGENT          ,
        Constants::HEADER_WAP_PROFILE        ,
        Constants::HEADER_NB_CONTENT         ,
    ];

    /**
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message)
    {
        foreach (array_keys($message->getHeaders()) as $header) {
            $this->headers[$header] = $message->getHeaderLine($header);
        }

        $this->filterHeaders();
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getFilteredHeaders(): array
    {
        return $this->filteredHeaders;
    }

    /**
     * @return string
     */
    public function getBrowserUserAgent(): string
    {
        $headers = [
            Constants::HEADER_SKYFIRE_VERSION    => true,
            Constants::HEADER_BLUECOAT_VIA       => true,
            Constants::HEADER_BOLT_PHONE_UA      => true,
            Constants::HEADER_UCBROWSER_UA       => true,
            Constants::HEADER_MOBILE_UA          => true,
            Constants::HEADER_REQUESTED_WITH     => true,
            Constants::HEADER_ORIGINAL_UA        => true,
            Constants::HEADER_DEVICE_STOCK_UA    => true,
            Constants::HEADER_OPERAMINI_PHONE_UA => true,
            Constants::HEADER_USERAGENT     => true,
        ];

        foreach (array_keys($headers) as $header) {
            if (array_key_exists($header, $this->filteredHeaders)) {
                return $this->filteredHeaders[$header];
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeviceUserAgent(): string
    {
        $headers = [
            Constants::HEADER_DEVICE_STOCK_UA     => true,
            Constants::HEADER_UCBROWSER_UA        => true,
            Constants::HEADER_UCBROWSER_DEVICE_UA => true,
            Constants::HEADER_UCBROWSER_DEVICE    => true,
            Constants::HEADER_SKYFIRE_PHONE       => true,
            Constants::HEADER_OPERAMINI_PHONE_UA  => true,
            Constants::HEADER_ORIGINAL_UA         => true,
            Constants::HEADER_BAIDU_FLYFLOW       => true,
            Constants::HEADER_USERAGENT      => true,
        ];

        foreach (array_keys($headers) as $header) {
            if (array_key_exists($header, $this->filteredHeaders)) {
                return $this->filteredHeaders[$header];
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getPlatformUserAgent(): string
    {
        $headers = [
            Constants::HEADER_UA_OS           => true,
            Constants::HEADER_SKYFIRE_VERSION => true,
            Constants::HEADER_BLUECOAT_VIA    => true,
            Constants::HEADER_BOLT_PHONE_UA   => true,
            Constants::HEADER_UCBROWSER_UA    => true,
            Constants::HEADER_MOBILE_UA       => true,
            Constants::HEADER_REQUESTED_WITH  => true,
            Constants::HEADER_ORIGINAL_UA     => true,
            Constants::HEADER_USERAGENT  => true,
        ];

        foreach (array_keys($headers) as $header) {
            if (array_key_exists($header, $this->filteredHeaders)) {
                return $this->filteredHeaders[$header];
            }
        }

        return '';
    }

    /**
     * @return void
     */
    private function filterHeaders(): void
    {
        $loader = new HeaderLoader();

        foreach (self::HEADERS as $header) {
            if (!array_key_exists($header, $this->headers)) {
                continue;
            }

            try {
                $headerObj = $loader->load($header, $this->headers[$header]);
            } catch (NotFoundException $e) {
                continue;
            }

            $this->filteredHeaders[$header] = $headerObj;
        }
    }
}
