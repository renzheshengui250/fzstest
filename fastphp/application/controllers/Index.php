<?php

class Index extends Controller{
    public function test(){
        /**
         * 实例化导航文字模型
         * 实例化轮播图模型
         * 实例化产品信息模型
         * 实例化新闻动态模型
         * 实例化产品应用模型
         */

        $model = new IndexModel();
        $slide_model = new SlideshowModel();
        $product_model = new ProductModel();
        $news_model = new NewsModel();
        $case_model = new CaseModel();


        $navigation = $model -> navigation();
        $slideshow = $slide_model -> slideshow();
        $product = $product_model -> product();
        $news = $news_model -> news();
        $case_list = $case_model -> case_list();


        //渲染数据、模板
        $this->_views->assign("navigation",$navigation);
        $this->_views->assign("slideshow",$slideshow);
        $this->_views->assign("product",$product);
        $this->_views->assign("news",$news);
        $this->_views->assign("case_list",$case_list);


        $this->_views->display("index.html");
    }
}