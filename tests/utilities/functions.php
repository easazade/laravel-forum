<?php

function create($class, $attrs = []) {
    return factory($class)->create($attrs);
}

function make($class, $attrs = []) {
    return factory($class)->make($attrs);
}
