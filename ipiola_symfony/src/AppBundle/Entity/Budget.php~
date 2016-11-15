<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Budget
 *
 * @ORM\Table(name="budget")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BudgetRepository")
 */
class Budget
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="totalCost", type="decimal", precision=3, scale=0)
     */
    private $totalCost = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="materialCost", type="decimal", precision=3, scale=0)
     */
    private $materialCost = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="labourCost", type="decimal", precision=3, scale=0)
     */
    private $labourCost = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="machineryCost", type="decimal", precision=3, scale=0)
     */
    private $machineryCost = 0;

    /**
    * @ORM\ManyToOne(targetEntity="Building", inversedBy="budgets")
    * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
    */
    private $building;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Budget
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set totalCost
     *
     * @param string $totalCost
     *
     * @return Budget
     */
    public function setTotalCost($totalCost)
    {
        return false;
    }

    /**
     * Get totalCost
     *
     * @return string
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * Set materialCost
     *
     * @param string $materialCost
     *
     * @return Budget
     */
    public function setMaterialCost($materialCost)
    {
        $this->materialCost = $materialCost;

        $this->calcTotalCost();

        return $this;
    }

    /**
     * Get materialCost
     *
     * @return string
     */
    public function getMaterialCost()
    {
        return $this->materialCost;
    }

    /**
     * Set labourCost
     *
     * @param string $labourCost
     *
     * @return Budget
     */
    public function setLabourCost($labourCost)
    {
        $this->labourCost = $labourCost;

        $this->calcTotalCost();

        return $this;
    }

    /**
     * Get labourCost
     *
     * @return string
     */
    public function getLabourCost()
    {
        return $this->labourCost;
    }

    /**
     * Set machineryCost
     *
     * @param string $machineryCost
     *
     * @return Budget
     */
    public function setMachineryCost($machineryCost)
    {
        $this->machineryCost = $machineryCost;

        $this->calcTotalCost();

        return $this;
    }

    /**
     * Get machineryCost
     *
     * @return string
     */
    public function getMachineryCost()
    {
        return $this->machineryCost;
    }

    /**
     * Set building
     *
     * @param \AppBundle\Entity\Building $building
     *
     * @return Budget
     */
    public function setBuilding(\AppBundle\Entity\Building $building = null)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return \AppBundle\Entity\Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    private function calcTotalCost()
    {
        $this->totalCost = $this->materialCost + $this->labourCost + $this->machineryCost;
    }
}
