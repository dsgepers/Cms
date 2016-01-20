<?php

namespace Opifer\CmsBundle\Entity;

use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use Opifer\EavBundle\Model\EntityInterface;
use Opifer\FormBundle\Model\Post as BasePost;

/**
 * Post
 *
 * @ORM\Entity()
 * @ORM\Table(name="post")
 * @JMS\ExclusionPolicy("all")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @GRID\Source(columns="id, submittedAt")
 */
class Post extends BasePost implements EntityInterface
{
}
