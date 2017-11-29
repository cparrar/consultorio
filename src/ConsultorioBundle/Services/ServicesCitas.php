<?php

    namespace ConsultorioBundle\Services;

    use ConsultorioBundle\Entity\Citas;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Query\Expr\Join;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class ServicesCitas {

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

            $qb->select('c.id, c.fechaAt, c.precio')
                ->addSelect($qb->expr()->concat('p.nombre', $qb->expr()->concat($qb->expr()->literal(' '), 'p.apellido')).' AS paciente')
                ->addSelect($qb->expr()->concat('m.nombre', $qb->expr()->concat($qb->expr()->literal(' '), 'm.apellido')).' AS medico')
                ->addSelect('l.nombre as consultorio')
                ->from('ConsultorioBundle:Citas', 'c')
                ->innerJoin('ConsultorioBundle:Pacientes', 'p', Join::WITH, $qb->expr()->eq('p.id', 'c.paciente'))
                ->innerJoin('ConsultorioBundle:Medicos', 'm', Join::WITH, $qb->expr()->eq('m.id', 'c.medico'))
                ->innerJoin('ConsultorioBundle:Consultorios', 'l', Join::WITH, $qb->expr()->eq('l.id', 'm.consultorio'))
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
         * @param Citas $citas
         */
        public function getNew(Citas $citas) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->insert('CONSULTORIOS')
                ->setValue('ID', $qb->expr()->literal('NULL'))
                ->setValue('FECHA_CITA', $qb->expr()->literal($citas->getFechaAt()->format('Y-m-d H:i:s')))
                ->setValue('PRECIO', $qb->expr()->literal($citas->getPrecio()))
                ->setValue('FECHA_CREACION', $qb->expr()->literal($citas->getCreadoAt()->format('Y-m-d H:i:s')))
                ->setValue('FECHA_ACTUALIZADO', $qb->expr()->literal('NULL'))
                ->setValue('ASISTENCIA', $qb->expr()->literal($citas->getIsAsistencia()))
                ->setValue('PACIENTE', $qb->expr()->literal($citas->getPaciente()->getId()))
                ->setValue('MEDICO', $qb->expr()->literal($citas->getMedico()->getId()))
                ->setValue('ESTADO', $qb->expr()->literal(1))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }
        /**
         * Mostrar un registro
         *
         * @param Citas $citas
         * @return mixed
         */
        public function getShow(Citas $citas) {

            $qb = $this->entityManager->createQueryBuilder();

            $qb->select('c.id, c.fechaAt, c.precio')
                ->addSelect($qb->expr()->concat('p.nombre', $qb->expr()->concat($qb->expr()->literal(' '), 'p.apellido')).' AS paciente')
                ->addSelect($qb->expr()->concat('m.nombre', $qb->expr()->concat($qb->expr()->literal(' '), 'm.apellido')).' AS medico')
                ->addSelect('l.nombre as consultorio')
                ->from('ConsultorioBundle:Citas', 'c')
                ->innerJoin('ConsultorioBundle:Pacientes', 'p', Join::WITH, $qb->expr()->eq('p.id', 'c.paciente'))
                ->innerJoin('ConsultorioBundle:Medicos', 'm', Join::WITH, $qb->expr()->eq('m.id', 'c.medico'))
                ->innerJoin('ConsultorioBundle:Consultorios', 'l', Join::WITH, $qb->expr()->eq('l.id', 'm.consultorio'))
                ->where($qb->expr()->eq('c.id', $qb->expr()->literal($citas->getId())))
                ->orderBy('c.id', 'ASC')
            ;

            $query = $qb->getQuery();
            $this->container->get('app.log')->setLog($query->getSQL());

            return $query->getOneOrNullResult();
        }

        /**
         * Actualizacion de datos
         *
         * @param Citas $citas
         */
        public function getEdit(Citas $citas) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->update('CITAS')
                ->setValue('FECHA_CITA', $qb->expr()->literal($citas->getFechaAt()->format('Y-m-d H:i:s')))
                ->setValue('PRECIO', $qb->expr()->literal($citas->getPrecio()))
                ->setValue('FECHA_CREACION', $qb->expr()->literal($citas->getCreadoAt()->format('Y-m-d H:i:s')))
                ->setValue('FECHA_ACTUALIZADO', $qb->expr()->literal('NULL'))
                ->setValue('ASISTENCIA', $qb->expr()->literal($citas->getIsAsistencia()))
                ->setValue('PACIENTE', $qb->expr()->literal($citas->getPaciente()->getId()))
                ->setValue('MEDICO', $qb->expr()->literal($citas->getMedico()->getId()))
                ->setValue('ESTADO', $qb->expr()->literal(1))
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($citas->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }

        /**
         * Borrado de Datos
         *
         * @param Citas $citas
         */
        public function getDelete(Citas $citas) {

            $qb = $this->entityManager->getConnection()->createQueryBuilder();

            $qb->delete('CITAS')
                ->where($qb->expr()->eq('ID', $qb->expr()->literal($citas->getId())))
            ;
            $this->container->get('app.log')->setLog($qb->getSQL());
        }
    }