<?php

    namespace ConsultorioBundle\DataFixtures\ORM;

    use ConsultorioBundle\Entity\Consultorios;
    use ConsultorioBundle\Entity\Especialidades;
    use ConsultorioBundle\Entity\Medicos;
    use ConsultorioBundle\Entity\Pacientes;
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Faker\Factory;

    class DemoFixtures extends AbstractFixture implements OrderedFixtureInterface {

        /**
         * Load data fixtures with the passed EntityManager
         *
         * @param ObjectManager $manager
         */
        public function load(ObjectManager $manager)
        {
            $this->setEspecialidades($manager);
            $this->setConsultorios($manager);
            $this->setMedicos($manager);
            $this->setPacientes($manager);
        }

        private function setPacientes(ObjectManager $manager) {

            $faker = Factory::create();

            for ($i = 1; $i <= 4; $i++) {
                $entity = new Pacientes();
                $entity->setNombre($faker->firstName);
                $entity->setApellido($faker->lastName);
                $entity->setDireccion($faker->address);
                $entity->setDocumento(rand(10000, 99999));
                $entity->setEmail($faker->companyEmail);
                $entity->setNacimientoAt(new \DateTime());
                $entity->setTelefono($faker->phoneNumber);

                $manager->persist($entity);
            }

            $manager->flush();
        }

        /**
         * @param ObjectManager $manager
         */
        private function setMedicos(ObjectManager $manager) {

            $faker = Factory::create();

            for ($i = 1; $i <= 4; $i++) {
                $entity = new Medicos();
                $entity->setNombre($faker->firstName);
                $entity->setApellido($faker->lastName);
                $entity->setConsultorio($this->getReference(sprintf('CONSULTORIO_%s01', $i)));
                $entity->setEspecialidad($this->getReference('ESPECIALIDAD_'.rand(1, 3)));
                $manager->persist($entity);
            }

            $manager->flush();
        }

        /**
         * @param ObjectManager $manager
         */
        private function setConsultorios(ObjectManager $manager) {

            for ($i = 101; $i <= 401; $i = $i + 100) {
                $entity = new Consultorios();
                $entity->setNombre(sprintf('Consultorio %s', $i));
                $manager->persist($entity);
                $this->setReference('CONSULTORIO_'.$i, $entity);
            }

            $manager->flush();
        }

        /**
         * @param ObjectManager $manager
         */
        private function setEspecialidades(ObjectManager $manager) {

            $especialidades = ['MEDICINA GENERAL', 'PEDIATRIA', 'NEUROLOGIA'];

            foreach ($especialidades AS $key => $especialidad) {
                $entity = new Especialidades();
                $entity->setNombre($especialidad);
                $manager->persist($entity);
                $this->setReference('ESPECIALIDAD_'.($key + 1), $entity);
            }

            $manager->flush();
        }

        /**
         * Get the order of this fixture
         *
         * @return integer
         */
        public function getOrder()
        {
            return 1;
        }
    }