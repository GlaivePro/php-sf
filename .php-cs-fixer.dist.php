<?php

return JanaSeta\PhpCs\Fix::in([
        'src',
	'tests',
])->addRules([
	'@PHP81Migration' => true,
]);
