<?php

namespace App\DataFixtures;

use App\Factory\AliasFactory;
use App\Repository\DomainRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAliasData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository('App:User')->findByEmail('admin@example.org');
        $domain = $this->getRepository()->findByName('example.org');

        for ($i = 1; $i < 5; ++$i) {
            $alias = AliasFactory::create($user, 'alias'.$i);

            $manager->persist($alias);
            $manager->flush();
        }

        for ($i = 1; $i < 5; ++$i) {
            $alias = AliasFactory::create($user, null);

            $manager->persist($alias);
            $manager->flush();
        }
    }

    /**
     * @return DomainRepository
     */
    private function getRepository()
    {
        return $this->container->get('doctrine')->getRepository('App:Domain');
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
