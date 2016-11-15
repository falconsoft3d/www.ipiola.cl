<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Building;
use AppBundle\Entity\Budget;

class LoadData extends AbstractFixture
{
    protected $lorem;

    public function __construct()
    {
        $this->lorem = <<<EOD
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et dui vestibulum, bibendum purus sit amet, vulputate mauris. Ut adipiscing gravida tincidunt. Duis euismod placerat rhoncus. Phasellus mollis imperdiet placerat. Sed ac turpis nisl. Mauris at ante mauris. Aliquam posuere fermentum lorem, a aliquam mauris rutrum a. Curabitur sit amet pretium lectus, nec consequat orci.

Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis et metus in libero sollicitudin venenatis eu sed enim. Nam felis lorem, suscipit ac nisl ac, iaculis dapibus tellus. Cras ante justo, aliquet quis placerat nec, molestie id turpis. Cras at tincidunt magna. Mauris aliquam sem sit amet dapibus venenatis. Sed metus orci, tincidunt sed fermentum non, ornare non quam. Aenean nec turpis at libero lobortis pretium.
EOD;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadBuildings($manager);
        $this->loadBudgets($manager);

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        $dev = new User();
        $dev->setUsername('dev');
        $dev->setEmail('dev@localhost.com');
        $dev->setPlainPassword('dev123');
        $dev->setEnabled(true);
        $dev->setRoles(['ROLE_ADMIN']);

        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setEmail('user1@localhost.com');
        $user1->setPlainPassword('user123');
        $user1->setEnabled(true);
        $user1->setRoles(['ROLE_USER']);

        $user2 = new User();
        $user2->setUsername('user2');
        $user2->setEmail('user2@localhost.com');
        $user2->setPlainPassword('user123');
        $user2->setEnabled(true);
        $user2->setRoles(['ROLE_USER']);

        $manager->persist($dev);
        $manager->persist($user1);

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }

    public function loadBuildings(ObjectManager $manager)
    {
        $building1 = new Building();
        $building1->setName('Obra1 Obra1 Obra1');
        $building1->setArchitect('NombreArquitecto PrimerApellido Segundo');
        $building1->setComments($this->lorem);
        $building1->setOwner($this->getReference('user1'));
        $building1->setImageName('demo/1.jpg');

        $building2 = new Building();
        $building2->setName('Obra2 Obra2 Obra2');
        $building2->setArchitect('NombreArquitecto PrimerApellido Segundo');
        $building2->setComments($this->lorem);
        $building2->setOwner($this->getReference('user1'));
        $building2->setImageName('demo/2.jpg');

        $building3 = new Building();
        $building3->setName('Obra3 Obra3 Obra3');
        $building3->setArchitect('NombreArquitecto PrimerApellido Segundo');
        $building3->setComments($this->lorem);
        $building3->setOwner($this->getReference('user2'));
        $building3->setImageName('demo/1.jpg');

        $manager->persist($building1);
        $manager->persist($building2);
        $manager->persist($building3);

        $this->addReference('building1', $building1);
        $this->addReference('building2', $building2);
        $this->addReference('building3', $building3);
    }

    public function loadBudgets(ObjectManager $manager)
    {
        $budget1 = new Budget();
        $budget1->setName('Presupuesto1');
        $budget1->setMaterialCost(123,45);
        $budget1->setLabourCost(678,90);
        $budget1->setMachineryCost(111,23);
        $budget1->setBuilding($this->getReference('building1'));

        $budget2 = new Budget();
        $budget2->setName('Presupuesto2');
        $budget2->setMaterialCost(111,23);
        $budget2->setLabourCost(678,90);
        $budget2->setMachineryCost(123,45);
        $budget2->setBuilding($this->getReference('building1'));

        $budget3 = new Budget();
        $budget3->setName('Presupuesto3');
        $budget3->setMaterialCost(678,90);
        $budget3->setLabourCost(123,45);
        $budget3->setMachineryCost(111,23);
        $budget3->setBuilding($this->getReference('building2'));
    }
}