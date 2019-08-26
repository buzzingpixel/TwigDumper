<?php

declare(strict_types=1);

namespace BuzzingPixel\TwigDumper;

use Symfony\Component\VarDumper\VarDumper;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use function call_user_func;
use function func_get_arg;
use function func_num_args;

class TwigDumper extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return [new TwigFunction('dump', [$this, 'dump'], [
            'needs_context' => true,
            'needs_environment' => true,
        ]),
        ];
    }

    /**
     * @param mixed[] $context
     */
    public function dump(Environment $env, array $context) : void
    {
        if (! $env->isDebug()) {
            return;
        }

        $varDumper = VarDumper::class;

        $count = func_num_args();

        if ($count !== 2) {
            for ($i = 2; $i < $count; ++$i) {
                call_user_func($varDumper . '::dump', func_get_arg($i));
            }

            return;
        }

        $vars = [];

        /** @psalm-suppress MixedAssignment */
        foreach ($context as $key => $value) {
            $vars[$key] = $value;
        }

        call_user_func($varDumper . '::dump', $vars);
    }
}
