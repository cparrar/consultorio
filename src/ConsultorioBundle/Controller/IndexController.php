<?php

    namespace ConsultorioBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * Class IndexController
     *
     * @package ConsultorioBundle\Controller
     */
    class IndexController extends Controller {

        /**
         * @Route(path="/", name="home")
         * @param Request $request
         */
        public function indexAction(Request $request) {
            dump($request);die;
        }
    }
