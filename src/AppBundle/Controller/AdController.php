<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ad controller.
 */
class AdController extends Controller
{
    /**
     * Lists all ad entities.
     *
     * @Route("/", name="ad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('AppBundle:Ad')->findBy([], ['timeUpdated' => 'desc']);

        return $this->render('ad/index.html.twig', array(
            'ads' => $ads,
        ));
    }

    /**
     * Creates a new ad entity.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/ad/new", name="ad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ad = new Ad();
        $form = $this->createForm('AppBundle\Form\AdType', $ad);
        $form->handleRequest($request);

        $ad->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ad);
            $em->flush();

            return $this->redirectToRoute('ad_show', array('id' => $ad->getId()));
        }

        return $this->render('ad/new.html.twig', array(
            'ad' => $ad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ad entity.
     *
     * @Route("/ad/{id}", name="ad_show")
     * @Method("GET")
     */
    public function showAction(Ad $ad)
    {
        $deleteForm = $this->createDeleteForm($ad);

        return $this->render('ad/show.html.twig', array(
            'ad' => $ad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ad entity.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/ad/{id}/edit", name="ad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ad $ad)
    {
        $deleteForm = $this->createDeleteForm($ad);
        $editForm = $this->createForm('AppBundle\Form\AdType', $ad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ad_edit', array('id' => $ad->getId()));
        }

        return $this->render('ad/edit.html.twig', array(
            'ad' => $ad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ad entity.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}", name="ad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ad $ad)
    {
        $form = $this->createDeleteForm($ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ad);
            $em->flush();
        }

        return $this->redirectToRoute('ad_index');
    }

    /**
     * Creates a form to delete a ad entity.
     *
     * @param Ad $ad The ad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ad $ad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ad_delete', array('id' => $ad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
