<?php
include_once dirname(__FILE__).'/../interfaces/menulink.entity.php';
include_once dirname(__FILE__).'/../interfaces/paginator.entity.php';

class PaginatorStorage implements IPagginator {
    private $links_data = array();
    private $current_index = -1;
    private $all_page = 0;

    function __construct($links,$allpage, $check = true) {
        // TODO фдаг $check нужно передавать в зависимости от конфигурационного
        // параметра debug. В рабочем варианте проверка типов данных излишня
        // но при разработке и внесения изменений в код движка, данная проверка
        // нужна.
        if ($check) {
            // Если нужна проверка типа данных массива
            $this->check_is_menulink_array($links);
        }
        $index = 0;
        // Ищем отмеченый элемент
        foreach($links as $link){
            if ($link->is_selected()){
                $this->current_index = $index;
                break;
            }
            $index+=1;
        }
        if ($this->current_index < 0 && count($links) > 0){
            throw new Exception('Нет ни одного выделенного элемента в пагинаторе.');
        }
        $this->links_data = $links;
        $this->all_page=$allpage;
    }

    /**
     * Проверяет являится ли значение параметра, массивом с элементами реализующие
     * интерфейс IOffer
     * @param Array $offers Проверяемое значение
     * @throws Exception В случае не соответствия значения генерируется исключение, с описанием проблемы.
     */
    private function check_is_menulink_array($links){
        if ( !is_array($links) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($links as $link){
            if ( !($link instanceof IMenuLink) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IMenuLink');
            }
        }
    }

    function links(){
        return $this->links_data;
    }

    function first() {
        if ( count($this->links_data) > 0 ){
            return $this->links_data[0];
        }
        return false;
    }

    function last(){
        if ( count($this->links_data) > 0 ){
            return $this->links_data[count($this->links_data)-1];
        }
        return false;
    }

    function next() {
        if (array_key_exists($this->current_index + 1, $this->links_data) ){
            $t=$this->showIdPage($this->last()->url());
            if($t!=$this->all_page)                
            return $this->links_data[$this->current_index + 1];
        }
        return false;
    }

    function previus() {
        if (array_key_exists($this->current_index - 1, $this->links_data) ){
            $t=$this->showIdPage($this->first()->url());
            if($t!=1)    
                return $this->links_data[$this->current_index - 1];
        }
        return false;
    }
    function showIdPage($link)
    {
        $linktemp=explode('/',$link);
        return $linktemp[count($linktemp)-1];
    }
}
?>