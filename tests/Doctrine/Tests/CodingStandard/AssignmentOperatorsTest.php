<?php

declare(strict_types=1);

namespace Doctrine\Tests\CodingStandard;

/**
 * @runTestsInSeparateProcesses
 */
final class AssignmentOperatorsTest extends TestCase
{
    /**
     * @return (string|int)[]
     */
    protected function getExpectedErrors() : array
    {
        return [
            ['SlevomatCodingStandard.Operators.RequireCombinedAssignmentOperator.RequiredCombinedAssigmentOperator', 5],
            ['SlevomatCodingStandard.Operators.RequireCombinedAssignmentOperator.RequiredCombinedAssigmentOperator', 7],
            ['SlevomatCodingStandard.Operators.RequireCombinedAssignmentOperator.RequiredCombinedAssigmentOperator', 9],
            ['SlevomatCodingStandard.Operators.RequireCombinedAssignmentOperator.RequiredCombinedAssigmentOperator', 11],
        ];
    }
}
