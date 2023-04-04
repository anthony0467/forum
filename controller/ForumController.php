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
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {

    }


    //liste general des topics
    public function listTopics($id){
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
       

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findTopics(),
                "category" => $categoryManager->findAll()
            ]
        ];
    }

    // liste des categories
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

    //liste des posts
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

    //liste des topics par categorie
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
            } else { // si pas connecté
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
        if(isset($_SESSION['user'])){ // si la session existe
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $categoryId = $topic->getCategory()->getId();
        $topicManager->deleteTopic($id);
        $this->redirectTo('forum', 'listTopics');
        }else{
            $this->redirectTo('forum', 'listTopics');
        }
    }


    //recherché un topic 
    public function topicSearch(){
        $topicManager= new TopicManager();
        $categoryManager = new CategoryManager();
        if (isset($_POST['submit'])) {
                

            if (isset($_POST['search']) && (!empty($_POST['search']))) { // filtrer les champs
                $search = filter_input(INPUT_POST, "search", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($search) {
                    return [
                        "view" => VIEW_DIR."forum/listTopics.php",
                        "data" => [
                            "topics" => $topicManager->searchTopic($search),
                            "category" => $categoryManager->findAll()
                        ]
                    ];
                }
        
            }
            else{
                $_SESSION['error']="Erreur de saisie.";
                $this->redirectTo('forum', 'listTopics');
            }
        }
    }
    // verouiller le topic
    public function topicLocked($id)
    {
        if(isset($_SESSION['user'])){  // si la session existe
        $topicManager = new TopicManager();
        $topicManager->lock($id);
        $this->redirectTo('forum', 'listPosts', $id);
        }else{
            $this->redirectTo('forum', 'listPosts', $id);
        }
    }

    // Déverouiller le topic
    public function topicUnlocked($id)
    {
        if(isset($_SESSION['user'])){  // si la session existe
        $topicManager = new TopicManager();
        $topicManager->unlock($id);
        $this->redirectTo('forum', 'listPosts', $id);
        }else{
            $this->redirectTo('forum', 'listPosts', $id);
        }
    }

    // like post 
    public function postLike($id)
{
    $postManager = new PostManager();
    $post = $postManager->findOneById($id);
    $topicId = $post->getTopic()->getId();
    $user = $post->getLikepost();
    // Vérifier si l'utilisateur est connecté
    if(isset($_SESSION['user'])){

        // Vérifier si l'utilisateur a déjà liké ce post
        $userId = $_SESSION['user']->getId();
        if(isset($user)){
            $_SESSION['error']="Vous avez déjà mis un j'aime pour ce post.";
        }else{
            $postManager->likePost($id);

            // Ajouter le post liké à la session de l'utilisateur
            if(isset($_SESSION['liked_posts'][$userId])){
                $_SESSION['liked_posts'][$userId][] = $id;
            }else{
                $_SESSION['liked_posts'][$userId] = array($id);
            }
        }

        $this->redirectTo('forum', 'listPosts', $topicId);
    }else{
        $_SESSION['error']="Connectez-vous pour mettre un j'aime.";
        $this->redirectTo('forum', 'listPosts', $topicId);
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

                $user = $_SESSION['user']->getId(); // récupéré l'id de l'utilisateur

                if (!$user) { // si pas co
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

    //nombre de post
    public function postCount($id){
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            $topicId = $topicManager->findOneById($id)->getPost()->getId();
            $count = $postManager->countPost($topicId);
            
            
    return [
        "view" => VIEW_DIR . "forum/listTopics.php",
        "data" => [
            "count" => $count
        ]
    ];
           
            
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
        
       
      

        $nbPoste = intVal($count); // récupérér la valeur en int
        
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
        $userManager = new UserManager();


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
