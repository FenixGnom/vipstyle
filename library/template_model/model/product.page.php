<?php
include_once dirname(__FILE__).'/../interfaces/product.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Класс реализующий хранение и выдачу данных о товаре
 */
class ProductPageStorage extends AbstractPage implements IPage,IProduct {
    
    /**
     * Хранение идентификатора  товара
     * @var Integer
     */
    protected $product_id = 0;
    
    /**
     * Хранение идентификатора  товара
     * @var Float
     */
    protected $product_price = 0;
    
    /**
     * Хранение названия  товара
     * @var String
     */
    protected $product_name = '';
    
     /**
     * Данные о категории товара
     * @var IMenuLink
     */
    protected $product_cat = null;
    
    /**
     * Хранение описания товара
     * @var String
     */
    protected $product_description = '';
    
    /**
     * Данные о подкатегории товара
     * @var IMenuLink
     */
    protected $product_subcat = '';
    
         
     /**
     * Хранение флага поиска
     * @var Boolean
     */
    protected $product_flag_search = false;
    
     /**
     * Хранение размеров  товара
     * @var Array of ISize
     */
    protected $product_size = array();
    
    /**
     * Хранение цветов  товара
     * @var Array of IColor
     */
    protected $product_color = array();
    
     /**
     * Хранение цветов  товара
     * @var Array of IModel
     */
    protected $product_model = array();
    
    /**
     * Хранение данных модели выбранного товара
     * @var IModel
     */
    protected $model_param=null;
    
    /**
     * Хранение данных о цвете выбранного товара
     * @var IColor
     */
    protected $color_param=null;
    
     /**
     * Хранение идентификатора модели товара
     * @var String
     */
     
    
     /**
     * Хранение ссылки на изображение товара, размером 250Х250(вид спереди)
     * @var String
     */
    protected $product_img='';  
    
     /**
     * Хранение ссылки на увеличенное изображение товара, размером 500Х500(вид спереди)
     * @var String
     */
    protected $product_img_big='';  
    
     /**
     * Хранение ссылки на изображение задника товара, размером 250Х250(вид спереди)
     * @var String
     */
    protected $product_img_back='';  
    
     /**
     * Хранение ссылки на увеличенное изображение задника товара, размером 500Х500(вид сзади)
     * @var String
     */
    protected $product_img_back_big='';  
    
    /**
     * Хранение похожих товаров
     * @var Array of IOffer
     */
    protected $product_other_offers=array();
    
    /**
     * Признак наличия картинки спереди
     * @var Boolean
     */
    protected $product_front=true;
    
     /**
     * Признак наличия картинки сзади
     * @var Boolean
     */
    protected $product_back=false;

    /**
     * Признак наличия длинного рукава
     * @var Boolean
     */
    protected $is_hand=true;
    
    /**
     * Хранение размера товара по-умолчанию
     * @var ISize
     */
    protected  $product_size_default=null;


    function set_product_id($id){
       
       $this->product_id=(int)$id;
    }
    
    
     function set_product_name($name){
         
       $this->product_name=(string)$name;
    }
    
    function set_size($size,$check=true){
       
        if ($check) {
            
            $this->check_is_size_array($size);
        }
        $this->product_size = $size;
    }
    function set_color($color,$check){     
      
        if ($check) {
            
            $this->check_is_color_array($color);
        }
        $this->product_color = $color;
    }
    
    function set_model($model,$check){     
      
        if ($check) {
            
            $this->check_is_model_array($model);
        }
        $this->product_model = $model;
    }
     function set_category(IMenuLink $cat){     
      
       $this->product_cat=$cat;
    }
    
    function set_subcategory(IMenuLink $sub){     
      
       $this->product_subcat=$sub;
    }   
    
    
    function set_price($price){     
      
       $this->product_price=(float) $price;
    }
    
    function set_is_hand($hand)
    {
        $this->is_hand=(boolean) $hand;
    }
    
     function set_description($description){     
      
       $this->product_description=(string) $description;
    }
    
     function set_serch_flag($flag){    
      
       $this->product_flag_search=(boolean) $flag;
    }
    
     function set_model_default(IModel $param){    
      
       $this->model_param= $param;
    }
    
    function set_color_default(IColor $param){    
      
       $this->color_param=$param;
    }
    
    
    function set_other_offers($offers,$check){    
      
       if ($check) {
            
            $this->check_is_other_offers_array($offers);
        }
        $this->product_other_offers = $offers;
    }
    
    function set_img_url($url)
    {
        $this->product_img=$url;
    }
     
    function set_imgbig_url($url)
    {
        $this->product_img_big=$url;
    }
    
    
    function set_imgback_url($url)
    {
        $this->product_img_back=$url;
    }
    
    
    function set_imgbackbig_url($url)
    {
        $this->product_img_back_big=$url;
    }
    function set_front($front)
    {
        $this->product_front=(boolean)$front;
    }
    
    function set_size_default(ISize $size)
    {
        $this->product_size_default=$size;
    }
    
    function set_back($back)
    {
        $this->product_back=(boolean)$back;
    }
    
    
   protected function check_is_color_array($colors){
        if ( !is_array($colors) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($colors as $color){
            if ( !($color instanceof IColor) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IColor');
            }
        }
    }
    
     protected function check_is_other_offers_array($offers){
        if ( !is_array($offers) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($offers as $offer){
            if ( !($offer instanceof IOffer) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IOffer');
            }
        }
    }
    
    protected function check_is_size_array($sizes){
        if ( !is_array($sizes) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($sizes as $size){
            if ( !($size instanceof ISize) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс ISize');
            }
        }
    }
    
    protected function check_is_model_array($models){
        if ( !is_array($models) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($models as $model){
            if ( !($model instanceof IModel) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IModel');
            }
        }
    }

    
    /**
     * Реализация методов интерфейса IProduct
     */
    
   
    function name()
    {
        return $this->product_name;
    }

   
    function id()   
    {
        return $this->product_id;
    }
   
    function price()
    {
       return $this->product_price;   
    }
    
    
    function model_default()
    {
       return $this->model_param;   
    }    
   
   
    function color_default()
    {
        return $this->color_param;   
    }    
   
    function category()
    {
        return $this->product_cat;  
    }
       
    
    function models()
    {
        return $this->product_model; 
    }
    
    
    function colors()
    {
        return $this->product_color; 
    }
    
     
    function other_offers()
    {
        return $this->product_other_offers; 
    }
    
   
    function sizes()
    {
        return $this->product_size; 
    }
    function size_default()
    {
        return $this->product_size_default; 
    } 
    
     function is_from_serch_page()
    {
        return $this->product_flag_search;
    }
    
   
    function description()
    {
        return $this->product_description;
    }
     
    
    function subcat()
    {
        return $this->product_subcat;
    }
        
   
    function img_url()
    {
        return $this->product_img;
    }
     
    function imgbig_url()
    {
        return $this->product_img_big;
    }
    
    
    function imgback_url()
    {
        return $this->product_img_back;
    }
    
    
    function imgbackbig_url()
    {
        return $this->product_img_back_big;
    }
    
    function front()
    {
        return $this->product_front;
    }
    
    
    function back()
    {
        return $this->product_back;
    }
    function is_hand()
    {
        return $this->is_hand;
    }
    
    
}
?>