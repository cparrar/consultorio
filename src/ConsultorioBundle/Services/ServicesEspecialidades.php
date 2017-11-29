<?php

    namespace ConsultorioBundle\Services;

    use ConsultorioBundle\Entity\Especialidades;
    use Doctrine\ORM\EntityManager;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    /**
     * Class ServicesEspecialidades
     *
     * @package ConsultorioBundle\Services
     */
    class ServicesEspecialidades {

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

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('e.id AS id, e.nombre AS nombre, e.isActivo AS isActivo')
                ->from('ConsultorioBundle:Especialidades', 'e')
                ->where($qb->expr()->eq('e.isActivo', $qb->expr()->literal('1')))
                ->orderBy('e.nombre', 'ASC')
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getResult();
        }

        /**
         * Insert de Datos
         *
         * @param Especialidades $especialidades
         */
        public function getNew(Especialidades $especialidades) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->insert('ESPECIALIDADES')
                ->setValue('ID', $qb->expr()->literal('NULL'))
                ->setValue('NOMBRE', $qb->expr()->literal($especialidades->getNombre()))
                ->setValue('ESTADO', $qb->expr()->literal(1))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Mostrar un registro
         *
         * @param Especialidades $especialidades
         * @return mixed
         */
        public function getShow(Especialidades $especialidades) {

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('e.id AS id, e.nombre AS nombre, e.isActivo AS isActivo')
                ->from('ConsultorioBundle:Especialidades', 'e')
                ->where($qb->expr()->eq('e.id', $qb->expr()->literal($especialidades->getId())))
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getOneOrNullResult();
        }

        /**
         * Actualizacion de datos
         *
         * @param Especialidades $especialidades
         */
        public function getEdit(Especialidades $especialidades) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->update('ESPECIALIDADES')
                ->set('NOMBRE', $qb->expr()->literal($especialidades->getNombre()))
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($especialidades->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Borrado de Datos
         *
         * @param Especialidades $especialidades
         */
        public function getDelete(Especialidades $especialidades) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->delete('ESPECIALIDADES')
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($especialidades->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }
    }