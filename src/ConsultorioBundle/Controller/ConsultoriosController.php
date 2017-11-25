<?php

namespace ConsultorioBundle\Controller;

use ConsultorioBundle\Entity\Consultorios;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Consultorio controller.
 *
 * @Route("/consultorios")
 */
class ConsultoriosController extends Controller
{

    /**
     * Lists all consultorio entities.
     *
     * @Route("/", name="consultorios_index")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $consultorios = $this->get('app.consultorios')->getIndex();

        return $this->render('consultorios/index.html.twig', array(
            'consultorios' => $consultorios,
        ));
    }

    /**
     * Creates a new consultorio entity.
     *
     * @Route("/new", name="consultorios_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $consultorio = new Consultorios();
        $form = $this->createForm('ConsultorioBundle\Form\ConsultoriosType', $consultorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.consultorios')->getNew($consultorio);
            $em = $this->getDoctrine()->getManager();
            $em->persist($consultorio);
            $em->flush();

            return $this->redirectToRoute('consultorios_show', array('id' => $consultorio->getId()));
        }

        return $this->render('consultorios/new.html.twig', array(
            'consultorio' => $consultorio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a consultorio entity.
     *
     * @Route("/{id}", name="consultorios_show")
     * @Method("GET")
     * @param Consultorios $consultorio
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Consultorios $consultorio)
    {
        $deleteForm = $this->createDeleteForm($consultorio);

        return $this->render('consultorios/show.html.twig', array(
            'consultorio' => $this->get('app.consultorios')->getShow($consultorio),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing consultorio entity.
     *
     * @Route("/{id}/edit", name="consultorios_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Consultorios $consultorio
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Consultorios $consultorio)
    {
        $deleteForm = $this->createDeleteForm($consultorio);
        $editForm = $this->createForm('ConsultorioBundle\Form\ConsultoriosType', $consultorio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('app.consultorios')->getEdit($consultorio);

            return $this->redirectToRoute('consultorios_edit', array('id' => $consultorio->getId()));
        }

        return $this->render('consultorios/edit.html.twig', array(
            'consultorio' => $consultorio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a consultorio entity.
     *
     * @Route("/{id}", name="consultorios_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Consultorios $consultorio
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Consultorios $consultorio)
    {
        $form = $this->createDeleteForm($consultorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.consultorios')->getDelete($consultorio);
            $em = $this->getDoctrine()->getManager();
            $em->remove($consultorio);
            $em->flush();
        }

        return $this->redirectToRoute('consultorios_index');
    }

    /**
     * Creates a form to delete a consultorio entity.
     *
     * @param Consultorios $consultorio The consultorio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Consultorios $consultorio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('consultorios_delete', array('id' => $consultorio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
