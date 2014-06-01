<?php

namespace Snailfinder\Adapter;

use League\Flysystem\Adapter\Local as FlysystemLocalAdapter;

class Local extends FlysystemLocalAdapter {
    
    public function getLine($stream) {
        return fgets($stream, 4096);
    }
    
}
