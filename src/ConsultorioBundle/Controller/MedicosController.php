<?php

namespace ConsultorioBundle\Controller;

use ConsultorioBundle\Entity\Medicos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Medico controller.
 *
 * @Route("/medicos")
 */
class MedicosController extends Controller
{
    /**
     * Lists all medico entities.
     *
     * @Route("/", name="medicos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medicos = $em->getRepository('ConsultorioBundle:Medicos')->findAll();

        return $this->render('medicos/index.html.twig', array(
            'medicos' => $medicos,
        ));
    }

    /**
     * Creates a new medico entity.
     *
     * @Route("/new", name="medicos_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $medico = new Medicos();
        $form = $this->createForm('ConsultorioBundle\Form\MedicosType', $medico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medico);
            $em->flush();

            return $this->redirectToRoute('medicos_show', array('id' => $medico->getId()));
        }

        return $this->render('medicos/new.html.twig', array(
            'medico' => $medico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medico entity.
     *
     * @Route("/{id}", name="medicos_show")
     * @Method("GET")
     * @param Medicos $medico
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Medicos $medico)
    {
        $deleteForm = $this->createDeleteForm($medico);

        return $this->render('medicos/show.html.twig', array(
            'medico' => $medico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medico entity.
     *
     * @Route("/{id}/edit", name="medicos_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Medicos $medico
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Medicos $medico)
    {
        $deleteForm = $this->createDeleteForm($medico);
        $editForm = $this->createForm('ConsultorioBundle\Form\MedicosType', $medico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicos_edit', array('id' => $medico->getId()));
        }

        return $this->render('medicos/edit.html.twig', array(
            'medico' => $medico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medico entity.
     *
     * @Route("/{id}", name="medicos_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Medicos $medico
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Medicos $medico)
    {
        $form = $this->createDeleteForm($medico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medico);
            $em->flush();
        }

        return $this->redirectToRoute('medicos_index');
    }

    /**
     * Creates a form to delete a medico entity.
     *
     * @param Medicos $medico The medico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Medicos $medico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medicos_delete', array('id' => $medico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
