<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\MediaBundle\Document;

use Sonata\DatagridBundle\Pager\PagerInterface;
use Sonata\Doctrine\Document\BaseDocumentManager;

/**
 * @final since sonata-project/media-bundle 3.21.0
 */
class MediaManager extends BaseDocumentManager
{
    public function save($entity, $andFlush = true): void
    {
        // BC compatibility for $context parameter
        if ($andFlush && \is_string($andFlush)) {
            $entity->setContext($andFlush);
        }

        // BC compatibility for $providerName parameter
        if (3 === \func_num_args()) {
            $entity->setProviderName(func_get_arg(2));
        }

        if ($andFlush && \is_bool($andFlush)) {
            parent::save($entity, $andFlush);
        } else {
            // BC compatibility with previous signature
            parent::save($entity, true);
        }
    }

    public function getPager(array $criteria, int $page, int $limit = 10, array $sort = []): PagerInterface
    {
        throw new \BadMethodCallException('Not implemented yet.');
    }
}
