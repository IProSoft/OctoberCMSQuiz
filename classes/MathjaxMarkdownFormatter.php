<?php namespace Ips\Quiz\Classes;

use October\Rain\Support\Markdown;

class MathjaxMarkdownFormatter
{
    private static function Replace($input, $pattern, $replacement)
    {
        return preg_replace($pattern, $replacement, $input);
    }

    public static function Format($input)
    {
        // Replace $$...$$, $...$, \begin{align}...\end{align},
        // \begin{equation}..\end{equation} and similar contrcucts
        // with dummy "html"-tags. Parsedown will not parse
        // Markdown inside block-level tags. Apparantly non-existing
        // tags are interpreted as block-level.

        //$input = self::Replace($input, '@\$\$(.*)\$\$@', '<math-display>$1</math-display>');
        //$input = self::Replace($input, '@\$(.*)\$@', '<math-inline>$1</math-inline>');

        $result = Markdown::parse(trim($input));

        //$result = self::Replace($result, '@<math-inline>(.*)</math-inline>@', '\$$1\$');
        //$result = self::Replace($result, '@<math-display>(.*)</math-display>@', '\$\$$1\$\$');
        return $result;
    }
}