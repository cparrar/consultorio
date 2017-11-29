<?php

namespace ConsultorioBundle\Controller;

use ConsultorioBundle\Entity\Citas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cita controller.
 *
 * @Route("citas")
 */
class CitasController extends Controller
{
    /**
     * Lists all cita entities.
     *
     * @Route("/", name="citas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('citas/index.html.twig', array(
            'citas' => $this->get('app.citas')->getIndex(),
        ));
    }

    /**
     * Creates a new cita entity.
     *
     * @Route("/new", name="citas_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $cita = new Citas();
        $form = $this->createForm('ConsultorioBundle\Form\CitasType', $cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cita);
            $em->flush();

            $this->get('app.citas')->getNew($cita);

            return $this->redirectToRoute('citas_show', array('id' => $cita->getId()));
        }

        return $this->render('citas/new.html.twig', array(
            'cita' => $cita,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cita entity.
     *
     * @Route("/{id}", name="citas_show")
     * @Method("GET")
     * @param Citas $cita
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Citas $cita)
    {
        $deleteForm = $this->createDeleteForm($cita);

        return $this->render('citas/show.html.twig', array(
            'cita' => $this->get('app.citas')->getShow($cita),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cita entity.
     *
     * @Route("/{id}/edit", name="citas_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Citas $cita
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Citas $cita)
    {
        $deleteForm = $this->createDeleteForm($cita);
        $editForm = $this->createForm('ConsultorioBundle\Form\CitasType', $cita, [
            'method' => 'POST',
            'action' => $this->generateUrl('citas_edit', ['id' => $cita->getId()])
        ]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('app.citas')->getEdit($cita);

            return $this->redirectToRoute('citas_edit', array('id' => $cita->getId()));
        }

        return $this->render('citas/edit.html.twig', array(
            'cita' => $cita,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cita entity.
     *
     * @Route("/{id}", name="citas_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Citas $cita
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Citas $cita)
    {
        $form = $this->createDeleteForm($cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.citas')->getDelete($cita);
            $em = $this->getDoctrine()->getManager();
            $em->remove($cita);
            $em->flush();
        }

        return $this->redirectToRoute('citas_index');
    }

    /**
     * Creates a form to delete a cita entity.
     *
     * @param Citas $cita The cita entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Citas $cita)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('citas_delete', array('id' => $cita->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
