<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // æ•°æ�®åº“ç±»åž‹
    'type'            => 'mysql',
    // æœ�åŠ¡å™¨åœ°å�€
    'hostname'        => '127.0.0.1',
    // æ•°æ�®åº“å��
    'database'        => 'inventory',
    // ç”¨æˆ·å��
    'username'        => 'root',
    // å¯†ç �
    'password'        => '123456',
    // ç«¯å�£
    'hostport'        => '3306',
    // è¿žæŽ¥dsn
    'dsn'             => '',
    // æ•°æ�®åº“è¿žæŽ¥å�‚æ•°
    'params'          => [],
    // æ•°æ�®åº“ç¼–ç �é»˜è®¤é‡‡ç”¨utf8
    'charset'         => 'utf8',
    // æ•°æ�®åº“è¡¨å‰�ç¼€
    'prefix'          => 'inventory_',
    // æ•°æ�®åº“è°ƒè¯•æ¨¡å¼�
    'debug'           => true,
    // æ•°æ�®åº“éƒ¨ç½²æ–¹å¼�:0 é›†ä¸­å¼�(å�•ä¸€æœ�åŠ¡å™¨),1 åˆ†å¸ƒå¼�(ä¸»ä»Žæœ�åŠ¡å™¨)
    'deploy'          => 0,
    // æ•°æ�®åº“è¯»å†™æ˜¯å�¦åˆ†ç¦» ä¸»ä»Žå¼�æœ‰æ•ˆ
    'rw_separate'     => false,
    // è¯»å†™åˆ†ç¦»å�Ž ä¸»æœ�åŠ¡å™¨æ•°é‡�
    'master_num'      => 1,
    // æŒ‡å®šä»Žæœ�åŠ¡å™¨åº�å�·
    'slave_no'        => '',
    // è‡ªåŠ¨è¯»å�–ä¸»åº“æ•°æ�®
    'read_master'     => false,
    // æ˜¯å�¦ä¸¥æ ¼æ£€æŸ¥å­—æ®µæ˜¯å�¦å­˜åœ¨
    'fields_strict'   => true,
    // æ•°æ�®é›†è¿”å›žç±»åž‹
    'resultset_type'  => 'array',
    // è‡ªåŠ¨å†™å…¥æ—¶é—´æˆ³å­—æ®µ
    'auto_timestamp'  => false,
    // æ—¶é—´å­—æ®µå�–å‡ºå�Žçš„é»˜è®¤æ—¶é—´æ ¼å¼�
    'datetime_format' => 'Y-m-d H:i:s',
    // æ˜¯å�¦éœ€è¦�è¿›è¡ŒSQLæ€§èƒ½åˆ†æž�
    'sql_explain'     => false,
];