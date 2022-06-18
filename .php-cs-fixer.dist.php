<?php

return JanaSeta\PhpCs\Fix::in([
    'src',
	'tests',
])->addRules([
	'@PHP81Migration' => true,
	'@PHP80Migration:risky' => true,
	'declare_strict_types' => false,
	'is_null' => false,
]);
