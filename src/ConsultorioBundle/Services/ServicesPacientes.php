<?php

    namespace ConsultorioBundle\Services;

    use ConsultorioBundle\Entity\Pacientes;
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

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('p.id AS id, p.documento AS documento, p.nombre AS nombre, p.apellido AS apellido, p.nacimientoAt AS nacimientoAt, p.email AS email, p.direccion AS direccion, p.telefono AS telefono, p.creadoAt AS creadoAt, p.isActivo AS isActivo')
                ->from('ConsultorioBundle:Pacientes', 'p')
                ->where($qb->expr()->eq('p.isActivo', $qb->expr()->literal('1')))
                ->orderBy('p.id', 'ASC')
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getResult();
        }

        /**
         * Insert de Datos
         *
         * @param Pacientes $pacientes
         */
        public function getNew(Pacientes $pacientes) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->insert('PACIENTES')
                ->setValue('ID', $qb->expr()->literal('NULL'))
                ->setValue('DOCUMENTO', $qb->expr()->literal($pacientes->getDocumento()))
                ->setValue('NOMBRE', $qb->expr()->literal($pacientes->getNombre()))
                ->setValue('APELLIDO', $qb->expr()->literal($pacientes->getApellido()))
                ->setValue('FECHA_NACIMIENTO', $qb->expr()->literal($pacientes->getNacimientoAt()->format('Y-m-d H:i:s')))
                ->setValue('CORREO', $qb->expr()->literal($pacientes->getEmail()))
                ->setValue('DIRECCION', $qb->expr()->literal($pacientes->getDireccion()))
                ->setValue('TELEFONO', $qb->expr()->literal($pacientes->getTelefono()))
                ->setValue('CREADO', $qb->expr()->literal($pacientes->getCreadoAt()->format('Y-m-d H:i:s')))
                ->setValue('ESTADO', $qb->expr()->literal('1'))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Mostrar un registro
         *
         * @param Pacientes $pacientes
         * @return mixed
         */
        public function getShow(Pacientes $pacientes) {

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('p.id AS id, p.documento AS documento, p.nombre AS nombre, p.apellido AS apellido, p.nacimientoAt AS nacimientoAt, p.email AS email, p.direccion AS direccion, p.telefono AS telefono, p.creadoAt AS creadoAt, p.isActivo AS isActivo')
                ->from('ConsultorioBundle:Pacientes', 'p')
                ->where($qb->expr()->eq('p.id', $qb->expr()->literal($pacientes->getId())))
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getOneOrNullResult();
        }

        /**
         * Actualizacion de datos
         *
         * @param Pacientes $pacientes
         */
        public function getEdit(Pacientes $pacientes) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->update('PACIENTES')
                ->set('DOCUMENTO', $qb->expr()->literal($pacientes->getDocumento()))
                ->set('NOMBRE', $qb->expr()->literal($pacientes->getNombre()))
                ->set('APELLIDO', $qb->expr()->literal($pacientes->getApellido()))
                ->set('FECHA_NACIMIENTO', $qb->expr()->literal($pacientes->getNacimientoAt()->format('Y-m-d H:i:s')))
                ->set('CORREO', $qb->expr()->literal($pacientes->getEmail()))
                ->set('DIRECCION', $qb->expr()->literal($pacientes->getDireccion()))
                ->set('TELEFONO', $qb->expr()->literal($pacientes->getTelefono()))
                ->set('CREADO', $qb->expr()->literal($pacientes->getCreadoAt()->format('Y-m-d H:i:s')))
                ->set('ESTADO', $qb->expr()->literal('1'))
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($pacientes->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Borrado de Datos
         *
         * @param Pacientes $pacientes
         */
        public function getDelete(Pacientes $pacientes) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->delete('PACIENTES')
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($pacientes->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }
    }