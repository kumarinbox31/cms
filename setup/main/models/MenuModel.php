<?php

class MenuModel extends MY_Model{
    public $table = 'menu';
    
    function  items($menuid){
        $query = $this->db->query("SELECT * FROM ab_menu_items WHERE menu_id = '$menuid' and admin_id = '" . CLIENT_ID . "' order by sort asc");
        $ref = [];
        $items = [];

        foreach ($query->result() as $data) {
            $page = $this->db->get_where('ab_pages', ['id' => $data->page_id])->row();

            $thisRef = &$ref[$data->id];
            $thisRef['parent'] = $data->parent;
            $thisRef['type'] = $data->type;
            $thisRef['label'] = @$page->page_name;
            $thisRef['link'] = @$page->link;
            $thisRef['id'] = $data->id;
            $thisRef['page_id'] = $data->page_id;
            $thisRef['uri'] = @$page->uri;
            $thisRef['target'] = @$page->redirect == 1 ? '_target' : '';

            if ($data->parent == 0) {
                $items[$data->id] = &$thisRef;
            } else {
                $ref[$data->parent]['child'][$data->id] = &$thisRef;
            }
        }
        return ['items'=>$items,'ref'=>$ref];
    }
    
    function get_menu($items,$arr) {
        extract($arr);
        $html = '';
          $html .= @$extendBefore;
          $html .= '<ul id="'.@$id.'" class="'.@$class.'">';
          foreach($items as $key=>$value) {
              $page_id = $value['page_id'];
              $_page_url = DEFAULTPAGE==$value['page_id']?'/':(base_url().'page/'.$value['uri']);
            $iconWithTExt =  $value['label'];
              
            if(array_key_exists('child',$value)){
                    $childArr = [
                                    'id' => '',
                                    'class' => @$dropdownUlClass,
                                    'itemClass' => @$childItemClass,
                                    'anchorClass'=>@$childAnchorClass,
                                    'activeClass' => @$childActiveClass,
                                ];
                    $html.= '<li id="menu-item-'.$page_id.'" class="'.@$dropdownLiClass.'">
                        <a class="'.@$dropdownAnchorClass.'" href="#" ><span class="menu-title">'.$iconWithTExt.' </span> <i class="bi bi-chevron-down"></i></a>'.$this->MenuModel->get_menu($value['child'],$childArr).'</li>';
        
            }else{
        
              $html.= '<li id="menu-item-'.$page_id.'" class="'.@$itemClass.'" ><a class="'.@$anchorClass.'" href="'.$_page_url.'" '.$value['target'].' >'.$iconWithTExt.'</a></li>';
            }
          }
        $html .= '</ul>';
        $html .= @$extendAfter;
      return $html;
    }
}