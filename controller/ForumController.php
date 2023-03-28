<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
use Model\Entities\Category;
use Model\Entities\Topic;
    use Model\Managers\TopicManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
           $categoryManager = new CategoryManager();
          
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["dateCreationTopic", "DESC"]),
                    "category" => $categoryManager->findAll()
                ]
            ];


        
        }

      

        public function listCategory(){

            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategory.php",
                "data" => [
                    "category" => $categoryManager->findAll(["nameCategory", "ASC"])
                ]
            ];

        }

        public function listPosts($id){
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            if($id){
            return [
                "view" => VIEW_DIR."forum/listPostsByTopic.php",
                "data" => [
                    "posts" => $postManager->findPostsByTopic($id),
                    "topics" => $topicManager->findOneById($id)
                ]
            ];
           }else{
            echo "<p>Pas de messages</p>";
           }
          
        }


        public function listTopicsByCategory($id){
            
            $TopicManager = new TopicManager();
            $categoryManager = new CategoryManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopicsByCategory.php",
                "data" => [
                    "topics" => $TopicManager->findTopicsByCategory($id),
                    "category" => $categoryManager->findOneById($id)
                ]
            ];

        }


        public function addTopic($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
           
            if(isset($_POST['submit'])) {
                

                 
                     $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                     $text = filter_input(INPUT_POST,"textPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                     
                    if(isset($_SESSION['user'])){
                        $user = $_SESSION['user']->getId();

                        if($text && $user && $title){ // verification des champs
                            $last_id =  $topicManager->add(["category_id" =>$id, "user_id" => $user, "title" => $title]);
                             $postManager->add(["topic_id" => $last_id, "textPost" => $text, "user_id" => $user ]);
                             $_SESSION['sucess_message'] =  "Topic envoyé avec succes.";
                             $this->redirectTo('forum', 'listTopicsByCategory', $id); // redirection vers la page concerné
                         }
                    }
                     else{
                         $_SESSION['error_message'] =  "Vous devez être connecté pour faire ça.";
                        $this->redirectTo('forum', 'listTopicsByCategory', $id); 
                     }
                     
                
            }
        }

        public function addTopicGeneral($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $categoryManager = new CategoryManager();

            
    
            if(isset($_POST['submit'])) {
               
             
                 if(isset($_POST['textPost']) && (!empty($_POST['textPost']))){ // filtrer les champs
                     $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                     $text = filter_input(INPUT_POST,"textPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                     $selected = filter_input(INPUT_POST,"category_id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
                     $user = $_SESSION['user']->getId();

                     if (!$user) {
                        echo "Vous devez être connecté pour ajouter un sujet";
                        return; // on arrête la fonction si l'utilisateur n'est pas connecté
                    }
                     
                     if($text && $user && $title){ // verification des champs
                        $last_id =  $topicManager->add(["category_id" =>$selected, "user_id" => $user, "title" => $title]);
                         $postManager->add(["topic_id" => $last_id, "textPost" => $text, "user_id" => $user ]);
                         $this->redirectTo('forum', 'listTopics'); // redirection vers la page concerné
                     }

                   
                 }


                
            }
        }

        public function addPost($id){
         
            $postManager = new PostManager();
            
           
            
               if(isset($_POST['submit'])) {
                   
                
                    if(isset($_POST['textPost']) && (!empty($_POST['textPost']))){
                        $text = filter_input(INPUT_POST,"textPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                       
                        
                        $user = $_SESSION['user']->getId();
                        
                        if($text && $user){
                            $postManager->add(["topic_id" =>$id, "textPost" => $text, "user_id" => $user]);
                            $this->redirectTo('forum', 'listPosts', $id);
                        }
                        
                    }
                   
               }
            
       }

       

    }
