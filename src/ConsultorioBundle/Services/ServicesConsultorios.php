<?php

    namespace ConsultorioBundle\Services;

    use ConsultorioBundle\Entity\Consultorios;
    use Doctrine\ORM\EntityManager;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class ServicesConsultorios {

        private $entityManager;
        private $container;

        function __construct(EntityManager $entityManager, ContainerInterface $container) {

            $this->entityManager = $entityManager;
            $this->container = $container;
        }

        /**
         * Listado de Consultorios
         *
         * @return array
         */
        public function getIndex() {

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('c.id AS id, c.nombre, c.isActivo')
                ->from('ConsultorioBundle:Consultorios', 'c')
                ->where($qb->expr()->eq('c.isActivo', $qb->expr()->literal('1')))
                ->orderBy('c.id', 'ASC')
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getResult();
        }

        /**
         * Insert de Datos
         *
         * @param Consultorios $consultorios
         */
        public function getNew(Consultorios $consultorios) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->insert('CONSULTORIOS')
                ->setValue('ID', $qb->expr()->literal('NULL'))
                ->setValue('NOMBRE', $qb->expr()->literal($consultorios->getNombre()))
                ->setValue('ESTADO', $qb->expr()->literal(1))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Mostrar un registro
         *
         * @param Consultorios $consultorios
         * @return mixed
         */
        public function getShow(Consultorios $consultorios) {

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('c.id AS id, c.nombre, c.isActivo')
                ->from('ConsultorioBundle:Consultorios', 'c')
                ->where($qb->expr()->eq('c.id', $qb->expr()->literal($consultorios->getId())))
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getOneOrNullResult();
        }

        /**
         * Actualizacion de datos
         *
         * @param Consultorios $consultorios
         */
        public function getEdit(Consultorios $consultorios) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->update('CONSULTORIOS')
                ->set('NOMBRE', $qb->expr()->literal($consultorios->getNombre()))
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($consultorios->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Borrado de Datos
         *
         * @param Consultorios $consultorios
         */
        public function getDelete(Consultorios $consultorios) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->delete('CONSULTORIOS')
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($consultorios->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }
    }