<?php

namespace App\Services;

use App\Helpers\InterviewQuestionHelper;
use App\Models\InterviewQuestion;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use Smalot\PdfParser\Parser as PdfParser;

class InterviewQuestionImportService
{
    /**
     * @return array{created: int, skipped: int}
     */
    public function importFromUploadedFile(UploadedFile $file, int $userId, string $level, ?string $category): array
    {
        $path = $file->store('imports/interview-questions');
        $fullPath = Storage::path($path);
        $extension = strtolower($file->getClientOriginalExtension());

        $text = match ($extension) {
            'pdf' => $this->extractTextFromPdf($fullPath),
            'doc', 'docx' => $this->extractTextFromWord($fullPath),
            'txt' => file_get_contents($fullPath) ?: '',
            default => '',
        };

        $pairs = InterviewQuestionHelper::extractPairs($text);

        $created = 0;
        $skipped = 0;

        foreach ($pairs as $pair) {
            $question = trim($pair['question']);
            $answer = $pair['answer'] ? trim($pair['answer']) : null;

            if ($question === '' || strlen($question) < 5) {
                $skipped++;
                continue;
            }

            InterviewQuestion::create([
                'user_id' => $userId,
                'question' => $question,
                'answer' => $answer,
                'level' => $level,
                'category' => $category,
            ]);
            $created++;
        }

        return ['created' => $created, 'skipped' => $skipped];
    }

    private function extractTextFromPdf(string $path): string
    {
        $parser = new PdfParser();
        $pdf = $parser->parseFile($path);
        return $pdf->getText();
    }

    private function extractTextFromWord(string $path): string
    {
        $phpWord = WordIOFactory::load($path);
        $text = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                $text .= $this->extractFromElement($element) . "\n";
            }
        }

        return $text;
    }

    private function extractFromElement($element): string
    {
        if (is_object($element)) {
            if (method_exists($element, 'getText')) {
                return (string) $element->getText();
            }

            if ($element instanceof Table) {
                $tableText = '';
                foreach ($element->getRows() as $row) {
                    foreach ($row->getCells() as $cell) {
                        $tableText .= $this->extractFromContainer($cell) . "\n";
                    }
                }
                return $tableText;
            }

            if ($element instanceof AbstractContainer) {
                return $this->extractFromContainer($element);
            }
        }

        return '';
    }

    private function extractFromContainer(AbstractContainer $container): string
    {
        $text = '';
        foreach ($container->getElements() as $child) {
            $text .= $this->extractFromElement($child) . "\n";
        }
        return $text;
    }
}
