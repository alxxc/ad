<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность объявления
 *
 * @ORM\Entity
 * @ORM\Table(
 *     name="ad",
 *     indexes={
 *          @ORM\Index(name="time_created_idx", columns={"time_created"}),
 *          @ORM\Index(name="time_updated_idx", columns={"time_updated"})
 *     }
 * )
 */
class Ad
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
     * @ORM\Column(type="string", length=200)
     */
    protected $title;

    /**
     * Описание
     *
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * Клиент
     *
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * Тематика
     *
     * @ORM\Column(type="string", length=200)
     */
    protected $theme;

    /**
     * Тэги
     *
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="ads_tags",
     *      joinColumns={@ORM\JoinColumn(name="ad_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    protected $tags;

    /**
     * Дата создания
     *
     * @ORM\Column(type="datetime", name="time_created")
     */
    protected $timeCreated;

    /**
     * Дата редактирования
     *
     * @ORM\Column(type="datetime", name="time_updated")
     */
    protected $timeUpdated;
}