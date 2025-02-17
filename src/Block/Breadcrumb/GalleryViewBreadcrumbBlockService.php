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

namespace Sonata\MediaBundle\Block\Breadcrumb;

use Knp\Menu\ItemInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * BlockService for view gallery.
 *
 * @author Sylvain Deloux <sylvain.deloux@ekino.com>
 */
final class GalleryViewBreadcrumbBlockService extends BaseGalleryBreadcrumbBlockService
{
    public function getName()
    {
        return 'Breadcrumb View: Media Gallery';
    }

    public function configureSettings(OptionsResolver $resolver): void
    {
        parent::configureSettings($resolver);

        $resolver->setDefaults([
            'gallery' => false,
        ]);
    }

    protected function getMenu(BlockContextInterface $blockContext): ItemInterface
    {
        $menu = $this->getRootMenu($blockContext);

        if ($gallery = $blockContext->getBlock()->getSetting('gallery')) {
            $menu->addChild($gallery->getName(), [
                'route' => 'sonata_media_gallery_view',
                'routeParameters' => [
                    'id' => $gallery->getId(),
                ],
            ]);
        }

        return $menu;
    }

    protected function getContext(): string
    {
        return 'media';
    }
}
