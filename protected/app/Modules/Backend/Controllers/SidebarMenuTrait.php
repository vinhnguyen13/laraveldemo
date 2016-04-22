<?php namespace App\Modules\Backend\Controllers;

use App\Libs\Utils\Vii;

use Request;

trait SidebarMenuTrait{
    
    public function createMenu(){
        $menu = [
            [
                'id' => '1',
                'text' => 'Admin Management',
                'url' => '#',
                'params' => [],
                'icon' => "<i class='fa fa-tasks'></i>",
                'level-icon' => "<i class='fa fa-angle-left pull-right'></i>",
                'children' => [
                    [
                        'id' => '11',
                        'text' => 'Create User',
                        'url' => '#',//'admin/user/create',
                        'params' => [],
                        'icon' => "<i class='fa fa-user-plus'></i>",
                        'level-icon' => "",
                        'children' => []
                    ]
                ]
            ],
            
            [
                'id' => '2',
                'text' => 'Menu',
                'url' => 'admin/menu/category',
                'params' => [],
                'icon' => "<i class='fa fa-th-list'></i>",
                'level-icon' => "<i class='fa fa-angle-left pull-right'></i>",
                'children' => [
                    
                ]
            ],
            
            [
                'id' => '3',
                'text' => 'Giới Thiệu Chung',
                'url' => '#',
                'params' => [],
                'icon' => "<i class='fa fa-info'></i>",
                'level-icon' => "<i class='fa fa-angle-left pull-right'></i>",
                'children' => [
                    
                ]
            ],
            
            [
                'id' => '4',
                'text' => 'Lancaster Lê Thánh Tôn',
                'url' => '#',
                'params' => [],
                'icon' => "<i class='fa fa-location-arrow'></i>",
                'level-icon' => "<i class='fa fa-angle-left pull-right'></i>",
                'children' => [
                    [
                        'id' => '41',
                        'text' => 'Giới Thiệu',
                        'url' => '#',
                        'params' => ['bldid' => 1],
                        'icon' => "<i class='fa fa-angle-double-right'></i>",
                        'level-icon' => "",
                        'children' => []
                    ],
                    [
                        'id' => '42',
                        'text' => 'Căn Hộ',
                        'url' => '#',
                        'params' => ['bldid' => 1],
                        'icon' => "<i class='fa fa-angle-double-right'></i>",
                        'level-icon' => "",
                        'children' => []
                    ],
                    [
                        'id' => '43',
                        'text' => 'Tiện Nghi Chung',
                        'url' => '#',
                        'params' => ['bldid' => 1],
                        'icon' => "<i class='fa fa-angle-double-right'></i>",
                        'level-icon' => "",
                        'children' => []
                    ],
                    [
                        'id' => '44',
                        'text' => 'Tiện Ích Xung Quanh',
                        'url' => '#',
                        'params' => ['bldid' => 1],
                        'icon' => "<i class='fa fa-angle-double-right'></i>",
                        'level-icon' => "",
                        'children' => []
                    ],
                    [
                        'id' => '45',
                        'text' => 'Giá Cả',
                        'url' => '#',
                        'params' => ['bldid' => 1],
                        'icon' => "<i class='fa fa-angle-double-right'></i>",
                        'level-icon' => "",
                        'children' => []
                    ],
                    [
                        'id' => '46',
                        'text' => 'Location',
                        'url' => '#',
                        'params' => ['bldid' => 1],
                        'icon' => "<i class='fa fa-angle-double-right'></i>",
                        'level-icon' => "",
                        'children' => []
                    ]
                ]
            ],
            
            [
                'id' => '5',
                'text' => 'Lancaster Quận 4',
                'url' => '#',
                'params' => [],
                'icon' => "<i class='fa fa-location-arrow'></i>",
                'level-icon' => "<i class='fa fa-angle-left pull-right'></i>",
                'children' => [
                    
                ]
            ],
                        
            [
                'id' => '6',
                'text' => 'Lancaster Nguyễn Trãi',
                'url' => '#',//'admin/setting',
                'params' => [],
                'icon' => "<i class='fa fa-location-arrow'></i>",
                'level-icon' => "<i class='fa fa-angle-left pull-right'></i>",
                'children' => []
            ],
            
            [
                'id' => '7',
                'text' => 'Lancaster Hà Nội',
                'url' => '#',//'admin/setting',
                'params' => [],
                'icon' => "<i class='fa fa-location-arrow'></i>",
                'level-icon' => "<i class='fa fa-angle-left pull-right'></i>",
                'children' => []
            ],
            
            [
                'id' => '8',
                'text' => 'News',
                'url' => 'admin/content',//'admin/setting',
                'params' => [],
                'icon' => "<i class='fa fa-newspaper-o'></i>",
                'level-icon' => "",
                'children' => []
            ],
            
            [
                'id' => '9',
                'text' => 'Contact',
                'url' => 'admin/contact',
                'params' => [],
                'icon' => "<i class='fa fa-phone'></i>",
                'level-icon' => "",
                'children' => []
            ]
            
        ];
        
        return $this->renderMenu($menu);
    }
    
    protected function renderMenu($menu=[]){
        $html = '';
        
        if(!empty($menu)){
            foreach($menu as $k => $item){
                //$item['id'] = strval($k+1);
                $pid = $k + 1;
                $item['id'] = hash('crc32', $pid);
                $pa = '';
                $child = $this->childMenu($item['children'], $pid, $pa, 1);
                if($child == ''){
                    $query_string = Vii::queryStringBuilder(['mid' => $item['id']]);
                    $_active = '';
                    if(strval(Request::input('mid')) == $item['id']){
                        $_active = 'active';
                    }
                    $html .= "<li class='$_active'>";
                    if($item['url'] != '#' && $item['url'] != ''){
                        $html .= "<a href='".url($item['url'], $item['params']) . $query_string . "'>";
                    }
                    else{
                        $html .= "<a href='#'>";
                    }
                    
                    $html .= $item['icon'] . "<span>" . $item['text'] . "</span>";
                    $html .= "</a>";
                    $html .= "</li>";
                }
                else{
                    $html .= "<li class='treeview $pa'>";
                    $html .= "<a href='".url($item['url'])."'>";
                    $html .= $item['icon'] . "<span>" . $item['text'] . "</span>" . $item['level-icon'];
                    $html .= "</a>";
                    $html .= $child;
                    $html .= "</li>";
                }
            }
        }
        
        return $html;
        
    }
    
    protected function childMenu($children=[], $parent_id, &$parent_active='', $h=1){
        if(empty($children))
            return '';
        
        $html = '';
        foreach($children as $k => $item){
            
            //$item['id'] = $parent_id . ($k+1);
            $cid = $parent_id . ($k + 1);
            $item['id'] = hash('crc32', $cid);
            $query_string = '';
            if(empty($item['children'])){
                //$item['params']['mid'] = $item['id'];
                $query_string = Vii::queryStringBuilder(['mid' => $item['id']]);
            }
            
            $_active = '';
            if(strval(Request::input('mid')) == $item['id']){
                $_active = 'active';
                $parent_active = 'active';
            }
            $pa = '';
            $html .= "<li class='$_active'>";
            if($item['url'] != '#' && $item['url'] != ''){
                $html .= "<a href='".url($item['url'], $item['params']) . $query_string . "'>";
            }
            else{
                $html .= "<a href='#'>";
            }
            $html .= $item['icon'] . "<span>" . $item['text'] . "</span>";
            if(!empty($item['children']))
                $html .= $item['level-icon'];
            $html .= "</a>";
            $html .= $this->childMenu($item['children'], $cid, $pa, $h + 1);
            $html .= "</li>";
        }
        
        return "<ul class='treeview-menu $pa'>$html</ul>";
    }
}