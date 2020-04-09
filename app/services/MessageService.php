<?php
namespace App\Services;


use App\Helpers\Exceptions\ApplicationExceptions;
use App\Helpers\Exceptions\Http422Exception;
use App\Helpers\Response;
use App\Models\Message;

class MessageService{

    const MESSAGE_NOT_FOUNT = 11010;
    const DELETE_ERROR      = 11011;
    const CREATE_ERROR      = 11012;
    const UPDATE_ERROR      = 11013;
    private $config;

    function __construct($config){
        $this->config = $config;
    }

//    public function create($article, $articleId = null){
//       try{
//          $is_update =  is_null($articleId) ? false : true;
//
//          if(empty($article)){
//              throw new Http400Exception("Empty request", 2);
//          }
//
//          if($is_update){
//              $articleEntry = Articles::findFirst("id = {$articleId}");
//              if(!$articleEntry){
//                  throw new ApplicationExceptions("Article not found", self::ARTICLE_NOT_FOUND);
//              }
//          }else{
//              $articleEntry = new Articles();
//          }
//
//          $errors = [];
//          $fields = [
//              'title' => ['message' => 'Title is empty or too short', 'min_lenght' => 8, 'required' => true],
//              'short_description' => ['message' => 'Short description missing', 'required' => true],
//              'content' => ['message' => 'Content missing', 'required' => true],
//              'date_publish' => ['required' => false]
//          ];
//
//          $articleData = $articleEntry->toArray();
//          foreach($fields as $field => $settings){
//              if($is_update && !isset($article[$field])){
//                  $article[$field] = $articleData[$field];
//              }
//
//              if($settings['required'] && (!isset($article[$field]) || (isset($settings['min_lenght']) && strlen($article[$field]) < $settings['min_lenght']))){
//                  $errors[$field] = $settings['message'];
//              }
//          }
//
//
//          if(empty($errors)) {
//              if (isset($article['title']) && !is_string($article['title'])) {
//                  $errors['title'] = 'String excepted';
//              }
//
//              if (isset($article['short_description']) && !is_string($article['short_description'])) {
//                  $errors['short_description'] = "String excepted";
//              }
//
//              if (isset($article['content']) && !is_string($article['content'])) {
//                  $errors['content'] = "String excepted";
//              }
//
//              if (isset($article['date_publish'])) {
//                  try {
//                      $article['date_publish'] = new \DateTime($article['date_publish']);
//                  } catch (\Exception $e) {
//                      $errors['date_publish'] = "Invalid format";
//                  }
//              }else{
//                  unset($article['date_publish']);
//              }
//          }
//
//          if(!empty($errors)){
//              $exception = new Http400Exception("Validation error", 2);
//              throw $exception->_add($errors);
//          }
//
//          $articleEntry->setTitle($article['title']);
//          $articleEntry->setShortDescription($article['short_description']);
//          $articleEntry->setContent($article['content']);
//
//          if(isset($article['date_publish'])){
//              $articleEntry->setDatePublish($article['date_publish']);
//          }
//
//          if($is_update){
//             $result = $articleEntry->update();
//          }else{
//             $result = $articleEntry->create();
//          }
//
//          if(!$result){
//              throw new ApplicationExceptions($is_update ? "Unable to update article" : "Unable to create article", $is_update ? self::UPDATE_ERROR : self::CREATE_ERROR);
//          }
//
//          $url = $this->config->get('application')->get('webpath')."/articles/view/".$articleEntry->getId();
//          return [
//              'status' => true,
//              'url'    => $url
//          ];
//       }catch (\PDOException $e){
//           throw new ApplicationExceptions($e->getCode(), $e->getMessage(), $e);
//       }
//    }
//
//    public function all($options = [], $limit, $page){
//        try{
//            $offset = ($page-1) * $limit;
//
//            $params = [];
//            $params['limit'] = ['number' => $limit, 'offset' => $offset];
//            $params['conditions'] = '1=1';
//            $params['bind'] = [];
//
//            if(isset($options['search'])){
//                $params['conditions'] .= " AND LOWER(title) LIKE :search:";
//                $params['bind']['search'] = '%'.mb_strtolower($options['search']).'%';
//            }
//
//            if(isset($options['orderBy'])){
//                $params['order'] = "{$options['orderBy']} {$options['orderType']}";
//            }
//
//            $articles = Articles::find($params);
//            $articles = $articles->toArray();
//
//            if(empty($articles)){
//                return ['hasMore' => false, 'articles' => []];
//            }
//
//            $offsetHasmore = $page * $limit;
//            $params['limit'] = ['number' => $limit, 'offset' => $offsetHasmore];
//            $hasMoreArticles = Articles::find($params);
//
//            return [
//                'hastMore' => empty($hasMoreArticles->toArray()) ? false : true,
//                'articles' => $articles
//            ];
//        }catch (\PDOException $e){
//            throw new ApplicationExceptions($e->getCode(), $e->getMessage(), $e);
//        }
//    }

    public function status($messageId){
        try{
           $message = Message::findFirst($messageId);


           if(!$message){
               throw new Http422Exception("Message not found", self::MESSAGE_NOT_FOUNT);
           }

           return Response::make_response(true, ['message_status' => $message->id]);
        }catch (\PDOException $e){
            throw new ApplicationExceptions($e->getCode(), $e->getMessage(), $e);
        }
    }
}