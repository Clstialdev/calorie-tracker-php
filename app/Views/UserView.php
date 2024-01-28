<?php

namespace Manger\View;

require_once VIEWSDIR.DS.'utils'.DS.'global.php';

class UserView {

    function view_login(){
        start_stream();

        include TEMPLATESDIR.DS.'user'.DS.'login.php';

        return end_stream();
    }

}
