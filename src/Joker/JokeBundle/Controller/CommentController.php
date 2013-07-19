<?php

namespace Joker\JokeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Joker\JokeBundle\Entity\Post;
use Joker\JokeBundle\Entity\Comment;
use Joker\JokeBundle\Form\CommentType;


class CommentController extends Controller {

	public function indexAction($post_id)
    {
        $em = $this->getDoctrine()->getManager();

        $post_entity = $em->getRepository('JokerJokeBundle:Post')->find($post_id);
        $comment_entities = $em->getRepository('JokerJokeBundle:Comment')->findByPost($post_entity);

        return $this->render('JokerJokeBundle:Comment:index.html.twig', array(
            'comments' => $comment_entities,
        ));
    }

    public function createAction(Request $request, $post_id){
    	$em = $this->getDoctrine()->getManager();

        $post_entity = $em->getRepository('JokerJokeBundle:Post')->find($post_id);

    	$comment_entity = new Comment();
    	$comment_entity->SetPost($post_entity);
    	$form = $this->createForm(new CommentType(), $comment_entity);
    	$form->bind($request);

    	if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment_entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $post_entity->getId())));
        }

        return $this->render('JokerJokeBundle:Comment:create.html.twig', array(
            'comment' => $comment_entity,
            'form'   => $form->createView(),
        ));

    }

    public function newAction($post_id)
    {
        $em = $this->getDoctrine()->getManager();
        $post_entity = $em->getRepository('JokerJokeBundle:Post')->find($post_id);
        $comment_entity = new Comment();
        $comment_entity->SetPost($post_entity);
        $form   = $this->createForm(new CommentType(), $comment_entity);


        return $this->render('JokerJokeBundle:Comment:new.html.twig', array(
            'comment' => $comment_entity,
            'form'   => $form->createView(),
        ));
    }

}