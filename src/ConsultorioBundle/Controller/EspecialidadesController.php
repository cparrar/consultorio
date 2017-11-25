<?php

namespace ConsultorioBundle\Controller;

use ConsultorioBundle\Entity\Especialidades;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Especialidade controller.
 *
 * @Route("/especialidades")
 */
class EspecialidadesController extends Controller
{
    /**
     * Lists all especialidade entities.
     *
     * @Route("/", name="especialidades_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $especialidades = $em->getRepository('ConsultorioBundle:Especialidades')->findAll();

        return $this->render('especialidades/index.html.twig', array(
            'especialidades' => $especialidades,
        ));
    }

    /**
     * Creates a new especialidade entity.
     *
     * @Route("/new", name="especialidades_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $especialidade = new Especialidades();
        $form = $this->createForm('ConsultorioBundle\Form\EspecialidadesType', $especialidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($especialidade);
            $em->flush();

            return $this->redirectToRoute('especialidades_show', array('id' => $especialidade->getId()));
        }

        return $this->render('especialidades/new.html.twig', array(
            'especialidade' => $especialidade,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a especialidade entity.
     *
     * @Route("/{id}", name="especialidades_show")
     * @Method("GET")
     * @param Especialidades $especialidade
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Especialidades $especialidade)
    {
        $deleteForm = $this->createDeleteForm($especialidade);

        return $this->render('especialidades/show.html.twig', array(
            'especialidade' => $especialidade,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing especialidade entity.
     *
     * @Route("/{id}/edit", name="especialidades_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Especialidades $especialidade
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Especialidades $especialidade)
    {
        $deleteForm = $this->createDeleteForm($especialidade);
        $editForm = $this->createForm('ConsultorioBundle\Form\EspecialidadesType', $especialidade);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('especialidades_edit', array('id' => $especialidade->getId()));
        }

        return $this->render('especialidades/edit.html.twig', array(
            'especialidade' => $especialidade,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a especialidade entity.
     *
     * @Route("/{id}", name="especialidades_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Especialidades $especialidade
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Especialidades $especialidade)
    {
        $form = $this->createDeleteForm($especialidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($especialidade);
            $em->flush();
        }

        return $this->redirectToRoute('especialidades_index');
    }

    /**
     * Creates a form to delete a especialidade entity.
     *
     * @param Especialidades $especialidade The especialidade entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Especialidades $especialidade)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('especialidades_delete', array('id' => $especialidade->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
