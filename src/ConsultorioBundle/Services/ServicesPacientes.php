<?php

    namespace ConsultorioBundle\Services;

    use Doctrine\ORM\EntityManager;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class ServicesPacientes {

        /**
         * @var EntityManager
         */
        private $entityManager;

        /**
         * @var ContainerInterface
         */
        private $container;

        /**
         * ServicesConsultorios constructor.
         *
         * @param EntityManager $entityManager
         * @param ContainerInterface $container
         */
        function __construct(EntityManager $entityManager, ContainerInterface $container) {

            $this->entityManager = $entityManager;
            $this->container = $container;
        }

        /**
         * Listado
         *
         * @return array
         */
        public function getIndex() {

            
        }

    }