<?php

namespace ConsultorioBundle\Controller;

use ConsultorioBundle\Entity\Pacientes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Paciente controller.
 *
 * @Route("/pacientes")
 */
class PacientesController extends Controller
{
    /**
     * Lists all paciente entities.
     *
     * @Route("/", name="paciente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('pacientes/index.html.twig', array(
            'pacientes' => $this->get('app.pacientes')->getIndex(),
        ));
    }

    /**
     * Creates a new paciente entity.
     *
     * @Route("/new", name="paciente_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $paciente = new Pacientes();
        $form = $this->createForm('ConsultorioBundle\Form\PacientesType', $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();

            $this->get('app.pacientes')->getNew($paciente);

            return $this->redirectToRoute('paciente_show', array('id' => $paciente->getId()));
        }

        return $this->render('pacientes/new.html.twig', array(
            'paciente' => $paciente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paciente entity.
     *
     * @Route("/{id}", name="paciente_show")
     * @Method("GET")
     * @param Pacientes $paciente
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Pacientes $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);

        return $this->render('pacientes/show.html.twig', array(
            'paciente' => $this->get('app.pacientes')->getShow($paciente),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paciente entity.
     *
     * @Route("/{id}/edit", name="paciente_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Pacientes $paciente
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Pacientes $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);
        $editForm = $this->createForm('ConsultorioBundle\Form\PacientesType', $paciente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('app.pacientes')->getEdit($paciente);

            return $this->redirectToRoute('paciente_edit', array('id' => $paciente->getId()));
        }

        return $this->render('pacientes/edit.html.twig', array(
            'paciente' => $paciente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paciente entity.
     *
     * @Route("/{id}", name="paciente_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Pacientes $paciente
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Pacientes $paciente)
    {
        $form = $this->createDeleteForm($paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.pacientes')->getDelete($paciente);
            $em = $this->getDoctrine()->getManager();
            $em->remove($paciente);
            $em->flush();
        }

        return $this->redirectToRoute('paciente_index');
    }

    /**
     * Creates a form to delete a paciente entity.
     *
     * @param Pacientes $paciente The paciente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pacientes $paciente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paciente_delete', array('id' => $paciente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
