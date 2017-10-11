<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность тэга объявлений
 *
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Заголовок
     *
     * @ORM\Column(type="string", length=200, unique=true)
     */
    protected $title;
}