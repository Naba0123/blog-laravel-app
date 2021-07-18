<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Support\MarkdownImgPreUrl;

use League\CommonMark\EnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Inline\Element\Image;

final class ImgPreUrlProcessor
{
    /** @var EnvironmentInterface */
    private $environment;

    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param DocumentParsedEvent $e
     *
     * @return void
     */
    public function __invoke(DocumentParsedEvent $e)
    {
        $preUrl = $this->environment->getConfig('img_pre_url-pre_url', '/');
        $distinctionChar = $this->environment->getConfig('img_pre_url-distinction_char', '@');

        $walker = $e->getDocument()->walker();
        while ($event = $walker->next()) {
            if ($event->isEntering() && $event->getNode() instanceof Image) {
                /** @var Image $image */
                $image = $event->getNode();
                if (strpos($image->getUrl(), $distinctionChar) !== 0) {
                    continue;
                }
                $image->setUrl($preUrl . substr($image->getUrl(), 1));
            }
        }
    }
}
