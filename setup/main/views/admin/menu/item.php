
<style>
    
.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
 * Nestable Extras
 */

.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0 border-bottom: 2px solid #ddd; }

#nestable-menu { padding: 0; margin: 20px 0; }

#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }

@media only screen and (min-width: 700px) {

    .dd { float: left; width: 48%; }
    .dd + .dd { margin-left: 2%; }

}

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background:#31aacf;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #31aacf; }

/**
 * Socialite
 */

.socialite { display: block; float: left; height: 35px; }
.span-right{
    float:right;
}
.del-button{
    color:red;
    cursor:pointer;
}
.SingleMenuSetting{
    color:blue;
    cursor:pointer;
}
</style>
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Pages
                </div>
                <div class="card-body">
                    <?php
                    $pages = $this->db->get_where('pages', ['admin_id' => CLIENT_ID, 'trash' => '0'])->result();
                    foreach ($pages as $page) {
                        echo '<div class="form-check"><input type="checkbox" name="items[page][]" id="page_' . $page->id . '" value="' . $page->id . '">
                            <label for="page_' . $page->id . '">' . $page->page_name . '</label>
                            </div>';
                    }
                    ?>
                </div>
                <div class="card-footer">
                    <button type="submit" name="action" value="add-menu-item" class="btn btn-sm btn-success">Add</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Arrange Menu
            </div>
            <div class="card-body">
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable" style="width:100%">

                        <?php 

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

                            if ($data->parent == 0) {
                                $items[$data->id] = &$thisRef;
                            } else {
                                $ref[$data->parent]['child'][$data->id] = &$thisRef;
                            }
                        }

                        
                        if(count($items)){
                            echo get_menu($items);
                        }else{
                            echo '<div class="alert alert-danger">No Item Found.</div>';
                        }
                        
                        function get_menu($items, $class = 'dd-list')
                        {
                            $html = "<ol class=\"" . $class . "\" id=\"menu-id\">";

                            foreach ($items as $key => $value) {
                                $del_class = $value['page_id'] != 1 ? 'del-button' : '';

                                $html .= '<li id="item_'.$value['id'].'" class="dd-item dd3-item" data-id="' . $value['id'] . '" >
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content"><span id="label_show' . $value['id'] . '">' . $value['label'] . '</span> 
                                        <span class="span-right"><span id="link_show' . $value['id'] . '">' . ucwords($value['type']) . '</span> &nbsp;&nbsp; 
                                        <a class="SingleMenuSetting" onclick="SingleMenuSetting(' . $value['id'] . ')"><i class="fa fa-cog"></i></a>     
                                        <a class="' . $del_class . '" id="' . $value['id'] . '"><i class="fa fa-trash"></i></a></span> 
                                    </div>';

                                if (array_key_exists('child', $value)) {
                                    $html .= get_menu($value['child'], 'child');
                                }

                                $html .= "</li>";
                            }

                            $html .= "</ol>";

                            return $html;
                        }
                        
                        ?>
                    </div>
                </div>

                <input type="hidden" id="nestable-output">
            </div>
            <div class="card-footer">
                <a class="btn btn-sm btn-success" href="javascript:arrangeMenu();"><i class="fa fa-save"></i> Save</a>
            </div>
        </div>
    </div>
</div>
<script>
    function SingleMenuSetting(){
        alert('clicked setting');
    }
    function arrangeMenu(){
        var menus = $('#nestable-output').val();
        $.ajax({
            url:"<?php echo base_url('admin/menu'); ?>",
            type:"POST",
            data:{action:"arrange-menu",menus:menus},
            dataType:"JSON",
            success:function(res){
                if(res.status){
                    notify('success',res.msg);
                }
            }
        });
    }
</script>