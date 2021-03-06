<?php

declare(strict_types=1);

/*
 * This file is part of the Compotes package.
 *
 * (c) Alex "Pierstoval" Rock <pierstoval@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Admin;

use App\Form\DataTransformer\TagAdminTransformer;
use App\Repository\TagRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class AdminTagRuleController extends EasyAdminController
{
    private TagRepository $tagsRepo;

    public function __construct(TagRepository $tagsRepo)
    {
        $this->tagsRepo = $tagsRepo;
    }

    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        $qb = parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

        $qb
            ->leftJoin('entity.tags', 'tags')
            ->addSelect('tags')
        ;

        return $qb;
    }

    protected function createEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);

        $builder
            ->get('tags')
            ->addViewTransformer(new TagAdminTransformer($this->tagsRepo, $this->em))
        ;

        return $builder;
    }
}
