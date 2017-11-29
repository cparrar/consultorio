<?php

    namespace ConsultorioBundle\Services;

    use ConsultorioBundle\Entity\Medicos;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Query\Expr\Join;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class ServicesMedicos {

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

            $qb->select('m.id AS id, m.nombre AS nombre, m.apellido AS apellido, m.isActivo, e.nombre AS especialidad')
                ->from('ConsultorioBundle:Medicos', 'm')
                ->innerJoin('ConsultorioBundle:Especialidades', 'e', Join::WITH, $qb->expr()->eq('e.id', 'm.especialidad'))
                ->where($qb->expr()->eq('m.isActivo', $qb->expr()->literal('1')))
                ->addOrderBy('m.apellido', 'ASC')
                ->addOrderBy('m.nombre', 'ASC')
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getResult();
        }

        /**
         * Insert de Datos
         *
         * @param Medicos $medicos
         */
        public function getNew(Medicos $medicos) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->insert('MEDICOS')
                ->setValue('ID', $qb->expr()->literal('NULL'))
                ->setValue('NOMBRE', $qb->expr()->literal($medicos->getNombre()))
                ->setValue('APELLIDO', $qb->expr()->literal($medicos->getApellido()))
                ->setValue('ESPECIALIDAD', $qb->expr()->literal($medicos->getEspecialidad()->getId()))
                ->setValue('CONSULTORIO', $qb->expr()->literal($medicos->getConsultorio()->getId()))
                ->setValue('ESTADO', $qb->expr()->literal(1))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Mostrar un registro
         *
         * @param Medicos $medicos
         * @return mixed
         */
        public function getShow(Medicos $medicos) {

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('m.id AS id, m.nombre AS nombre, m.apellido AS apellido, m.isActivo, e.nombre AS especialidad')
                ->from('ConsultorioBundle:Medicos', 'm')
                ->innerJoin('ConsultorioBundle:Especialidades', 'e', Join::WITH, $qb->expr()->eq('e.id', 'm.especialidad'))
                ->where($qb->expr()->eq('m.id', $qb->expr()->literal($medicos->getId())))
                ->addOrderBy('m.apellido', 'ASC')
                ->addOrderBy('m.nombre', 'ASC')
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getOneOrNullResult();
        }

        /**
         * Actualizacion de datos
         *
         * @param Medicos $medicos
         */
        public function getEdit(Medicos $medicos) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->update('MEDICOS')
                ->set('NOMBRE', $qb->expr()->literal($medicos->getNombre()))
                ->set('APELLIDO', $qb->expr()->literal($medicos->getApellido()))
                ->set('ESPECIALIDAD', $qb->expr()->literal($medicos->getEspecialidad()->getId()))
                ->set('CONSULTORIO', $qb->expr()->literal($medicos->getConsultorio()->getId()))
                ->set('ESTADO', $qb->expr()->literal('1'))
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($medicos->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }
        /**
         * Borrado de Datos
         *
         * @param Medicos $medicos
         */
        public function getDelete(Medicos $medicos) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->delete('MEDICOS')
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($medicos->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

    }