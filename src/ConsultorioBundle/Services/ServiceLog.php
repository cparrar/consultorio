<?php

    namespace ConsultorioBundle\Services;

    use Symfony\Component\Filesystem\Filesystem;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

    /**
     * Class ServiceLog
     *
     * @package ConsultorioBundle\Services
     */
    class ServiceLog {

        /**
         * @var Filesystem
         */
        private $filesystem;

        /**
         * @var string
         */
        private $file;

        /**
         * ServiceLog constructor.
         *
         * @param Filesystem $filesystem
         */
        function __construct(Filesystem $filesystem) {

            $this->filesystem = $filesystem;
            $this->file = dirname(__DIR__).'/Log/queries.log';
        }

        /**
         * @param null $string
         * @return null
         */
        public function setLog($string = null) {

            if($this->filesystem->exists($this->file) != true) {
                $this->filesystem->touch($this->file);
            }
            $this->filesystem->appendToFile($this->file, sprintf("%s\n", $string));
            return null;
        }
    }