<?php

use Zend\Config\Factory as ConfigFactory;

return ConfigFactory::fromFiles(
    glob('config/autoload/{{,*.}global,{,*.}local}.php', GLOB_BRACE)
);

