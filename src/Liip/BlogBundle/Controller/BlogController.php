<?php

namespace Liip\BlogBundle\Controller;

use Liip\BlogBundle\Entity\Post;
use Liip\BlogBundle\Form\PostForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $q = $em->createQuery('SELECT p FROM Liip\BlogBundle\Entity\Post p ORDER BY p.createdAt DESC');
        $q->setMaxResults(15);
        $posts = $q->execute();

        return $this->render('BlogBundle:Blog:index.html.twig', array(
            'posts' => $posts,
        ));
    }

    public function createAction()
    {
        $post = new Post();

        return $this->_editAction($post);

        // render a PHP template instead
        // return $this->render('BlogBundle:Blog:index.html.php', array('name' => $name));
    }

    public function editAction($id)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $post = $em->find('Liip\BlogBundle\Entity\Post', $id);

        return $this->_editAction($post);
    }

    protected function _editAction(Post $post)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $form = PostForm::create($this->get('form.context'), 'post');
        $form->bind($this->get('request'), $post);

        if ($form->isValid()) {
            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_index'));
        }

        return $this->render('BlogBundle:Blog:edit.html.twig', array(
            'form' => $form,
        ));
    }
}
