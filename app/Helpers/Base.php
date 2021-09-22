<?php

use Illuminate\Support\Facades\URL;

if (!function_exists('menuOrder')) {
    function menuOrder($menus, $sub = 0, $parent = null)
    {
        foreach ($menus as $menu) {
            if ($menu['title'] != null && $menu['parent'] == $parent && $sub < 20) { ?>
                <tr>
                    <td><?php echo str_repeat("-", $sub) . $menu['order'] ?></td>
                    <td><?php echo str_repeat("-", $sub) . $menu['title'] . " " . html_entity_decode($menu['icon']) ?></td>
                    <td><?php echo $menu['link'] ?></td>
                    <td>
                        <a href="<?php echo URL::to('/') . "/admin/option/menu/" . $menu['id'] . "/edit" ?>" title="Kurtar" class="btn btn-primary btn-xs"><i class="fas fa-pen"></i></a>
                        <a href="<?php echo URL::to('/') . "/admin/option/menu/delete/" . $menu['id'] ?>" onclick="validate(<?php echo $menu['id'] ?>)" title="Tamamen Sil" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                    </td>
                </tr>
<?php
                menuOrder($menus, $sub + 2, $menu['id']);
            } else {
                //return false;
            }
        }
    }
}

if (!function_exists('delete_files')) {
    function delete_files($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

            foreach ($files as $file) {
                delete_files($file);
            }
        } elseif (is_file($target)) {
            unlink($target);
        }
    }
}
