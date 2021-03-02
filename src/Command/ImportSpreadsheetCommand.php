<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Repository\GebruikerRepository;


class ImportSpreadsheetCommand extends Command
{
    protected $gebruiker;

    public function __construct(GebruikerRepository $gebruiker) {
        parent::__construct();
        $this->gebruiker = $gebruiker;
    }

    protected function configure()
    {
        $this
            ->setName('app:import-spreadsheet')
            ->setDescription('Import Excel Spreadsheet')
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('file', InputArgument::REQUIRED, 'Spreadsheet')
        ;
    }

    protected function execute(InputInterface $input,
                                OutputInterface $output)
    {
        $inputFilename = $input->getArgument('file');
        $spreadsheet = IOFactory::load($inputFilename);
        $row = $spreadsheet->getActiveSheet()->removeRow(1);

        $sheetdata = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach($sheetdata as $row)
        {
            if(!$row['A']) {
                die();
            }
            $params = [
            'naam' => $row['A'],
            'email' => $row['B'],
            'password' => 'test',
            'roles' => ["ROLE_BEDRIJF"],
            'adres' => $row['C'],
            'postcode' => $row['D'],
            'woonplaats' => $row['E'],
            'telefoonnummer' => $row['F'],
            'gebruikerBeschrijving' => $row['G']
            ];

            $gebruiker = $this->gebruiker->saveGebruiker($params);

            $output->writeln("");
            $output->writeln("Nieuwe gebuiker:");
            $output->writeln($params['naam']);
        }

    }
}