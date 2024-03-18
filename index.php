<?php
require_once('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Directory containing the images
$imageDirectory = 'SERC';

// Get all files (images) in the directory
$imageFiles = scandir($imageDirectory);

// Remove . and .. from the list
$imageFiles = array_diff($imageFiles, array('.', '..'));

// Initialize an array to store image names
$imageNames = [];

// Iterate through the image files
foreach ($imageFiles as $imageFile) {
  // Add the image name to the array
  $imageNames[] = $imageFile;
}

// Create a new Excel spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header
$sheet->setCellValue('A1', 'Image Name');

// Write image names to Excel
$row = 2;
foreach ($imageNames as $imageName) {
  $sheet->setCellValue('A' . $row, $imageName);
  $row++;
}

// Save the Excel file
$writer = new Xlsx($spreadsheet);
$excelFilename = 'image_names.xlsx';
$writer->save($excelFilename);

echo "Image names have been written to $excelFilename";
