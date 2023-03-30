<?php
// https://www.figma.com/file/ojDy3u6CatQreracxbVf7o/Maquette-forum?node-id=0%3A1&t=D6ann6Ot0lRVcj5W-1
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Entities\Category;
use Model\Entities\Topic;
use Model\Entities\Post;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {


        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["dateCreationTopic", "DESC"]),
                "category" => $categoryManager->findAll()
            ]
        ];
    }



    public function listCategory()
    {

        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategory.php",
            "data" => [
                "category" => $categoryManager->findAll(["nameCategory", "ASC"])
            ]
        ];
    }

    public function listPosts($id)
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        if ($id) {
            return [
                "view" => VIEW_DIR . "forum/listPostsByTopic.php",
                "data" => [
                    "posts" => $postManager->findPostsByTopic($id),
                    "topics" => $topicManager->findOneById($id)
                ]
            ];
        } else {
            echo "<p>Pas de messages</p>";
        }
    }


    public function listTopicsByCategory($id)
    {

        $TopicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listTopicsByCategory.php",
            "data" => [
                "topics" => $TopicManager->findTopicsByCategory($id),
                "category" => $categoryManager->findOneById($id)
            ]
        ];
    }


    public function addTopic($id)
    { // ajouter un topic 
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        if (isset($_POST['submit'])) {


            // filtrer les champs
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, "textPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user']->getId();

                if ($text && $user && $title) { // verification des champs
                    $last_id =  $topicManager->add(["category_id" => $id, "user_id" => $user, "title" => $title]);
                    $postManager->add(["topic_id" => $last_id, "textPost" => $text, "user_id" => $user]);
                    $_SESSION['sucess_message'] =  "Topic envoyé avec succes.";
                    $this->redirectTo('forum', 'listTopicsByCategory', $id); // redirection vers la page concerné
                }
            } else {
                $_SESSION['error_message'] =  "Vous devez être connecté pour faire ça.";
                $this->redirectTo('forum', 'listTopicsByCategory', $id);
            }
        }
    }

    public function topicDelete($id){ // supprimer un topic par categorie
        if(isset($_SESSION['user'])){ // si la session existe
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $categoryId = $topic->getCategory()->getId();
        $topicManager->deleteTopic($id);
        $this->redirectTo('forum', 'listTopicsByCategory', $categoryId);
        }else{
            $this->redirectTo('forum', 'listTopicsByCategory');
        }
    }

    public function topicDeleteGeneral($id){ // supprimer un topic sur la liste entiere
        if(isset($_SESSION['user'])){
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $categoryId = $topic->getCategory()->getId();
        $topicManager->deleteTopic($id);
        $this->redirectTo('forum', 'listTopics');
        }else{
            $this->redirectTo('forum', 'listTopics');
        }
    }


    // verouiller le topic
    public function topicLocked($id)
    {
        if(isset($_SESSION['user'])){
        $topicManager = new TopicManager();
        $topicManager->lock($id);
        $this->redirectTo('forum', 'listPosts', $id);
        }else{
            $this->redirectTo('forum', 'listPosts', $id);
        }
    }


    // topic toutes liste confondu
    public function addTopicGeneral($id)
    {
        $topicManager = new TopicManager();
        $postManager = new PostManager();
        $categoryManager = new CategoryManager();



        if (isset($_POST['submit'])) {


            if (isset($_POST['textPost']) && (!empty($_POST['textPost']))) { // filtrer les champs
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $text = filter_input(INPUT_POST, "textPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $selected = filter_input(INPUT_POST, "category_id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $user = $_SESSION['user']->getId();

                if (!$user) {
                    echo "Vous devez être connecté pour ajouter un sujet";
                    return; // on arrête la fonction si l'utilisateur n'est pas connecté
                }

                if ($text && $user && $title) { // verification des champs
                    $last_id =  $topicManager->add(["category_id" => $selected, "user_id" => $user, "title" => $title]);
                    $postManager->add(["topic_id" => $last_id, "textPost" => $text, "user_id" => $user]);
                    $this->redirectTo('forum', 'listTopics'); // redirection vers la page concerné
                }
            }
        }
    }


    // supprimer un post
    public function postDelete($id){
        if(isset($_SESSION['user'])){
        $postManager = new PostManager();
        $post = $postManager->findOneById($id);
        // nombre de poste
        $count = $postManager->deletePost($id);
        //récupéré l'id du topic
        $topicId = $post->getTopic()->getId();
        
       
      

        $nbPoste = intVal($count);
        var_dump($nbPoste);
        if($nbPoste > 0){
            $this->redirectTo('forum', 'listPosts', $topicId);
        }else{
            $this->redirectTo('forum', 'listCategory');
        }
        
        }
        else{
            $this->redirectTo('forum', 'listTopics');
        }


    }

    public function addPost($id)
    { // ajouter un post

        $postManager = new PostManager();



        if (isset($_POST['submit'])) {


            if (isset($_POST['textPost']) && (!empty($_POST['textPost']))) {
                $text = filter_input(INPUT_POST, "textPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                $user = $_SESSION['user']->getId();

                if ($text && $user) {
                    $postManager->add(["topic_id" => $id, "textPost" => $text, "user_id" => $user]);
                    $this->redirectTo('forum', 'listPosts', $id);
                }
            }
        }
    }
}
