<?php


namespace App\Domain;

use Importer;

class Exam
{
    /** @var string */
    private $fullPathExcelSheet;

    /** @var integer */
    private $numberOfQuestions;

    /** @var float */
    private $maxScore;

    /** @var array */
    private $studentResults;

    /**
     * Exam constructor.
     * @param string $fullPathExcelSheet
     */
    public function __construct($fullPathExcelSheet)
    {
        $this->fullPathExcelSheet = $fullPathExcelSheet;
        $this->parseExcel();
        $this->calulateResults();
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return [
            'studentResults' => $this->studentResults
        ];
    }

    private function parseExcel()
    {
        $parsedExcel = Importer::make('Excel')->load($this->fullPathExcelSheet)->getCollection();

        $this->numberOfQuestions = sizeof($parsedExcel[0]) - 1;
        $this->setMaxScore($parsedExcel);
        $this->setStudentResult($parsedExcel);
    }

    private function calulateResults()
    {
        /** @var float */
        $caesura = $this->maxScore * .7;

        foreach ($this->studentResults as $student => $result) {
            $this->studentResults[$student]['passed'] = ($this->studentResults[$student]['points'] >= $caesura);
            $percentageOfMaximum = ($this->studentResults[$student]['points'] / $this->maxScore) * 100;
            switch (true) {
                case ($percentageOfMaximum <= 20):
                    $this->studentResults[$student]['grade'] = 1.0;
                    break;
                case ($percentageOfMaximum <= 70):
                    $this->studentResults[$student]['grade'] =
                        round(1.0 + 4.5 * $this->studentResults[$student]['points'] / $caesura, 1);
                    break;
                default:
                    $this->studentResults[$student]['grade'] =
                        round(5.5 + 4.5 * ($this->studentResults[$student]['points'] - $caesura) / ($this->maxScore - $caesura),
                            1);
            }
        }
    }

    /**
     * @param $parsedExcel
     */
    private function setMaxScore($parsedExcel)
    {
        for ($col = 1; $col <= $this->numberOfQuestions; $col++) {
            $this->maxScore += $parsedExcel[1][$col];
        }
    }

    /**
     * @param $parsedExcel
     */
    private function setStudentResult($parsedExcel): void
    {
        for ($row = 2; $row < sizeof($parsedExcel); $row++) {
            $this->studentResults[$parsedExcel[$row][0]]['points'] = 0;
            for ($col = 1; $col <= $this->numberOfQuestions; $col++) {
                $this->studentResults[$parsedExcel[$row][0]]['points'] += $parsedExcel[$row][$col];
            }
        }
    }
}
