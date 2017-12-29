<?php

declare(strict_types=1);

namespace Doctrine\CodingStandard;

use PhpCsFixer\Config as PhpCsFixerConfig;

final class Config extends PhpCsFixerConfig
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__);

        $this->setRiskyAllowed(true);
        $this->setRules([
            '@DoctrineAnnotation' => true,
            '@PHP71Migration' => true,
            '@PHP71Migration:risky' => true,
            '@PHPUnit60Migration:risky' => true,
            '@Symfony' => true,
            '@Symfony:risky' => true,
            'align_multiline_comment' => ['comment_type' => 'all_multiline'],
            'array_syntax' => ['syntax' => 'short'],
            'binary_operator_spaces' => false,
            'blank_line_before_return' => false,
            'blank_line_before_statement' => true,
            'class_definition' => ['singleItemSingleLine' => true],
            'class_keyword_remove' => false,
            'combine_consecutive_issets' => false,
            'combine_consecutive_unsets' => false,
            'compact_nullable_typehint' => true,
            'concat_space' => ['spacing' => 'one'],
            'doctrine_annotation_array_assignment' => true,
            'doctrine_annotation_spaces' => true,
            'encoding' => true,
            'escape_implicit_backslashes' => true,
            'explicit_indirect_variable' => true,
            'explicit_string_variable' => true,
            'final_internal_class' => false,
            'general_phpdoc_annotation_remove' => false,
            'hash_to_slash_comment' => false,
            'header_comment' => false,
            'heredoc_to_nowdoc' => true,
            'linebreak_after_opening_tag' => true,
            'list_syntax' => true,
            'mb_str_functions' => false,
            'method_argument_space' => ['keep_multiple_spaces_after_comma' => true],
            'method_chaining_indentation' => true,
            'method_separation' => false,
            'native_function_invocation' => false,
            'no_blank_lines_before_namespace' => false,
            'no_extra_consecutive_blank_lines' => ['tokens' => ['break', 'continue', 'extra', 'return', 'throw', 'use', 'useTrait', 'curly_brace_block', 'parenthesis_brace_block', 'square_brace_block']],
            'no_multiline_whitespace_around_double_arrow' => false,
            'no_multiline_whitespace_before_semicolons' => false,
            'no_null_property_initialization' => true,
            'no_php4_constructor' => true,
            'no_short_echo_tag' => true,
            'no_superfluous_elseif' => true,
            'no_unneeded_control_parentheses' => true,
            'no_unreachable_default_argument_value' => true,
            'no_useless_else' => true,
            'no_useless_return' => true,
            'not_operator_with_space' => false,
            'not_operator_with_successor_space' => true,
            'ordered_class_elements' => ['order' => ['use_trait', 'constant_public', 'constant_protected', 'constant_private', 'property', 'construct', 'destruct', 'magic', 'phpunit', 'method']],
            'ordered_imports' => true,
            'php_unit_strict' => false,
            'php_unit_test_annotation' => true,
            'php_unit_test_class_requires_covers' => false,
            'phpdoc_add_missing_param_annotation' => false,
            'phpdoc_order' => true,
            'phpdoc_types_order' => true,
            'pow_to_exponentiation' => false,
            'pre_increment' => false,
            'psr0' => true,
            'random_api_migration' => true,
            'silenced_deprecation_error' => false,
            'simplified_null_return' => true,
            'single_line_comment_style' => true,
            'static_lambda' => false,
            'strict_comparison' => false,
            'strict_param' => true,
            'unary_operator_spaces' => false,
            'void_return' => false,
            'yoda_style' => false,
        ]);
    }
}
