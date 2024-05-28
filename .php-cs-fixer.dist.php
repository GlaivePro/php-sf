<?php

$finder = PhpCsFixer\Finder::create()->in([
	'src',
	'tests',
]);

return (new PhpCsFixer\Config)->setFinder($finder)
	->setIndent("\t")
	->setRiskyAllowed(true)
	->setLineEnding("\n")
	->setRules([
		'@PHP80Migration:risky' => true,
		'@PHP84Migration' => true,
        '@PER-CS2.0' => true,
        '@Symfony:risky' => true,
		'@Symfony' => true,

		// Overrides `@PHP80Migration:risky`
		'declare_strict_types' => false,

		// Overrides `@PHP84Migration`
		'nullable_type_declaration_for_default_null_value' => false,

		// Overrides `@Symfony:risky`
		'is_null' => false,

		// Overrides `@PER-CS2.0`
		'new_with_parentheses' => [
			'anonymous_class' => false,
			'named_class' => false,
		],
		'trailing_comma_in_multiline' => [
			'elements' => ['arrays', 'match', 'parameters'],
		],
		'control_structure_braces' => false,
		'concat_space' => [
			'spacing' => 'none',
		],

		// Overrides `@Symfony`
		'phpdoc_summary' => false,
		'ordered_imports' => false, //
		'global_namespace_import' => false,
		'single_line_throw' => false,
		// Disabled to allow no separation between interface/abstract methods
		'class_attributes_separation' => false,

		// Additional
		'single_line_empty_body' => true,
	]);

