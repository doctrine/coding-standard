<?php

declare(strict_types=1);

namespace Doctrine\Tests\CodingStandard;

/**
 * @runTestsInSeparateProcesses
 */
final class ExampleClassTest extends TestCase
{
    /**
     * @return (string|int)[]
     */
    protected function getExpectedErrors() : array
    {
        return [
            ['SlevomatCodingStandard.TypeHints.DeclareStrictTypes.IncorrectStrictTypesFormat', 3],
            ['SlevomatCodingStandard.Namespaces.AlphabeticallySortedUses.IncorrectlyOrderedUses', 8],
            ['SlevomatCodingStandard.Namespaces.UselessAlias.UselessAlias', 8],
            ['SlevomatCodingStandard.Commenting.DocCommentSpacing.IncorrectLinesCountBetweenDescriptionAndAnnotations', 14],
            ['SlevomatCodingStandard.Commenting.ForbiddenAnnotations.AnnotationForbidden', 14],
            ['SlevomatCodingStandard.Commenting.ForbiddenAnnotations.AnnotationForbidden', 15],
            ['Squiz.Classes.ClassFileName.NoMatch', 17],
            ['SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFullyQualifiedName', 17],
            ['SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFullyQualifiedName', 19],
            ['SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFallbackGlobalName', 19],
            ['SlevomatCodingStandard.TypeHints.NullTypeHintOnLastPosition.NullTypeHintNotOnLastPosition', 21],
            ['SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversableParameterTypeHintSpecification', 33],
            ['SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint', 33],
            ['SlevomatCodingStandard.TypeHints.NullableTypeForNullDefaultValue.NullabilitySymbolRequired', 33],
            ['SlevomatCodingStandard.Commenting.DocCommentSpacing.IncorrectLinesCountBetweenDescriptionAndAnnotations', 43],
            ['SlevomatCodingStandard.TypeHints.TypeHintDeclaration.UselessReturnAnnotation', 43],
            ['SlevomatCodingStandard.TypeHints.ReturnTypeHintSpacing.WhitespaceAfterNullabilitySymbol', 45],
            ['SlevomatCodingStandard.TypeHints.ReturnTypeHintSpacing.IncorrectWhitespaceBeforeColon', 45],
            ['Squiz.WhiteSpace.FunctionSpacing.After', 48],
            ['SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversableReturnTypeHintSpecification', 52],
            ['SlevomatCodingStandard.TypeHints.ReturnTypeHintSpacing.NoSpaceBetweenColonAndTypeHint', 54],
            ['SlevomatCodingStandard.TypeHints.ReturnTypeHintSpacing.IncorrectWhitespaceBeforeColon', 54],
            ['SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFallbackGlobalName', 56],
            ['SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFullyQualifiedName', 57],
            ['SlevomatCodingStandard.PHP.ShortList.LongListUsed', 62],
            ['Generic.Formatting.SpaceAfterNot.Incorrect', 72],
            ['SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFullyQualifiedName', 73],
            ['SlevomatCodingStandard.Namespaces.ReferenceUsedNamesOnly.ReferenceViaFullyQualifiedName', 76],
            ['SlevomatCodingStandard.Variables.UselessVariable.UselessVariable', 81],
            ['Squiz.WhiteSpace.FunctionSpacing.AfterLast', 89],
            ['PSR2.Classes.ClassDeclaration.CloseBraceAfterBody', 91],
            ['SlevomatCodingStandard.Classes.EmptyLinesAroundClassBraces.IncorrectEmptyLinesBeforeClosingBrace', 91],
        ];
    }

    /**
     * @return string[]
     */
    protected function getImplicitlyIgnoredSniffs() : array
    {
        return [];
    }
}
