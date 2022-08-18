<?php

return [

    /*
     * To inject the 'nova-impersonate::reverse' view in every route when impersonating
     */
    'enable_middleware' => true,

    /*
     * register the route for unimpersonate automatically
     */
    'enable_routes' => true,
];
