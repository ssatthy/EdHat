<?php
return array(
    '0' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Student',
        'bizRule' => null,
        'data' => null
    ),
    '1' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Professor',
        'children' => array(
            'guest', 
        ),
        'bizRule' => null,
        'data' => null
    ),
    '2' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'IntSupervisor',
        'children' => array(
            'user',          
        ),
        'bizRule' => null,
        'data' => null
    ),
    '3' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'ExtSupervisor',
        'children' => array(
            'moderator',        
        ),
        'bizRule' => null,
        'data' => null
    ),
);