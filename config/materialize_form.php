<?php

return [
    'inputContainer' => '<div class="row"><div class="input-field col s12 {{type}}{{required}}">{{content}}</div></div>',
    'formGroup' => '{{input}}{{label}}',
    'file' => '<div class="file-field"><div class="btn"><span>' . __('Upload') . '</span><input type="file"></div> <div class="file-path-wrapper"><input class="file-path validate" name="{{name}}" {{attrs}}></div></div>'
];