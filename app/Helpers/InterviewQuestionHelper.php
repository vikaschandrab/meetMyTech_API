<?php

namespace App\Helpers;

class InterviewQuestionHelper
{
    public static function normalizeText(string $text): string
    {
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = preg_replace("/[ \\t]+/", " ", $text);
        $text = preg_replace("/\\n{3,}/", "\n\n", $text);
        return trim($text);
    }

    /**
     * @return array<int, array{question: string, answer: string|null}>
     */
    public static function extractPairs(string $text): array
    {
        $text = self::normalizeText($text);
        if ($text === '') {
            return [];
        }

        $blocks = preg_split("/\\n{2,}/", $text) ?: [];
        $pairs = [];

        foreach ($blocks as $block) {
            $block = trim($block);
            if ($block === '') {
                continue;
            }

            $lines = preg_split("/\\n/", $block) ?: [];
            $lines = array_values(array_filter(array_map('trim', $lines), fn ($line) => $line !== ''));

            if (empty($lines)) {
                continue;
            }

            $questionLines = [];
            $answerLines = [];
            $answerStarted = false;

            foreach ($lines as $line) {
                if (preg_match("/^(A|Answer)[:\\-]\\s*(.*)$/i", $line, $match)) {
                    $answerStarted = true;
                    $content = trim($match[2]);
                    if ($content !== '') {
                        $answerLines[] = $content;
                    }
                    continue;
                }

                if ($answerStarted) {
                    $answerLines[] = $line;
                    continue;
                }

                // Question line (supports multi-line question until Answer marker)
                if (preg_match("/^(Q|Question)[:\\-]\\s*(.*)$/i", $line, $match)) {
                    $content = trim($match[2]);
                    if ($content !== '') {
                        $questionLines[] = $content;
                    }
                    continue;
                }

                $questionLines[] = $line;
            }

            $question = trim(implode(' ', $questionLines));
            if ($question === '') {
                continue;
            }

            $answerText = trim(implode("\n", $answerLines));
            $answer = $answerText !== '' ? $answerText : null;

            $pairs[] = [
                'question' => $question,
                'answer' => $answer,
            ];
        }

        return $pairs;
    }
}
