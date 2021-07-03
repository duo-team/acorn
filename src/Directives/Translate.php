<?php

namespace DuoTeam\Acorn\Directives;

use Illuminate\Support\Str;

class Translate
{
    /**
     * Invoke the @translate directive.
     *
     * @param string $expression
     *
     * @return string
     */
    public function __invoke(string $expression): string
    {
        $expression = $this->stripExpression($expression);
        $domain = get_theme_text_domain();

        return sprintf("<?= __(\"%s\", \"%s\"); ?>", $expression, $domain);
    }

    /**
     * Strip expression to simple string.
     *
     * @param string $expression
     * @return string
     */
    protected function stripExpression(string $expression): string
    {
        $expression = Str::of($expression);
        $toStrip = ['\'', '"'];
        $replaceWith = '';

        foreach ($toStrip as $search) {
            if ($expression->startsWith($search)) {
                $expression = $expression->replaceFirst($search, $replaceWith);
            }

            if ($expression->endsWith($search)) {
                $expression = $expression->replaceLast($search, $replaceWith);
            }
        }

        return $expression;
    }
}
