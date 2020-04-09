<?php
namespace App\Controllers;

use App\Helpers\Exceptions\Http422Exception;
use App\Helpers\Exceptions\Http500Exception;
use App\Models\Articles;
use App\Helpers\Helpers\ApplicationExceptions;
use App\Services\MessageService;

class ArticlesController extends \Phalcon\Mvc\Controller {
    const DEFAULT_LIMIT = 20;
    const DEFAULT_PAGE  = 1;
    const DEFAULT_ORDER_FIELD = "id";
    const ALLOWED_ORDER_FIELDS = ['id', 'date_publish', 'date_created'];
    const DEFAULT_ORDER_TYPE = "DESC";
    const ALLOWED_ORDER_TYPES = ["ASC", "DESC"];
    const MISSING_ARTICLE_MESSAGE = "Article not found";

    public function listAction(){
        try {
            $limit = $this->request->has("limit") ? $this->request->get('limit') : self::DEFAULT_LIMIT;
            $page = $this->request->has("page") ? $this->request->get('page') : self::DEFAULT_PAGE;

            $options = [];
            if($this->request->has("search")){
                $options['search'] = $this->request->get('search');
            }

            $options['orderBy'] = $this->request->has("orderBy") && in_array(mb_strtolower($this->request->get('orderBy')), self::ALLOWED_ORDER_FIELDS) ? mb_strtolower($this->request->get("orderBy")) : self::DEFAULT_ORDER_FIELD;
            $options['orderType'] = $this->request->has("orderType") && in_array(mb_strtoupper($this->request->get('orderType')), self::ALLOWED_ORDER_TYPES) ? $this->request->get("orderType") : self::DEFAULT_ORDER_TYPE;

            return $this->articlesService->all($options, $limit, $page);
        } catch (\PDOException $e) {
            throw new ApplicationExceptions($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function viewAction($articleId){
        try {
            $article = Articles::findFirst("id = {$articleId}");
            if (!$article) {
                throw new Http422Exception(self::MISSING_ARTICLE_MESSAGE, MessageService::ARTICLE_NOT_FOUND);
            }
            return $article->toArray();
        } catch (\PDOException $e) {
            throw new ApplicationExceptions($e->getMessage(), $e->getCode(), $e);
        }
    }


    public function createAction(){
        try{
            $articleData = $this->request->get();
            $response = $this->articlesService->create($articleData);
            return $response;
        }catch (ApplicationExceptions $e){
            switch($e->getCode()){
                case MessageService::ARTICLE_NOT_FOUND:
                case MessageService::CREATE_ERROR:
                case MessageService::UPDATE_ERROR:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    public function updateAction($articleId){
        try{
            $articleData = $this->request->get();
            $response = $this->articlesService->create($articleData, $articleId);
            return $response;
        }catch (ApplicationExceptions $e){
            switch($e->getCode()){
                case MessageService::ARTICLE_NOT_FOUND:
                case MessageService::CREATE_ERROR:
                case MessageService::UPDATE_ERROR:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    public function deleteAction($articleId){
        try{
            $this->articlesService->delete($articleId);
            return ['status' => true];
        }catch (ApplicationExceptions $e){
            if(($e->getCode() == MessageService::ARTICLE_NOT_FOUND) || ($e->getCode() == MessageService::DELETE_ERROR)){
                throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
            }else{
                throw new Http500Exception(_("Internal server error"), $e->getCode(), $e);
            }
        }
    }
}