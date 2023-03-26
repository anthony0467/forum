<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
use Model\Entities\Topic;
use Model\Managers\TopicManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
           
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["dateCreationTopic", "DESC"])
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
            
            
            return [
                "view" => VIEW_DIR."forum/listTopicsByCategory.php",
                "data" => [
                    "topics" => $TopicManager->findTopicsByCategory($id)
                ]
            ];

        }


        public function addPost($id){
            $postManager = new PostManager();
            
           
            
               if(isset($_POST['submit'])) {
                
                    if(isset($_POST['textPost']) && (!empty($_POST['textPost']))){
                        $text = filter_input(INPUT_POST,"textPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        var_dump($text);
                        $user = 1;
                        
                        if($text && $user){
                            $postManager->add(["topic_id" =>$id, "textPost" => $text, "user_id" => $user]);
                            $this->redirectTo('post', $postManager);
                        }
                        
                    }
                   
               }
            
       }

       

    }
