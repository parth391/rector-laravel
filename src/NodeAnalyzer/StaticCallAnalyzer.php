<?php

declare(strict_types=1);

namespace RectorLaravel\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\StaticCall;
use Rector\NodeNameResolver\NodeNameResolver;

final readonly class StaticCallAnalyzer
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver
    ) {}

    public function isParentCallNamed(Node $node, string $desiredMethodName): bool
    {
        if (! $node instanceof StaticCall) {
            return false;
        }

        if ($node->class instanceof Expr) {
            return false;
        }

        if (! $this->nodeNameResolver->isName($node->class, 'parent')) {
            return false;
        }

        if ($node->name instanceof Expr) {
            return false;
        }

        return $this->nodeNameResolver->isName($node->name, $desiredMethodName);
    }
}
