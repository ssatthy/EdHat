<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 echo '<h2>Notifications</h2>';
 for($i=0;$i<count($notifications);$i++){
     echo '<li>'.CHtml::link($assignments[$i]->assign_name,
             array('assignment/view','id'=>$assignments[$i]->id)). '  has been evaluated  </li>';
 }
?>
