<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
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

            return [
                "view" => VIEW_DIR."forum/listPostsByTopic.php",
                "data" => [
                    "posts" => $postManager->findPostsByTopic($id)
                ]
            ];

        }

       

    }
